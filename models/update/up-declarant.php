<?php
include_once('../../connexion/connexion.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' )
{
    $numero=$_GET['numero'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $telephone=htmlspecialchars($_POST['telephone']);
     if(!is_numeric($telephone) && strlen($telephone)!=10)
    {
        $_SESSION['notif']="numero incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/declarant.php');
    }
    else if(strlen($telephone)!=10)
    {
        $_SESSION['notif']="nombre de chiffre  du numero est incorrect";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/declarant.php');
    }
    else
    {
        $sel=$connexion->prepare("SELECT * from declarant where  telephone=? and numero!=? and supprimer=0 ");
        $sel->execute(array($telephone,$numero));
        if($exist=$sel->fetch())
        {
            $_SESSION['notif']="Le declarant existe déjà";
            $_SESSION['color']='danger';
            $_SESSION['icon']="x-circle-fill";
            header("location:../../views/declarant.php?id=$id");
        }
        else
        {
            $req=$connexion->prepare("UPDATE declarant SET nom=?,postnom=?,prenom=?,genre=?,telephone=? where  numero=?");
            $req->execute(array($nom,$postnom,$prenom,$genre,$telephone,$numero)); 

            if($req){
                
                $_SESSION['notif']="Modification reussie";
                $_SESSION['color']='success';
                $_SESSION['icon']="check-circle-fill";
                header('location:../../views/declarant.php');
            }
        }
    }
  
}

?>
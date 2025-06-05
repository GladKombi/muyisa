<?php 
include('../../connexion/connexion.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $telephone=htmlspecialchars($_POST['telephone']);
    $numero="";
    if(!is_numeric($telephone))
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
        
        $sel=$connexion->prepare("SELECT * from declarant where telephone=? and supprimer=0 ");
        $sel->execute(array($telephone));
        if($exist=$sel->fetch())
        {
            $_SESSION['notif']="ce  declarant  existe déjà";
            $_SESSION['color']='danger';
            $_SESSION['icon']="x-circle-fill";
            echo strlen($telephone);
            header('location:../../views/declarant.php');
        }
        else
        {

                $sellastdeclarant=$connexion->prepare("SELECT * from declarant order by numero desc  limit 1");
                $sellastdeclarant->execute();
                if($lastdeclarant=$sellastdeclarant->fetch())
                {
                    $numero="DE".sprintf('%04d', substr($lastdeclarant['numero'],2)+1);
                }
                else 
                {
                    $numero="DE0001";
                }
                echo $numero;
                $req=$connexion->prepare("INSERT INTO declarant (numero,nom,postnom,prenom,genre,telephone) values (?,?,?,?,?,?)");
                $req->execute(array($numero,$nom,$postnom,$prenom,$genre,$telephone)); 
                if($req){
                    $_SESSION['notif']="Enregistrement reussi";
                    $_SESSION['color']='success';
                    $_SESSION['icon']="check-circle-fill";
                    header('location:../../views/declarant.php');
                }
        }
    }
   
                
}

?>
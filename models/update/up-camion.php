<?php
include_once('../../connexion/connexion.php');
if(isset($_POST['valider']))

{
    $id=$_GET['id'];
   
    $plaque=strtoupper(htmlspecialchars($_POST['plaque']));
    $sel=$connexion->prepare("SELECT * from camion  where  id!=? and plaque=? ");
    $sel->execute(array($id,$plaque));
   if($exist=$sel->fetch())
    {
        $_SESSION['notif']="ce camion existe deja ";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header("location:../../views/camion.php?id=$id");
    }
    else
    {
        $req=$connexion->prepare("UPDATE  camion  SET plaque=? where id=?");
        $req->execute(array($plaque,$id)); 
         if($req)
         {
            $_SESSION['notif']="modification  reussie";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header('location:../../views/camion.php');
        }
    }
}



?>
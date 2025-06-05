<?php 
include('../../connexion/connexion.php');


if (isset($_POST["valider"])) 
{
    
    $plaque=strtoupper(htmlspecialchars($_POST['plaque']));
   
    $sel=$connexion->prepare("SELECT * from camion where plaque=? and supprimer=0");
    $sel->execute(array($plaque));
    if($exist=$sel->fetch())
    {
        $_SESSION['notif']="ce  camion  existe déjà";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x-circle-fill";
        header('location:../../views/camion.php');
    }
    else
    {
          
        $req=$connexion->prepare("INSERT INTO camion (plaque) values (?)");
        $req->execute(array($plaque)); 
        if($req)
        {
             $_SESSION['notif']="Enregistrement reussi";
             $_SESSION['color']='success';
             $_SESSION['icon']="check-circle-fill";
             header('location:../../views/camion.php');
        }
               
         
    }
                
}

?>
<?php 
include('../../connexion/connexion.php');


if (isset($_POST["valider"])) 
{
    $dates=date('Y-m-d');
    $camion=strtoupper(htmlspecialchars($_POST['camion']));
    $commande=strtoupper(htmlspecialchars($_POST['commande']));
    $req=$connexion->prepare("INSERT INTO chargement (dates,camion,commande) values (?,?,?)");
        $req->execute(array($dates,$camion,$commande)); 
        if($req)
        {
             $_SESSION['notif']="Enregistrement reussi";
             $_SESSION['color']='success';
             $_SESSION['icon']="check-circle-fill";
             header('location:../../views/chargement.php');
        }
               
         
    
                
}

?>
<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $commande=$_GET['idcom'];
    $dates=date("Y-m-d");
    $quantite_essence_prevu=$_GET['quantite_essence'];
    $quantite_mazout_prevu=$_GET['quantite_mazout'];
    $quantite_essence=htmlspecialchars($_POST['quantite_essence']);
    $quantite_mazout=htmlspecialchars($_POST['quantite_mazout']);

    $reste_essence=$quantite_essence_prevu-$quantite_essence;
    $reste_mazout=$quantite_mazout_prevu-$quantite_mazout;
   
    $req=$connexion->prepare("INSERT INTO nonlivrer (dates,commande,quantite_essence,quantite_mazout) values (?,?,?,?)");
    $req->execute(array($dates,$commande,$reste_essence,$reste_mazout)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/non_livrer.php');
    }
 }


?>
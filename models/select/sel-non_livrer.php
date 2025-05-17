<?php

 $date=date("Y-m-d");
// $date=date("2025-04-27");

$sel_commande=$connexion->prepare("SELECT client.nom,client.postnom,client.prenom,commande.*  from commande,client where client.numero=commande.client and commande.supprimer=0 and commande.dates=?");
$sel_commande->execute(array($date));

$message="";

$SelData=$connexion->prepare("SELECT nonlivrer.*,client.nom,client.postnom,client.prenom,client.numero,commande.numfacture  from nonlivrer,client,commande where nonlivrer.commande=commande.id and client.numero=commande.client and nonlivrer.supprimer=0");
$SelData->execute();



if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT client.nom,client.postnom,client.prenom,nonlivrer.*,commande.numfacture from client,commande,nonlivrer where  commande.client=client.numero and commande.id=nonlivrer.commande and  nonlivrer.id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}


?>
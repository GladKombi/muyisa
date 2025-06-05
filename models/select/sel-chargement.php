<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-chargement.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier chargement";
    
    $req=$connexion->prepare("SELECT * from chargement where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT chargement.dates,chargement.id,camion.plaque as camion,commande_ap.id,commande_ap.dates as datecom,commande_ap.numcommande,fournisseur.prenom,panier_ap.type,panier_ap.quantite,panier_ap.prixunitaire from commande_ap,fournisseur,panier_ap,chargement,camion where chargement.commande=commande_ap.id and chargement.camion=camion.id and  commande_ap.id=panier_ap.commande and commande_ap.fournisseur=fournisseur.id and chargement.id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-chargement.php";
    $bouton="Enregistrer";
    $titre="Ajouter chargement";

}

$SelData=$connexion->prepare("SELECT chargement.dates,chargement.id,camion.plaque as camion,commande_ap.dates as datecom,commande_ap.numcommande,fournisseur.prenom,panier_ap.type,panier_ap.quantite,panier_ap.prixunitaire from commande_ap,fournisseur,panier_ap,chargement,camion where chargement.commande=commande_ap.id and chargement.camion=camion.id and  commande_ap.id=panier_ap.commande and commande_ap.fournisseur=fournisseur.id and chargement.supprimer=0 order by chargement.id desc");
$SelData->execute();


$SelCam=$connexion->prepare("SELECT * from camion where supprimer=0");
$SelCam->execute();

$SelCom=$connexion->prepare("SELECT commande_ap.id,commande_ap.dates,commande_ap.numcommande,fournisseur.prenom,panier_ap.type,panier_ap.quantite,panier_ap.prixunitaire from commande_ap,fournisseur,panier_ap where commande_ap.id=panier_ap.commande and commande_ap.fournisseur=fournisseur.id and commande_ap.supprimer=0 and (commande_ap.id) not in (SELECT commande from chargement where supprimer=0) order by commande_ap.id desc ");
$SelCom->execute();
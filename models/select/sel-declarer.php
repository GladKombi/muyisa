<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-declarer.php?id=$id";
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
    $action="../models/add/add-declarer.php";
    $bouton="Enregistrer";
    $titre="Ajouter chargement";

}

$SelData=$connexion->prepare("SELECT declarer.*,declarant.nom,declarant.postnom,declarant.prenom,chargement.dates,camion.plaque as camion,commande_ap.dates as datecom,commande_ap.numcommande,fournisseur.prenom as fournisseur,panier_ap.type,panier_ap.quantite,panier_ap.prixunitaire from commande_ap,fournisseur,panier_ap,chargement,camion,declarer,declarant where declarer.declarant=declarant.numero and declarer.chargement=chargement.id and  chargement.commande=commande_ap.id and chargement.camion=camion.id and  commande_ap.id=panier_ap.commande and commande_ap.fournisseur=fournisseur.id and declarer.supprimer=0 order by declarer.id desc");
$SelData->execute();


$SelDec=$connexion->prepare("SELECT * from declarant where supprimer=0");
$SelDec->execute();

$SelCha=$connexion->prepare("SELECT chargement.dates,chargement.id,camion.plaque as camion,commande_ap.dates as datecom,commande_ap.numcommande,fournisseur.prenom,panier_ap.type,panier_ap.quantite,panier_ap.prixunitaire from commande_ap,fournisseur,panier_ap,chargement,camion where chargement.commande=commande_ap.id and chargement.camion=camion.id and  commande_ap.id=panier_ap.commande and commande_ap.fournisseur=fournisseur.id and (chargement.id) not in (SELECT chargement from declarer where supprimer=0) and chargement.supprimer=0");
$SelCha->execute();
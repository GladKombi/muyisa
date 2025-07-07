<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-approvisionnement.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier  une approvisionnement";
    
    $req=$connexion->prepare("SELECT * from entree where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from entree where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-approvisionnement.php";
    $bouton="Enregistrer";
    $titre="Ajouter une  approvisionnement";

}

$SelData=$connexion->prepare("SELECT entree.*,commande_ap.numcommande,fournisseur.nom,fournisseur.postnom,fournisseur.prenom from entree,commande_ap,fournisseur where entree.commande=commande_ap.id and commande_ap.fournisseur=fournisseur.id and entree.supprimer=0 ");
$SelData->execute();

$SelCom=$connexion->prepare("SELECT commande_ap.*,fournisseur.nom,fournisseur.postnom,fournisseur.prenom from commande_ap,fournisseur  where commande_ap.fournisseur=fournisseur.id AND commande_ap.supprimer=0 AND(commande_ap.id) NOT IN (SELECT commande from entree where supprimer=0 )");
$SelCom->execute();
if(isset($_GET['com']))
{
    $quantite=0;
  
    $com=$_GET['com'];
    $action="../models/add/add-approvisionnement.php?com=$com";
    $selPanier=$connexion->prepare("SELECT * from panier_ap where commande=?");
    $selPanier->execute(array($com));
    while($panier=$selPanier->fetch())
    {
      
            $quantite=$panier['quantite'];
            $argent_total=$quantite*$panier['prixunitaire'];
            $_SESSION['quantite']=$quantite*1000;
            $_SESSION['type']=$panier['type'];
            $_SESSION['argent']=$argent_total/$_SESSION['quantite'];
            $_SESSION['total_argent']=$argent_total;
      
      
        
    }
}

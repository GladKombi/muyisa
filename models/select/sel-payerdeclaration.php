<?php 



if(isset($_GET['search']))
{
    $SelDecl=$connexion->prepare("SELECT declarer.id as decl,declarer.dates,declarer.montant,declarant.*,commande_ap.numcommande,fournisseur.prenom as fournisseur,panier_ap.quantite,panier_ap.type,camion.plaque from declarer,declarant,commande_ap,fournisseur,panier_ap,camion,chargement where declarer.declarant=declarant.numero and declarer.chargement=chargement.id and chargement.camion=camion.id and chargement.commande=commande_ap.id and commande_ap.fournisseur=fournisseur.id and panier_ap.commande=commande_ap.id and declarer.supprimer=0;=0");
    $SelDecl->execute();
    
  
}
else
{
    $SelDecl=$connexion->prepare("SELECT declarer.id as decl,declarer.dates,declarer.montant,declarant.*,commande_ap.numcommande,fournisseur.prenom as fournisseur,panier_ap.quantite,panier_ap.type,camion.plaque from declarer,declarant,commande_ap,fournisseur,panier_ap,camion,chargement where declarer.declarant=declarant.numero and declarer.chargement=chargement.id and chargement.camion=camion.id and chargement.commande=commande_ap.id and commande_ap.fournisseur=fournisseur.id and panier_ap.commande=commande_ap.id and declarer.supprimer=0;=0");
    $SelDecl->execute();
   
     
   
}





if(isset($_GET['iddecl']))
{
     unset($SelDecl);
    $declarr=$_GET['iddecl'];
    $SelDet=$connexion->prepare("SELECT declarant.*,declarer.montant,declarer.dates,camion.plaque,commande_ap.numcommande,panier_ap.type,panier_ap.quantite,fournisseur.prenom as four from declarant,declarer,panier_ap,commande_ap,chargement,camion,fournisseur where declarant.numero=declarer.declarant and declarer.chargement=chargement.id and chargement.camion=camion.id and commande_ap.id=chargement.commande and panier_ap.commande=commande_ap.id and declarer.id=?");
    $SelDet->execute(array($declarr));
    $details=$SelDet->fetch();
   // echo $details['prenom']." ".$details['nom']." ".$details['telephone'];
    $SelDet->closeCursor(); // Libérer le jeu de résultats

    $sel_fiche=$connexion->prepare("SELECT * FROM paiment_declaration WHERE declaration=? and supprimer=0;");
    $sel_fiche->execute(array($declarr));

 
    } 






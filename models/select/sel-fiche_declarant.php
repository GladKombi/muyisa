<?php 



if(isset($_GET['search']))
{
     $SelDecl=$connexion->prepare("SELECT * from declarant where supprimer=0");
    $SelDecl->execute();
  
}
else
{
    $SelDecl=$connexion->prepare("SELECT * from declarant where supprimer=0");
    $SelDecl->execute();
   
     
   
}





if(isset($_GET['iddecl']))
{
    
    $declarr=$_GET['iddecl'];
    $SelDet=$connexion->prepare("SELECT * from declarant where numero=?");
    $SelDet->execute(array($declarr));
     $details=$SelDet->fetch();
$SelDet->closeCursor(); 
    $SelDetails=$connexion->prepare("SELECT declarant.*,declarer.montant,declarer.dates,declarer.id as declaration,camion.plaque,commande_ap.numcommande,panier_ap.type,panier_ap.quantite,fournisseur.prenom as four from declarant,declarer,panier_ap,commande_ap,chargement,camion,fournisseur where declarant.numero=declarer.declarant and declarer.chargement=chargement.id and chargement.camion=camion.id and commande_ap.id=chargement.commande and panier_ap.commande=commande_ap.id and  declarer.supprimer=0 and declarant.numero=?");
    $SelDetails->execute(array($declarr));
   
   // echo $details['prenom']." ".$details['nom']." ".$details['telephone'];
    // Libérer le jeu de résultats

  

 
    } 






<?php
try {
session_start();	
$connexion=new PDO('mysql:dbname=muyisa_energie; host=localhost', 'root', '');
} catch (Exception $e) {
	echo $e;
	
}
$Sel_not_updatE=$connexion->prepare("SELECT count(id) as nb from entree    where type='essence' and supprimer=0 and (id) not in (SELECT entree from prix where type='essence')");
$Sel_not_updatE->execute();
$countE=$Sel_not_updatE->fetch();
$nombreE=$countE['nb'];
if($nombreE==0)
{
	$sellast_E=$connexion->prepare("SELECT prix.*,entree.PR from prix,entree  where prix.entree=entree.id and prix.type='essence' and  prix.supprimer=0 order by prix.id desc");
	$sellast_E->execute();
	$lastE=$sellast_E->fetch();
	$_SESSION['prix_essenceL']=$lastE['prix_detail'];
	$_SESSION['prix_essenceF']=$lastE['prix_gros'];
	$_SESSION['entreeE']=$lastE['id'];
	$_SESSION['PRE']=$lastE['PR'];
}






$Sel_not_updatM=$connexion->prepare("SELECT count(id) as nb from entree    where type='mazout' and supprimer=0 and (id) not in (SELECT entree from prix where type='mazout')");
$Sel_not_updatM->execute();
$countM=$Sel_not_updatM->fetch();
$nombreM=$countM['nb'];


if($nombreM==0)
{
	$sellast_M=$connexion->prepare("SELECT prix.*,entree.PR from prix,entree  where prix.entree=entree.id and prix.type='mazout' and  prix.supprimer=0 order by prix.id desc");
	$sellast_M->execute();
	$lastM=$sellast_M->fetch();
	$_SESSION['prix_mazoutL']=$lastM['prix_detail'];
	$_SESSION['prix_mazoutF']=$lastM['prix_gros'];
	$_SESSION['entreeM']=$lastM['id'];
	$_SESSION['PRM']=$lastM['PR'];
}


$sel_reste=$connexion->prepare("SELECT sum(reste_argent) as total from entree  where supprimer=0");
$sel_reste->execute();
if($total_reste=$sel_reste->fetch())
{
	$total_reste=$total_reste['total'];
}
else
{
	$total_reste=0;
}

$sel_tot_sortie=$connexion->prepare("SELECT sum(panier.prixunitaire*panier.quantite) as total from panier,commande where panier.commande=commande.id and commande.type=1 and commande.supprimer=0;");
$sel_tot_sortie->execute();
$tot_sortie=$sel_tot_sortie->fetch();
if($tot_sortie['total']!=0)
{
	$total_sortie=$tot_sortie['total'];

}
else
{
	$total_sortie=0;
}

$sel_tot_paiement_dette=$connexion->prepare("SELECT sum(montant) as total from paiment_dette  where supprimer=0;");
$sel_tot_paiement_dette->execute();
$tot_paiement_dette=$sel_tot_paiement_dette->fetch();
if($tot_paiement_dette['total']!=0)
{
	$total_paiement_dette=$tot_paiement_dette['total'];

}
else
{
	$total_paiement_dette=0;
}


$sel_tot_appro=$connexion->prepare("SELECT sum(panier_ap.prixunitaire*panier_ap.quantite) as total from panier_ap,commande_ap where panier_ap.commande=commande_ap.id and commande_ap.supprimer=0");
$sel_tot_appro->execute();
if($tot_appro=$sel_tot_appro->fetch())
{
	$total_appro=$tot_appro['total'];
}
else
{	
	$total_appro=0;
	
}

$sel_tot_remuneration=$connexion->prepare("SELECT sum(montant) as total from remuneration  where supprimer=0");
$sel_tot_remuneration->execute();
if($total_remuneration=$sel_tot_remuneration->fetch())
{
	$total_remuneration=$total_remuneration['total'];
}
else
{
	$total_remuneration=0;
}	

$sel_bondesortie=$connexion->prepare("SELECT sum(montant ) as total from bondesortie  where supprimer=0");
$sel_bondesortie->execute();
if($total_bondesortie=$sel_bondesortie->fetch())
{
	$total_bondesortie=$total_bondesortie['total'];
}
else
{
	$total_bondesortie=0;
}

// $sel_reste->closeCursor();
// $sel_tot_sortie->closeCursor();
// $sel_tot_paiement_dette->closeCursor();
// $sel_tot_appro->closeCursor();
// $sel_tot_remuneration->closeCursor();
// $sel_bondesortie->closeCursor();

$_SESSION['caisse']=$total_reste+$total_sortie+$total_paiement_dette-$total_remuneration-$total_appro-$total_bondesortie;




//pour le stock 


$sel_sortieEF=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='essence' and type_achat='fut'");
$sel_sortieEF->execute();
if($sortie=$sel_sortieEF->fetch())
{
	$quantite_sortieEF=$sortie['quantite']*207;
}
else
{
	$quantite_sortieEF=0;
}



$sel_sortieEL=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='essence' and type_achat='litre'");
$sel_sortieEL->execute();
if($sortie=$sel_sortieEL->fetch())
{
   $quantite_sortieEL=$sortie['quantite'];
}
else
{
   $quantite_sortieEL=0;
}
$quantite_sortieE=$quantite_sortieEF+$quantite_sortieEL;

$sel_sortieMF=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='mazout' and type_achat='fut'");
$sel_sortieMF->execute();
if($sortie=$sel_sortieMF->fetch())
{
   $quantite_sortieMF=$sortie['quantite']*207;
}
else
{
   $quantite_sortieMF=0;
}


$sel_sortieML=$connexion->prepare("SELECT SUM(quantite) as quantite from panier where supprimer=0 and type='mazout' and type_achat='litre'");
$sel_sortieML->execute();
if($sortie=$sel_sortieML->fetch())
{
   $quantite_sortieML=$sortie['quantite'];
}
else
{
   $quantite_sortieML=0;
}
$quantite_sortieM=$quantite_sortieMF+$quantite_sortieML;

$sel_approvisionnementE=$connexion->prepare("SELECT SUM(quantite) as quantite from entree where supprimer=0 and type='essence'");
$sel_approvisionnementE->execute();
$approvisionnementE=$sel_approvisionnementE->fetch();
if($approvisionnementE['quantite']<=0)
{
   $_SESSION['stock_essence']=0;
}
else
{
   $quantite_approvisionnementE=$approvisionnementE['quantite'];
   $_SESSION['stock_essence']=$quantite_approvisionnementE-$quantite_sortieE;
}

$sel_approvisionnementM=$connexion->prepare("SELECT SUM(quantite) as quantite from entree where  supprimer=0 and type='mazout'");
$sel_approvisionnementM->execute();
$approvisionnementM=$sel_approvisionnementM->fetch();
if($approvisionnementM['quantite']<=0)
{
   $_SESSION['stock_mazout']=0;
}
else
{
   $quantite_approvisionnementM=$approvisionnementM['quantite'];
   $_SESSION['stock_mazout']=$quantite_approvisionnementM-$quantite_sortieM;
}



?>
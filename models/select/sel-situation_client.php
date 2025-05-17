<?php

if(isset($_GET['search']))
{
    $recherche=$_GET['search'];
    $SelClient=$connexion->prepare("SELECT * From client where  client.supprimer=0 and  (client.nom   LIKE ? OR client.postnom  LIKE ? OR client.prenom  LIKE ? OR client.numero LIKE ?)");
    $SelClient->execute(["%".$recherche."%","%".$recherche."%","%".$recherche."%","%".$recherche."%"]); 
    $message="Aucun element correspond  a votre recherche";
    
}
else{
    $SelClient=$connexion->prepare("SELECT * From client where supprimer=0");
    $SelClient->execute();
    $message="Veillez ajouter le client d'abord dans le menu approprier";
}



if(isset($_GET['idclient']))
{
    $client=$_GET['idclient'];
    $SelData=$connexion->prepare("SELECT  * from commande where commande.client=? ORDER BY commande.id DESC ");
    $SelData->execute(array($client));


    $sel_payer=$connexion->prepare("SELECT  sum(paiment_dette.montant) as total from paiment_dette,client,commande where paiment_dette.commande=commande.id and commande.client=client.numero and  commande.client=?");
    $sel_payer->execute(array($client));
    $payer=$sel_payer->fetch();
    if($payer['total']!="")
    {
        $total_payer=$payer['total'];
    }
    else
    {
        $total_payer=0;
    }
  


    $sel_dette=$connexion->prepare("SELECT sum(panier.prixunitaire*panier.quantite) as total from panier,commande where panier.commande=commande.id and commande.supprimer=0 and commande.type=2 and commande.client=?");
    $sel_dette->execute(array($client));
    $dette=$sel_dette->fetch();
    if($dette['total']!="")
    {
        $total_dette=$dette['total'];
    }
    else
    {
        $total_dette=0;
    }

    $total_dette_gen=$total_dette-$total_payer;
    $SelDetail=$connexion->prepare("SELECT * from client where numero=?");
    $SelDetail->execute(array($client));
    $detail=$SelDetail->fetch();


    $sel_non_liver=$connexion->prepare("SELECT sum(nonlivrer.quantite_essence) as quantite_essence,sum(nonlivrer.quantite_mazout) as quantite_mazout from nonlivrer,commande where commande.id=nonlivrer.commande and commande.client=? and nonlivrer.statut=0 and nonlivrer.supprimer=0");
    $sel_non_liver->execute(array($client));
    $non_liver=$sel_non_liver->fetch();
    if($non_liver['quantite_essence']!="")
    {
        $quantite_essenceNL=$non_liver['quantite_essence'];
    }
    else
    {
        $quantite_essenceNL=0;
    }
    if($non_liver['quantite_mazout']!="")
    {
        $quantite_mazoutNL=$non_liver['quantite_mazout'];
    }
    else
    {
        $quantite_mazoutNL=0;
    }
}


?>
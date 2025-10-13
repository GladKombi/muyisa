<?php if(isset($_GET['type']))
{
    $type=$_GET['type'];
    $SelData=$connexion->prepare("SELECT date_mouvement, type_mouvement, quantite, sum(quantite_calcule) OVER ( order by date_mouvement) as solde from (SELECT dates as date_mouvement,'entree' AS type_mouvement,quantite,quantite as quantite_calcule from entree where type=? UNION ALL SELECT commande.dates as date_mouvement,'sorti' AS type_mouvement, CASE WHEN panier.type_achat = 'fut' THEN panier.quantite*207 ELSE panier.quantite END as quantite, CASE WHEN panier.type_achat = 'fut' THEN -panier.quantite*207 ELSE -panier.quantite END as quantite_calcule from commande,panier where panier.commande=commande.id and panier.type=? ) AS mouvements order by date_mouvement");
    $SelData->execute(array($type,$type));
}

?>
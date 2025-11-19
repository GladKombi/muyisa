<?php 
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-vente.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier la vente";
    
    $req=$connexion->prepare("SELECT * from sortie where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();
}
else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from commande where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";
}
if(isset($_GET['idexp'])){
    $idexp=$_GET['idexp'];
    $action="../models/add/add-vente.php?idexp=$idexp";
    $bouton="Enregistrer";
    $titre="Ajouter sortie";
}

// Gestion des filtres par date
$date_filter = isset($_GET['date_filter']) ? $_GET['date_filter'] : 'today';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Construction de la requête en fonction du filtre
$sql = "SELECT * FROM commande WHERE 1=1";
$params = [];

if ($date_filter == 'today') {
    $sql .= " AND DATE(dates) = CURDATE()";
    $page_title = "Ventes d'Aujourd'hui";
} elseif ($date_filter == 'custom' && !empty($start_date) && !empty($end_date)) {
    $sql .= " AND DATE(dates) BETWEEN ? AND ?";
    $params[] = $start_date;
    $params[] = $end_date;
    $page_title = "Ventes du $start_date au $end_date";
} else {
    $page_title = "Toutes les Ventes";
}

$sql .= " ORDER BY commande.id DESC";

$SelData = $connexion->prepare($sql);
$SelData->execute($params);

if(isset($_GET['com']))
{
    $idd=$_GET['com'];
    $action="../models/add/add-vente.php?com=$idd";
    $bouton="Enregistrer";
    $titre="Ajouter sortie";
    $sel_cl=$connexion->prepare("SELECT * from commande where id=?");
    $sel_cl->execute(array($idd));
    $detail=$sel_cl->fetch();
   
    $Selpanier=$connexion->prepare("SELECT * from panier where commande=?");
    $Selpanier->execute(array($idd));

    $SelpanierE=$connexion->prepare("SELECT * from panier where commande=?");
    $SelpanierE->execute(array($idd));
}

// Initialiser les variables pour éviter les erreurs
$totalg = 0;
$numero = 0;
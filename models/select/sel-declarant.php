<?php 

if(isset($_GET['numero']))
{
    $id=$_GET['numero'];
    $action="../models/update/up-declarant.php?numero=$id";
    $bouton="Modifier";
    $titre="Modifier declarant";
    
    $req=$connexion->prepare("SELECT * from declarant where numero=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from declarant where numero=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-declarant.php";
    $bouton="Enregistrer";
    $titre="Ajouter declarant";

}

$SelData=$connexion->prepare("SELECT * from declarant where supprimer=0");
$SelData->execute();


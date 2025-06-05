<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-camion.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier camion";
    
    $req=$connexion->prepare("SELECT * from camion where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from camion where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-camion.php";
    $bouton="Enregistrer";
    $titre="Ajouter camion";

}

$SelData=$connexion->prepare("SELECT * from camion where supprimer=0");
$SelData->execute();

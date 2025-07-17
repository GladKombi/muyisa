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
 





$SelData=$connexion->prepare("SELECT  * from commande ORDER BY commande.id DESC");
$SelData->execute();
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





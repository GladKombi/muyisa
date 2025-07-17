<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-sortie.php?id=$id";
    $bouton="Modifier";
    $titre="Modifier l'sortie";
    
    $req=$connexion->prepare("SELECT * from sortie where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}
else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT commande.id,client.numero,client.nom,client.postnom,client.prenom,commande.dates from client,commande where client.numero=commande.client and commande.supprimer=0 AND commande.id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
if(isset($_GET['idexp'])){
    $idexp=$_GET['idexp'];
    $action="../models/add/add-sortie.php?idexp=$idexp";
    $bouton="Enregistrer";
    $titre="Ajouter sortie";
}
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





$SelData=$connexion->prepare("SELECT  commande.*,client.* from commande ,client  where commande.client=client.numero ORDER BY commande.id DESC");
$SelData->execute();
if(isset($_GET['com']))
{
    

    $idd=$_GET['com'];
    $action="../models/add/add-sortie.php?com=$idd";
    $bouton="Enregistrer";
    $titre="Ajouter sortie";
    $sel_cl=$connexion->prepare("SELECT commande.*,client.* from commande,client  where commande.client=client.numero AND commande.id=?");
    $sel_cl->execute(array($idd));
    $detail=$sel_cl->fetch();
   
    $Selpanier=$connexion->prepare("SELECT * from panier where commande=?");
    $Selpanier->execute(array($idd));

     $SelpanierE=$connexion->prepare("SELECT * from panier where commande=?");
     $SelpanierE->execute(array($idd));
}





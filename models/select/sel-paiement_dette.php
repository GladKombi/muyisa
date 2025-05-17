<?php 

if(isset($_GET['search']))
{
    $recherche=$_GET['search'];
    $sel_commande=$connexion->prepare("SELECT client.nom,client.postnom,client.prenom,commande.*, sum(panier.prixunitaire*panier.quantite) as total from panier,commande,client where panier.commande=commande.id and client.numero=commande.client and commande.supprimer=0 and commande.type=2  and(client.nom like ? or client.postnom like ? or client.postnom like ? or client.numero like ?) group by commande.id;");
    $sel_commande->execute(["%".$recherche."%","%".$recherche."%","%".$recherche."%","%".$recherche."%"]);

    $message="Aucun element correspond  a votre recherche";
    
}
else{
    $sel_commande=$connexion->prepare("SELECT client.nom,client.postnom,client.prenom,commande.*, sum(panier.prixunitaire*panier.quantite) as total from panier,commande,client where panier.commande=commande.id and client.numero=commande.client and commande.supprimer=0 and commande.type=2 group by commande.id;");
    $sel_commande->execute();
    

   
    $message="Veillez ajouter le client d'abord dans le menu approprier";
}

if(isset($_GET['idcom']))
{
    $com=$_GET['idcom'];
    $sel_com=$connexion->prepare("SELECT client.nom,client.postnom,client.prenom,commande.*, sum(panier.prixunitaire*panier.quantite) as total from panier,commande,client where panier.commande=commande.id and client.numero=commande.client and commande.id=?");
    $sel_com->execute(array($com));
    $detail=$sel_com->fetch();
}

if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT client.nom,client.postnom,client.prenom,paiment_dette.*,commande.numfacture from client,commande,paiment_dette where  commande.client=client.numero and commande.id=paiment_dette.commande and  paiment_dette.id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
$SelData=$connexion->prepare("SELECT client.numero,client.nom,client.postnom,client.prenom,commande.numfacture,paiment_dette.* from client,commande,paiment_dette where commande.client=client.numero and commande.id=paiment_dette.commande and paiment_dette.supprimer=0 order by paiment_dette.id DESC");
$SelData->execute();

?>
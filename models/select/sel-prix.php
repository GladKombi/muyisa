<?php 

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $action="../models/update/up-prix.php?id=$id";
    $bouton="mettre à jour";
    $titre="mettre à jour le  prix";
    
    $req=$connexion->prepare("SELECT * from prix where id=?");
    $req->execute(array($id));
    $modData=$req->fetch();

}

else if(isset($_GET['idsup']))
{
    $id=$_GET['idsup'];
    $req=$connexion->prepare("SELECT * from prix where id=?");
    $req->execute(array($id));
    $supprimer=$req->fetch();
    $titre="";

}
else{
    $action="../models/add/add-prix.php";
    $bouton="Enregistrer";
    $titre="Ajouter le prix";

}

$SelDataE=$connexion->prepare("SELECT prix.*,entree.PR from prix,entree where prix.entree=entree.id and entree.type='essence'order by prix.id desc ");
$SelDataE->execute();

$SelDataM=$connexion->prepare("SELECT prix.*,entree.PR from prix,entree where prix.entree=entree.id and entree.type='mazout'order by prix.id desc ");
$SelDataM->execute();




$Sellast=$connexion->prepare("SELECT * from prix order by id desc limit 1");
$Sellast->execute();
$compt=0;
if($last=$Sellast->fetch())
{
    $compt=1;
}



if(isset($_GET['update']) && $_GET['update']=='essence')
{
    $select_last_entreeEssence=$connexion->prepare("SELECT * from entree where supprimer=0 and (id) not in (select entree from prix ) and type='essence' order by id  limit 1");
     $select_last_entreeEssence->execute();
     $last_essence= $select_last_entreeEssence->fetch();
}


if(isset($_GET['update']) && $_GET['update']=='mazout')
{
    $select_last_entreemazout=$connexion->prepare("SELECT * from entree where supprimer=0  and (id) not in (select entree from prix ) and  type='mazout' order by id  limit 1");
     $select_last_entreemazout->execute();
     $last_mazout= $select_last_entreemazout->fetch();
}




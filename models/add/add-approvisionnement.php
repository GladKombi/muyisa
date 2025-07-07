<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $dates=date('Y-m-d');
    $quantite=htmlspecialchars($_POST['quantite']);
    $type= $_SESSION['type'];
    $commande=$_GET['com'];
    if($_SESSION['quantite']>$quantite)
    {
        $reste_E=$_SESSION['quantite']-$quantite;
        $reste_argent=$reste_E *  $_SESSION['argent'];
        // echo "</br>".$reste_E. "x".$_SESSION['argent']." = ".$reste_argent;
    }
    else
    {
        $reste_E=0;
        $reste_argent=0;
       
    }
    $total_argent=$_SESSION['argent']*$quantite;
    $declaration=0;
    $select_declaration=$connexion->prepare("SELECT declarer.montant from declarer,chargement where declarer.chargement=chargement.id and chargement.commande=? and declarer.supprimer=0");
    $select_declaration->execute(array($commande));
    if($decl=$select_declaration->fetch())
    {
        $declaration=$decl['montant'];
    }
    $prix_de_revient=number_format(($declaration+ $total_argent)/$quantite, 3);

    echo $prix_de_revient;
    $select_last=$connexion->prepare("SELECT * from entree where type=? order by id  desc limit 1");
    $select_last->execute(array($type));
    if($last_prix=$select_last->fetch())
    {
        $last_prix_de_revient=$last_prix['prix_de_revient'];
        $PR=($prix_de_revient+$last_prix_de_revient)/2;
    }
    else 
    {
        $PR=$prix_de_revient;
    }


  
    $req=$connexion->prepare("INSERT INTO entree (dates,commande,quantite,type,reste_argent,PR) values (?,?,?,?,?,?)");
    $req->execute(array($dates,$commande,$quantite,$type,$reste_argent,$PR)); 
     if($req)
     {
        $_SESSION['quantite']=0;
        $_SESSION['type']="";
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/approvisionnement.php');
    }
 }


?>
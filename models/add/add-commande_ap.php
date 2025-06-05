<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{

    $commande=$_GET['com'];
    $quantite=htmlspecialchars($_POST['qte']);
    $prixunitaire=htmlspecialchars($_POST['prixunitaire']);
    $type=htmlspecialchars($_POST['type']);

  
        $sel_prod=$connexion->prepare("SELECT * FROM panier_ap where commande=? and type=?");
        $sel_prod->execute(array($commande,$type));
        if($exist=$sel_prod->fetch())
        {
            $quantite_up=$exist['quantite']+$quantite;
            echo $quantite_up;
            $up_quantite=$connexion->prepare("UPDATE panier_ap set quantite=? where commande=? and type=?");
            $up_quantite->execute(array($quantite_up,$commande,$type));
            if($up_quantite)
            {
                $_SESSION['notif']="Une quantite vient d'etre ajouter dans le panier d'approvisionnement";
                $_SESSION['color']='success';
                $_SESSION['icon']="check-circle-fill";
                header("location:../../views/commande_ap.php?com=$commande");
            }
        }
        else
        {
            $req=$connexion->prepare("INSERT into panier_ap(commande,type,quantite,prixunitaire) values (?,?,?,?)");
            $req->execute(array($commande,$type,$quantite,$prixunitaire));
            if($req)
            {
                $_SESSION['notif']="Un element vient d'etre ajouter dans le panier d'approvisionnement";
                $_SESSION['color']='success';
                $_SESSION['icon']="check-circle-fill";
                header("location:../../views/commande_ap.php?com=$commande&pfin");
            }
        }
 }


?>
<?php
include("../../connexion/connexion.php");
if(isset($_POST['valider_new']))
{

    $sel_lastnum=$connexion->prepare("SELECT numfacture from commande order by  id desc limit 1");
    $sel_lastnum->execute();
    $numfacutre=0;
    if($last=$sel_lastnum->fetch())
    {
        $numfacutre=$last['numfacture']+1;
       
    }
    else
    {
        $numfacutre=1;
       
    }

   
    $date=date('Y-m-d');
    $client=htmlspecialchars($_POST['client']);
    $type_vente=1;
    $req=$connexion->prepare("INSERT INTO commande(dates,client,type,numfacture) values (?,?,?,?)");
    $req->execute(array($date,$client,$type_vente,$numfacutre));
    if($req)
    {
        $sel_com=$connexion->prepare("SELECT * from commande where commande.dates=? and  commande.client=? order by commande.id desc LIMIT 1");
        $sel_com->execute(array($date,$client));
        $com=$sel_com->fetch();
        $idcom=$com['id'];
        header("location:../../views/vente.php?new&com=$idcom");
    }
}

if (isset($_POST['valider'])){
    $type=htmlspecialchars($_POST['type']);
    $type_achat=htmlspecialchars($_POST['type_achat']);
    $quantite=htmlspecialchars( $_POST['qte']);
    $commande=$_GET['com'];
    $PR=0;
    $entree=0;
    $prix=0;
    $stock=0;
    if($nombreM!=0)
    {
        $_SESSION['notif']="Erreur !!! Le prix de mazout n'est pas a jour ";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x";
        header("location:../../views/vente.php?com=$commande");
    }
  if($nombreE!=0)
    {
        $_SESSION['notif']="Erreur !!! Le prix d'essence n'est pas a jour ";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x";
        header("location:../../views/vente.php?com=$commande");
    }

    if($type=="essence")
    {
        $entree=$_SESSION['entreeE'];
        $PR=$_SESSION['PRE'];
        $stock=$_SESSION['stock_essence'];
        if($type_achat=='litre')
        {
            
            $prix= $_SESSION['prix_essenceL'];
        }
        else
        {
            $prix= $_SESSION['prix_essenceF'];
        }
    }
    else
    {
        $entree=$_SESSION['entreeM'];
        $PR=$_SESSION['PRM'];
        $stock=$_SESSION['stock_mazout'];
        if($type_achat=='litre')
        {
            $prix= $_SESSION['prix_mazoutL'];
        }
        else
        {
            $prix= $_SESSION['prix_mazoutF'];
        }
    }
    
    if($type_achat=='litre')
    {
        $resultat=($prix-$PR)*$quantite;
    }
    else
    {
        
        $resultat=($prix-($PR*207))*($quantite);
    }

   
  

    if($stock<$quantite)
    {
        $_SESSION['notif']="stock insuffisant, le stock disponible pour se type est de $stock L";
        header("location:../../views/vente.php?com=$commande");
    }
    else
    {
        $sel_prod=$connexion->prepare("SELECT * FROM panier where commande=? and type=? and type_achat=?");
        $sel_prod->execute(array($commande,$type,$type_achat));
        if($exist=$sel_prod->fetch())
        {


            $quantite_up=$exist['quantite']+$quantite;
            echo $quantite_up;
              if($type_achat=='litre')
                {
                    $resultat=($prix-$PR)*$quantite_up;
                }
                else
                {
                    
                    $resultat=($prix-($PR*207))*($quantite_up);
                }
            $up_quantite=$connexion->prepare("UPDATE panier set quantite=? where commande=? and type=? and type_achat=? and resultat=?");
            $up_quantite->execute(array($quantite_up,$commande,$type,$type_achat,$resultat));
            if($up_quantite)
            {
                $_SESSION['notif']="Une quantite vient d'etre ajouter dans le panier";
                $_SESSION['color']='success';
                $_SESSION['icon']="check-circle-fill";
                header("location:../../views/vente.php?com=$commande");
            }
        }
        else
        {
            $req=$connexion->prepare("INSERT into panier(commande,type,type_achat,quantite,prixunitaire,PR,entree,resultat) values (?,?,?,?,?,?,?,?)");
            $req->execute(array($commande,$type,$type_achat,$quantite,$prix,$PR,$entree,$resultat));
            if($req)
            {
                $_SESSION['notif']="Un element vient d'etre ajouter dans le panier";
                $_SESSION['color']='success';
                $_SESSION['icon']="check-circle-fill";
                header("location:../../views/vente.php?com=$commande");
            }
        }
    }   

   

    
    
}


?>
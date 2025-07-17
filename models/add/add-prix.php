<?php 
include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $date=date("Y-m-d");
    $prix_detail=htmlspecialchars($_POST['prix_detail']);
    $prix_gros=htmlspecialchars($_POST['prix_gros']);
    $type=htmlspecialchars($_POST['type']);
     $entree=htmlspecialchars($_POST['entree']);
    echo $type.$entree;
    
    $req=$connexion->prepare("INSERT INTO prix (dates,type,prix_detail,prix_gros,entree) values (?,?,?,?,?)");
    $req->execute(array($date,$type,$prix_detail,$prix_gros,$entree,)); 
     if($req)
     {
        $_SESSION['notif']="Enregistrement reussi";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:../../views/prix.php');
    }
 }


?>
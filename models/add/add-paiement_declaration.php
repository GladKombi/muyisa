<?php include('../../connexion/connexion.php');
if (isset($_POST["valider"])) 
{
    $date=date("Y-m-d");
    $declaration=$_GET['decl'];
    $montant=htmlspecialchars($_POST['montant']);
    if($montant>$_SESSION['caisse'])
    {
        $_SESSION['notif']="echec d'enregistrement, le montant est superieur a la caisse";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x";
        header("location:../../views/payerdeclaration.php?payer=$montant&decl=$declaration");
    }
    else
    {
        $req=$connexion->prepare("INSERT INTO paiment_declaration (dates,declaration,montant) values (?,?,?)");
        $req->execute(array($date,$declaration,$montant)); 
        if($req)
        {
            $_SESSION['notif']="Enregistrement reussi";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header("location:../../views/payerdeclaration.php?iddecl=$declaration");
        }
    }
   
 }
 if(isset($_GET['solder']))
 {
    $date=date("Y-m-d");
    $declaration=$_GET['decl'];
    $montant=$_GET['solder'];
    if($montant>$_SESSION['caisse'])
    {
        $_SESSION['notif']="echec d'enregistrement, le montant est superieur a la caisse";
        $_SESSION['color']='danger';
        $_SESSION['icon']="x";
        header("location:../../views/payerdeclaration.php?iddecl=$declaration");
    }
    else
    {
        $req=$connexion->prepare("INSERT INTO paiment_declaration (dates,declaration,montant) values (?,?,?)");
        $req->execute(array($date,$declaration,$montant)); 
        if($req)
        {
            $_SESSION['notif']="Enregistrement reussi";
            $_SESSION['color']='success';
            $_SESSION['icon']="check-circle-fill";
            header("location:../../views/payerdeclaration.php?iddecl=$declaration");
        }
    }

 }


?>
<?php 
include('../../connexion/connexion.php');


if (isset($_POST["valider"])) 
{
    $dates=date('Y-m-d');
    $declarant=strtoupper(htmlspecialchars($_POST['declarant']));
    $chargement=strtoupper(htmlspecialchars($_POST['chargement']));
    $montant=strtoupper(htmlspecialchars($_POST['montant']));
    echo $chargement;
    $req=$connexion->prepare("INSERT INTO declarer (dates,chargement,declarant,montant) values (?,?,?,?)");
        $req->execute(array($dates,$chargement,$declarant,$montant)); 
        if($req)
        {
             $_SESSION['notif']="Enregistrement reussi";
             $_SESSION['color']='success';
             $_SESSION['icon']="check-circle-fill";
             header('location:../../views/declarer.php');
        }
               
         
    
                
}

?>
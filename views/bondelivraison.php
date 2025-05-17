<?php 
include('../connexion/connexion.php');
include('../models/select/sel-sortie.php');
$bon=$_GET['com'];
$SelData=$connexion->prepare("SELECT nonlivrer.*,client.nom,client.postnom,client.prenom,client.numero,commande.numfacture  from nonlivrer,client,commande where nonlivrer.commande=commande.id and client.numero=commande.client and nonlivrer.supprimer=0 and nonlivrer.id=?");
$SelData->execute(array($bon));
$data=$SelData->fetch();



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Muyisa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 <?php include('../include/link.php'); ?> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>

@media print {
    .no-print {
        display: none;
    }
}

 @media print {
            .no-print {
                display: none;
            }
        }

 th, td, tr {
      border: 5px solid black; 
      border-collapse: collapse; 
  }
 
</style>


</head>

<body class='m-3'>
<div class="row ">

    <?php if($_SESSION['fonction']=="comptable"){?>

         <!-- <div class="col-6 no-print mb-3">
            <button onclick="window.print()" class="btn btn-success col-12 me-2">Imprimer</button>
        </div> -->
        <div class="col-12 no-print mb-3">
            <button onclick="saveAsImage()" class="btn btn-dark col-12 me-2"><i
            class="bi bi-printer-fill"></i>Imprimer</button>
         </div>
    <?php }else{?>
        <div class="col-6 no-print mb-3">
            <a href="sortie.php?new" class="btn btn-success col-12 me-2">Nouvelle Facture</a>
        </div>
        <!-- <div class="col-6 no-print mb-3">
            <button onclick="window.print()" class="btn btn-success col-12 me-2">Imprimer</button>
        </div> -->
        <div class="col-6 no-print mb-3">
            <button onclick="saveAsImage()" class="btn btn-dark col-12 me-2">Imprimer</button>
         </div>
    <?php  } ?>
</div>

<div class="m-3" id="invoice">
  <table class="table">
      <thead>
        <tr>
            <th class='fs-3'  colspan='4'><span class='fs-1'>STATION MUYISA ENERGIE</span> 
      <br>
      <div class="row">
        <div class="col-6">
              RCCM : CD/Bbo/RCCM/23-A-1446  <br>
              IMPOT: A 20271017P
              <br>
              ID.NAT: 19-G4701-N50027E
              <br>
                 Q.VUTESTE 
                 <br> Cell. LUSANDO ,   N° 1  
        </div>
        <div class="col-6">
            Bbo le <?php $dates=strtotime($data["dates"]); echo date('d/m/Y ',$dates);?>   
        </div>
      </div>
          Tel : +243 993580599 ,+243 997287934
      <br>
              <center>sur facture  n° <?php echo sprintf('%04d', $data['numfacture']);?></center>
      <br>
              Mr,Mme : <?php echo strtoupper($data['nom']." ".$data['postnom']);?>
        <br>
     
            
            </th>
              
        </tr>
            
          <tr class='fs-1'>
              <th scope="col">Qte essence </th>
              <th scope="col">Qte mazout</th>
              
              
             
          </tr>
      </thead>
      <tbody class='fs-1'>
        
        
        <tr>
             <td><strong><?=$data['quantite_essence']?></strong></td>
          
             <td><strong><?=$data['quantite_mazout']?></strong></td>
            
          
           
        </tr> 
        
        <tr>
            <td colspan='4' class='text-center'>
                <em><strong>Les marchandises vendues ne sont ni remises  ni echangées</strong></em>

            </td>
        </tr>  
          
      </tbody>
  </table>
</div>

<script>
function saveAsImage() {
    const invoiceElement = document.getElementById('invoice');
    html2canvas(invoiceElement).then(canvas => {
        const link = document.createElement('a');
        link.download = 'facture.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    });
}
</script>

</body>

</html>
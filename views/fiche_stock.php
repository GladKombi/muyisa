 
 <?php 
 include('../connexion/connexion.php');
 include_once('../models/select/sel-stock.php');
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
      border: 1px solid black; 
      border-collapse: collapse; 
  }
 
</style>


</head>
<body>
    

  <div class="row fs-6">
                    
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                                                
                                        <div class="m-3" id="invoice">
                                        <table class="table">
                                            <thead>
                                                <tr >
                                                    
                                                   
                                                </tr>
                                                <tr>
                                                    <th  colspan='5'> 
                                            
                                                    <div class="row">
                                                        <div class="col-6 text-align-center">
                                                            <center>
                                                                STATION MUYISA ENERGIE <br>
                                                                RCCM : CD/Bbo/RCCM/23-A-1446  <br>
                                                                IMPOT: A 20271017P
                                                                <br>
                                                                ID.NAT: 19-G4701-N50027E
                                                                <br>
                                                                Tel : +243 993580599 ,+243 997287934
                                                                <br>
                                                                1,CELLULE LUSANDO QUARTIER VUTESTE
                                                                    <br> COMMUNE KIMEMI <br>VILLE DE BUTEMBO
                                                                </center>
                                                            </div>
                                                        
                                                            <div class="col-6">
                                                                <br>
                                                                FICHE DE STOCK <br> <br>
                                                                MARCHANDISE  : <?=$_GET['type']?> <br> <br>
                                                                
                                                            </div>
                                                    
                                                    </div>
                                                
                                                    
                                                    </th>
                                                    
                                                </tr>
                                                    
                                                <tr class=''>
                                                    <th scope="col"><center>DATES</center></th>
                                                    <th scope="col"><center>LIBELLES</center></th>
                                                    
                                                    <th scope="col"><center>DEBIT</center></th>
                                                    <th scope="col"><center>CREDIT</center></th>
                                                    <th scope="col"><center>SOLDE</center></th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody class=''>

                                              <?php
                                                    $rows=$SelData->fetchAll();
                                            unset($SelDetails);
                                            $solde=0;
                                            foreach($rows as $data){
                                                if($data["type_mouvement"]=="entree")
                                                {
                                                      $solde=$solde+$data['quantite'];
                                                }
                                                else{
                                                     $solde=$solde-$data['quantite'];
                                                }
                                              
                                                
                                                    
                                                    ?>
                                                 <tr> 
                                                  
                                                        
                                                        <td > <strong><?php echo date('d/m/Y',strtotime($data['date_mouvement']));?>  </strong></td>
                                                        <td> <strong> <?=$data["type_mouvement"]?></strong></td>
                                                        <?php if($data["type_mouvement"]=="entree"){?>
                                                            <td> <strong><center><?=$data['quantite']?></center> </strong></td>
                                                            <td> <strong><center>---</center> </strong></td>
                                                        <?php } else { ?>
                                                            <td> <strong><center>---</center> </strong></td>
                                                            <td> <strong><center><?=$data['quantite']?></center> </strong></td>
                                                            
                                                        <?php } ?>
                                                        <td> <strong><center><?=$solde?></center> </strong></td>
                                                       
                                                    </tr>
                                                  <?php } ?>   
                                            
                                                 
                                                </div>
                                                
                                            </tbody>
                                        </table>
                                            
                                        <div class="col-12 no-print mb-3">
                                                        <button onclick="window.print()" class="btn btn-dark col-12 me-2">Imprimer</button>
                                        </div>
                                        
                                    </div>
                                  
                                   
                                </div>
                            
                     
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
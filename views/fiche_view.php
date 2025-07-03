 
 <?php 
 include('../connexion/connexion.php');
 include_once('../models/select/sel-fiche_declarant.php');
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
                                      <?php if(isset($_GET['iddecl'])){ ?>
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
                                                                FICHE COMPTABLE DES DECLARANTS  <br> <br>
                                                                NOM DU DECLARANT : <?=$details['nom']." ". $details['postnom']." ". $details['prenom']?> <br> <br>
                                                                Tel : <?=$details['telephone']?>
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
                                                    $rows=$SelDetails->fetchAll();
                                            unset($SelDetails);
                                            $solde=0;
                                            foreach($rows as $declaration){
                                              
                                                 $solde=$solde+$declaration['montant'];
                                                    
                                                    ?>
                                                 <tr> 
                                                  
                                                        
                                                        <td > <strong><?php echo date('d/m/Y',strtotime($declaration['dates']));?>  </strong></td>
                                                        <td> <strong>declaration du camion <?=$camion=$declaration['plaque']." de ".$declaration['quantite']." m3 ".$declaration['type']."/".$declaration['four']?> </strong></td>
                                                        <td> <strong><center><?=$declaration['montant']?></center> </strong></td>
                                                        <td> <strong><center>---</center> </strong></td>
                                                        <td> <strong><center><?=$solde?></center> </strong></td>
                                                       
                                                    </tr>
                                                    
                                                <?php 
                                                $decl_details=$declaration['declaration'];
                                                 $sel_fiche=$connexion->prepare("SELECT * FROM paiment_declaration WHERE declaration=? and supprimer=0;");
                                                    $sel_fiche->execute(array($decl_details));
                                                while($fiche=$sel_fiche->fetch()){ 
                                                    $solde=$solde-$fiche['montant'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('d/m/Y',strtotime($fiche['dates']));?>  </td>
                                                        <td><?php if($solde>0){ echo "avance sur  $camion ";}else {echo "solder  $camion ";}?></td>
                                                        <td><center>---</center></td>
                                                        <td><center><?=$fiche['montant']?></center></td>
                                                        <td><center><?=$solde?></center></td>
                                                        
                                                    </tr>
                                                 <?php }} ?>
                                                 
                                                </div>
                                                
                                            </tbody>
                                        </table>
                                            
                                        <div class="col-12 no-print mb-3">
                                                        <button onclick="window.print()" class="btn btn-dark col-12 me-2">Imprimer</button>
                                        </div>
                                        
                                    </div>
                                  
                                   
                                </div>
                            
                        <?php } ?>
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
<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-situation_client.php');
if(isset($_GET['idclient']))
{

   
  

   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title class="no-print">situation client</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
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


</style>

  <!-- link -->
    <?php 
    include_once('../include/link.php');
    
    ?>
  <!-- link -->
  
<!-- menu -->
<?php 
include_once('../include/menu.php');
?>

</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none  no-print"></i>

  <main id="main" class="main">
        <div class="row " >
    
            <div class="col-120 bg-black position-fixed m-auto p-3 no-print"  >
            
                <h2 class=" text-white ">situation_client</h2>
              
            </div><!-- End Page Title -->
       
        </div>
       
        
          <section class="section">
              <div class="row">
                  <div class="col-lg-12">

                      <div class=" p-3  m-3">
                          <div class="card-body ">
                    <?php      if(isset($_GET['idsup']) && ! empty($_GET['idsup'])){
                    ?>
                        <div class="col-12 h-100  d-flex justify-content-center align-items-center p-4">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 bg-black card p-3 shadow   m-3">
                                <div class="card-header text-dark d-flex justify-content-between">
                                    <b class="text-white">Supprimer</b>
                                    <a href="situation_client.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer l'situation clientde "<b> <?=$supprimer['nom']."  ".$supprimer['postnom']." d'une quantite de ".$supprimer['quantite']." L au prix de  ".$supprimer['prix']?> par L </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-situation_client.php?iddel=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="situation_client.php" class="btn btn-success">Annuler</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }else { ?>
                            <?php if(isset($_GET['new']) && !isset($_GET['com'])){?>
                                <div class="shadow p-3 row">
                                    <center><h2>Choisir l'Client</h2></center>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                <label for=""></span></label>
                                                <a href="situation_client.php?fin"><input type="buttom" class="btn btn-success w-100" name="annuler " value="Annuler l'operation"></a>
                                        </div>
                                            
                                        <div class="col-xl-12 col-lg-12  p-3">
                                                <form class="search-form d-flex row "   method="get">
                                                            <input class="col-xl-10 col-lg-10 col-md-10  col-sm-10 p-3 m-1" required autocomplete="off" type="text" name="search" placeholder="Rechercher avec les noms de l'Client" title="">
                                                            <input hidden type="text" name="new">
                                                            <button class="col-xl-1 col-lg-1 col-md-1  col-sm-1 p-3 m-1 btn btn-dark" type="submit" title="Search"><i class="bi bi-search "></i></button>
                                                    <?php if(isset($_GET['search'])){ ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                        <a href="situation_client.php?new"><input  class="btn btn-success "type="button" value="Voir tout"></a>
                                                    </div>
                                                    <?php } ?>
                                                </form>
                                        </div>
                                        <?php
                                            $nb=0;
                                            while($Client= $SelClient->fetch()){
                                                $nb++;
                                           
                                            ?>
                                        
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6  ">
                                                <a class=" btn btn-white shadow m-3 w-100" href="situation_client.php?idclient=<?=$Client['numero']?>">
                                                    <div class=row>
                                                        
                                                        <div class="col-12">
                                                            <div class="row">
                                                               
                                                                <div class="col-12">
                                                                <b>Noms : </b><?=$Client['nom'].' '.$Client['postnom'].' '.$Client['prenom']?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>Numero Client : </b> <?=$Client['numero']?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>N° telephone : </b> <?=$Client['telephone']?>
                                                                </div>
                                                              
                                                            
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    </a>
                                            </div>
                                    
                                        <?php } ?> 
                                                <?php if($nb==0){ ?>
                                                    <center><?=$message?></center>
                                               <?php } ?> 

                                        </div>
                                
                                </div>
                            <?php }else if(isset($_GET['idclient'])){ ?>
                            
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 shadow p-3 m-3">
                                        <strong><h1>CLIENT : <?=$detail['nom']." ".$detail['postnom']." ".$detail['prenom']?></h1></strong>
                                        

                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 row">
                                        <div class="col-4 shadow p-3 m-3">
                                            TOTAL DETTE : <?=$total_dette_gen?> $
                                        </div>
                                        <div class="col-6 shadow p-3 m-3">
                                            <div class="row">
                                                <div class="col-12">
                                                     ESSENCE NON LIVRER :
                                                </div>
                                                <div class="col-12">
                                                     MAZOUT NON LIVRER :
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>

                                    <div class=" table-responsive shadow p-3">
                                <table class="table table-borderless datatable   ">
                                <h4 class="p-3 ">rapport</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>  

                                            <th scope="col">Date</th>
                                            <th scope="col">facture N°</th>
                                            <th scope="col">type achat</th>
                                            <th scope="col">montant</th>
                                            <th scope="col" class="no-print">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $quantite=0;
                                        $numero=0;
                                        $totalg=0;
                                        while($data=$SelData->fetch())
                                        { 
                                             $total=0;
                                           
                                            $com=$data['id'];
                                            $Selpanier=$connexion->prepare("SELECT * from panier where commande=?");
                                            $Selpanier->execute(array($com));
                                            $tot=0;
                                            while($panier=$Selpanier->fetch())
                                            {
                                                $tot=$panier['quantite']*$panier['prixunitaire'];
                                                $total=$total+$tot;
                                                $totalg=$totalg+$total;
                                            }
                                        
                                           
                                            $numero++;
                                        ?>
                                       <tr>
                                            <th scope="row"><?php echo $numero; ?></th>
                                           
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y',$dates);?></td>
                                            <td><?php echo sprintf('%04d', $data['numfacture'])?></td>
                                            <td> <?php if($data['type']==1){ echo "cash";}else { echo "credit";}?></td>
                                            
                                            <td><?=$total?>$</td>
                                            <td class="no-print">
                                            <a href="facture.php?com=<?=$data['id']?>" class="btn btn-success btn-sm "><i
                                             class="bi bi-eye-fill"></i></a>

                                              
                                        </td>

                                       </tr>
                               
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4">TOTAL</td>
                                           
                                          
                                            <td><?=$totalg?> $</td>
                                       </tr>
                                    </tbody>
                                </table>
                                
                              </div>
                              <div class="col-12  no-print mb-3">
                                    <button onclick="window.print()" class="btn btn-success col-12 me-2">Imprimer</button>
                                </div>
                              <!-- End Table with stripped rows -->

                             </div>
                          </div>
                                   
                                </div>
                            
                            <?php }else{ ?>
                              
                                <a href=" situation_client.php?new" class="col-12 btn btn-outline-success">Choisir le client</a> 
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                        <?php if(isset($_SESSION['notif'])){ ?>
                                            <center><p class="alert-<?=$_SESSION['color']?> alert">
                                            <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                    
                                            </p></center> 
                                        <?php } ?> 
                                    </div>
                            <?php } ?>
                <?php }  ?>
                           
                      </div>

                  </div>
              </div>
          </section>
    

     

        <footer id="footer" class="no-print">
        <?php 
          include_once('../include/footer.php');
          
          ?>
        </footer>

  </main><!-- End #main -->
  

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- JS Files -->
  <?php 
    include_once('../include/script_tab.php');
    
    ?>

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
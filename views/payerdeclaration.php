<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-declarer.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>declarer</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <main id="main" class="main">
        <div class="row " >
    
            <div class="col-120 bg-black position-fixed m-auto p-3">
            
                <h2 class=" text-white">declarer </h2>
              
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
                                    <a href="declarer.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer le declarer du <b> <?php $dates=strtotime($supprimer["dates"]); echo date('d/m/Y',$dates);?> dans le  camion <?=$supprimer['camion']?> de la  commande n°<?php echo sprintf('%04d', $supprimer['numcommande']);?>  du <?php echo date('d/m/Y',strtotime($supprimer["datecom"]));?> de <?=$supprimer['type']?> de <?=$supprimer['quantite']?>m3 ,fournisseur: <?=$supprimer['prenom']?></b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-declarer.php?id=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="declarer.php" class="btn btn-success">Annuler</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }else { ?>

                            <?php if(isset($_SESSION['notif'])){ ?>
                                 <center><p class="alert-<?=$_SESSION['color']?> alert">
                                        <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                                    
                                 </p></center> 
                             <?php } ?> 
                            <?php if(isset($_GET['new']) && !isset($_GET['com'])){?>
                                <div class="shadow p-3 row">
                                    <center><h2>declarer le camion</h2></center>
                                    <div class="row">
                                        
                                            
                                        <div class="col-xl-12 col-lg-12  p-3">
                                        <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST">
                                            <h5 class="card-title text-center "></h5>
                                            <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                            <label for="">Choisir le declarant </span></label>
                                                            <select name="declarant" id="declarant" class="form-select">
                                                                <?php while($declarant=$SelDec->fetch()){ ?>
                                                                    <option value="<?=$declarant['numero']?>"><?=$declarant['nom']." ".$declarant['postnom']." ".$declarant['prenom']?> </option>
                                                                
                                                                <?php } ?>
                                                            
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                            <label for="">montant</span></label>
                                                            <input autocomplete="off" required type="number" step="0.01"  class="form-control" placeholder="Ex:15000"  name="montant" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['montant']?>" <?php } ?>> 
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                            <label for="">Choisir le chargement</span></label>
                                                            <select name="chargement" id="chargement" class="form-select">
                                                                <?php while($commande=$SelCha->fetch()){ ?>
                                                                    <option value="<?=$commande['id']?>">  camion <?=$commande['camion']?> qui transporte : <?=$commande['type']?> de <?=$commande['quantite']?>m3 ,fournisseur: <?=$commande['prenom']?> </option>
                                                                
                                                                <?php } ?>
                                                            
                                                            </select>
                                                            
                                                        </div>
                                                
                                                    
                                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 row">
                                                                   
                                                                    <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                                        <a href="declarer.php"><input type="buttom" class="btn btn-success w-100" name="annuler " value="Annuler l'operation"></a>
                                                                    </div>
                                                                    <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                                        <input type="submit" class="btn btn-dark text-white p-2 w-100" name="valider" value="<?=$bouton?>">
                                                                    </div>
                                                         
                                                         
                                                        
                                                    </div>
                                                    
                                                   
                                            </div>   
                        
                        
                                        </form>
                                        </div>
                                     

                                        </div>
                                
                                </div>
                        

                            <?php  } ?>
                            <a href="?new" class="col-12 btn btn-outline-success">Declarer un camion</a> 
                <?php }  ?>
                            <div class=" table-responsive shadow p-3">
                                <table class="table table-borderless datatable   ">
                                <h4 class="p-3 ">Liste de declaration</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>  
                                            <th scope="col">date</th>
                                            <th scope="col">declarant</th>
                                            <th scope="col">camion</th>
                                            <th scope="col">montant</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $numero=0;
                                       
                                        while($data=$SelData->fetch())
                                        {
                                            $numero++;
                                        ?>
                                       <tr>
                                            <th scope="row"><?php echo $numero; ?></th>
                                           
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y',$dates);?></td>
                                            <td><?=$data['nom']." ".$data['postnom']." ".$data['prenom']  ?></td>
                                            <td><?=$data['camion']?>  qui transporte : <?=$data['type']?> de <?=$data['quantite']?>m3 ,fournisseur: <?=$data['fournisseur']?> commande n° <?php echo sprintf('%04d', $data['numcommande']);?></td>
                                            <td><?=$data['montant']?>$</td>
                                            <td>
                                          

                                              <a   href="?idsup=<?=$data['id']?>"
                                                class="btn btn-dark btn-sm "><i class="bi bi-trash3-fill"></i></a>
                                        </td>

                                       </tr>
                               
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>
                                
                              </div>
                              <!-- End Table with stripped rows -->

                             </div>
                          </div>
                      </div>

                  </div>
              </div>
          </section>
    

     

        <footer id="footer" class="bg-success">
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

 


</body>

</html>
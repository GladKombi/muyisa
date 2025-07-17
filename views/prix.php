<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-prix.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>prix</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <style>




 
</style>
  
    <?php 
    include_once('../include/link.php');
    
    ?>
  
  
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
    
            <div class="col-120 bg-dark position-fixed m-auto p-3">
            
                <h2 class=" text-success">prix</h2>
              
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
                                    <a href="prix.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer "<b> <?=$supprimer['equivalent']?>"
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-prix.php?id=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="prix.php" class="btn btn-success">Annuler</a>
                                </div>

                            </div>
                        </div>
                    <?php
                }else { ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                    <?php if(isset($_SESSION['notif'])){ ?>
                                        <center><p class="alert-<?=$_SESSION['color']?> alert">
                                        <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                
                                        </p></center> 
                                    <?php } ?> 
                                </div>
                                <?php if($nombreE>0 && !isset($_GET['id'])){?>
                                   <?php if(isset($_GET['update']) && $_GET['update']=='essence')  {?>
                                    <div>
                                    <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST" enctype="multipart/form-data">
                                     <h3 class="card-title text-center ">mettre a jour le prix d'essence</h3>
                                        <div class="row">
                                            <center><em>NB le prix de revient actuel est de <?=$last_essence['PR']?></em> </center>
                                            <input type="text" name="type"  hidden id="type" value="essence" >
                                            <input type="text" name="entree"  hidden id="entree" value="<?=$last_essence['id']?>" >
                                            <div class="col-xl-12  col-lg-12  col-md-12   col-sm-12  p-3">
                                                <label for="">Prix detail </span></label>
                                                <input autocomplete="off" required type="number" class="form-control" min="<?=$last_essence['PR']?>" step="0.01" placeholder="ex: 1.7"  name="prix_detail" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_detail']?>" <?php } ?>> 
                                            </div>
                                            <div class="col-xl-12  col-lg-12  col-md-12   col-sm-12  p-3">
                                                <label for="">Prix gros  </span></label>
                                                <input autocomplete="off" required type="number" class="form-control"  min="<?=$last_essence['PR']*207?>" step="0.01" placeholder="ex: 230"  name="prix_gros" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_gros']?>" <?php } ?>> 
                                            </div>
                                         
                                            
                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                           
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 ">
                                    
                                        <?php if(isset($_GET['id'])){?>
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="<?=$bouton?>">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                <a href="prix.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                            </div>
                                        </div>
                                        <?php }else {?>
                                                <input type="submit" class="btn btn-success text-white p-2 w-100" name="valider" value="<?=$bouton?>">
                                            <?php } ?>
                                        </div>
                                            
                    
                    
                                    </form>
                                    </div>
                                    <?php }else { ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="?update=essence" class="btn btn-dark p-2  mt-1 w-100">Mettre a jour le prix essence</a>

                                            </div>
                                            <div class="col-6">
                                                <H3>prix a jour mazout </H3>
                                                    <h5>detail: <?=$_SESSION['prix_mazoutL']?></h5>
                                                    <h5>Gros : <?=$_SESSION['prix_mazoutF']?></h5>
                                                
                                            </div>
                                      </div>
                                        <?php }  ?>


                                      
                           

                               <?php }else if($nombreM>0 && !isset($_GET['id'])){?>
                                   <?php if(isset($_GET['update']) && $_GET['update']=='mazout')  {?>
                                    <div>
                                    <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST" enctype="multipart/form-data">
                                     <h3 class="card-title text-center ">mettre a jour le prix de mazout</h3>
                                        <div class="row">
                                            <center><em>NB le prix de revient actuel est de <?=$last_mazout['PR']?></em> </center>
                                            <input type="text" name="type"  hidden id="type" value="mazout" >
                                            <input type="text" name="entree"  hidden id="entree" value="<?=$last_mazout['id']?>" >
                                            <div class="col-xl-12  col-lg-12  col-md-12   col-sm-12  p-3">
                                                <label for="">Prix detail </span></label>
                                                <input autocomplete="off" required type="number" class="form-control" min="<?=$last_mazout['PR']?>" step="0.01" placeholder="ex: 1.7"  name="prix_detail" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_detail']?>" <?php } ?>> 
                                            </div>
                                            <div class="col-xl-12  col-lg-12  col-md-12   col-sm-12  p-3">
                                                <label for="">Prix gros  </span></label>
                                                <input autocomplete="off" required type="number" class="form-control"  min="<?=$last_mazout['PR']*207?>" step="0.01" placeholder="ex: 230"  name="prix_gros" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_gros']?>" <?php } ?>> 
                                            </div>
                                         
                                            
                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                           
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 ">
                                    
                                        <?php if(isset($_GET['id'])){?>
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="<?=$bouton?>">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                <a href="prix.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                            </div>
                                        </div>
                                        <?php }else {?>
                                                <input type="submit" class="btn btn-success text-white p-2 w-100" name="valider" value="<?=$bouton?>">
                                            <?php } ?>
                                        </div>
                                            
                    
                    
                                    </form>
                                    </div>
                                    <?php }else { ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <H3>prix a jour essence </H3>
                                                <h5>detail: <?=$_SESSION['prix_essenceL']?></h5>
                                                 <h5>Gros : <?=$_SESSION['prix_essenceF']?></h5>
                                                
                                            </div>
                                            <div class="col-6">
                                                <a href="?update=mazout" class="btn btn-dark p-2  mt-1 w-100">Mettre a jour le prix de mazout</a>

                                            </div>
                                            
                                        </div>
                                        <?php }  ?>


                                      
                           

                                <?php }else if(isset($_GET['id'])) {?>
                                    <div>
                                    <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST" enctype="multipart/form-data">
                                     <h5 class="card-title text-center "><?=$titre?></h5>
                                        <div class="row">
                                            
                                            <div class="col-xl-12  col-lg-12  col-md-12   col-sm-12  p-3">
                                                <label for="">Prix detail </span></label>
                                                <input autocomplete="off" required type="number" class="form-control" step="0.01" placeholder="ex: 2800"  name="prix_detail" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_detail']?>" <?php } ?>> 
                                            </div>
                                            <div class="col-xl-12  col-lg-12  col-md-12   col-sm-12  p-3">
                                                <label for="">Prix gros  </span></label>
                                                <input autocomplete="off" required type="number" class="form-control" step="0.01" placeholder="ex: 2800"  name="prix_gros" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['prix_gros']?>" <?php } ?>> 
                                            </div>
                                         
                                            
                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                           
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 ">
                                    
                                        <?php if(isset($_GET['id'])){?>
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="<?=$bouton?>">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                <a href="prix.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                            </div>
                                        </div>
                                        <?php }else {?>
                                                <input type="submit" class="btn btn-success text-white p-2 w-100" name="valider" value="<?=$bouton?>">
                                            <?php } ?>
                                        </div>
                                            
                    
                    
                                    </form>
                                    </div>
                                <?php } else{?>
                                    <div class="row">
                                        <div class="col-6">
                                            <H3>prix a jour essence </H3>
                                                <h5>detail: <?=$_SESSION['prix_essenceL']?></h5>
                                                 <h5>Gros : <?=$_SESSION['prix_essenceF']?></h5>
                                        </div>
                                        <div class="col-6">
                                            <H3>prix a jour mazout </H3>
                                                <h5>detail: <?=$_SESSION['prix_mazoutL']?></h5>
                                                 <h5>Gros : <?=$_SESSION['prix_mazoutF']?></h5>
                                        </div>
                                        
                                    </div>
                                    <?php }?>


                                
                  <?php }  ?>

                                <div class="row">
                                    <div class="shadow p-3 col-6">
                                        <table class="table datatable  ">
                                           
                                        <h4 class="p-3 ">Historique du prix essence</h4>
                                            <thead>
                                                <tr>
                                                    <th scope="col">N°</th>
                                                    <th scope="col">date</th>
                                                    <th scope="col">prix detail</th>
                                                    <th scope="col">prix gros </th>
                                                    <th scope="col">PR </th>
                                                   
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                            
                                                $numero=0;
                                                while($dataE=$SelDataE->fetch())
                                                { 
                                                    $numero++;
                                                ?>
                                            <tr>
                                                    <th scope="row"><?php echo $numero; ?></th>
                                                    <td><?php $dates=strtotime($dataE["dates"]); echo date('d/m/Y ',$dates);?> </td>
                                                    <td><?=$dataE['prix_detail']?> $</td>
                                                    <td><?=$dataE['prix_gros']?> $</td>
                                                    <td><?=$dataE['PR']?> $</td>
                                                   
                                                

                                            </tr>
                                                


                                            
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    <div class="shadow p-3 col-6">
                                        <table class="table datatable  ">
                                        <h4 class="p-3 ">Historique prix mazout</h4>
                                            <thead>
                                                <tr>
                                                    <th scope="col">N°</th>
                                                    <th scope="col">date</th>
                                                    <th scope="col">prix detail</th>
                                                    <th scope="col">prix gros </th>
                                                    <th scope="col">PR </th>
                                                   
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                            
                                                $numero=0;
                                                while($dataM=$SelDataM->fetch())
                                                { 
                                                    $numero++;
                                                ?>
                                            <tr>
                                                    <th scope="row"><?php echo $numero; ?></th>
                                                    <td><?php $dates=strtotime($dataM["dates"]); echo date('d/m/Y ',$dates);?> </td>
                                                    <td><?=$dataM['prix_detail']?> $</td>
                                                    <td><?=$dataM['prix_gros']?> $</td>
                                                    <td><?=$dataM['PR']?> $</td>
                                                   
                                                

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
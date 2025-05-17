<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-non_livrer.php');
if(isset($_GET['liv']))
{
    $id=$_GET['liv'];
    $statut=1;
   $livrer=$connexion->prepare("UPDATE nonlivrer set statut=? where id=?");
   $livrer->execute(array($statut,$id));
   if($livrer)
   {
        $_SESSION['notif']="livraison reussie ";
        $_SESSION['color']='success';
        $_SESSION['icon']="check-circle-fill";
        header('location:non_livrer.php');
   }
    
   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>livraison </title>
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
            
                <h2 class=" text-white">livraison</h2>
              
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
                                    <a href="non_livrer.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a> 
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer le bon   de "<b> <?=$supprimer['nom']."  ".$supprimer['postnom']." d'une  quantite d'essence ".$supprimer['quantite_essence']." L et  d'une quantite de mazout de  ".$supprimer['quantite_mazout']?> L </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-non_livrer.php?iddel=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="non_livrer.php" class="btn btn-success">Annuler</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }else { ?>
                            <?php if(isset($_GET['new']) && !isset($_GET['com'])){?>
                                <div class="shadow p-3 row">
                                    <center><h2>Choisir la commande  du client</h2></center>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                <label for=""></span></label>
                                                <a href="non_livrer.php?fin"><input type="buttom" class="btn btn-success w-100" name="annuler " value="Annuler l'operation"></a>
                                        </div>
                                            
                                        <div class="col-xl-12 col-lg-12  p-3">
                                                <form class="search-form d-flex row "   method="get">
                                                            <input class="col-xl-10 col-lg-10 col-md-10  col-sm-10 p-3 m-1" required autocomplete="off" type="text" name="search" placeholder="Rechercher le client" title="">
                                                            <input hidden type="text" name="new">
                                                            <button class="col-xl-1 col-lg-1 col-md-1  col-sm-1 p-3 m-1 btn btn-dark" type="submit" title="Search"><i class="bi bi-search "></i></button>
                                                    <?php if(isset($_GET['search'])){ ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                        <a href="non_livrer.php?new"><input  class="btn btn-success "type="button" value="Voir tout"></a>
                                                    </div>
                                                    <?php } ?>
                                                </form>
                                        </div>
                                        <?php
                                            $nb=0;
                                            while($commande=$sel_commande->fetch()){
                                             $quantite_essence=0;
                                             $quantite_mazout=0;
                                             $com=$commande['id'];
                                             $sel_details=$connexion->prepare("SELECT * from panier where commande=?");
                                             $sel_details->execute(array($com));
                                             while($details=$sel_details->fetch())
                                             {
                                                if($details['type_achat']=="fut")
                                                {
                                                    $quantite=$details['quantite']*207;
                                                }
                                                else
                                                {
                                                    $quantite=$details['quantite'];
                                                }
                                                if($details['type']=="essence")
                                                {
                                                    $quantite_essence=$quantite_essence+$quantite;
                                                }
                                                else
                                                {
                                                    $quantite_mazout=$quantite_mazout+$quantite;
                                                }

                                             }
                                                
                                           
                                            ?>
                                        
                                            <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6" >
                                                <a class=" btn btn-white shadow m-3 w-100 text-align-left" href="non_livrer.php?idcom=<?=$commande['id']?>&quantite_essence=<?=$quantite_essence?>&quantite_mazout=<?=$quantite_mazout?>">
                                                    <div class=row>
                                                        
                                                        <div class="col-12">
                                                            <div class="row">
                                                               
                                                                <div class="col-12">
                                                                <b>Noms : </b><?=$commande['nom'].' '.$commande['postnom'].' '.$commande['prenom']?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>facture N° : </b><?php echo sprintf('%04d', $commande['numfacture'])?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>date  : </b> <?php $dates=strtotime($commande["dates"]); echo date('d/m/Y',$dates);?>
                                                                </div>
                                                                <div class="col-12">
                                                                <b>quantite  essence : </b> <?=$quantite_essence?> L
                                                                </div>
                                                                <div class="col-12">
                                                                <b>quantite  mazout : </b>   <?=$quantite_mazout?>L
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
                        

                     
                            
                            <?php }else if(isset($_GET['idcom'])){ ?>
                            
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                            <form  class="shadow  p-3 m-3" action="../models/add/add-non_livrer.php?idcom=<?=$_GET['idcom']?>&quantite_essence=<?=$_GET['quantite_essence']?>&quantite_mazout=<?=$_GET['quantite_mazout']?>" method="POST">
                                                <h5 class="card-title text-center "></h5>
                                                <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                            <label for="">quantite essence en L<?=$_GET['quantite_essence']?></span></label>
                                                            <input autocomplete="off" required type="number" step="0.001" max="<?=$_GET['quantite_essence']?>"  class="form-control" placeholder="Ex:150"  name="quantite_essence" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['montant']?>" <?php } ?>> 
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                            <label for="">quantite mazout en L <?=$_GET['quantite_mazout']?></span></label>
                                                            <input autocomplete="off" required type="number" step="0.001" max="<?=$_GET['quantite_mazout']?>"  class="form-control" placeholder="Ex:150"  name="quantite_mazout" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['montant']?>" <?php } ?>> 
                                                        </div>

                                                    
                                                        
                                                        <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                                            <?php if(isset($_SESSION['notif'])){ ?>
                                                                <center><p class="alert-<?=$_SESSION['color']?> alert">
                                                                <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                                        
                                                                </p></center> 
                                                            <?php } ?> 
                                                        </div>
                                                        
                                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 row">
                                                    
                                                                <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                                    <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="enregistrer">
                                                                </div>
                                                                <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                                    <a href="non_livrer.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                                                </div>
                                                            
                                                    </div>
                                                </div>   
                            
                            
                                            </form>
                                        </div>
                                        
                                    
                                    </div>
                                
                                <?php }else{ ?>
                                 
                              
                                <a href=" non_livrer.php?new" class="col-12 btn btn-outline-success">ajouter un bon  </a> 
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                        <?php if(isset($_SESSION['notif'])){ ?>
                                            <center><p class="alert-<?=$_SESSION['color']?> alert">
                                            <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                    
                                            </p></center> 
                                        <?php } ?> 
                                    </div>
                            <?php } ?>
                <?php }  ?>
                            <div class=" table-responsive shadow p-3">
                                <table class="table table-borderless datatable   ">
                                <h4 class="p-3 ">Liste de non livres</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>  
                                           
                                            <th scope="col">Date</th>
                                            <th scope="col">client</th>
                                           
                                            <th scope="col">commande N°</th>
                                            <th scope="col">Quantite Essence</th>
                                            <th scope="col">Quantite mazout</th>
                                            <th scope="col">Statut</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $quantite=0;
                                        $numero=0;
                                        $totalg=0;
                                        while($data=$SelData->fetch())
                                        {
                                            $numero++;
                                        ?>
                                       <tr>
                                            <th scope="row"><?php echo $numero; ?></th>
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y',$dates);?></td>
                                            <td><?=$data['numero']." : ".$data['nom']." ".$data['postnom']." ".$data['prenom']?></td>
                                            
                                           
                                            <td> <?php echo sprintf('%04d', $data['numfacture']);?></td>
                                            <td><?=$data['quantite_essence']?>L</td>
                                            <td><?=$data['quantite_mazout']?>L</td>
                                            <td><?php if($data['statut']==0){ echo "non livrer ";}else{ echo "livré";}?></td>
                                          
                                            <td>
                                            <?php if($data['statut']==0){?>
                                                <a href="?liv=<?=$data['id']?>"  class="btn btn-info btn-sm ">livrer</a>
                                                <?php } ?>
                                                <a href="bondelivraison.php?com=<?=$data['id']?>" class="btn btn-success btn-sm "><i
                                                class="bi bi-printer-fill"></i></a>
                                           

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
    

     

        <footer id="footer">
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
<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-sortie.php');
if(isset($_GET['idclient']))
{

   
  

   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>sortie </title>
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
            
                <h2 class=" text-white">sortie</h2>
              
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
                                    <a href="sortie.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer l'sortie de "<b> <?=$supprimer['nom']."  ".$supprimer['postnom']." d'une quantite de ".$supprimer['quantite']." L au prix de  ".$supprimer['prix']?> par L </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-sortie.php?iddel=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="sortie.php" class="btn btn-success">Annuler</a>
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
                                                <a href="sortie.php?fin"><input type="buttom" class="btn btn-success w-100" name="annuler " value="Annuler l'operation"></a>
                                        </div>
                                            
                                        <div class="col-xl-12 col-lg-12  p-3">
                                                <form class="search-form d-flex row "   method="get">
                                                            <input class="col-xl-10 col-lg-10 col-md-10  col-sm-10 p-3 m-1" required autocomplete="off" type="text" name="search" placeholder="Rechercher avec les noms de l'Client" title="">
                                                            <input hidden type="text" name="new">
                                                            <button class="col-xl-1 col-lg-1 col-md-1  col-sm-1 p-3 m-1 btn btn-dark" type="submit" title="Search"><i class="bi bi-search "></i></button>
                                                    <?php if(isset($_GET['search'])){ ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                        <a href="sortie.php?new"><input  class="btn btn-success "type="button" value="Voir tout"></a>
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
                                                <a class=" btn btn-white shadow m-3 w-100" href="sortie.php?idclient=<?=$Client['numero']?>">
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
                            <?php }else if(isset($_GET['com']) || isset($_GET['id'])){ ?>
                                <center><h3> Quantite  stock essence = <?=$_SESSION['stock_essence']?> L</h3></center> 
                                <center><h3> Quantite  stock mazout = <?=$_SESSION['stock_mazout']?> L</h3></center> 
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6">
                                         <form  class="shadow  p-3 m-3" action="<?=$action?>" method="POST">
                                            <h5 class="card-title text-center "></h5>
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                    <label for="">type</span></label>
                                                    <select name="type" id="type" class="form-select">
                                                        
                                                            <option value="essence">essence </option>
                                                            <option value="mazout">mazout</option>
                                                        
                                                    
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                    <label for="">Achat par</span></label>
                                                    <select name="type_achat" id="type_achat" class="form-select">
                                                        
                                                            <option value="litre">litre  </option>
                                                            <option value="fut">fut</option>
                                                        
                                                    
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                    <label for="">quantite</span></label>
                                                    <input autocomplete="off" required type="text" class="form-control" placeholder="Ex:12.5"  name="qte" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['quantite']?>" <?php } ?>> 
                                                </div>
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                                    <?php if(isset($_SESSION['notif'])){ ?>
                                                        <center><p class="alert-<?=$_SESSION['color']?> alert">
                                                        <b> <i class="bi bi-<?=$_SESSION['icon']?>">  <?php echo $_SESSION['notif']; unset($_SESSION['notif']) ?></i></b>
                                                                
                                                        </p></center> 
                                                    <?php } ?> 
                                                </div>
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 ">
                                            
                                                    <?php if(isset($_GET['id'])){?>
                                                    <div class="row">
                                                        <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                            <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="<?=$bouton?>">
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                            <a href="sortie.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                                        </div>
                                                    </div>
                                                    <?php }else {?>
                                                            <input type="submit" class="btn btn-success text-white p-2 w-100" name="valider" value="valider">
                                                        <?php } ?>
                                                </div>
                                            </div>
                                                
                        
                        
                                        </form>
                                    </div>
                                   
                                    <div class="shadow p-3 col-xl-6 col-lg-6 col-md-6  col-sm-6">

                                        <?php if(isset($_GET['com'])){?>
                                        <div>

                                            <h5>STATION ENERGIE MUYISA</h5>
                                            <p>CLIENT : <?=$detail['client'];?></p>
                                            <p>Date : <?php $dates=strtotime($detail["dates"]); echo date('d-m-Y',$dates);?></p>
                                            <p>Paiement : <?php if($detail['type']==1){ echo "cash";}else { echo "credit";}?> </p>
                                        </div>
                                        <?php } ?>
                                        

                                        <div class=" table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                     <th scope="col">Qte</th>
                                                    <th scope="col">designation</th>
                                                   
                                                    <th scope="col">P.U</th>
                                                    <th scope="col">P.T</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $numero=0;
                                                $total=0;
                                                $totalo=0;
                                                while($data=$Selpanier->fetch()){
                                                    $numero++;
                                                    $PT=$data['prixunitaire']*$data['quantite'];
                                                    $total=$total+$PT;
                                                    $totalo=$total;
                                                ?>
                                                <tr>
                                                    <td><?=$data['quantite']?></td>
                                                   
                                                    <td><?=$data['type_achat']." ".$data['type']?></td>
                                                   
                                                    <td><?=$data['prixunitaire']?> $</td>
                                                    <td><?=$PT?> $</td>
                                                    <td>
                                                    
                                                        <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                                                        href="../models/del/del-sortie.php?iddelpanier=<?=$data['id']?>&com=<?=$_GET['com']?>"
                                                        class="btn btn-danger btn-sm "><i class="bi bi-trash3-fill"></i></a>
                                                    </td>
                                                </tr> 
                                                <?php } ?> 
                                                <tr>
                                                <td colspan='3'>TOTAL</td>
                                                <td><?=$total?>$</td>
                                                </tr>       
                                            </tbody>
                                        </table>
                                        </div>

                                        </div>
                                        <div class="col-4"><a  href="../models/del/del-sortie.php?cancel=<?=$_GET['com'];?>" class="col-12 btn btn-danger ">Annuler </a> </div>
            
                                        <div  <?php if($totalo==0){ ?> Hidden <?php } ?> class="col-8"><a href="facture.php?com=<?=$_GET['com'];?>"  class="col-12 btn btn-dark ">Valider et imprimer</a> </div>

                                        <div class="col-12 p-3"><a  href="sortie.php?new" class="col-12 btn btn-outline-dark bi bi-plus">Nouvelle commande</a> </div>

                                    
                            </div>

                            <?php }else if(isset($_GET['idclient'])){ ?>
                            
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                         <form  class="shadow  p-3 m-3" action="../models/add/add-sortie.php?client=<?=$_GET['idclient']?>" method="POST">
                                            <h5 class="card-title text-center "></h5>
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                    <label for="">Type de vente</span></label>
                                                    <select name="type" id="type" class="form-select">
                                                        
                                                            <option value="1">cash </option>
                                                            <option value="2">credit</option>
                                                        
                                                    
                                                    </select>
                                                    
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
                                                            <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider_new" value="suivant">
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-4  col-sm-4">
                                                            <a href="sortie.php" class="btn btn-dark p-2  mt-1 w-100">Annuler</a>
                                                        </div>
                                                    
                                            </div>
                                                
                        
                        
                                        </form>
                                    </div>
                                   
                                   </div>
                            
                            <?php }else{ ?>
                                <center><h3> Quantite  stock essence = <?=$_SESSION['stock_essence']?> L</h3></center> 
                                <center><h3> Quantite  stock mazout = <?=$_SESSION['stock_mazout']?> L</h3></center> 
                                <a href=" sortie.php?new" class="col-12 btn btn-outline-success">vendre</a> 
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
                                <h4 class="p-3 ">Liste d'sortie</h4>
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>  
                                            <th scope="col">Client</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">type achat</th>
                                            <th scope="col">montant</th>
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
                                            <td><?=$data['nom']." ".$data['postnom']." ".$data['prenom']?></td>
                                            <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y',$dates);?></td>
                                            <td> <?php if($data['type']==1){ echo "cash";}else { echo "credit";}?></td>
                                           
                                            <td><?=$total?>$</td>
                                            <td>
                                            <a href="facture.php?com=<?=$data['id']?>" class="btn btn-success btn-sm "><i
                                             class="bi bi-eye-fill"></i></a>

                                              <a   href="?idsup=<?=$data['id']?>"
                                                class="btn btn-dark btn-sm "><i class="bi bi-trash3-fill"></i></a>
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
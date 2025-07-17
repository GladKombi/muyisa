<?php 
include('../connexion/connexion.php');
include_once('../models/select/sel-payerdeclaration.php');

if(isset($_GET['retour']))
{
    $_SESSION['retour']=$_GET['retour'];
}

if($_SESSION['retour']==1)
{
    $lien_retour="payerdeclaration.php?new";
}
else
{
    $lien_retour="declarer.php";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>payement declaration  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- link -->
    <?php 
    include_once('../include/link.php');
    
    ?>
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
      border: 2px solid black; 
      border-collapse: collapse; 
  }
 
</style>
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
            
                <h2 class=" text-white">payement declaration </h2>
              
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
                                    <a href="payerdeclaration.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                    
                                </div>
                                <div class="card-body py-3  text-white">
                                    Voulez-vous vraiment supprimer l'sortie de "<b> <?=$supprimer['nom']."  ".$supprimer['postnom']." d'une quantite de ".$supprimer['quantite']." L au prix de  ".$supprimer['prix']?> par L </b>"?
                                    <br>
                                    <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                </div>
                                <div class="card-footer">
                                    <a href='../models/del/del-payerdeclaration.php?iddel=<?=$_GET['idsup'] ?>' class="btn btn-outline-danger">Supprimer</a>
                                    <a href="payerdeclaration.php" class="btn btn-success">Annuler</a>
                                </div>
                            </div>
                        </div>
                    <?php
                }else { ?>
                            <?php if(isset($_GET['new']) ){?>
                                <div class="shadow p-3 row">
                                    <center><h2>Choisir la declaration</h2></center>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                <label for=""></span></label>
                                                <a href="?fin"><input type="buttom" class="btn btn-success w-100" name="annuler " value="Annuler l'operation"></a>
                                        </div>
                                            
                                        <div class="col-xl-12 col-lg-12  p-3">
                                                <form class="search-form d-flex row "   method="get">
                                                            <input class="col-xl-10 col-lg-10 col-md-10  col-sm-10 p-3 m-1" required autocomplete="off" type="text" name="search" placeholder="Rechercher avec les noms du declarant" title="">
                                                            <input hidden type="text" name="new">
                                                            <button class="col-xl-1 col-lg-1 col-md-1  col-sm-1 p-3 m-1 btn btn-dark" type="submit" title="Search"><i class="bi bi-search "></i></button>
                                                    <?php if(isset($_GET['search'])){ ?>
                                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                        <a href="payerdeclaration.php?new"><input  class="btn btn-success "type="button" value="Voir tout"></a>
                                                    </div>
                                                    <?php } ?>
                                                </form>
                                        </div>
                                        <?php
                                            $nb=0;
                                            $rows=$SelDecl->fetchAll();
                                            unset($SelDecl);
                                            foreach($rows as $declarant){
                                                $nb++;
                                             
                                                
                                            
     

                                                        $decl_sel= $declarant['decl'];
                                                        $sel_solde=$connexion->prepare("SELECT SUM(montant) as som from paiment_declaration where declaration=?");
                                                        $sel_solde->execute(array($decl_sel));
                                                        $soldee=$sel_solde->fetch();
                                                        if($soldee['som']!="")
                                                        {
                                                            $reste=$declarant['montant']-$soldee['som'];
                                                        }
                                                        else
                                                        {
                                                            $reste=$declarant['montant'];
                                                        }
                                                        
                                                       
                                                
                                           
                                            ?>
                                        
                                            <div <?php if($reste==0){?> hidden <?php } ?> class="col-xl-6 col-lg-6 col-md-6  col-sm-6  ">
                                                <a class=" btn btn-white shadow m-3 w-100" href="payerdeclaration.php?iddecl=<?=$declarant['decl']?>">
                                                    <div class=row>
                                                        
                                                        <div   class="col-12">
                                                            <div  class="row">
                                                               <div class="col-12">
                                                                <b>Date : </b> <?php echo date('d/m/Y',strtotime($declarant['dates']));?>  
                                                               </div>
                                                                <div class="col-12">
                                                                <b>Declarant : </b><?=$declarant['nom'].' '.$declarant['postnom'].' '.$declarant['prenom']?>
                                                                </div>
                                                                
                                                                <div class="col-12">
                                                                <b>Camion : </b> <?=$declarant['plaque']?>
                                                                </div>
                                                                <div class="col-12">
                                                                    <b>marchandise</b> : <?=$declarant['quantite']." m3 ".$declarant['type']?>
                                                                </div>
                                                                <div class="col-12">
                                                                   <b>montant total :<?=$declarant['montant']?> $</b> 
                                                                </div>
                                                                 <div class="col-12">
                                                                   <b>montant  payer:<?=$soldee['som']?> $</b> 
                                                                </div>
                                                                <div class="col-12">
                                                                   <b>reste:<?=$reste?> $</b> 
                                                                </div>
                                                            
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    </a>
                                            </div>
                                    
                                        <?php }   ?> 
                                                <?php if($nb==0){ ?>
                                                    <center><?=$message?></center>
                                               <?php } ?> 

                                        </div>
                                
                                </div>
                        

                            <?php }else if(isset($_GET['iddecl'])){ ?>
                            
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                         <div class="col-5 no-print mb-3">
                                             <a href="<?=$lien_retour?>" class="btn btn-success col-12 me-2">retour</a>
                                        </div>
                                                                                
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
                                                 <tr>
                                                    <?php
                                                    $solde=$details['montant'];
                                                    
                                                    ?>
                                                        
                                                        <td><?php echo date('d/m/Y',strtotime($details['dates']));?>  </td>
                                                        <td><center>declaration du camion <?=$details['plaque']." de ".$details['quantite']." m3 ".$details['type']."/".$details['four']?></center></td>
                                                        <td><center><?=$details['montant']?></center></td>
                                                        <td><center>---</center></td>
                                                        <td><center><?=$solde?></center></td>
                                                    </tr>
                                                <?php while($fiche=$sel_fiche->fetch()){ 
                                                    $solde=$solde-$fiche['montant'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo date('d/m/Y',strtotime($fiche['dates']));?>  </td>
                                                        <td><center><?php if($solde>0){ echo "avance sur declaration";}else {echo "solder la declaration";}?></center></td>
                                                        <td><center>---</center></td>
                                                        <td><center><?=$fiche['montant']?></center></td>
                                                        <td><center><?=$solde?></center></td>
                                                        
                                                    </tr>
                                                 <?php } ?>
                                                 
                                                </div>
                                                
                                            </tbody>
                                        </table>
                                             <div class="row">
                                                <?php if($solde>0){?>
                                                    <div class="col-5 no-print mb-3">
                                                        <a href="?payer=<?=$solde?>&decl=<?=$_GET['iddecl']?>" class="btn btn-success col-12 me-2">Payer une tranche</a>
                                                    </div>
                                                    <div class="col-5 no-print mb-3">
                                                        <a href="?solder=<?=$solde?>&decl=<?=$_GET['iddecl']?>" class="btn btn-success col-12 me-2">Solder cette declaration</a>
                                                    </div>
                                                    <div class="col-2 no-print mb-3">
                                                        <button onclick="window.print()" class="btn btn-dark col-12 me-2">Imprimer</button>
                                                    </div>
                                                <?php }else{ ?>
                                                     <div class="col-12 no-print mb-3">
                                                        <button onclick="window.print()" class="btn btn-dark col-12 me-2">Imprimer</button>
                                                    </div>
                                                 
                                                <?php }?>
                                        </div>
                                        
                                    </div>
                                  
                                   
                                </div>
                            
                        <?php }else if(isset($_GET['payer'])){ ?>
                            
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                        
                                         <form  class="shadow  p-3 m-3" action="../models/add/add-paiement_declaration.php?decl=<?=$_GET['decl']?>" method="POST">
                                            <h5 class="card-title text-center "></h5>
                                            <div class="row">
                                                
                                            <center><h3>solde=<?=$_GET['payer']?>$ </h3></center>
                                                 <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                                            <label for=""> Entrez le montant a payer </span></label>
                                                            <input autocomplete="off" required type="number" step="0.001" max="<?=$_GET['payer']?>"  class="form-control" placeholder="Ex:150.500"  name="montant" <?php if(isset($_GET['id'])){ ?> value="<?=$modData['montant']?>" <?php } ?>> 
                                                </div>
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">


                                            
                                                </div>
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 ">
                                            
                                                    <?php if(isset($_GET['id'])){?>
                                                    <div class="row">
                                                        <div class="col-xl-8 col-lg-8 col-md-8  col-sm-8">
                                                            <input type="submit" class="btn btn-success text-white p-2 mt-1 w-100" name="valider" value="Enregistrer">
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
                                  
                                   
                                </div>
                            
                        <?php }else if(isset($_GET['solder'])){ ?>
                            
                                <div class="col-12 h-100  d-flex justify-content-center align-items-center p-4">
                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 bg-black card p-3 shadow   m-3">
                                        <div class="card-header text-dark d-flex justify-content-between">
                                            <b class="text-white">Solder la declaration</b>
                                            <a href="payerdeclaration.php" class="btn btn-outline-danger text-white"><b><i class="bi bi-x"></i></b></a>
                                            
                                        </div>
                                        <div class="card-body py-3  text-white">
                                            Voulez-vous vraiment supprimer solder cette declaration au montant de  <?=$_GET['solder']?> $ </b>"?
                                            <br>
                                            <em class="mt-3 text-danger">NB: cette action est irréversible</em>
                                        </div>
                                        <div class="card-footer">
                                            <a href='../models/add/add-paiement_declaration.php?decl=<?=$_GET['decl'] ?>&solder=<?=$_GET['solder']?>' class="btn btn-outline-danger">Solder </a>
                                            <a href="payerdeclaration.php?iddecl=<?=$_GET['decl'] ?>" class="btn btn-success">Annuler</a>
                                        </div>
                                    </div>
                                </div>
                            
                        <?php }else{ ?>
                                 
                                <center><h3> montant  en caisse = <?=$_SESSION['caisse']?> $</h3></center> 
                                <a href="?new" class="col-12 btn btn-outline-success">Payer une declaration</a> 
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
<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['fonction']) || empty($_SESSION['fonction'] ))
{
  header('location:../index.html');
}
?>
<header id="header" class="bg-success no-print">
    <div class="d-flex flex-column " >

      <div class="profile">
         <!-- <img src="../assets/img/profils/al.jpg" alt="" class="img-fluid rounded"  height=50> -->
        <img src="../assets/img/logoo.jpg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="#">MUYISA ÉNERGIE</a></h1>
       
        <div class="social-links mt-3 text-center">
      
         
          <hr class="text-white">

       
        </div>
      </div>
     

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li class=""><a  href="../views/accueil.php" class="nav-link scrollto active pb-0 mb-0 "><i class="bx bx-home text-white"></i><strong> <span>Home</span></strong></a></li>
          
          <?php if($_SESSION['fonction']=="gerant"){?>
                <li ><a href="../views/taux.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-repeat text-white"></i><strong> <span>Taux d'echange</span></strong></a></li>
                <li ><a href="../views/prix.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-bar-chart-fill text-white"></i><strong> <span>definir le prix</span></strong></a></li>
                <li ><a href="../views/camion.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-truck text-white"></i><strong> <span>camion</span></strong></a></li>
                <li ><a href="../views/fournisseur.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>fournisseur</span></strong></a></li>
                <li ><a href="../views/commande_ap.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-cart-plus-fill text-white"></i><strong> <span>commande carburant</span></strong></a></li>
                <li ><a href="../views/chargement.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-up-circle-fill text-white"></i><strong> <span>chargement</span></strong></a></li>
                <li ><a href="../views/declarant.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>declarant</span></strong></a></li>
                <li ><a href="../views/declarer.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>declarer un camion</span></strong></a></li>
                <li ><a href="../views/payerdeclaration.php?retour=1" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>Payement declarationn</span></strong></a></li>
                <li ><a href="../views/approvisionnement.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-down-circle-fill text-white"></i><strong> <span>approvisionnement</span></strong></a></li>
                <li ><a href="../views/personnel.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>personnel</span></strong></a></li>
                <li ><a href="../views/client.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>Client</span></strong></a></li>
                <li ><a href="../views/sortie.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-left-circle-fill text-white"></i><strong> <span>vente en credit</span></strong></a></li>
                <li ><a href="../views/remuneration.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-calculator-fill text-white"></i><strong> <span>Remuneration</span></strong></a></li>
                <li ><a href="../views/bondesortie.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-arrow-left-circle-fill text-white"></i><strong> <span>bon de sortie</span></strong></a></li>

   <li ><a href="../views/fichedeclarant.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-card-list text-white"></i><strong> <span>fiche declarant</span></strong></a></li>              
               
               
          <?php } else if($_SESSION['fonction']=="caissiere"){?>
               
                  
         <?php } else if($_SESSION['fonction']=="comptable"){?>
                 <li ><a href="../views/stock.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-box-seam text-white"></i><strong> <span>Verifier stock</span></strong></a></li>
                 <li ><a href="../views/situation_client.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-bar-chart-fill text-white"></i><strong> <span>situation client</span></strong></a></li>
                 <li ><a href="../views/paiement_dette.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-calculator-fill text-white"></i><strong> <span>Paiement dette </span></strong></a></li>
                 <li ><a href="../views/non_livrer.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-cart-dash-fill text-white"></i><strong> <span>non livrer</span></strong></a></li>
          <?php } else { ?>
                 <li ><a href="../views/utilisateur.php" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-people text-white"></i><strong> <span>users</span></strong></a></li>
          <?php } ?>
                 <li ><a  href="../index.html" class="nav-link scrollto active pb-0 mb-0"><i class="bi bi-toggle2-off text-white"></i><strong><span>Deconnexion</span></strong> </a></li>
          
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
         

         
         
          
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header>
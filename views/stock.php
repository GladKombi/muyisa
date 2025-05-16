<?php 
include('../connexion/connexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin </title>
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

<body class="bg-white">

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <main id="main" class="main">
        <div class="row " >
    
           
       
        </div>
       
        
          <section class="section ">
              <div class=" m-3">
             <center> <div class="mt-3">
                <div class="row">
                  <div class="col-6 shadow p-3">
                       <h1 class="text-success">Stock essence : <?=$_SESSION['stock_essence']?>  Litres</h1>
                  </div>
                  <div class="col-6 shadow p-3">
                        <h1 class="text-success">Stock mazout : <?=$_SESSION['stock_mazout']?>  Litres</h1>
                  </div>
                </div>
                  
                  
                
              </div>
            </center>
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
<link rel="stylesheet"type="text/css" href="../assets/css/dashboard.css">
<?php
   
    $title = 'Dashboard Page';
    $baseUrl=  '';
    require_once('layouts/header.php');
if(!empty($_SESSION['current_user']))
{
   
    

    ?>
        <div class ="row">
        <div class="col-md-12">
          <div id="colorlib-main" >
           
           <div class="mid-card">
            <img src="../assets/img/avt.jpg" alt="" srcset="" class="card2">
            </div>
            <div class="mid-card">
                <img src="../assets/img/avt.jpg" alt="" srcset="" class="card2">
                </div>
                <div class="mid-card">
                    <img src="../assets/img/avt.jpg" alt="" srcset="" class="card3">
                    <img src="../assets/img/avt.jpg" alt="" srcset="" class="card3">
                </div>
                <div class="mid-card">
            <img src="../assets/img/avt.jpg" alt="" srcset="" class="card2">
            </div>
                
    </div>

        </div>
 </div>
  
<?php
}
 require_once('layouts/footer.php');
 ?>


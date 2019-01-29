<?php 
session_start();
if(!isset($_SESSION['admin_id'])){
	header('location: signin.php');
}
$catarray = array();
$str = '';
$mid = $_GET['mid'];
$adminid = $_SESSION['admin_id'];
$name = $_SESSION['admin_name'];
$mail = $_SESSION['admin_mail'];
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style1.css">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <?php include('sidebar.php');?>
        <div id="content">
        	<?php include('header.php');?>
      			<?php
      				$selm = "SELECT movie_name, movie_url FROM $tbl_movie  WHERE movie_status = 'active' AND movie_id = '$mid'";
      				$mres = mysqli_query($con, $selm);
      			  $mrow = mysqli_fetch_array($mres); 
            ?>
            <center>
                <iframe width="96%" height="450px" class="i-frame"
                  src="https://www.youtube.com/embed/_qOl_7qfPOM">
                </iframe><br>
      				  <span class="large-span"><?=$mrow['movie_name']?></span>
            </center>
            <?php
              $csel = "SELECT $tbl_cat.cat_name FROM $tbl_cat, $tbl_moviecatrel WHERE  $tbl_cat.cat_id = $tbl_moviecatrel.cat_id AND $tbl_moviecatrel.movie_id = '$mid'";
              $cres = mysqli_query($con, $csel);
              while($crow = mysqli_fetch_array($cres)){
                $catarray[] = $crow['cat_name'];
              }
              $str = @$catarray[0];
              for($i = 1; $i < count($catarray)-1; $i++){
                $str .= ', '.$catarray[$i];
              }
            ?>
          &emsp;&nbsp;<strong>Genere :</strong> <?=$str?><br>
          &emsp;&nbsp;<strong>Cast & Crew :</strong><br>
          <div class="form-row" style="padding:20px;">
            <?php 
            $crsel = "SELECT crew_name, crew_type FROM $tbl_moviecrew  WHERE movie_id = '$mid'";
            $crres = mysqli_query($con, $crsel);
            while($crrow = mysqli_fetch_array($crres)){
              ?>
              <div class="form-group col-md-2" align="center">
                <img src="img/download.png" height="40" width="40" style="border-radius:50%;"><br>
                <span><?php echo $crrow['crew_name'];  ?></span>
              </div>
              <?php
            }
            ?>
          </div>
          <br><br>
        </div>
    </div>
    <script src='js/jquery-2.2.3.min.js'></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
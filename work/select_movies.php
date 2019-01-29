<?php 
session_start();
if(!isset($_SESSION['admin_id'])){
	header('location: signin.php');
}
$adminid = $_SESSION['admin_id'];
$name = $_SESSION['admin_name'];
$mail = $_SESSION['admin_mail'];
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$sel_cat = '';
if(isset($_POST['sel_cat'])){
	$sel_cat = $_POST['sel_cat'];
}

$catarray = array();
$sel = "SELECT 	cat_id, cat_name FROM $tbl_cat WHERE cat_status = 'active'";
$res = mysqli_query($con, $sel);
while($row = mysqli_fetch_array($res)){
	$catarray[$row['cat_id']]=$row['cat_name'];
}
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
        	<form method="post" name="form1" id="form1" action="">
	          	<h4 class="main-title-w3layouts mb-2 text-center">Movie List</h4>
	          	<span class="view-span">View</span>
	          	<select name="sel_cat" id="sel_cat" class="common-sel" onchange="frm_submit();">
	          		<option value="0">All Movies</option>
	          		<?php 
	          			foreach($catarray as $catid => $values){ ?>
	          				<option value="<?=$catid?>" <?php if($sel_cat == $catid) echo 'selected';?> ><?=$values?></option>
	          			<?php }
	          		?>
	          	</select>
	          	<div class="add-pad">          	
	          	<?php
	          		$catsql = '';
	          		if($sel_cat > 0){
	          			$catsql = "AND cat_id = $sel_cat";	
	          		}
	          		$catarray = array();
					$sel = "SELECT 	cat_id, cat_name FROM $tbl_cat WHERE cat_status = 'active' $catsql ";
					$res = mysqli_query($con, $sel);
					while($row = mysqli_fetch_array($res)){
						$catid = $row['cat_id'];
	          		?>
	          			<span class="span-head"><?=$row['cat_name']?></span>
	          			<div class="form-row">
	          			<?php
	          				$selm = "SELECT $tbl_movie.movie_id, $tbl_movie.movie_name, $tbl_movie.movie_url FROM $tbl_movie, $tbl_moviecatrel  WHERE movie_status = 'active' AND $tbl_movie.movie_id = $tbl_moviecatrel.movie_id AND $tbl_moviecatrel.cat_id = '$catid'";
	          				$mres = mysqli_query($con, $selm);
	          				while($mrow = mysqli_fetch_array($mres)){ ?>
	          					<div class="form-group col-md-3" align="center">
									<iframe width="100%" height="140" class="i-frame"
										src="<?=$mrow['movie_url']?>">
									</iframe><br>
		          					<a class="span-mname" href="movie_view.php?mid=<?=$mrow['movie_id']?>" ><?=$mrow['movie_name']?></a>
		          					<a class="span-medit" href="edit_movies.php?mid=<?=$mrow['movie_id']?>" >Edit</a>
		          				</div>
	          				<?php }
	          			?>
	          		</div>
	          		<?php 
	          		}
	          	?>
          		</div>
          	</form>
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
    <script>
    	function frm_submit(){
    		var frm = document.form1;
    		frm.submit();
    	}
    </script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
session_start();
$adminid = $_SESSION['admin_id'];
$name = $_SESSION['admin_name'];
$mail = $_SESSION['admin_mail'];
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$movieid = $_GET['movieid'];
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$type = $_POST['type'];
	$proceed = $_POST['proceed'];
	$image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));
    $sel = "SELECT crew_id FROM $tbl_moviecrew WHERE movie_id = '$movieid' AND crew_name = '$name'  ";
    $sres = mysqli_query($con, $sel);
	if(mysqli_num_rows($sres) == 0){
		$ins = "INSERT INTO $tbl_moviecrew (movie_id, crew_name, crew_type,crew_image) VALUES ('$movieid','$name','$type','')";
		$ires = mysqli_query($con, $ins);
	}
	if($proceed == 'add'){
		header("location: add_cast_crew.php?movieid=$movieid");
	}else{
		header("location: movie_list.php");
	}
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="js/jquery.sumoselect.js"></script>
  <link href="css/sumoselect.css" rel="stylesheet" />
  <script type="text/javascript">
    $(document).ready(function () {
      window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 5, selectAll:true, captionFormatAllSelected: "All Selected" });
      window.groups_eg_g = $('.groups_eg_g').SumoSelect({selectAll:true, search:true });
      $('.SlectBox').on('sumo:opened', function(o) {
        console.log("dropdown opened", o)
      });

    });
  </script>
</head>
<body>
  <div class="wrapper">
    <?php include('sidebar.php');?>
    <div id="content">
      <?php include('header.php');?>
      <div class="outer-w3-agile mt-3">
         <h4 class="tittle-w3-agileits mb-4">Add New Movie</h4>
         <form action="#" method="post" id="form1" name="form1" enctype="multipart/form-data">
         	<input type="hidden" name="proceed" id="proceed">
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputEmail4">Name</label>
                  <input type="name" class="form-control" id="name" name="name" placeholder="Enter Movie Name" >
               </div>
               <div class="form-group col-md-6">
                  	<label for="inputEmail4">Type</label>
                  	<select  placeholder="" id="type" name="type" class="form-control" >
                  		<option value="">Select Type</option>
                        <option value="1">Actor</option>
                        <option value="2">Director</option>
                        <option value="">...</option>
                  	</select>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputEmail4">Add Image</label>
                  <input type="file" name="image" id="image">
               </div>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary" onclick="return get_data(1);">Add Another</button>
                <button type="submit" name="submit" class="btn btn-primary" style="float: right;" onclick="return get_data(2);">Continue</button>
            </div>
        </form>
      </div>
    </div>
  </div>
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
      	function get_data(val){
	      	var frm = document.form1;
	      	if(frm.name.value.trim() == ''){
	      		alert("Enter Name");
	      		frm.name.focus();
	      		return false;
	      	}else if(frm.image.value.trim() == ''){
	      		alert("Add Image");
	      		frm.image.focus();
	      		return false;
	      	}else{
		      	if(val == 1){
		      		frm.proceed.value = 'add';
		      	}else{
		      		frm.proceed.value = 'continue';
		      	}
		      	return true;
		    }
		    return false;
      	}
 	</script>
  	<script src="js/bootstrap.min.js"></script>
</body>
</html>
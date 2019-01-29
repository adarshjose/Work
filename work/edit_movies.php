<?php 
session_start();
if(!isset($_SESSION['admin_id'])){
	header('location: signin.php');
}
$mid = $_GET['mid'];
$cat = array();
$adminid = $_SESSION['admin_id'];
$name = $_SESSION['admin_name'];
$mail = $_SESSION['admin_mail'];
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$sel = "SELECT movie_name, movie_desc, movie_url FROM $tbl_movie WHERE movie_id = '$mid'";
$res = mysqli_query($con,$sel);
$row = mysqli_fetch_array($res);
$name = $row['movie_name'];
$desc = $row['movie_desc'];
$url = $row['movie_url'];
$csel = "SELECT cat_id FROM $tbl_moviecatrel WHERE movie_id = '$mid'";
$cres = mysqli_query($con,$csel);
while($crow = mysqli_fetch_array($cres)){
  $cat[] = $crow['cat_id'];
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
         <form action="#" method="post" id="form1" name="form1">
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputEmail4">Name</label>
                  <input type="name" class="form-control" id="name" value="<?=$name?>" name="name" placeholder="Enter Movie Name" >
               </div>
               <div class="form-group col-md-6">
                  <label for="inputPassword4">Category</label>
                  <select multiple="multiple" onchange="console.log('changed', this)" placeholder="Select Film Category" id="cat" name="cat" class="SlectBox" >
                     <?php
                        $sel = "SELECT cat_id, cat_name FROM $tbl_cat WHERE cat_status = 'active'";
                        $res = mysqli_query($con, $sel);
                        while($row = mysqli_fetch_array($res)){ 
                          $catid = $row['cat_id'];
                          ?>
                          <option value="<?=$catid?>" <?php if(in_array($catid, $cat)){ echo 'selected'; } ?> ><?=$row['cat_name']?></option>
                        <?php }
                     ?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="desc">Discription</label>
               <textarea class="form-control" id="desc" name="desc" style="height: 90px;" placeholder="Movie description..." ><?=$desc?></textarea>
            </div>
            <div class="form-group">
               <label for="url">Trailor Url</label>
               <input type="url" class="form-control" id="url" name="url" value="<?=$url?>" placeholder="Enter Youtube Trailor url" >
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary" onclick="return get_data();">Continue</button>
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
      function get_data(){
         var frm = document.form1;
         var values = $('#cat').val();
         if(frm.name.value.trim() == ''){
            alert("Enter Movie Name");
            frm.name.focus();
         }else if(values <= 0){
            alert("Please Select Any Category To continue");
            frm.cat.focus();
         }else if(frm.desc.value.trim() == ''){
            alert("Enter Movie Description");
            frm.desc.focus();
         }else if(frm.url.value.trim() == ''){
            alert("Enter Movie Url");
            frm.url.focus();
         }else{
            var name = frm.name.value.trim();
            var desc = frm.desc.value.trim();
            var url  = frm.url.value.trim();
            $.ajax({
               type: 'post',
               url : 'ajax_edit_movie.php',
               data: {
                  values:values,
                  name  :name,
                  desc  :desc,
                  url   :url,
                  mid   :<?=$mid?>
               },
               success: function(resp){
                  if(resp == 1){
                    alert("Movie Details Updated");
                     window.location = 'select_movies.php';
                  }
               }
            });
         }
         return false;
      }
  </script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
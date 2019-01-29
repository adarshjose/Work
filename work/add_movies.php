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
                  <input type="name" class="form-control" id="name" name="name" placeholder="Enter Movie Name" >
               </div>
               <div class="form-group col-md-6">
                  <label for="inputPassword4">Category</label>
                  <select multiple="multiple" onchange="console.log('changed', this)" placeholder="Select Film Category" id="cat" name="cat" class="SlectBox" >
                     <?php
                        $sel = "SELECT cat_id, cat_name FROM $tbl_cat WHERE cat_status = 'active'";
                        $res = mysqli_query($con, $sel);
                        while($row = mysqli_fetch_array($res)){ ?>
                          <option value="<?=$row['cat_id']?>"><?=$row['cat_name']?></option>
                        <?php }
                     ?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="desc">Discription</label>
               <textarea class="form-control" id="desc" name="desc" style="height: 90px;" placeholder="Movie description..." ></textarea>
            </div>
            <div class="form-group">
               <label for="url">Trailor Url</label>
               <input type="url" class="form-control" id="url" name="url" placeholder="Enter Youtube Trailor url eg: https://www.youtube.com/embed/_qOl_7qfPOM" >
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
               url : 'ajax_add_movie.php',
               data: {
                  values:values,
                  name  :name,
                  desc  :desc,
                  url   :url
               },
               success: function(resp){
                  if(resp > 0){
                     window.location = 'add_cast_crew.php?movieid='+resp;
                  }else{
                     alert(resp);
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
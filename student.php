<?php session_start();
    include("includes/connection.php");
   if(!isset($_SESSION['user_id'])){
    header("location:login.php?ref_denied");
    }else{
   @$firstName = $_SESSION['firstName'];
   @$lastName = $_SESSION['lastName'];
   @$phoneNumber = $_SESSION['phoneNumber'];
   @$email = $_SESSION['email'];
   @$address = $_SESSION['address'];
?>
<?php
  if(isset($_GET['ref_denied'])){
    //promting user to login
    $login = "<span class='error'>You need to log in first</span>";
  }
?>

<?php 
//loging out
  if(isset($_GET['logout'])){
    session_destroy();
    header("location:login.php");
    exit();
  }
?>
<?php
  if (isset($_POST["upload"])) {
    $viewId = $_SESSION['user_id'];
    @$profile_image = $_FILES['photo']['name'];
    @$extentsion = strtolower(substr($profile_image, strpos($profile_image, '.') + 1));
    @$file_size = $_FILES['photo']['size'];
    @$file_type = $_FILES['photo']['type'];
    @$file_tem_loc = $_FILES['photo']['tmp_name'];
    @$file_store = "images/" . $profile_image;
    

    if (($extentsion == 'jpg' || $extentsion == 'jpeg' || $extentsion == 'png') && $file_type =='image/jpeg') {

      if (move_uploaded_file($file_tem_loc, $file_store)) {
    $updateRecord = $dbconnect->query("UPDATE users SET image ='$profile_image' WHERE user_id = '$viewId'") or die ("fail to update record:" . $dbconnect->error);
    if ($updateRecord = $dbconnect->affected_rows =="1") {
         $_SESSION['success'] = "Image Upload Successfully";
        }else{
          $_SESSION['err'] = "Fail To Upload image";
          }
    }
  }else{
    $_SESSION['err'] = "Invalide File Format";
  }
  } 
?>
  

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Profile Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/design.css" />
    <style>
    a {
      text-decoration:none;
      color: black;
    }

    input[type=text] {
    border: none;
    border-bottom: 1px solid maroon;
    border-radius: none;
}

  input[type=email] {
      border: none;
      border-bottom: 1px solid maroon;
      border-radius: none;
  }
  input[type=password] {
      border: none;
      border-bottom: 1px solid maroon;
      border-radius: none;
  }
      
    </style>
    <script>
    $(document).ready(function(){
        $(".close").click(function(){
            $("#myAlert").alert("close");
        });
    });
  </script>
  </head>

  
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"> DashBoard</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <section>
      <div class="container">
        <div class="row">
            <div class=col-md-12>
              <div class="display1">
                 <?php 
                   if(isset($_SESSION['err'])) { ?>
                <div class="alert alert-danger" id="myAlert">
                  <button class="close" data-dismiss="alert">&times;</button>
                  <?php echo $_SESSION['err'];
                    unset($_SESSION['err']);
                   ?> 
                </div>
                <?php } ?>

                  <!--Do this when registered -->
                  <?php 
                  //Display success
                  if(isset($_SESSION['success'])) { ?>
                  <div class="alert alert-success" id="myAlert">
                    <button class="close" data-dismiss="alert">&times;</button>
                    <?php echo $_SESSION['success'];
                      unset($_SESSION['success']);
                      ?> 
                </div>
              <?php } ?>
          </div>
        </div>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <!-- panel to add biodata -->
          <div class="col-md-9" >
          <div class="panel panel-default" id="panel-Wrapper1">
            <div class="panel-heading main-color-bg" >
              <h3 class="panel-title" > <span class="glyphicon glyphicon-plus"></span> Student Profile</h3>
            </div>
            <div class="panel-body">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo "$firstName";?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo "$lastName";?>" disabled>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">email:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo "$email";?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="<?php echo "$phoneNumber";?>" disabled maxlength="11">
                        </div>
                      </div>


                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="address">Address:</label>
                      <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="<?php echo "$address";?>" disabled>
                      <span class="error-msg"></span>
                    </div>
                  </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default" id="panel-Wrapper1">
          <div class="panel-heading main-color-bg" >
            <h3 class="panel-title" > <span class="glyphicon glyphicon-education"></span> Student Photograph</h3>
          </div>
          <div class="panel-body">
            <form action="student.php" method="post" enctype="multipart/form-data">
              <?php
                  $viewId = $_SESSION['user_id'];
                  $select = $dbconnect->query("SELECT * FROM users WHERE user_id = $viewId") or die ("Fail to fetch record<br/>" . $dbconnect->error);
                  if($select->num_rows>=1){
                  while($row = $select->fetch_assoc()){
                      echo '<img height="40%" alt="profile Image" width="100%" src="images/'.$row['image'].'">';
                    }
                  }
              ?>
              <input type="file" name="photo" class="form-control">
              <br>
              <button type="submit" class="btn btn-primary" name="upload">Submit</button>
            </form>
          </div>
        </div>

        <div class="list-group">
          <a href="#" class="list-group-item active main-color-bg" id="panel-Wrapper1" >
            <span class="glyphicon glyphicon-cog"></span> Settings
          </a>
          <a href="login.php?logout" class="list-group-item" >
            <span class="glyphicon glyphicon-log-out"></span> Logout
          </a>
        </div>
          </div>
    </section>

    <!-- /.container -->
    <section>
      <div class="container" id="footer">
        <div class="row">
          <h1 class="title" >Unique Academy</h1>
          <p class="lead">Learning For Excellence...</p>
          <p class="lead">&copy; 2021-<?php echo date("Y");?></p>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.
    <!-- Placed at the end of the document so the pages load faster -->min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php }?>
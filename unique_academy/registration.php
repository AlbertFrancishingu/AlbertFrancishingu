<?php

  //collecting user information
  include("includes/connection.php");

  if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $password = sha1($_POST['password']);

    //inserting into database
    $insert = $dbconnect->query("INSERT INTO users (firstName, lastName, email, phoneNumber, address, password) VALUES('$first_name', '$last_name', '$email', '$phone_number', '$address', '$password')") or die($dbconnect->error); 

    if ($insert = $dbconnect->affected_rows =="1"){
      $_SESSION['success'] = "Registration Successfull";
    }else{
      $_SESSION['err'] = "Registration not Successfull";
    }


  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Registration Page</title>

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
          <div class="col-md-12" >
          <div class="panel panel-default" id="panel-Wrapper1">
            <div class="panel-heading main-color-bg" >
              <h3 class="panel-title" > <span class="glyphicon glyphicon-plus"></span> Student Registration Form</h3>
            </div>
            <div class="panel-body">
              <form action="registration.php" method="POST">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="" >
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">email:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="" maxlength="11">
                        </div>
                      </div>


                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="address">Address:</label>
                      <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="">
                      <span class="error-msg"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password">Password:</label>
                      <input type="Password" name="password" class="form-control" id="password" placeholder="Password" value="">
                      <span class="error-msg"></span>
                    </div>
                  </div>

                <div class="form-row">
                
                  <div class="form-group col-md-6">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      <button type="reset" class="btn btn-warning" name="reset">Reset</button>

                      <a href="login.php" class="btn btn-md btn-info"> Login</a>
           
                  </div>
                </div>
              </form>
          </div>
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

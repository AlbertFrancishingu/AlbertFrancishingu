<!--starting session to keep user loged in -->
<?php session_start();?>

<?php
include("includes/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Student's Login </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <?php
        //checking if the user has click the button
        if(isset($_POST['submit'])){
          $email = $dbconnect->real_escape_string($_POST['email']);
          $password = sha1($dbconnect->real_escape_string($_POST['password']));
          
          $usercheck = $dbconnect->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'") or die("fail to check<br />" . $dbconnect->error);
            if($usercheck->num_rows=="1"){
            //sucsss
            while($row = $usercheck->fetch_assoc()){
              //create login sessions
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['firstName'] = $row['firstName'];
              $_SESSION['lastName'] = $row['lastName'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['address'] = $row['address'];
              $_SESSION['phoneNumber'] = $row['phoneNumber'];
              header("location:student.php");
              exist();
            }
            
            }else{
              $error['err'] = "<span class='glyphicon glyphicon-exclamation-sign'></span> Incorrect Username Or Password";
            }
        }

      ?>

     <div class="container">
       <div class="row">
         <form action="login.php" method="post" role="form" class="login" id="form_wrapper" >
            </fieldset>
              <legend class="legend">Student Login</legend>
                <div class="display">
                  
                  <?php 
                    //display error message
                   if(isset($error['err'])) { ?>
                    <div class="alert alert-danger">
                      <?php echo $error['err'];?> 
                    </div>
                <?php } ?>
              </div>
            <div class="input">
              <input type="text" name="email" placeholder="Email" required="on"/>
            </div>  
            
            <div class="input">
              <input type="password" name="password" placeholder="Password" required="on" />
            </div>
            <button type="submit" name="submit" class="submit"><i class="fa fa-long-arrow-right"></i></button>
            </fieldset> 
          </form>
       </div>
     </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
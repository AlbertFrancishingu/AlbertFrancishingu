<?php session_start();
    include("includes/connection.php");
   if(!isset($_SESSION['id'])){
    header("location:login.php?ref_denied");
    }else{
   @$firstName = $_SESSION['firstName'];
   @$lastName = $_SESSION['lastName'];
   @$phoneNumber = $_SESSION['phoneNumber'];
   @$email = $_SESSION['email'];
   @$address = $_SESSION['address'];
   @$user_id = $_SESSION['id'];
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
    $viewId = $_SESSION['id'];
    @$profile_image = $_FILES['photo']['name'];
    @$extentsion = strtolower(substr($profile_image, strpos($profile_image, '.') + 1));
    @$file_size = $_FILES['photo']['size'];
    @$file_type = $_FILES['photo']['type'];
    @$file_tem_loc = $_FILES['photo']['tmp_name'];
    @$file_store = "images/" . $profile_image;
    

    if (($extentsion == 'jpg' || $extentsion == 'jpeg' || $extentsion == 'png') && $file_type =='image/jpeg') {

      if (move_uploaded_file($file_tem_loc, $file_store)) {
    $updateRecord = $dbconnect->query("UPDATE users SET image ='$profile_image' WHERE id = '$viewId'") or die ("fail to update record:" . $dbconnect->error);
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
 <?php

  //users' post, inserting into database

  if (isset($_POST['post'])) {
    $post = $_POST['post'];
    $user_id = $_SESSION['id'];

    //inserting into database
    $insert = $dbconnect->query("INSERT INTO chat (post,user_id )VALUES('$post', '$user_id')") or die($dbconnect->error); 

    if ($insert = $dbconnect->affected_rows =="1"){
      $_SESSION['success'] = "Post Sent";
    }else{
      $_SESSION['err'] = "Post not Sent";
    }
  }
?> 

<?php

  //users' comment, inserting into database

  if (isset($_POST['comment']) && isset($_GET['post_id'])) {
    $user_id = $_SESSION['id'];
    $comment_body = ($_POST['comment_body'] );
    $comment = $_GET['post_id'];
    
    //inserting into database
    $insert = $dbconnect->query("INSERT INTO comment (comment, user_id, post_id )VALUES('$comment_body', '$user_id', $comment)") or die($dbconnect->error); 

    if ($insert = $dbconnect->affected_rows =="1"){
      $_SESSION['success'] = "Comment Sent";
    }else{
      $_SESSION['err'] = "comment not Sent";
    }
  }
?>

<?php 
  @$comment = $_GET['post_id'];
  $fetch_comment = $dbconnect->query("SELECT comment.comment, users.firstName FROM comment WHERE post_id = $comment AND comment.user_id = user.id");

  if (is_array($fetch_comment) || is_object($fetch_comment)) {
  
  foreach ($fetch_comment as $comment){
    echo $comment['comment']."~".$comment['firstName']."<br>";
  }
}
?>

<?php
  // fetch user post from database to display
  $fetch_post = $dbconnect->query("SELECT * FROM chat ORDER BY id DESC") or die($dbconnect->error); 
  $post ="";
  foreach ($fetch_post as $p) { 
   $post .= htmlspecialchars( $p['post'])."

    <form action='chat.php?comment=true&post_id=".$p['id']."' method='POST'>
    <textarea class='form-control input-md' rows='2' cols='20' name='comment_body'></textarea><br>
    <button type='submit' class='btn btn-info' name='comment'>Comment</button>
    </form>
   <br><hr class='hr'>";
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

  #scroll{
    margin: 4px, 4px;
    padding: 4px;
    background-color: #666;
    color: #fff;
    width: 400px;
    height: 450px;
    overflow-x: hidden;
    overflow-y: auto;
    text-align: justify;
    border-radius: 10px;
  }
  .hr{
    width: 800%;
    height: 2px;
    background-color: maroon;
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
              <h3 class="panel-title" > <span class="glyphicon glyphicon-plus"></span> Chat Room</h3>
            </div>
            <div class="panel-body">

               <form action="chat.php" method="post">
                 <div class="form-group col-md-6">
                  <label for="comment">Your Post:</label>
                  <textarea class="form-control input-md" id="comment" name="post"></textarea><br>

                  <div class="btn-btn-inline">
                    <button class="btn btn-primary" name="send"> Send</button>
                  </div>
                </div>
               </form>

               <div class="form-group col-md-6" id="scroll">
                  <p>Your Chat Comes Here</p>
                  <?php echo "$post" ; ?>
                  <?php echo "$comment" ; ?>
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
            <form action="chat.php" method="post" enctype="multipart/form-data">
              <?php
                  $viewId = $_SESSION['id'];
                  $select = $dbconnect->query("SELECT * FROM users WHERE id = $viewId") or die ("Fail to fetch record<br/>" . $dbconnect->error);
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
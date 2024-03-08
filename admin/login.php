<html>
	<head>
		<title>BootFiters - Login</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	   
    <?php include("header.php");?>

		<div class="container">
		<?php
      session_start();
      if(isset($_SESSION['umail']))
      {
        header("location:index.php");
      }


      if(isset($_SESSION["class"]))
      {?>
    
        <div class="row">
          <div class="col-sm-offset-4 col-sm-4">
              <div class="alert alert-dismissible <?=$_SESSION['class']?>">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?=$_SESSION["error"]?></strong>
              </div>
            </div>
        </div>



      <?php  session_unset($_SESSION["class"]);}
    ?>


<div class="row">
				<div class="col-sm-offset-4 col-sm-4">
  <form class="form-horizontal" method="post" action="logincode.php" enctype="multipart/form-data">
  <fieldset>
    <legend>Login Here</legend>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input class="form-control" id="email" name="email" placeholder="Enter your Email" type="email" required="required">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input class="form-control" id="pass" name="pass" placeholder="Enter your paswword" type="password" required="required">
      </div>
    </div>

    

	

   

    
    
    
    <div class="form-group">
      <div class="col-lg-6 col-lg-offset-2">
      <button type="submit" name="signup" class="btn btn-primary">Login</button>
        <button type="reset" class="btn btn-default">Clear</button>
        
      </div><div class="col-sm-4" style="padding-top: 15px;"><p style="display: inline;"><a href="https://tpanel.bootfitters.com/user">User Login</a></p></div>
    </div>
  </fieldset>
</form>
				</div>
				<!--show response here-->
				<div class="col-sm-offset-1 col-sm-6">

				</div>
			</div>
			
		</div>
  <?php 

  include("footer.php");?>

	</body>
</html>
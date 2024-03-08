<html>
	<head>
		<title>Registration from</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	   
    <?php include("header.php");?>

		<div class="container">
		
<div class="row">
				<div class="col-sm-offset-4 col-sm-4">
  <form class="form-horizontal" method="post" action="signupcode.php" enctype="multipart/form-data">
  <fieldset>
    <legend>Sign Up Here</legend>
    
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
        <input class="form-control" id="userid" name="userid" placeholder="Enter your Username" type="text" required="required">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input class="form-control" id="email" name="email" placeholder="Enter your Email" type="email" required="required">
      </div>
    </div>

     <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Shop</label>
      <div class="col-lg-10">
        <input class="form-control" id="shop" name="shop" placeholder="Enter your shopname" type="text" required="required">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input class="form-control" id="pass" name="pass" placeholder="Enter your new password" type="text" required="required">
      </div>
    </div>


	 
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
      <button type="submit" name="signup" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-default">Clear</button>
        
      </div>
    </div>
  </fieldset>
</form>
				</div>
				<!--show response here-->
				<div class="col-sm-offset-1 col-sm-6">

				</div>
			</div>
			
		</div>
  <?php include("footer.php");?>

	</body>
</html>
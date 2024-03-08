<?php
  include("connect.php");
  include("session.php");
?>
<html>
    <head>
        <title>Bootfiters - Changepassword</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="http://www.bootfitters.com/themes/boots/favicon.ico" type="image/vnd.microsoft.icon" />
    </head>
    <body>
       
    <?php include("header.php");?>

    <div class="container">
    
   	 <div class="row" id="notification" style="display:none;">
   	 
            
        </div>
        
        
    <div class="row">
    <div class="col-sm-offset-4 col-sm-4">
      <form class="form-horizontal" method="post" action="" id="chnagepass">
  <fieldset>
    <legend><input action="action" class="btn btn-primary btn-xs" type="button" value="Back" onclick="history.go(-1);" />&nbsp;&nbsp;&nbsp;Change Password</legend>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-4 control-label">Old Password</label>
      <div class="col-lg-8">
        <input class="form-control" name="oldpass" placeholder="Enter your old password" type="password" required="required">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-4 control-label">New Password</label>
      <div class="col-lg-8">
        <input class="form-control" name="nwpass" placeholder="Enter your new paswword" type="password" required="required">
      </div>
    </div>

    
    <div class="form-group">
      <div class="col-lg-8 col-lg-offset-4">
      <button type="submit" name="signup" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-default">Clear</button>
        
      </div>
    </div>
  </fieldset>
</form>
</div>
</div>

    </div>
  <?php 

  include("footer.php");?>
  <script>
    $(document).ready(function(){
    
    $("form").submit(function(e){
        e.preventDefault();
        var datastring = $("form").serialize();
        //alert(datastring);
        $.ajax({
          type:'post',
          url:'changepass_code.php',
          data:datastring,
          beforeSend:function()
          {
          	$("#notification").fadeIn(500);

          },
          success:function(res)
          {
            if(res == 1)
            {
            	$("#notification").html('<div class="col-sm-offset-4 col-sm-4"><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>congrates..!</strong>Your Password Successfully Changed.</div></div>');
            }
            else
            {
            	$("#notification").html('<div class="col-sm-offset-4 col-sm-4"><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry..!</strong>Your Old Password is Wrong, try again.</div></div>');	
            }
          },
        });
        $('form')[0].reset();
        $("#notification").fadeOut(5000);
    });
});

  </script>
    </body>
</html>
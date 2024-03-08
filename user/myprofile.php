<?php
  include("connect.php");
  include("session.php");
  
  $q = mysqli_query($con,"select * from boot_reguser where email='".$email."'");
  if($val = mysqli_fetch_assoc($q))
  {
  	$username = $val['username'];
  	$email = $val['email'];
  	$shopn= $val['shop'];
  	
  }
?>
<html>
    <head>
        <title>Bootfiters - My Profile</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="http://www.bootfitters.com/themes/boots/favicon.ico" type="image/vnd.microsoft.icon" />
    </head>
    <body>
     
    <?php   include("header.php");?>

    <div class="container">
    	<div class="row" id="notification" style="display:none;">
            
        </div>
    
      <form method="post" action="" class="form-group">
      
        <div class="col-lg-offset-4 col-xs-8 col-sm-4">
         <fieldset>
          <legend>Profile Details</legend>
         

          <div class="row">
            <div class="col-xs-6 col-sm-6">
              <label class="control-label">Emailid</label>
            </div>
            <div class="col-xs-6 col-sm-6">
              <label class="control-label"><b><?=$email ?></b></label>
            </div>
          </div>
 <div class="row">
            <div class="col-xs-6 col-lg-6">
              <label class="control-label">Username</label>
            </div>
            <div class="col-xs-6 col-sm-6">
              <label class="control-label" id="usr_name"><b><?=$username ?></b></label>
              <input type="hidden" value="<?=$username?>" name="username" id="usr_input">
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6">
              <label class="control-label">Shop name</label>
            </div>
            <div class="col-xs-6 col-sm-6">
              <label class="control-label" id="sp_name"><b><?=$shopn?></b></label>
              <input type="hidden" value="<?=$shopn?>" name="shopname" id="sp_input">
            </div>
          </div>
          
          <div class="row">
            <hr/>
            <div class="col-lg-10 col-lg-offset-2">
              <a href="#" class="btn btn-primary btn-sm" id="editpr">Edit Profile</a>
              <button type="submit" class="btn btn-primary" id="upd_btn" style="display:none;">Update Profile</button>
               <a href="changepass.php" class="btn btn-primary btn-sm" id="chdpass">Change Password</a>
            </div>
          </div>
	
	
          
          </fieldset>
          
        </div>
        <div class="col-xs-2 col-sm-4">
            <!--<a href="changepass.php" class="btn btn-success">Change Password</a>-->
            
          </div>       
      </form>

    </div>
  <?php 

  include("footer.php");?>

	<script>
		$(document).ready(function(){
		
			$("#editpr").click(function(){
				$(this).hide();
				$("#upd_btn").show();
				$("#sp_name").hide();
				$("#chdpass").hide();
				$("#usr_name").hide();
				$("#sp_input").prop('type','text');
				$("#usr_input").prop('type','text');
				$("legend").html("Edit Profile");
					
			});
			$("form").submit(function(e){
				e.preventDefault();
				var spname = $("#sp_input").val();
				var usr_name = $("#usr_input").val();
				var datastring = 'spname='+spname+'&username='+usr_name;
				console.log(datastring);
				$.ajax({
					type:'post',
					url:'updateprofile.php',
					data:datastring,
					beforeSend:function(){$("#notification").fadeIn(500);},
					success:function(res)
					{
						if(res == 1)
            {
            	$("#notification").html('<div class="col-sm-offset-4 col-sm-4"><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>congrates..!</strong>Profile Updated Successfully.</div></div>');
            	$("#sp_name").html('<b>'+spname+'</b>');
            	$("#usr_name").html('<b>'+usr_name+'</b>');
            	$("#sp_input").prop('type','hidden');
            	$("#usr_input").prop('type','hidden');
		$("#sp_name").show();
		$("#editpr").show();
		$("#usr_name").show();
		$("#upd_btn").hide();
		$("#chdpass").show();
		$("legend").html("Profile Details");
            }
            else
            {
            	$("#notification").html('<div class="col-sm-offset-4 col-sm-4"><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry..!</strong>Internal error, try again.</div></div>');	
            }	
					}
				});
				$('form')[0].reset();
       				 $("#notification").fadeOut(5000);
			});
		});
	</script>


    </body>
</html>
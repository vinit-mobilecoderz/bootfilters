
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="margin-top:-4%;" href="index.php"><img src="images/logo.png" width="222px" /></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav navbar-right">
        
        <?php if(isset($_SESSION['umail']) && $_SESSION['role'] == 'admin' )
        {
		echo '<li><a href="manageReview.php">Manage Review<span class="sr-only">/span></a></li>';
       	  echo '<li><a href="edit_question.php">Edit Question<span class="sr-only">/span></a></li>';
          echo '<li><a href="manage_brand.php">Manage Brand<span class="sr-only">/span></a></li>';
           echo '<li><a href="manage_model.php">Manage Model<span class="sr-only">/span></a></li>';
          echo '<li><a href="myprofile.php">My Profile<span class="sr-only">/span></a></li>';
          echo '<li><a href="logout.php">Logout</a></li>';
		}else if(isset($_SESSION['umail'])){
			echo '<li><a href="manageReview.php">Manage Review<span class="sr-only">/span></a></li>';
			echo '<li><a href="myprofile.php">My Profile<span class="sr-only">/span></a></li>';
			echo '<li><a href="logout.php">Logout</a></li>';
		}
        ?>
        
      </ul>
    </div>
  </div>
</nav>

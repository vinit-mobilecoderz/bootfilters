<html>
	<head>
		<title>Skiew - Edit Details</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	   
    <?php  session_start(); include("header.php");
    	  include("connect.php");
    ?>

		<div class="container">
		<?php
     
      if(!isset($_SESSION['umail']))
      {
        header("location:index.php");
      }
      else
      {
      	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
	
		$id = $_GET['id'];
		$query = mysqli_query($con,"select * from sk_newuserreview where id='".$id."'");
		if($row = mysqli_fetch_assoc($query))
		{
		$brand = $row['brand'];
		$model= $row['model'];
		$length= $row['length'];
		$shop = $row['shop'];
		$tester= $row['tester'];
		$earlyedge= $row['earlyedge'];
		$continiouscurve= $row['continiouscurve'];
		$reboundfinish= $row['reboundfinish'];
		$stability= $row['stability'];
		$radius_turns= $row['radius_turns'];
		$off_piste= $row['off_piste'];
		$lowspeed= $row['lowspeed'];
		
		$drift= $row['drift'];
		$faqiveness= $row['faqiveness'];
		$finesse= $row['finesse'];
		$distinguishing= $row['distinguishing'];
		$reviewid = $row['reviewid'];
		
			
		}
	}
      }
      ?>


		<div class="row">
			<div class="col-sm-4">
  			  <div class="table-responsive">
  			  	<table class="table">
  			  			<tr>
  			  			<th>Brand</th>
  			  			<td><?=$brand?></td>
  			  			</tr>
  			  			<tr>
  			  			<th>Model</th>
  			  			<td><?=$model?></td>
  			  			</tr>
  			  			<tr>
  			  			<th>Length</th>
  			  			<td><?=$length?></td>
  			  			</tr>
  			  			<tr>
  			  			<th>Shop</th>
  			  			<td><?=$shop ?></td>
  			  			</tr>
  			  			<tr>
  			  			<th>Tester</th>
  			  			<td><?=$tester?></td>
  			  			</tr>
  			  			<tr>
  			  			<th>Distinguishing Characteristics</th>
  			  			<td><?=$distinguishing?></td>
  			  			</tr>
  			  			<tr>
  			  				<td colspan='2' align="right">
  			  					<a href="editreview.php?id=<?=$id?>" class="btn btn-success">Edit</a>
  			  					<a href="deletereview.php?id=<?=$id?>" class="btn btn-danger">delete</button>
  			  				</td>
  			  			</tr>
  			  			
  			  		</tr>
  			  	</table>
  			  </div>
  				
			</div>
			<!--show response here-->
			<div class="col-sm-offset-1 col-sm-6">
<div class="table-responsive">
  			  	<table class="table">
  			  			<tr>
  			  			<th><?=$row['question1']?></th>
  			  			<td><?=$earlyedge?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question2']?></th>
  			  			<td><?=$continiouscurve?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question3']?></th>
  			  			<td><?=$reboundfinish?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question4']?></th>
  			  			<td><?=$stability?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question5']?></th>
  			  			<td><?=$radius_turns?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question6']?></th>
  			  			<td><?=$off_piste?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question7']?></th>
  			  			<td><?=$lowspeed?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question8']?></th>
  			  			<td><?=$faqiveness?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question9']?></th>
  			  			<td><?=$drift?></td>
  			  			</tr>
  			  			<tr>
  			  			<th><?=$row['question10']?></th>
  			  			<td><?=$finesse?></td>
  			  			</tr>
  			  			
  			  			
  			  		</tr>
  			  	</table>
  			  </div>
			</div>
		</div>
			
	</div>
  <?php 

  include("footer.php");?>

	</body>
</html>
<html>
	<head>
		<title>Skiew - review details</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	   
    <?php 
    	session_start();
    	include("header.php");
    	  include("connect.php");
   
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
		$id=$row['id'];
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
		$userid = $row['userid'];
		
		
			
		}
	}
	else
	{
		header("location:index.php");
	}
      }
      
      function seldata($a)
	{
	$value="";
	$arr = [$a];
	$arr2 = [1,2,3,4,5,6,7,8,9,10];
	foreach($arr2 as $a)
	{
		if($a==$arr[0])
		 $value .= "<option selected value='".$a."'>".$a."</option>";
		else
		$value .= "<option value='".$a."'>".$a."</option>";
	}
	return $value;
	}
      
      
      
      
      ?>

	<div class="container">
	<form class="form-horizontal" method="post" action="updatereview.php">
		<div class="col-sm-5">
			
  <fieldset>
	 
	  <legend>Edit Review</legend>
	 
    <div class="form-group">
      <label for="brandname" class="col-lg-2 control-label"><b>Brand</b></label>
      <div class="col-lg-10">
        <select class="form-control" name="brandname">
          <option value="Armada" selected="">Armada</option><option value="Atomic">Atomic</option><option value="Black Crows">Black Crows</option><option value="Blizzard">Blizzard</option><option value="Dynastar">Dynastar</option><option value="Elan">Elan</option><option value="Faction">Faction</option><option value="Fischer">Fischer</option><option value="Head">Head</option><option value="K2">K2</option><option value="Kastle">Kastle</option><option value="Line">Line</option><option value="Nordica">Nordica</option><option value="Rossignol">Rossignol</option><option value="Salomon">Salomon</option><option value="Stockli">Stockli</option><option value="Volkl">Volkl</option><option value="Other">Other</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="modelname" class="col-lg-2 control-label"><b>Model</b></label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="modelname" value="<?=$model?>">
        <input type="hidden" name="reviewid" value="<?=$reviewid ?>">
        <input type="hidden" name="userid" value="<?=$userid?>">
        <input type="hidden" name="id" value="<?=$id?>">
        
      </div>
    </div>
    
    <div class="form-group">
      <label for="length" class="col-lg-2 control-label"><b>Length</b></label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="length" value="<?=$length?>">
        
      </div>
    </div>
    
    <div class="form-group">
      <label for="shopname" class="col-lg-2 control-label"><b>Shop</b></label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="shopname" value="<?=$shop?>">
        
      </div>
    </div>
   
   <div class="form-group">
      <label for="tester" class="col-lg-2 control-label"><b>Tester</b></label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="tester" value="<?=$tester?>">
        
      </div>
    </div>
   
    
   
  </fieldset>

</div><!--col-sm-5 closed-->

	<div class="col-sm-6">
	
	<div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question1']?></b></label>
     
      <div class="col-lg-4">
        <select class="form-control" name="early_edge">
          <?php echo seldata($earlyedge);?>
        </select>
        
       
      </div>
    </div>
	
	<div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question2']?></b></label>
     
      <div class="col-lg-4">
        <select class="form-control" name="continuous_carve_accurate">
          <?php echo seldata($continiouscurve);?>
        </select>
        
       
      </div>
    </div>
    
    <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question3']?></b></label>
      
      <div class="col-lg-4">
        <select class="form-control" name="rebound_turn_finish">
          <?php echo seldata($reboundfinish);?>
        </select>
        
       
      </div>
    </div>
     
    
     <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question4']?></b></label>
      
      <div class="col-lg-4">
        <select class="form-control" name="stability_accuracy_speed">
          <?php echo seldata($stability);?>
        </select>
        
       
      </div>
    </div>
    
     <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question5']?></label>
      <div class="col-lg-4">
        <select class="form-control" name="short_radius_turns">
          <?php echo seldata($radius_turns);?>
        </select>
        
       
      </div>
    </div>
    
     <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question6']?></b></label>
      <div class="col-lg-4">
        <select class="form-control" name="off_piste_performance">
         <?php echo seldata($$off_piste);?>
        </select>
        
       
      </div>
    </div>
    
     <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question7']?></b></label>
      <div class="col-lg-4">
        <select class="form-control" name="low_speed_turning">
         <?php echo seldata($lowspeed);?>
        </select>
        
       
      </div>
    </div>
    
    <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question8']?></b></label>
      <div class="col-lg-4">
        <select class="form-control" name="forgiveness_ease">
          <?php echo seldata($faqiveness);?>
        </select>
        
       
      </div>
    </div>
    
    <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question9']?></b></label>
      <div class="col-lg-4">
        <select class="form-control" name="drift_scrub">
         <?php echo seldata($drift);?>
        </select>
        
       
      </div>
    </div>
    
    <div class="form-group">
      <label for="select" class="col-lg-6 control-label"><b><?=$row['question10']?></b></label>
      <div class="col-lg-4">
        <select class="form-control" name="power_balance">
          <?php echo seldata($finesse);?>
        </select>
        
       
      </div>
    </div>
    
    <div class="form-group">
      <label for="textArea" class="col-lg-6 control-label"><b>Distinguishing characteristics</b></label>
      <div class="col-lg-4">
        <textarea class="form-control" rows="2" name="distinguishing"><?=$distinguishing?></textarea>
      </div>
    </div>
    
   <div class="form-group" >
      <div class="col-lg-5 col-lg-offset-6">
       <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-default">reset</button>
       
      </div>
    </div>
    
    	
	</div>
	</form>
	</div><!--div closed-->




		
	
  <?php 

  include("footer.php");?>

	</body>
</html>
<?php
	  include("connect.php");
      $query_brand = mysqli_query($con,"SELECT id, brandname,created_at from brands");
      while($brand = mysqli_fetch_assoc($query_brand))
      {
      	echo "<option value=".$brand['id']." >".$brand['brandname']."</option>";
      }



 ?>

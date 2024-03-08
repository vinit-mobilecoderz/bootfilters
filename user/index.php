<?php
  session_start();
  if(!isset($_SESSION['rmail']))
  {
    header("location:login.php"); 
  }
  
?>
<html ng-app="angularTable">
	<head>
		<title>Home | BootFiters</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="shortcut icon" href="http://www.bootfitters.com/themes/boots/favicon.ico" type="image/vnd.microsoft.icon" />
	</head>
	<body>
	   
    <?php include("header.php");?>

		<div class="container">
   
   		<?php
		 if(isset($_SESSION["class"]))
		      {?>
		    
		        <div class="row">
		          <div class="col-sm-4">
		              <div class="alert alert-dismissible <?=$_SESSION['class']?>">
		                <button type="button" class="close" data-dismiss="alert">&times;</button>
		                <strong><?=$_SESSION["msg"]?></strong>
		              </div>
		            </div>
		        </div>
		
		
		
		      <?php  unset($_SESSION["class"]);} ?>
   
   
   
   
   
		<div class="bs-component" ng-controller="listdata">
               
                <form class="form-inline text-right" >
                    <div class="form-group has-success">
                       
                        <input type="text" ng-model="search.first_name" class="form-control" id="search_byfname" placeholder="Search By Brand">
                        <input type="text" ng-model="search.last_name" class="form-control" id="search_bylanme" placeholder="Search By Model">
                    </div>

                </form>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            
                            <th ng-click="sort('first_name')">Brand
                                <span class="glyphicon sort-icon" ng-show="sortKey=='first_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                            </th>
                            <th ng-click="sort('last_name')">Model
                                <span class="glyphicon sort-icon" ng-show="sortKey=='last_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                            </th>
                            <th ng-click="sort('hobby')">Category
                                <span class="glyphicon sort-icon" ng-show="sortKey=='hobby'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                            </th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr dir-paginate="user in users|orderBy:sortKey:reverse|filter:search|itemsPerPage:5" >

                            
                            <td><a href='showdetails.php?id={{user.reviewId}}'>{{user.first_name}}</a></td>
                            <td>{{user.last_name}}</td>
                            <td>{{user.hobby}}</td>
                            <td><a class="btn btn-danger btn-sm" href='deletereview.php?id={{user.reviewId}}'>Delete</a></td></td>
                        </tr>
                    </tbody>
                </table> 
                <dir-pagination-controls
                    max-size="5"
                    direction-links="true"
                    boundary-links="true" >
                </dir-pagination-controls>
                <a ng-show="users.length" href="downloadcsv.php"> <button class="btn btn-success" style="float:right;">download Excel File</button></a>
            </div>  

			
		</div>
  <?php include("footer.php");?>
  <script src="lib/angular/angular.js"></script>
        <script src="lib/dirPagination.js"></script>
        <script src="app/app.js"></script>

	</body>
</html>
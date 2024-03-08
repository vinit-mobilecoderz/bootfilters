<html>
	<head>
		<title>Bootfiters - review details</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
	</head>
	<body>
	   
    <?php 
    	session_start();
      if(!isset($_SESSION['umail']))
      {
        header("location:login.php"); 
      }
    	include("header.php");
    	include("connect.php");
    ?>
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
    
    
    
          <?php  unset($_SESSION["class"]);}
        ?>

      <div class="modal" id="brandmodal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Model</h4>
          </div>
          <form action="addmodel.php" method="post" id="addmodelFrom">
          <div class="modal-body">
              <div class="form-group">
                <label for="brandname" class="label-control">Select Brand</label>
               <select class="form-control" id="getbrands" name='brand_id'>
                 
               </select>
                <!-- <div class="help-box" id="errbox" style="color:red;"></div> -->
              </div>
              <div class="form-group">
                <label for="brandname" class="label-control">Enter Model Name</label>
                <input type="text" class="form-control" placeholder="Model Name" id="modelname" name="modelname">
                <div class="help-box" id="errbox" style="color:red;"></div>
              </div>
			  <div class="form-group">
                <label for="brandname" class="label-control">Enter Category</label>
                <input type="text" class="form-control" placeholder="Category" id="category" name="category">
                <div class="help-box" id="category_errbox" style="color:red;"></div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Model</button>
          </div>
        </form>
        </div>
      </div>
    </div>
	   <div><button class="btn btn-success pull-right" data-toggle="modal" data-target="#brandmodal" style="margin-bottom:1%;" onclick="getbrands()">Add Model</button></div>

    <?php
      $query_brand = mysqli_query($con,"SELECT models.category,brands.brandname,models.id,models.modelname,models.created_at FROM brands inner JOIN models on brands.id=models.brand_id order by created_at desc") ;
    ?>


     <table class="table table-striped table-hover " id="myTable">
      <thead>
        <tr class="success">
          <th>#</th>
          <th>Brand Name</th>
          <th>Model Name</th>
		  <th>Category</th>
          <th>Added At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $cnt = 1; 
        while($model = mysqli_fetch_assoc($query_brand)){

      ?>
        <tr>
          <td><?=$cnt?></td>
          <td>
              <span id="<?=$cnt?>"><?=$model['brandname']?></span>
             <!--  <select class="form-control" id="getbrands" name='brand_id'>
              </select> -->
            </td>
            <td>
              <span id="name<?=$cnt?>"><?=$model['modelname']?></span>
                <input type="text" style="display: none;" name="barcodename" id="barcodename<?=$cnt?>" value="<?=$model['modelname']?>">
            </td>
			<td>
              <span id="cat<?=$cnt?>"><?=$model['category']?></span>
                <input type="text" style="display: none;" name="category" id="category<?=$cnt?>" value="<?=$model['category']?>">
            </td>
          <td><?=$model['created_at']?></td>
          <td><a class="btn btn-info btn-sm" href="javascript:;" id="editbtn<?=$cnt?>" onclick='edit("name<?=$cnt?>","barcodename<?=$cnt?>","cat<?=$cnt?>","category<?=$cnt?>","update<?=$cnt?>","editbtn<?=$cnt?>","del<?=$cnt?>","bck<?=$cnt?>")'>Edit</a>

            <a class="btn btn-success btn-sm" href="javascript:;" id="update<?=$cnt?>" style="display:none;" onclick='update("<?=$model['id']?>","name<?=$cnt?>","barcodename<?=$cnt?>","cat<?=$cnt?>","category<?=$cnt?>","editbtn<?=$cnt?>","update<?=$cnt?>","del<?=$cnt?>","bck<?=$cnt?>")'>Update</a>
            &nbsp;
            <a href="javascript:;" onclick='reset("editbtn<?=$cnt?>","update<?=$cnt?>","del<?=$cnt?>","name<?=$cnt?>","barcodename<?=$cnt?>","bck<?=$cnt?>");' style="display: none;" class="btn btn-default btn-sm" id="bck<?=$cnt?>">Back</a>
            &nbsp;
            <a id="del<?=$cnt?>" class="btn btn-danger btn-sm" href='#' onclick='deleted("<?=$model['id']?>")'>Delete</a></td>
        </tr>
       <?php $cnt++; } ?> 
      </tbody>
    </table> 
  
    <div id="delform"></div>


	</div><!--div closed-->




		
	
  <?php 

  include("footer.php");?>
  <script>
    function gett(value)
    {
      alert(value);
    }
    function getbrands()
    {
      
      $.ajax({
        url:'getbrandnames.php',
        success:function(data)
        {
          $('#getbrands').html(data);
        },
        error:function()
        {
          $('#getbrands').html("<option>Ajax not called.</option>");
        }
      });
    }
    function edit(tdid, inputid, cattext,catval, sbtnid, hbtnid, delid, bkid){

      $("#"+tdid).hide();
      $("#"+inputid).show();
	  
	  $("#"+cattext).hide();
      $("#"+catval).show();
	  
      $("#"+hbtnid).hide();
      $("#"+sbtnid).show();
      $("#"+delid).hide();
      $("#"+bkid).show();

    }

    function update(bid,tdid,inputid, cattext,catval,sbtnid, hbtnid, delid, bkid)
    {//?=$model['id']?>","name<?=$cnt?>","barcodename<?=$cnt?>","editbtn<?=$cnt?>","update<?=$cnt?>","del<?=$cnt?>","bck<?=$cnt?>
      
      // $("#"+inputid).hide();
      // $("#"+tdid).show();
      // $("#"+hbtnid).hide();
      // $("#"+sbtnid).show();
	 var categorval = $("#"+catval).val();
      var modelname = $("#"+inputid).val();
      var modelText = $("#"+tdid).text();
      /*if(modelname == modelText){
        alert("Change the modelname something else");
        $("#"+inputid).focus();
      } else 
		  */
	  
	  if( modelname == "" || modelname == null){
        alert("Model name can not be blank.");
        $("#"+inputid).focus();
      }else{
        $.ajax({
          type : "post",
          url : "updatemodelname.php",
          data : {id : bid, modelname : modelname,catval : categorval },
          beforeSend : function(){
            console.log("before send");
          },
          success : function(res){
            if(res == 1){
              $("#"+inputid).hide();
              $("#"+tdid).show();
			   $("#"+catval).hide();
			  $("#"+cattext).show();
			 $("#"+cattext).text(categorval);
			  
              $("#"+hbtnid).hide();
              $("#"+sbtnid).show();
              $("#"+inputid).val(modelname);
              $("#"+tdid).text(modelname);
              $("#"+delid).show();
              $("#"+bkid).hide();

            }
          },
          complete : function(){
            console.log("completed");
          }
        });
      }




    }

    function reset(edbtn, upbtn, delbtn, spnid, inputid, bkid){
        $("#"+edbtn).show();
        $("#"+upbtn).hide();
        $("#"+delbtn).show();
        $("#"+spnid).show();
        $("#"+inputid).hide();
        $("#"+bkid).hide();
    
    }

    $("#addmodelFrom").submit(function(e){
      e.preventDefault();
	$flag = 1;
      var modelname = $("#modelname").val();
	  var category = $("#category").val();
      if(modelname == "" || modelname == null){
          $("#brandname").focus();
		  $flag = 0;
          $("#errbox").html("Model name can not be blanked.");
      } else{
          $("#errbox").html("");

      }
	  if(category == "" || category == null){
		  $flag = 0;
          $("#category").focus();
          $("#category_errbox").html("Model category can not be blanked.");
      } else{
          $("#category_errbox").html("");
      }

	if($flag == 1)
		 $("#addmodelFrom")[0].submit();

    });

    // delete brands
    function deleted(bid){

      var html = '';
      html += '<form method="post" action="deletemodel.php" id="deleteb"><input type="hidden" name="id" value="'+bid+'"></form>';
      $("#delform").html(html);
      $("#deleteb")[0].submit();
    }
  </script>


	</body>
</html>
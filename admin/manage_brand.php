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
            <h4 class="modal-title">Add Brand</h4>
          </div>
          <form action="addbrand.php" method="post" id="addbrandFrom">
          <div class="modal-body">
            
              <div class="form-group">
                <label for="brandname" class="label-control">Enter Brand Name</label>
                <input type="text" class="form-control" placeholder="Brand Name" id="brandname" name="brandname">
                <div class="help-box" id="errbox" style="color:red;"></div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Brand</button>
          </div>
        </form>
        </div>
      </div>
    </div>
	   <div><button class="btn btn-success pull-right" data-toggle="modal" data-target="#brandmodal" style="margin-bottom:1%;">Add Brand</button></div>

    <?php
      $query_brand = mysqli_query($con,"SELECT id, brandname,created_at from brands") ;
    ?>


     <table class="table table-striped table-hover " id="myTable">
      <thead>
        <tr class="success">
          <th>#</th>
          <th>Brand Name</th>
          <th>Added At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $cnt = 1; 
        while($brand = mysqli_fetch_assoc($query_brand)){

      ?>
        <tr>
          <td><?=$cnt?></td>
          <td>
              <span id="name<?=$cnt?>"><?=$brand['brandname']?></span>
              <input type="text" style="display: none;" name="barcodename" id="barcodename<?=$cnt?>" value="<?=$brand['brandname']?>">
            </td>
          <td><?=$brand['created_at']?></td>
          <td><a class="btn btn-info btn-sm" href="javascript:;" id="editbtn<?=$cnt?>" onclick='edit("name<?=$cnt?>","barcodename<?=$cnt?>","update<?=$cnt?>","editbtn<?=$cnt?>","del<?=$cnt?>","bck<?=$cnt?>")'>Edit</a>

            <a class="btn btn-success btn-sm" href="javascript:;" id="update<?=$cnt?>" style="display:none;" onclick='update("<?=$brand['id']?>","name<?=$cnt?>","barcodename<?=$cnt?>","editbtn<?=$cnt?>","update<?=$cnt?>","del<?=$cnt?>","bck<?=$cnt?>")'>Update</a>
            &nbsp;
            <a href="javascript:;" onclick='reset("editbtn<?=$cnt?>","update<?=$cnt?>","del<?=$cnt?>","name<?=$cnt?>","barcodename<?=$cnt?>","bck<?=$cnt?>");' style="display: none;" class="btn btn-default btn-sm" id="bck<?=$cnt?>">Back</a>
            &nbsp;
            <a id="del<?=$cnt?>" class="btn btn-danger btn-sm" href='#' onclick='deleted("<?=$brand['id']?>")'>Delete</a></td>
        </tr>
       <?php $cnt++; } ?> 
      </tbody>
    </table> 
  
    <div id="delform"></div>


	</div><!--div closed-->




		
	
  <?php 

  include("footer.php");?>
  <script>
    function edit(tdid, inputid, sbtnid, hbtnid, delid, bkid){

      $("#"+tdid).hide();
      $("#"+inputid).show();
      $("#"+hbtnid).hide();
      $("#"+sbtnid).show();
      $("#"+delid).hide();
      $("#"+bkid).show();

    }

    function update(bid,tdid, inputid, sbtnid, hbtnid, delid, bkid){
      
      // $("#"+inputid).hide();
      // $("#"+tdid).show();
      // $("#"+hbtnid).hide();
      // $("#"+sbtnid).show();

      var bname = $("#"+inputid).val();
      var brandText = $("#"+tdid).text();
      if(bname == brandText){
        alert("Change the brandname something else");
        $("#"+inputid).focus();
      } else if( bname == "" || bname == null){
        alert("Brand name can not be blank.");
        $("#"+inputid).focus();
      }else{
        $.ajax({
          type : "post",
          url : "updatebrandname.php",
          data : {id : bid, brandname : bname},
          beforeSend : function(){
            console.log("before send");
          },
          success : function(res){
            if(res == 1){
              $("#"+inputid).hide();
              $("#"+tdid).show();
              $("#"+hbtnid).hide();
              $("#"+sbtnid).show();
              $("#"+inputid).val(bname);
              $("#"+tdid).text(bname);
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

    $("#addbrandFrom").submit(function(e){
      e.preventDefault();

      var brandname = $("#brandname").val();
      if(brandname == "" || brandname == null){
          $("#brandname").focus();
          $("#errbox").html("Brand name can not be blanked.");
      } else{
          $("#errbox").html("");

          $("#addbrandFrom")[0].submit();

      }



    });

    // delete brands
    function deleted(bid){

      var html = '';
      html += '<form method="post" action="deletebrand.php" id="deleteb"><input type="hidden" name="id" value="'+bid+'"></form>';
      $("#delform").html(html);
      $("#deleteb")[0].submit();
    }
  </script>


	</body>
</html>
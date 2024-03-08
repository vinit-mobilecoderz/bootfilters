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

  <!--     <div class="modal" id="brandmodal">
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
    </div> -->
<!--      <div><button class="btn btn-success pull-right" data-toggle="modal" data-target="#brandmodal" style="margin-bottom:1%;">Add Brand</button></div> -->

    <?php
      $query_brand = mysqli_query($con,"SELECT *  from boot_sections order by sections ASC ") ;
    ?>


     <table class="table table-striped table-hover " id="myTable">
      <thead>
        <tr class="success">
          <th>#</th>
          <th>Section Name</th>
          <th>Added At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $cnt = 1; 
        while($brand = mysqli_fetch_assoc($query_brand)){

      ?>
        <tr >
          <td><?=$cnt?>
           
          </td>
          <td>
              <span id="name<?=$cnt?>"><?=$brand['sections']?></span>
              <input type="text" style="display: none;" name="section" id="section<?=$cnt?>" value="<?=$brand['sections']?>">
            </td>
          <td><?=$brand['created_on']?></td>
          <td><a class="btn btn-info btn-sm" href="javascript:;" id="editbtn<?=$cnt?>" onclick='edit("name<?=$cnt?>","section<?=$cnt?>","editbtn<?=$cnt?>","<?=$brand['id']?>")'>Edit</a>

            <a class="btn btn-success btn-sm" href="javascript:;" id="<?=$brand['id']?>" style="display:none;" onclick='update("name<?=$cnt?>","section<?=$cnt?>","editbtn<?=$cnt?>","<?=$brand['id']?>")'>Update</a>
            &nbsp;
            <a href="javascript:;" onclick='reset("editbtn<?=$cnt?>","update<?=$cnt?>","del<?=$cnt?>","name<?=$cnt?>","barcodename<?=$cnt?>","bck<?=$cnt?>");' style="display: none;" class="btn btn-default btn-sm" id="bck<?=$cnt?>">Back</a>
            &nbsp;
            <!-- <a id="del<?=$cnt?>" class="btn btn-danger btn-sm" href='#' onclick='deleted("<?=$brand['id']?>")'>Delete</a> -->
          </td>
        </tr>
       <?php $cnt++; } ?> 
      </tbody>
    </table> 
  
    <div id="delform"></div>


  </div><!--div closed-->




    
  
  <?php 

  include("footer.php");?>
  <script>
    function edit(tdid, inputid,edit,update){
     
       $("#"+tdid).hide();
       $("#"+inputid).show();
       $("#"+edit).hide();
       $("#"+update).show();
      // $("#"+delid).hide();
      // $("#"+bkid).show();

    }

    function update(tdid, inputid,edit,update){   
    

       var section = $("#"+inputid).val();
      

      var brandText = $("#"+tdid).text();
      if(section == brandText){
        alert("Change the brandname something else");
        $("#"+inputid).focus();
      } else if( section == "" || section == null){
        alert("Section name can not be blank.");
        $("#"+inputid).focus();
      }else{
        $.ajax({
          type : "post",
          url : "updatesectionname.php",
          data : {id : update, section : section},
          beforeSend : function(){
            console.log("before send");
          },
          success : function(res){
            if(res == 1){
               $("#"+tdid).show();
               $("#"+tdid).html(section);
               $("#"+inputid).hide();
               $("#"+edit).show();
               $("#"+update).hide();

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


   
  </script>


  </body>
</html>
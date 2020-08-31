<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP & Ajax CRUD</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Last Name : <input type="text" id="lname">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>

      <!-- <td>
        <input type="button" value="Load Data" id="load-data"/>
      </td> -->
    </tr>

    <tr>
      <td id="table-data">

      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>

  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
        
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   function load_data(){
    $.ajax({
        url: "ajax-load.php",
        type: "POST",
        success:function(data){
            $("#table-data").html(data)
        }
      })
   }
   load_data();

   $("#save-button").on("click",function(e){
     //console.log(e);
     e.preventDefault();
     var fname = $("#fname").val();
     var lname = $("#lname").val();
      if(fname === '' || lname === ''){
        $("#error-message").html("feild is required").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url:"ajax-insert.php",
          type:"POST",
          data: {first_name:fname,last_name:lname},
          success:function(data){
            if(data == 1){
              load_data();
              $("#success-message").html("Data Insert Successfully").slideDown();
              $("#addForm").trigger("reset");
            }else{
              $("#error-message").html("Can't save record").slideDown();
              $("#success-message").slideUp();
            }
            
          }
        })
      }
    

   })

   $(document).on("click",".delete-btn",function(){

     if(confirm("Do yo really want delete this record")){
        var deleteId = $(this).data("id");
        //alert(deleteId);
        var element = this;

        $.ajax({
          url:'ajax-delete.php',
          type:"POST",
          data:{id:deleteId},
          success:function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else {
                $("#error-message").html("Can't Delete record").slideDown();
                $("#success-message").slideUp();
              }
          }
        })
     }
   })

   //Show Modal Box
   $(document).on("click",".edit-btn", function(){
      $("#modal").show(); 
      var editId = $(this).data("eid");

      $.ajax({
          url:'update-load-data.php',
          type:"POST",
          data:{id:editId},
          success:function(data){
              $("#modal-form table").html(data)
          }
        })
   })
   $("#close-btn").on("click",function(){
      $("#modal").hide();
   })

   $(document).on("click","#edit-submit", function(){
      var sid   = $("#edit-id").val();
      var fname =  $("#edit-fname").val();
      var lname = $("#edit-lname").val();
      $.ajax({
          url:'edit-update-data.php',
          type:"POST",
          data:{id:sid,fname:fname,lname:lname},
          success:function(data){
            if(data == 1){
              $("#modal").hide();
              load_data();
            }else {
              $("#error-message").html("Can't Update record").slideDown();
                $("#success-message").slideUp();
            }
            
          }
        })
   })

   $("#search").on("keyup",function(){
     var serach = $(this).val();
     $.ajax({
          url:'live-search.php',
          type:"POST",
          data:{search:serach},
          success:function(data){
            $("#table-data").html(data)
          }
        })
   });
});
</script>
</body>
</html>

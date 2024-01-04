<?php
include_once('admin_include/header.php');





?>
<style>
    td,input[type="password"]{
        text-align:center!important;
       
    }
    .btn-block {
  display: flex!important;
  flex-direction: row-reverse!important;

}

.view_data, .edit_data {
  
  width: 100px; 
}
.input[type="submit"].btn-block, input[type="reset"].btn-block, input[type="button"].btn-block {
   text-align:center!important;
   width: auto;
   margin: auto;
   
}
.edit_data{
    margin-top:8px;
}
.align {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* Set the number of columns you desire (e.g., 5 cards per row) */
    grid-gap: 20px; /* Adjust the gap between cards */
}

.card-container {
    display: inline-block;
    width: 100%;
    break-inside: avoid; /* Prevent cards from breaking across columns */
}



</style>


                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Gender</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </a>


                                </div>
                            </div>
                            <div class="card-body">
                                <?php

                                $db_connection = connect_to_database();
                                $query = "SELECT gender, COUNT(*) AS count FROM user GROUP BY gender";
                                $result = mysqli_query($db_connection, $query);

                                $dataPoints = array();

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $label = ucfirst($row['gender']);
                                    $y = $row['count'];
                                    $dataPoints[] = array("label" => $label, "y" => $y);
                                }
                                ?>
                                <script>
                                    window.onload = function () {
                                        var chart = new CanvasJS.Chart("chartContainer", {
                                            animationEnabled: true,
                                            title: {

                                            },
                                            data: [{
                                                type: "pie",
                                                yValueFormatString: "#,##\"\"",
                                                indexLabel: "{label} ({y})",
                                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                            }]
                                        });
                                        chart.render();
                                    }
                                </script>
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                            </div>
                        </div>
                    </div>    


<h1 class="h3 mb-2 text-gray-800 ml-3">Announcements</h1>
<?php 
$query = "SELECT * FROM announcement ORDER BY created_at DESC";
$announcement = $db_connection->query($query);
?>
<div class="align">
    <?php while ($row = $announcement->fetch_assoc()) { ?>
        <div class="card-container">
            <div class="card border-success ml-4 mb-3" style="max-width: 18rem;">
                <div class="card-header bg-transparent border-success"><?php echo $row['announcement_title']; ?></div>
                <div class="card-body text-success">
                    <p class="card-text"><?php echo $row['announcement']; ?></p>
                </div>
                <div class="card-footer bg-transparent border-success"><?php echo date("F j, Y h:i A", strtotime($row["created_at"])); ?>
</div>
            </div>
        </div>
    <?php } ?>
</div>
<?php 
$sql = "SELECT * FROM user ORDER BY ID DESC";
$users = mysqli_query($db_connection, $sql);
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
               <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Registered Users</h6>
               </div>
               <div class="card-body">
                    <div class="table-responsive" id="user_table">

                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                                                              
                                       
                                             <thead>
                                                  <tr>
                                                       <th>First Name</th>
                                                       <th>Last Name</th>
                                                       <th>Actions</th>
                                                      
                                                  </tr>
                                             </thead>

                                             <tfoot>
                                                  <tr>
                                                       <th>First Name</th>
                                                       <th>Last Name</th>
                                                      <th>Actions</th>
                                                  </tr>
                                             </tfoot>
                                       
                                             <?php while ($row = $users->fetch_assoc()) { ?>
                                                  <!-- Inside the while loop -->

                                                  <tr>
                                                       <td><?php echo $row["First_name"]; ?></td>
                                                       <td><?php echo $row["Last_name"]; ?></td>
                                                     
                                                       <td>

                                                  <div class="btn-block">
                                                            <input type="button" name="edit" value="Edit" id="<?php echo $row["ID"]; ?>" class="btn btn-primary  mb-2 btn-user  btn-block edit_data" />
                                                            <input type="button" name="view" value="View" id="<?php echo $row["ID"]; ?>" class="btn btn-primary  mb-2 btn-user  btn-block view_data" />
                                                            <!-- <input class="btn btn-primary  mb-2 btn-user  btn-block" type="submit" name="Edit" value="Edit"> -->
                                                </div>
                                                       </td>
                                                  </tr>
                                             <?php } ?>
                                        </tbody>


                                   </div>
                         </table>
                    </div>
               </div>
          </div>
            <!-- End of Topbar -->
                                 
</body>


<div id="dataModal" class="modal fade">
     <div class="modal-dialog">
          <div class="modal-content">
              
               <div class="modal-body" id="employee_detail">
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>
<div id="add_data_Modal" class="modal fade">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
               <h4 class="modal-title" id="name"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   
               </div>
               <div class="modal-body">
                    <form method="post" id="insert_form">

                         <label>Enter First Name</label>
                         <input type="text" name="first_name" id="first_name" class="form-control" required/>
                         <br/>

                         <label>Enter Last Name</label>
                         <input type="text" name="last_name" id="last_name" class="form-control" required/>
                         <br/>

                         <label>Enter Age</label>
                         <input type="number" name="age" id="age" class="form-control" required/>
                         <br/>

                         <label>Enter Nick Name</label>
                         <input type="text" name="nick_name" id="nick_name" class="form-control" required/>
                         <br/>

                         <label>Enter Email</label>
                         <input type="email" name="email" id="email" class="form-control" required/>
                         <br/>

                         <label>Enter Address</label>
                         <input name="address" id="address" class="form-control" required/>
                         <br/>

                         <label>Select Gender</label>
                         <select name="gender" id="gender" class="form-control">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Other">Other</option>
                         </select>
                         <br/>

                         <label>Enter Password</label>
                         <input type="password" name="password" id="password" class="form-control" required/>
                         <br/>

                         <label>Select Role</label>
                         <select name="role" id="role" class="form-control" required>
                              <option value="User" required>User</option>
                              <option value="Admin" required>Admin</option>
                         </select>
                         <br/>

                         <label>Select Status</label>
                         <select name="status" id="status" class="form-control" required>
                              <option value="Active" required>Active</option>
                              <option value="Deactive"required>Deactive</option>
                         </select>
                         <br/>


                         <input type="hidden" name="user_id" id="user_id" />
                         <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>


<script>
     
     $(document).ready(function() {
          $('#add').click(function() {
               $('#insert').val("Insert");
               $('#insert_form')[0].reset();
          });
          $(document).on('click', '.edit_data', function() {
               var user_id = $(this).attr("ID");
               
               $.ajax({
                    
                    url: "fetch.php",
                    method: "POST",
                    data: {
                         user_id: user_id
                    },
                    dataType: "json",
                    
                    success: function(data) {
                         var name = data.First_name;
                         var detail = " Details";
                         var name_details = name + detail;                 
                         $('#name').text(name_details);                    
                         $('#first_name').val(data.First_name);
                         $('#last_name').val(data.Last_name);
                         $('#age').val(data.Age);  
                         $('#nick_name').val(data.Nick_name);
                         $('#email').val(data.Email);
                         $('#address').val(data.Address);
                         $('#gender').val(data.Gender);
                         $('#password').val(data.Password);
                         $('#role').val(data.Role);
                         $('#status').val(data.Status);
                         $('#user_id').val(data.ID);
                         $('#insert').val("Update");
                         $('#add_data_Modal').modal('show');
                    }
               });
          });
          $('#insert_form').on("submit", function(event) {
               event.preventDefault();
               if ($('#first_name').val() == "") {
                    alert("First Name is required");
               } else if ($('#last_name').val() == '') {
                    alert("Last Name is required");
               } else if ($('#age').val() == '') {
                    alert("Age is required");
               } else if ($('#nick_name').val() == '') {
                    alert("Nick Name is required");
               } else if ($('#email').val() == '') {
                    alert("Nick Name is required");
               } else if ($('#address').val() == '') {
                    alert("Nick Name is required");
               } else if ($('#gender').val() == '') {
                    alert("Nick Name is required");
               } else if ($('#password').val() == '') {
                    alert("Password is required");
               } else if ($('#role').val() == '') {
                    alert("Role is required");
               } else if ($('#status').val() == '') {
                    alert("Status is required");
               } else {
                    $.ajax({
                         url: "insert.php",
                         method: "POST",
                         data: $('#insert_form').serialize(),
                         beforeSend: function() {
                              $('#insert').val("Inserting");
                         },
                         success: function(data) {
                              $('#insert_form')[0].reset();
                              $('#add_data_Modal').modal('hide');
                              $('#user_table').html(data);
                         }
                    });
               }
          });
          $(document).on('click', '.view_data', function() {
               var user_id = $(this).attr("id");
               if (user_id != '') {
                    $.ajax({
                         url: "select.php",
                         method: "POST",
                         data: {
                              user_id: user_id
                         },
                         success: function(data) {
                              $('#employee_detail').html(data);
                              $('#dataModal').modal('show');
                         }
                    });
               }
          });
     });
</script>

<?php
include_once('admin_include/footer.php');
?>

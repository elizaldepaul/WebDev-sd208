<?php
include_once("php/connection.php");
$db_connection = connect_to_database();
if (!empty($_POST)) {
     $output = '';
     $message = '';
     $first_name = mysqli_real_escape_string($db_connection, $_POST["first_name"]);
     $last_name = mysqli_real_escape_string($db_connection, $_POST["last_name"]);
     $age = mysqli_real_escape_string($db_connection, $_POST["age"]);
     $nick_name = mysqli_real_escape_string($db_connection, $_POST["nick_name"]);
     $email = mysqli_real_escape_string($db_connection, $_POST["email"]);
     $address = mysqli_real_escape_string($db_connection, $_POST["address"]);
     $gender = mysqli_real_escape_string($db_connection, $_POST["gender"]);
     $password = mysqli_real_escape_string($db_connection, $_POST["password"]);
     $role = mysqli_real_escape_string($db_connection, $_POST["role"]);
     $status = mysqli_real_escape_string($db_connection, $_POST["status"]);
     if ($_POST["user_id"] != null) {
          $query = "  
           UPDATE user   
           SET First_name='$first_name',   
           Last_name='$last_name',   
           Age='$age',   
           Nick_name = '$nick_name',   
           Email = '$email',
           Address='$address',
           Gender='$gender',
           Password='$password',
           Role='$role',
           Status='$status'  
           WHERE ID='" . $_POST["user_id"] . "'";
          $message = 'Data Updated';
     } else {
          $query = "  
           INSERT INTO user(First_name, Last_name,Age, Nick_name, Email, Address, Gender, Password, Role, Status)  
           VALUES('$first_name', '$last_name', '$age', '$nick_name', '$email', '$address', '$gender', '$password', '$role', '$status');  
           ";
          $message = 'Data Inserted';
     }
     if (mysqli_query($db_connection, $query)) {
          $output .= '<label class="text-success">' . $message . '</label>';
          $select_query = "SELECT * FROM user ORDER BY ID DESC";
          $result = mysqli_query($db_connection, $select_query);
          $output .= '    
      
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        
                                             
                                              <br />
                                             
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
           ';
          while ($row = $result->fetch_assoc()) {
               $output .= '  
                <!-- Inside the while loop -->

                <tr>
                     <td> ' . $row["First_name"] . '</td>
                     <td> ' . $row["Last_name"] . '</td>
                   
                     <td>

                
                          <input type="button" name="edit" value="Edit" id="' . $row["ID"] . '" class="btn btn-primary  mb-2 btn-user  btn-block edit_data" />
                          <input type="button" name="view" value="view" id="' . $row["ID"] . '" class="btn btn-primary  mb-2 btn-user  btn-block view_data" />
                          <!-- <input class="btn btn-primary  mb-2 btn-user  btn-block" type="submit" name="Edit" value="Edit"> -->

                     </td>
                </tr>
               

               <!-- Page level plugins -->
               <script src="vendor/datatables/jquery.dataTables.min.js"></script>
               <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

               <!-- Page level custom scripts -->
               <script src="js/demo/datatables-demo.js"></script>

                ';
          }
          $output .= ' </tbody> </table>';
     }
     echo $output;
}
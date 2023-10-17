<?php
include_once("php/connection.php");
$db_connection = connect_to_database();
if (isset($_POST["user_id"])) {
     $output = '';
     $query = "SELECT * FROM user WHERE ID = '" . $_POST["user_id"] ."'";
     $result = mysqli_query($db_connection, $query);
     $output .= '  
     
      <div class="table-responsive">  
           <table class="table table-bordered">';
     while ($row = mysqli_fetch_array($result)) {
          $output .= '  
          <div class="modal-header">
          <h4 class="modal-title" id="sname"> ' . $row["First_name"] . ' Details</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               
          </div>
         
                <tr>  
                     <td width="30%"><label>First Name</label></td>  
                     <td width="70%">' . $row["First_name"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Last Name</label></td>  
                     <td width="70%">' . $row["Last_name"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Age</label></td>  
                     <td width="70%">' . $row["Age"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Nick Name</label></td>  
                     <td width="70%">' . $row["Nick_name"] . ' </td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%">' . $row["Email"] . ' </td>  
                </tr>  
                <tr>  
                <td width="30%"><label>Address</label></td>  
                <td width="70%">' . $row["Address"] . ' </td>  
           </tr>  
           <tr>  
           <td width="30%"><label>Gender</label></td>  
           <td width="70%">' . $row["Gender"] . ' </td>  
          </tr>  
            <tr>  
           <td width="30%"><label>Password</label></td>  
           <td width="70%"><input type="password" id="password" value="'. htmlspecialchars($row["Password"]) . '" style="border:none;background-color:white;" disabled></td>          </tr>  
          <tr>  
        <td width="30%"><label>Role</label></td>  
          <td width="70%">' . $row["Role"] . ' </td>  
          </tr>  
          <tr>  
          <td width="30%"><label>Status</label></td>  
          <td width="70%">' . $row["Status"] . ' </td>  
          </tr>  
           ';
     }
     $output .= '  
           </table>  
      </div>  
      ';
     echo $output;
}
?>
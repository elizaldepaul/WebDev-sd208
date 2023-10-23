<?php
include_once("php/connection.php");
$db_connection = connect_to_database();

if (isset($_POST["activity_id"])) {
     $output = '';
     $query = "SELECT * FROM activity WHERE activity_id = '" . $_POST["activity_id"] ."'";
     $result = mysqli_query($db_connection, $query);
     $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
     while ($row = mysqli_fetch_array($result)) {
          $output .= '  
                <tr>  
                     <td width="30%"><label>Activity Name</label></td>  
                     <td width="70%">' . $row["activity_name"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Activity Time</label></td>  
                     <td width="70%">' . $row["activity_time"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Activity Location</label></td>  
                     <td width="70%">' . $row["activity_location"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Activity OOTD</label></td>  
                     <td width="70%"><img height = "100px" width="100px" src = "activity_image/' . $row["activity_ootd"] . '"> </td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Notes</label></td>  
                     <td width="70%">
                     <textarea type="text" class="form-control" id="notes" name="activity_remarks" required></textarea>
                     </td>  
                
                </tr>  
                <tr>
           
                     <td colspan="2" align="center">
              
                          <button type="button" class="btn btn-primary mark_as_done" style="margin-right:30px;" id = "'. $row["activity_id"].'">Mark As Done</button>
                          <button type="button" class="btn btn-danger mark_as_cancel" id = "'. $row["activity_id"].'">Cancel Activty</button>
                     </td>
                    
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

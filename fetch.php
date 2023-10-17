<?php  
 //fetch.php  
 include_once("php/connection.php");
 $db_connection = connect_to_database();
 if(isset($_POST["user_id"]))  
 {  
      $query = "SELECT * FROM user WHERE ID = '".$_POST["user_id"]."'";  
      $edit_user = mysqli_query($db_connection, $query);  
      $row = mysqli_fetch_array($edit_user);  
      echo json_encode($row);  
 }
 
 ?>
 
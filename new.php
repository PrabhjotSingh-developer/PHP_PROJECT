<?php
       $new_name = $_GET["update_name"];
      $new_class = $_GET["update_class"];
      $new_email = $_GET["update_emailId"];
      $new_mob = (int)$_GET["update_mobile"];
      $roll = (int)$_GET["update_rollno"];
    
      $conn = mysqli_connect("localhost", "Prabhjot", "Prabhjot@123", "bca3");
      if (!$conn)
        die("Connection not successful");

      $q = "UPDATE STUDENT SET NAME = '$new_name',CLASS = '$new_class',EMAILID = '$new_email',MOBNUMBER=$new_mob WHERE ROLLNO = $roll";
      if(mysqli_query($conn,$q))
      echo "<h1>🤟💪 Record Updated 🤟💪</h1>";
      else 
      echo "<h1>😓😓 Please try again 😓😓</h1>"
       

?>
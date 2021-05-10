<?php  
require_once('dbcon.php');
// INSERT INTO `notes` (`sno`, `name`, `age`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $name = $_POST["nameEdit"];
    $age = $_POST["ageEdit"];

    $sql = "select * from notes where name='$name';";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
      // $row = mysqli_fetch_assoc($res);
        echo '<script>alert("User already exists")</script>';
    }
    else{
      // Sql query to be executed
     $sql = "UPDATE `notes` SET `name` = '$name' , `age` = '$age' WHERE `notes`.`sno` = $sno";
     $result = mysqli_query($conn, $sql);
     if($result){
       $update = true;
   }
   else{
       echo "We could not update the record successfully";
   }
  }
}
else{
    $name = $_POST["name"];
    $age = $_POST["age"];

    $sql = "select * from notes where name='$name';";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
      // $row = mysqli_fetch_assoc($res);
        echo '<script>alert("User already exists")</script>';
    }
    else{
      // Sql query to be executed
      $sql = "INSERT INTO `notes` (`name`, `age`) VALUES ('$name', '$age')";
      $result = mysqli_query($conn, $sql);
      if($result){ 
          $insert = true;
      }
      else{
          echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
      } 
    }
}
}
?>
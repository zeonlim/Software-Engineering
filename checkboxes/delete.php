<?php
//delete.php
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  $query = "DELETE FROM package WHERE packageID = '".$id."'";
  mysqli_query($connect, $query);
 }
}
?>
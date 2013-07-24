<?php 
include("../inc/dbConnect.inc.php");
// include("generators.php");
// $email="user@user.com";
// $customer_id=customer_id_gen();
// $customer_sql="INSERT INTO `fundsinn_development`.`customer` (`customer_id`, `email`) VALUES ('".$customer_id."','".$email."');";
// // mysqli_query($con,$customer_sql);
// $ids=date("Ymd");
// $sql = "SELECT count(*) from `accounts` WHERE `account_id` LIKE '%".$ids."%';"; 
//   //echo $sql;
//   $res=mysqli_query($con,$sql);
//   $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//   $today_count=$row['count(*)'];

// echo $today_count;


  //date in mm/dd/yyyy format; or it can be in other formats as well
         $birthDate = "1992-05-13";
         //explode the date to get month, day and year
         $birthDate = explode("-", $birthDate);
         //get age from date or birthdate
         $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
         echo "Age is:".$age;

?>
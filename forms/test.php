<?php 
// include("../inc/dbConnect.inc.php");
// // include("generators.php");
// // $email="user@user.com";
// // $customer_id=customer_id_gen();
// // $customer_sql="INSERT INTO `fundsinn_development`.`customer` (`customer_id`, `email`) VALUES ('".$customer_id."','".$email."');";
// // // mysqli_query($con,$customer_sql);
// // $ids=date("Ymd");
// // $sql = "SELECT count(*) from `accounts` WHERE `account_id` LIKE '%".$ids."%';"; 
// //   //echo $sql;
// //   $res=mysqli_query($con,$sql);
// //   $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
// //   $today_count=$row['count(*)'];

// // echo $today_count;


//   //date in mm/dd/yyyy format; or it can be in other formats as well

//       function get_age_by_dob($dob)// Format "1992-05-13"
//       {
//          $birthDate = $dob;
//          //explode the date to get month, day and year
//          $birthDate = explode("-", $birthDate);
//          //get age from date or birthdate
//          $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
//          // echo "Age is:".$age;
//          return $age; 
//        }
// 



// Open fdf from input string provided by the extension
// The pdf form contained several input text fields with the names
// volume, date, comment, publisher, preparer, and two checkboxes
// show_publisher and show_preparer.
$fdf = fdf_open("Individual_data.fdf");
$volume = fdf_get_value($fdf, "volume");
echo "The volume field has the value '<b>$volume</b>'<br />";

$date = fdf_get_value($fdf, "date");
echo "The date field has the value '<b>$date</b>'<br />";

$comment = fdf_get_value($fdf, "comment");
echo "The comment field has the value '<b>$comment</b>'<br />";

if (fdf_get_value($fdf, "show_publisher") == "On") {
  $publisher = fdf_get_value($fdf, "publisher");
  echo "The publisher field has the value '<b>$publisher</b>'<br />";
} else
  echo "Publisher shall not be shown.<br />";

if (fdf_get_value($fdf, "show_preparer") == "On") {
  $preparer = fdf_get_value($fdf, "preparer");
  echo "The preparer field has the value '<b>$preparer</b>'<br />";
} else
  echo "Preparer shall not be shown.<br />";
fdf_close($fdf);
?>

?>
<?php
//echo(rand(10,100));

function get_age_by_dob($dob)// Format "1992-05-13"
      {
         $birthDate = $dob;
         	//echo $dob;
         //explode the date to get month, day and year
         $birthDate = explode("-", $birthDate);
         //print_r($birthDate);
         //get age from date or birthdate
         $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
         // echo "Age is:".$age;
         return $age; 
       }


function customer_id_gen(){
	$no=rand(10,100);
	$id="cust".$no;
	return $id;
}

function application_id_gen($code1,$code2){
	include("../inc/dbConnect.inc.php");
	$ids=date("Ymd");
	
  $sql = "SELECT count(*) from `accounts` WHERE `account_id` LIKE '%".$ids."%';"; 
  //echo $sql;
  $res=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
  $today_count=$row['count(*)'];

	$id=$code1.$code2.$ids.$today_count;
	return $id;
}

function account_id_gen(){
	$no=rand(10,100);
	$id="acc".$no;
	return $id;
}

function reference_id_gen($application_id){
	
	$id=substr($application_id, 2);
	return $id;
}

// echo customer_id_gen();
// echo account_id_gen();
// echo reference_id_gen();
 //temp=application_id_gen("I","M");

 //echo "reference id : ".reference_id_gen($temp)."---".$temp;
?>
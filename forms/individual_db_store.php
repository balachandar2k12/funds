
<?php
include("../inc/dbConnect.inc.php");
include("generators.php");
//var_dump($_POST);
$account_type=$_POST["account_type"];
$applicant_name=$_POST['applicant_name']; 
//echo "-track  ->".$applicant_name;
$applicant_father_name=$_POST["applicant_father_name"];
$applicant_dob=$_POST["applicantdobyyyy"]."-".$_POST["applicantdobmm"]."-".$_POST["applicant_dob"];
$applicant_gender=$_POST["applicant_gender"];
$applicant_pan=$_POST["applicant_pan"];
$phone_resi=$_POST["phone_resi"];
$phone_office=$_POST["phone_office"];
$mobile=$_POST["mobile"];
$email=$_POST["email"];
$occupation=$_POST["occupation"];
$tax_status="N/A";
$perm_address=$_POST["perm_addr1"].", ".$_POST["perm_addr2"].", ".$_POST["perm_addr3"];
$perm_city=$_POST["perm_city"];
$perm_state=$_POST["perm_state"];
$perm_zip=$_POST["perm_zip"];
if($_POST['applicantpaddrcheck']!="same")
{
  $temp_address=$_POST["temp_addr1"].", ".$_POST["temp_addr2"].", ".$_POST["temp_addr3"];
  $temp_city=$_POST["temp_city"];
  $temp_state=$_POST["temp_state"];
  $temp_zip=$_POST["temp_zip"];
 } else{
  $temp_address=$perm_address;
  $temp_city=$perm_city;
  $temp_state=$perm_state;
  $temp_zip=$perm_zip;
 }

$applicant2_name=$_POST["applicant2_name"];
$applicant2_pan=$_POST["applicant2_pan"];

$applicant3_name=$_POST["applicant3_name"];
$applicant3_pan=$_POST["applicant3_pan"];

// bank details
$bank_name=$_POST["bankname"];
$bank_acc_type=$_POST["bank_acc_type"];
$bank_micr=$_POST["bankmicr"];
$bank_ifsc=$_POST["bankifsc"];
$bank_acc_no=$_POST["bank_acc_no"];
$bank_address=$_POST["bank_addr1"].", ".$_POST["bank_addr2"];
$bank_city=$_POST["bank_city"];

$bank2stat=$_POST["bank2stat"];

$bank2name=$_POST["bank2name"];
$bank2acctype=$_POST["bank2acctype"];
$bank2accno=$_POST["bank2accno"];
$bank2address=$_POST["bank2_addr1"].", ".$_POST["bank2_addr2"];
$bank2city=$_POST["bank2city"];
$bank2micr=$_POST["bank2micr"];
$bank2ifsc=$_POST["bank2ifsc"];

$bank3stat=$_POST["bank3stat"];
 
$bank3name=$_POST["bank3name"];
$bank3acctype=$_POST["bank3acctype"];
$bank3accno=$_POST["bank3accno"];
$bank3address=$_POST["bank3_addr1"].", ".$_POST["bank3_addr2"];
$bank3city=$_POST["bank3city"];
$bank3micr=$_POST["bank3micr"];
$bank3ifsc=$_POST["bank3ifsc"];

$sip_validity_years=$_POST["applicantvalidy"];
$sip_mandate_amount=$_POST["applicantvalidma"];
$nomineename=$_POST["nomineename"];
$nominee_dob=$_POST["nomineedoby"]."-".$_POST["nomineedobm"]."-".$_POST["nomineedobd"];
$nominee_relationship=$_POST["nominee_relationship"];
//  Customer tabel entry
$customer_id=customer_id_gen();
$customer_sql="INSERT INTO `fundsinn_development`.`customer` (`customer_id`, `email`) VALUES ('".$customer_id."','".$email."');";
mysqli_query($con,$customer_sql);


$account_number=account_id_gen();
$age=get_age_by_dob($applicant_dob);
if ($age < 18){
  $application_no=application_id_gen("I","M");
}else{
  $application_no=application_id_gen("I","S");
}
if($applicant2_pan!=""){
  $application_no=application_id_gen("I","J");
}

$reference_id=reference_id_gen($application_no);

 $mode="single";
 $invester_id1="";
 $invester_id2="";
 $bank_id1="";
 $bank_id2="";
 $bank_id3=""; 

$acc_sql = "INSERT INTO `accounts` (`account_id`,`customer_id`,`reference_id`, `application_no`) VALUES ('".$account_number."','".$customer_id."','".$reference_id."','".$application_no."');";
 mysqli_query($con,$acc_sql);
// co-investors Entry 
if($applicant2_pan!=""){
  $investors_sql = "INSERT INTO `co_investers` (`application_id`, `name`,`pan_no`) VALUES ('".$application_no."','".$applicant2_name."','".$applicant2_pan."')";
  mysqli_query($con,$investors_sql);
  $sql_str="select id from co_investers where pan_no='".$applicant2_pan."';";
  //echo $sql_str;
  $res=mysqli_query($con,$sql_str);
  $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
  //echo "invid1---".$row["id"];
  $invester_id1=$row['id'];
  $mode="Joint";
 }

 if($applicant3_pan!=""){
  $investors_sql = "INSERT INTO `co_investers` (`application_id`, `name`,`pan_no`) VALUES ('".$application_no."','".$applicant3_name."','".$applicant3_pan."')";
  mysqli_query($con,$investors_sql);

  $res=mysqli_query($con,"select id from co_investers where pan_no='".$applicant3_pan."';");
  $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
  $invester_id2=$row['id'];
  $mode="Joint";
 }
  
  // Bank Entries
  $bank_sql = "INSERT INTO `bank_accounts` (`application_id`, `account_no`, `bank_name`,`account_type`, `address`, `city`, `micr_code`, `ifsc_code`) VALUES (
  									'".$application_no."','".$bank_acc_no."','".$bank_name."','".$bank_acc_type."','".$bank_address."','".$bank_city."','".$bank_micr."','".$bank_ifsc."')";
  //echo "bank1 sql".$bank_sql;
  mysqli_query($con,$bank_sql);
  $res=mysqli_query($con,"select id from bank_accounts where account_no='".$bank_acc_no."';");
  $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
  $bank_id1=$row['id'];
  
 
 if($bank2stat=="bank2true"){
  $bank1_sql = "INSERT INTO `bank_accounts` (`application_id`, `account_no`, `bank_name`,`account_type`, `address`, `city`, `micr_code`, `ifsc_code`) VALUES (
  									'".$application_no."','".$bank2accno."','".$bank2name."','".$bank2acctype."','".$bank2address."','".$bank2city."','".$bank2micr."','".$bank2ifsc."')";
  //echo "bank2 sql".$bank1_sql;
  mysqli_query($con,$bank1_sql);
  $res=mysqli_query($con,"select id from bank_accounts where account_no='".$bank2accno."';");
  $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
  $bank_id2=$row['id'];
 }
 if($bank3stat=="bank3true"){
  $bank2_sql = "INSERT INTO `bank_accounts` (`application_id`, `account_no`, `bank_name`,`account_type`, `address`, `city`, `micr_code`, `ifsc_code`) VALUES (
  									'".$application_no."','".$bank3accno."','".$bank3name."','".$bank3acctype."','".$bank3address."','".$bank3city."','".$bank3micr."','".$bank3ifsc."')";
  //echo "bank3 sql".$bank2_sql;
  mysqli_query($con,$bank2_sql);
  $res=mysqli_query($con,"select id from bank_accounts where account_no='".$bank3accno."';");
  $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
  $bank_id3=$row['id'];
 }


$details_sql = "INSERT INTO `individual_account_details` (`application_id`,`account_type`, `applicant_name`, `father_name`,
									  `dob`, `gender`, `pan`, `phone_office`, `phone_resi`, 
									  `mobile`, `email`, `occupation`, `tax_status`,
									   `nationality`, `temp_address`, `temp_city`, 
									   `temp_state`, `temp_zip`, `perm_address`,
									    `perm_city`, `perm_state`, `perm_zip`, 
									    `invester_id1`, `invester_id2`, `bank_id1`, 
									    `bank_id2`, `bank_id3`,`sip_validity_years`,`sip_mandate_amount`,
                       `nominee_name`,`nominee_dob`, `nominee_parent`, `nominee_relationship`, 
									     `mode_of_holding`) VALUES ('".$application_no."',
    										'".$account_type."','".$applicant_name."','".$applicant_father_name."',
    										'".$applicant_dob."','".$applicant_gender."','".$applicant_pan."',
    										'".$phone_office."','".$phone_resi."','".$mobile."',
    										'".$email."','".$occupation."','".$tax_status."',
    										'".$nationality."','".$temp_address."','".$temp_city."',
    										'".$temp_state."','".$temp_zip."','".$perm_address."','".$perm_city."',
    										'".$perm_state."','".$perm_zip."','".$invester_id1."',
    										'".$invester_id2."','".$bank_id1."','".$bank_id2."','".$bank_id3."',
                        '".$sip_validity_years."','".$sip_mandate_amount."',
    										'".$nomineename."','".$nominee_dob."','".$nominee_parent_name."',
    										'".$nominee_relationship."','".$mode."');";

//echo ($details_sql);
 $result=mysqli_query($con,$details_sql);
 if($result){
  $fetch_detail_sql="select id from `individual_account_details` where `application_id`='".$application_no."';";
  $result1=mysqli_query($con,$fetch_detail_sql);
  $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
  $detail_id=$row['id'];
  $update_sql = "UPDATE `fundsinn_development`.`accounts` SET `account_detail_id` = '".$detail_id."' WHERE `application_no`='".$application_no."';";
  mysqli_query($con,$update_sql);
 	echo 1;
 }else{
 	echo 0;
 }
?>

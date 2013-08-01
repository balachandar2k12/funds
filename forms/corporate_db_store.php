
<?php
include("../inc/dbConnect.inc.php");
include("generators.php");
$account_type=$_POST['account_type'];
$applicant_name=$_POST['applicantname'];
$applicant_father_name=$_POST['applicantfname'];
$applicant_dob=$_POST['applicantdoiyyyy']."-".$_POST['applicantdoimm']."-".$_POST['applicantdoidd'];
 //echo $applicant_dob;
$applicant_pan=$_POST['applicantpan'];
$applicant2contactname=$_POST['applicant2contactname'];
$applicant2designation=$_POST['applicant2contactdes'];
$applicant2email=$_POST['applicant2contactemail'];
$phone_resi=$_POST['applicant2contacttelr'];
$phone_office=$_POST['applicant2contacttelo'];
$mobile=$_POST['applicant2contacttelm'];

$occupation=$_POST['applicantocc'];
$status= $_POST['applicantstatus'];
$tax_status=$_POST['applicanttaxstatus'];

$nationality=$_POST['applicantnat'];
$perm_addr=$_POST['applicantpaddr1'].','.$_POST['applicantpaddr2'].','.$_POST['applicantpaddr3'];
$perm_city=$_POST['applicantpcity'];
$perm_state=$_POST['applicantpstate'];
$perm_zip=$_POST['applicantpzip'];
if($_POST['applicantpaddrcheck']!="same")
{
  $current_addr=$_POST['applicantcaddr1'].','.$_POST['applicantcaddr2'].','.$_POST['applicantcaddr3'];
  $current_city=$_POST['applicantccity'];
  $current_state=$_POST['applicantcstate'];
  $current_zip=$_POST['applicantczip'];
 } else{
  $current_addr=$perm_addr;
  $current_city=$perm_city;
  $current_state=$perm_state;
  $current_zip=$perm_zip;
 }
$applicant2_name=$_POST['applicant2name'];
$applicant2_pan=$_POST['applicant2pan'];

$applicant3_name=$_POST['applicant3name'];
$applicant3_pan=$_POST['applicant3pan'];

$bank_name=$_POST['bankname'];
$bank_acc_type=$_POST['bankacctype'];
$bank_acc_no=$_POST['bankaccno'];
$bank_address=$_POST['bankaddr1'].', '.$_POST['bankaddr2'];
$bank_city=$_POST['bankcity'];
$bank_micr=$_POST['bankmicr'];
$bank_ifsc=$_POST['bankifsc'];

$bank2stat=$_POST['bank2stat'];

$bank2name=$_POST['bank2name'];
$bank2acctype=$_POST['bank2acctype'];
$bank2accno=$_POST['bank2accno'];
$bank2address=$_POST['bank2addr1'].', '.$_POST['bank2addr2'];
$bank2city=$_POST['bank2city'];
$bank2micr=$_POST['bank2micr'];
$bank2ifsc=$_POST['bank2ifsc'];

$bank3stat=$_POST['bank3stat'];

$bank3name=$_POST['bank3name'];
$bank3acctype=$_POST['bank3acctype'];
$bank3address=$_POST['bank3addr1'].', '.$_POST['bank3addr2'];

$bank3accno=$_POST['bank3accno'];
$bank3addr1=$_POST['bank3addr1'];
$bank3addr2=$_POST['bank3addr2'];
$bank3city=$_POST['bank3city'];
$bank3micr=$_POST['bank3micr'];
$bank3ifsc=$_POST['bank3ifsc'];

$applicantsip=$_POST['applicantsip'];
$sip_validity_years=$_POST['applicantvalidy'];
$sip_mandate_amount=$_POST['applicantvalidma'];

$nomineename=$_POST['appnomname'];
$nominee_dob=$_POST['appnomdoby']."-".$_POST['appnomdobm']."-".$_POST['appnomdobd'];
$nominee_parent_name=$_POST['appnompname'];
$nominee_relationship=$_POST['appnomrel'];

//  Customer tabel entry
$customer_id=customer_id_gen();
$customer_sql="INSERT INTO `fundsinn_development`.`customer` (`customer_id`, `email`) VALUES ('".$customer_id."','".$email."');";
mysqli_query($con,$customer_sql);

$account_number=account_id_gen();
 
$age=get_age_by_dob($applicant_dob);
if ($age < 18){
  $application_no=application_id_gen("C","");
}else{
  $application_no=application_id_gen("C","");
}
if($applicant2_pan!=""){
	$application_no=application_id_gen("C","");
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


$details_sql = "INSERT INTO `corporate_account_details` (`application_id`,`account_type`, `applicant_name`, `dob`, 
										`gender`, `pan`, `contact_person_name`, `contact_person_desig`,
										 `phone_office`, `phone_resi`, `mobile`, `email`, `occupation`, 
										 `status`, `tax_status`, `prem_address`, `prem_city`, `prem_state`,
										  `prem_zip`, `temp_address`, `temp_city`, `temp_state`, `temp_zip`,
                      `invester_id1`,`invester_id2`,`bank_id1`, 
                      `bank_id2`, `bank_id3`,`sip_validity_years`,`sip_mandate_amount`,
                      `nominee_name`,`nominee_dob`, `nominee_parent`, `nominee_relationship`, 
                       `mode_of_holding`)
										   VALUES ('".$application_no."','".$account_type."','".$applicant_name."',
            										'".$applicant_dob."','".$applicant_gender."','".$applicant_pan."',
            										'".$applicant2contactname."','".$applicant2designation."',
            										'".$phone_office."','".$phone_resi."','".$mobile."',
            										'".$applicant2email."','".$occupation."','".$status."','".$tax_status."',
            										'".$perm_addr."','".$perm_city."','".$perm_state."','".$perm_zip."','".$current_addr."',
            										'".$current_city."','".$current_state."','".$current_zip."','".$invester_id1."',
            										'".$invester_id2."','".$bank_id1."','".$bank_id2."','".$bank_id3."','".$sip_validity_years."',
                                '".$sip_mandate_amount."','".$nomineename."','".$nominee_dob."','".$nominee_parent_name."',
            										'".$nominee_relationship."','".$mode."');";

//echo ($details_sql);
 $result=mysqli_query($con,$details_sql);
 if($result){
  $fetch_detail_sql="select id from `corporate_account_details` where `application_id`='".$application_no."';";
  $result1=mysqli_query($con,$fetch_detail_sql);
  $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
  $detail_id=$row['id'];
  $update_sql = "UPDATE `accounts` SET `account_detail_id` = '".$detail_id."',`account_type` = '".$account_type."' WHERE `application_no`='".$application_no."';";
  mysqli_query($con,$update_sql);
  //echo $update_sql."--".$fetch_detail_sql;
 	echo 1;
 }else{
 	echo 0;
 }
?>






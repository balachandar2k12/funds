<?php

function request($param, $default){
    return (isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : $default;
}




//data base 
$return_array = array();
  $return_array['success'] = '0';

  // load array
	$applicant_id = date('dmo'); 
	$applicant_account_type = request("account_type", "corporate");
    $applicant_name = request("applicantname", "");
	
	$applicant_doi_year = request("applicantdoiyyyy", "");
    $applicant_doi_month = request("applicantdoimm", "");
    $applicant_doi_day = request("applicantdoidd", "");
    if (($applicant_doi_year != "")
     && ($applicant_doi_month != "")
     && ($applicant_doi_day != "")) {
        $applicant_doi = $applicant_doi_year."-".$applicant_doi_month."-".$applicant_doi_day;
    } else {
        $applicant_doi = "";
    }
    $applicant_pan = request("applicantpan", "");
   
	
	$applicant_contact_name=request("applicant2contactname", "");
	$applicant_contact_designation=request("applicant2contactdes", "");
	$applicant_contact_telephone_residence=request("applicant2contacttelr", "");
	$applicant_contact_telephone_office=request("applicant2contacttelo", "");
	$applicant_contact_telephone_mobile=request("applicant2contacttelm", "");
	$applicant_contact_email=request("applicant2contactemail", "");

	$applicant_occupation = request("applicantocc", "");
	$applicant_status = request("applicantstatus", "");
	$applicant_tax_status = request("applicanttaxstatus", "");
	
    $applicant_address_permanant_line1 = request("applicantpaddr1", "");
    $applicant_address_permanent_line2 = request("applicantpaddr2", "");
	$applicant_address_permanent_line3 = request("applicantpaddr3", "");
    $applicant_address_permanent_city = request("applicantpcity", "");
    $applicant_address_permanent_state = request("applicantpstate", "");
    $applicant_address_permanent_pincode = request("applicantpzip", "");
    $applicant_address_communication_line1 = request("applicantcaddr1", "");
    $applicant_address_communication_line2 = request("applicantcaddr2", "");
	$applicant_address_communication_line3 = request("applicantcaddr3", "");
    $applicant_address_communication_city = request("applicantccity", "");
    $applicant_address_communication_state = request("applicantcstate","");
    $applicant_address_communication_pincode = request("applicantczip", "");
    $applicant_bank1_account_number = request("bankaccno", "");
    $bank1_account_type = request("bankacctype", "");
    $bank1_ifsc_code = request("bankifsc", "");
    $bank1_micr_code = request("bankmicr", "");
    $bank1_name = request("bankname", "");
    $bank1_branch_address_line1 =request("bankaddr1", "");
    $bank1_branch_address_line2 = request("bankaddr2", "");
    $bank1_branch_city = request("bankcity", "");
	$applicant_bank2_account_number = request("bank2accno", "");
    $bank2_account_type = request("bank2acctype", "");
    $bank2_ifsc_code = request("bank2ifsc", "");
    $bank2_micr_code = request("bank2micr", "");
    $bank2_name = request("bank2name","");
	$bank2_branch_address_line1 = request("bank2addr1", "");
    $bank2_branch_address_line2 = request("bank2addr2", "");
    $bank2_branch_city = request("bank2city", "");
	$applicant_bank3_account_number = request("bank3accno", "");
    $bank3_account_type = request("bank3acctype", "");
    $bank3_ifsc_code = request("bank3ifsc", "");
    $bank3_micr_code = request("bank3micr", "");
    $bank3_name = request("bank3name", "");
	$bank3_branch_address_line1 = request("bank3addr1", "");
    $bank3_branch_address_line2 = request("bank3addr2", "");
    $bank3_branch_city = request("bank3city", "");
	$applicant_nominee_mandate = request("aplicantnomcheckbox", "");
	$applicant_nominee_name = request("appnomname", "");
    $applicant_nominee_dob_year = request("appnomdoby", "");
    $applicant_nominee_dob_month = request("appnomdobm", "");
    $applicant_nominee_dob_day = request("appnomdobd", "");
    if (($applicant_nominee_dob_year != "")
     && ($applicant_nominee_dob_month != "")
     && ($applicant_nominee_dob_day != "")) {
        $applicant_nominee_dob = $applicant_nominee_dob_year."-".$applicant_nominee_dob_month."-".$applicant_nominee_dob_day;
    } else {
        $applicant_nominee_dob = "";
    }
    $applicant_nominee_parent_name = request("appnompname","");
    $applicant_nominee_relationship = request("appnomrel", "");
	$applicant_sip_mandate = request("applicantsip", "");
    $applicant_sip_mandate_years = request("applicantvalidy", "");
    $appplicant_sip_mandate_maximum_per_month = request("applicantvalidma", "");




//check validation and defaults /formatting

	// app id generate unique
	
	$return_attr=array();
	$words = "/^[A-Za-z]+[A-Za-z \\s]*\$/";
	if($applicant_name==="")
		$return_attr['applicantname']="Applicant name cannot be empty";
	else
		if(preg_match($words,$applicant_name))
			$return_attr['applicantname']="TRUE";
		else
			$return_attr['applicantname']="Only alpha bhats are allowed for name";

	//$datepattern = "/^[0-9]{4}[-\/][0-9]{1,2}[-\/][0-9]{1,2}\$/";
	$datepattern="/^(1)?[0-9]{3}[-\/](0?[1-9]|1[012])[-\/](0?[1-9]|[12][0-9]|3[01])\$/";

	if($applicant_doi==="")
			{
				$return_attr['applicantdoidd']="Date of incorporation cannot be empty";
				$return_attr['applicantdoimm']="Date of incorporation cannot be empty";
				$return_attr['applicantdoiyyyy']="Date of incorporation cannot be empty";
			}
	else
		if(preg_match($datepattern,$applicant_doi))
			{	
				$return_attr['applicantdoidd']="TRUE";
				$return_attr['applicantdoimm']="TRUE";
				$return_attr['applicantdoiyyyy']="TRUE";
						
			}
		else
			{
					$return_attr['applicantdoidd']="In Valid Date";
					$return_attr['applicantdoimm']="In Valid Date";
					$return_attr['applicantdoiyyyy']="In Valid Date";
			}
	$panpattern='/^[a-z]{4,4}[cphfatbljg]{1,1}[0-9]{4,4}[a-z]/i';
	
	if($applicant_pan==="")
		$return_attr['applicantpan']="PAN number cannot be empty";
	else
		if(preg_match($panpattern,$applicant_pan))
			$return_attr['applicantpan']="TRUE";
		else
			$return_attr['applicantpan']="In Valid PAN example ABCDF9999A ";
	
	
		if(!$applicant_contact_name=="")
			if(preg_match($words,$applicant_contact_name))
				$return_attr['applicant2contactname']="TRUE";
			else
				$return_attr['applicant2contactname']="Only alpha bhats are allowed for name";
				
	
	
		if(!$applicant_contact_designation=="")
			if(preg_match($words,$applicant_contact_designation))
				$return_attr['applicant2contactdes']="TRUE";
			else
				$return_attr['applicant2contactdes']="Only alpha bhats are allowed for designation";
	
	$terpattern = "/^[0-9]{6,12}\$/";
	
		if(!$applicant_contact_telephone_residence=="")
			if(preg_match($terpattern,$applicant_contact_telephone_residence))
				$return_attr['applicant2contacttelr']="TRUE";
			else
				$return_attr['applicant2contacttelr']="InValid phone no";
	
		$teopattern = "/^[0-9]{6,15}\$/";
		
		if(!$applicant_contact_telephone_office=="")
		if(preg_match($teopattern,$applicant_contact_telephone_office))
			$return_attr['applicant2contacttelo']="TRUE";
		else
			$return_attr['applicant2contacttelo']="InValid phone no";
	
		$tempattern = "/^[0-9]{10,11}\$/";
	
		if(!$applicant_contact_telephone_mobile=="")
			if(preg_match($tempattern,$applicant_contact_telephone_mobile))
			$return_attr['applicant2contacttelm']="TRUE";
		else
			$return_attr['applicant2contacttelm']="In Valid phone no";
	
	
	$emailpattern='/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/'; 
	
	if(!$applicant_contact_email=="")
		if(preg_match($emailpattern,$applicant_contact_email))
			$return_attr['applicant2contactemail']="TRUE";
		else
			$return_attr['applicant2contactemail']="In Valid email ";
	
		if($applicant_occupation==="--Select--")
			$return_attr['applicantocc']="Please select the occupation ";
		else
			$return_attr['applicantocc']="TRUE";
			
		if($applicant_status==="--Select--")
			$return_attr['applicantstatus']="Please select the status ";
		else
			$return_attr['applicantstatus']="TRUE";
			
		if($applicant_tax_status==="--Select--")
			$return_attr['applicanttaxstatus']="Please select the Taxt Status ";
		else
			$return_attr['applicanttaxstatus']="TRUE";
	
	if($applicant_address_permanant_line1==="")
		$return_attr['applicantpaddr1']="address line cannot  be empty";
	else 
		$return_attr['applicantpaddr1']="TRUE";
		
	if($applicant_address_permanent_city==="")
		$return_attr['applicantpcity']="city cannot  be empty";
	else 
		$return_attr['applicantpcity']="TRUE";
		
	if($applicant_address_permanent_state==="")
		$return_attr['applicantpstate']="State cannot  be empty";
	else 
		$return_attr['applicantpstate']="TRUE";
	
	$pinpattern="/^[0-9]{6,7}/";
	
	if($applicant_address_permanent_pincode==="")
		$return_attr['applicantpzip']="zip/pincode  cannot be empty";
	else
		if(preg_match($pinpattern,$applicant_address_permanent_pincode))
			$return_attr['applicantpzip']="TRUE";
		else
			$return_attr['applicantpzip']="In Valid zip/Pincode ";
	
	if(request("applicantpaddrcheck", "different")==="same")
	{
		
		$applicant_address_communication_line1=$applicant_address_permanant_line1;
		$applicant_address_communication_line2=$applicant_address_permanent_line2;
		$applicant_address_communication_line3=$applicant_address_permanent_line3;
		$applicant_address_communication_city=$applicant_address_permanent_city;
		$applicant_address_communication_state=$applicant_address_permanent_state;
		$applicant_address_communication_pincode=$applicant_address_permanent_pincode;
	}
	else
	{
			
			if($applicant_address_communication_line1==="")
			$return_attr['applicantcaddr1']="communication address cannot  be empty";
			else 
		$return_attr['applicantcaddr1']="TRUE";
		
	if($applicant_address_communication_city==="")
		$return_attr['applicantccity']="city cannot  be empty";
	else 
		$return_attr['applicantccity']="TRUE";
		
	if($applicant_address_communication_state==="")
		$return_attr['applicantcstate']="State cannot  be empty";
	else 
		$return_attr['applicantcstate']="TRUE";
	
	if($applicant_address_communication_pincode==="")
		$return_attr['applicantczip']="zip/pincode  cannot be empty";
	else
		if(preg_match($pinpattern,$applicant_address_communication_pincode))
			$return_attr['applicantczip']="TRUE";
		else
			$return_attr['applicantczip']="In Valid zip/Pincode ";
	}
	
	$accpattern="/^[0-9]{1,20}\$/";

	if($applicant_bank1_account_number==="")
		$return_attr['bankaccno']="account no  cannot be empty";
	else
		if(preg_match($accpattern,$applicant_bank1_account_number))
			$return_attr['bankaccno']="TRUE";
		else
			$return_attr['bankaccno']="In Valid account no ";
	
	if($bank1_ifsc_code==="")
		$return_attr['bankifsc']="ifsc  cannot be empty";
	else
		$return_attr['bankifsc']="TRUE";	
		
	$micrpattern="/^[0-9]{9}\$/";

	if($bank1_micr_code==="")
		$return_attr['bankmicr']="micr cannot be empty no  cannot be empty";
	else
		if(preg_match($micrpattern,$bank1_micr_code))
			$return_attr['bankmicr']="TRUE";
		else
			$return_attr['bankmicr']="InValid Micr no ";	
	
	if($bank1_name==="")
		$return_attr['bankname']="bamk name cannot be empty";
	else
		$return_attr['bankname']="TRUE";	
			
	if($bank1_branch_address_line1==="")
		$return_attr['bankaddr1']="bamk addresscannot be empty";
	else
		$return_attr['bankaddr1']="TRUE";	
		
	if($bank1_branch_city==="")
		$return_attr['bankcity']="bamk city cannot be empty";
	else
		$return_attr['bankcity']="TRUE";		
		
	if(request("bank2stat", "bank2false")=="bank2true")
	{
			

		if($applicant_bank2_account_number==="")
		$return_attr['bank2accno']="account no  cannot be empty";
	else
		if(preg_match($accpattern,$applicant_bank2_account_number))
			$return_attr['bank2accno']="TRUE";
		else
			$return_attr['bank2accno']="In Valid account no ";
	
	if($bank2_ifsc_code==="")
		$return_attr['bank2ifsc']="ifsc  cannot be empty";
	else
		$return_attr['bank2ifsc']="TRUE";	
		
	if($bank2_micr_code==="")
		$return_attr['bank2micr']="micr cannot be empty no  cannot be empty";
	else
		if(preg_match($micrpattern,$bank2_micr_code))
			$return_attr['bank2micr']="TRUE";
		else
			$return_attr['bank2micr']="In Micr no ";	
	
	if($bank2_name==="")
		$return_attr['bank2name']="bamk name cannot be empty";
	else
		$return_attr['bank2name']="TRUE";	
			
	if($bank2_branch_address_line1==="")
		$return_attr['bank2addr1']="bamk addresscannot be empty";
	else
		$return_attr['bank2addr1']="TRUE";	
		
	if($bank2_branch_city==="")
		$return_attr['bank2city']="bamk city cannot be empty";
	else
		$return_attr['bank2city']="TRUE";		
		
	}
	else
	{
	    $applicant_bank2_account_number="";
		$bank2_account_type=""; 
		$bank2_ifsc_code="";
		$bank2_micr_code=""; 
		$bank2_name="";
		$bank2_branch_address_line1=""; 
		$bank2_branch_address_line2="";
		$bank2_branch_city=""; 
	}
		
		if(request("bank3stat", "bank3false")=="bank3true")
	{
			
		if($applicant_bank3_account_number==="")
		$return_attr['bank3accno']="account no  cannot be empty";
	else
		if(preg_match($accpattern,$applicant_bank3_account_number))
			$return_attr['bank3accno']="TRUE";
		else
			$return_attr['bank3accno']="In Valid account no ";
	
	if($bank3_ifsc_code==="")
		$return_attr['bank3ifsc']="ifsc  cannot be empty";
	else
		$return_attr['bank3ifsc']="TRUE";	
		
	

	if($bank3_micr_code==="")
		$return_attr['bank3micr']="micr cannot be empty no  cannot be empty";
	else
		if(preg_match($micrpattern,$bank3_micr_code))
			$return_attr['bank3micr']="TRUE";
		else
			$return_attr['bank3micr']="In Valid account no ";	
	
	if($bank3_name==="")
		$return_attr['bank3name']="bamk name cannot be empty";
	else
		$return_attr['bank3name']="TRUE";	
			
	if($bank3_branch_address_line1==="")
		$return_attr['bank3addr1']="bamk addresscannot be empty";
	else
		$return_attr['bank3addr1']="TRUE";	
		
	if($bank3_branch_city==="")
		$return_attr['bank3city']="bamk city cannot be empty";
	else
		$return_attr['bank3city']="TRUE";		
		
	}
	else
	{
	    $applicant_bank3_account_number="";
		$bank3_account_type=""; 
		$bank3_ifsc_code="";
		$bank3_micr_code=""; 
		$bank3_name="";
		$bank3_branch_address_line1=""; 
		$bank3_branch_address_line2="";
		$bank3_branch_city=""; 
	}
	
		if(request("aplicantnomcheckbox", "appnomineetrue")==="appnomineefalse")
		{
			$applicant_nominee_mandate="0";
			$applicant_nominee_name="";
			$applicant_nominee_dob="";
			$applicant_nominee_parent_name="";
			$applicant_nominee_relationship="";
		}else
		{
				if($applicant_nominee_name==="")
					$return_attr['appnomname']="Nominee name cannot be empty";
				else
					if(preg_match($words,$applicant_nominee_name))
						$return_attr['appnomname']="TRUE";
					else
						$return_attr['appnomname']="Only alpha bhats are allowed";
				
				if($applicant_nominee_dob==="")
					{
						$return_attr['appnomdobd']="Date of birth name cannot be empty";
						$return_attr['appnomdobm']="Date of birth name cannot be empty";
						$return_attr['appnomdoby']="Date of birth name cannot be empty";
					}
				else
					if(preg_match($datepattern,$applicant_nominee_dob))
						{
							$return_attr['appnomdobd']="TRUE";
							$return_attr['appnomdobm']="TRUE";
							$return_attr['appnomdoby']="TRUE";
						}
					else
						{
								$return_attr['appnomdobd']="In Valid Date";
								$return_attr['appnomdobm']="In Valid Date";
								$return_attr['appnomdoby']="In Valid Date";
						}
				
				if($applicant_nominee_parent_name==="")
					$return_attr['appnompname']="TRUE";
				 else
					if(preg_match($words,$applicant_nominee_parent_name))
						$return_attr['appnompname']="TRUE";
					else
						$return_attr['appnompname']="Only alpha bhats are allowed";
						
				if($applicant_nominee_relationship==="")
						$return_attr['appnomrel']="TRUE";
				else
					if(preg_match($words,$applicant_nominee_relationship))
						$return_attr['appnomrel']="TRUE";
					else
						$return_attr['appnomrel']="Only alpha bhats are allowed";
			
			$applicant_nominee_mandate="1";
		}
		
		if(request("applicantsip", "sipmandatetrue")==="sipmandatefalse")
		{
			$applicant_sip_mandate="0";
			$applicant_sip_mandate_years = "0";
			$appplicant_sip_mandate_maximum_per_month ="0";
		
		}
		else
		{
				if($applicant_sip_mandate_years==="--Select--")
						$return_attr['applicantvalidy']="Please select the SIP Mandate Years ";
				else
						$return_attr['applicantvalidy']="TRUE";
				
				if($appplicant_sip_mandate_maximum_per_month==="--Select--")
					$return_attr['applicantvalidma']="Please select the SIP Mandate amount ";
				else
					$return_attr['applicantvalidma']="TRUE";
			
			$applicant_sip_mandate="1";
		}
		
		
		foreach($return_attr as $key=>$value)
		{
			if($value==="TRUE")
			$return_array['success'] = '1';
			else
			{
				$return_array['success'] = '0';
				$return_array['attr'] =$return_attr;
				break;
			}
		} 
	

if(($return_array['success'])==='1')
{	
		
	//prepare sql
  $sql = "INSERT INTO `corporate_customer`";
        $sql .= " (";
        $sql .= "corporate_customer.applicant_id"; 
        $sql .= ",corporate_customer.applicant_account_type"; 
        $sql .= ",corporate_customer.applicant_name"; 
		$sql .= ",applicant_doi"; 
		$sql .= ",applicant_pan"; 
		$sql .= ",applicant_contact_name"; 
		$sql .= ",applicant_contact_designation"; 
		$sql .= ",applicant_contact_telephone_residence"; 
		$sql .= ",applicant_contact_telephone_office"; 
		$sql .= ",applicant_contact_telephone_mobile"; 
		$sql .= ",applicant_contact_email"; 
		$sql .= ",applicant_occupation"; 
		$sql .= ",applicant_status"; 
		$sql .= ",applicant_tax_status";
		$sql .= ",corporate_customer.applicant_address_permanant_line1"; 
        $sql .= ",corporate_customer.applicant_address_permanent_line2"; 
        $sql .= ",corporate_customer.applicant_address_permanent_line3"; 
        $sql .= ",corporate_customer.applicant_address_permanent_city"; 
        $sql .= ",corporate_customer.applicant_address_permanent_state"; 
        $sql .= ",corporate_customer.applicant_address_permanent_pincode"; 
        $sql .= ",corporate_customer.applicant_address_communication_line1"; 
        $sql .= ",corporate_customer.applicant_address_communication_line2"; 
        $sql .= ",corporate_customer.applicant_address_communication_line3"; 
        $sql .= ",corporate_customer.applicant_address_communication_city"; 
        $sql .= ",corporate_customer.applicant_address_communication_state"; 
        $sql .= ",corporate_customer.applicant_address_communication_pincode"; 
		$sql .= ",corporate_customer.applicant_bank1_account_number"; 
        $sql .= ",corporate_customer.bank1_account_type"; 
        $sql .= ",corporate_customer.bank1_ifsc_code"; 
        $sql .= ",corporate_customer.bank1_micr_code"; 
        $sql .= ",corporate_customer.bank1_name"; 
        $sql .= ",corporate_customer.bank1_branch_address_line1"; 
        $sql .= ",corporate_customer.bank1_branch_address_line2"; 
        $sql .= ",corporate_customer.bank1_branch_city"; 
        $sql .= ",corporate_customer.applicant_bank2_account_number"; 
        $sql .= ",corporate_customer.bank2_account_type"; 
        $sql .= ",corporate_customer.bank2_ifsc_code"; 
        $sql .= ",corporate_customer.bank2_micr_code"; 
        $sql .= ",corporate_customer.bank2_name"; 
        $sql .= ",corporate_customer.bank2_branch_address_line1"; 
        $sql .= ",corporate_customer.bank2_branch_address_line2"; 
        $sql .= ",corporate_customer.bank2_branch_city"; 
        $sql .= ",corporate_customer.applicant_bank3_account_number"; 
        $sql .= ",corporate_customer.bank3_account_type"; 
        $sql .= ",corporate_customer.bank3_ifsc_code"; 
        $sql .= ",corporate_customer.bank3_micr_code"; 
        $sql .= ",corporate_customer.bank3_name"; 
        $sql .= ",corporate_customer.bank3_branch_address_line1"; 
        $sql .= ",corporate_customer.bank3_branch_address_line2"; 
        $sql .= ",corporate_customer.bank3_branch_city"; 
        $sql .= ",corporate_customer.applicant_nominee_mandate"; 
        $sql .= ",corporate_customer.applicant_nominee_name"; 
        $sql .= ",corporate_customer.applicant_nominee_dob"; 
        $sql .= ",corporate_customer.applicant_nominee_parent_name"; 
        $sql .= ",corporate_customer.applicant_nominee_relationship"; 
        $sql .= ",corporate_customer.applicant_sip_mandate"; 
        $sql .= ",corporate_customer.applicant_sip_mandate_years"; 
        $sql .= ",corporate_customer.appplicant_sip_mandate_maximum_per_month"; 
        $sql .= ") ";
        $sql .= " VALUES "; 
        $sql .= " (";
        $sql .=  "?" ; 
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
		$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
$sql .= " , ?" ;  
       $sql .= ") ";

	

$return_array['success'] = '0';
$return_array['error'] ='0';
	 /*Prepared statement, sql insert */

	   $mysqli = new mysqli("localhost", "root","", "fundsinn_db");
	   $mysqli2 = new mysqli("localhost", "root","", "fundsinn_db");

		if ($mysqli->connect_errno) {
			$return_array['error'] ="Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		
		$query="SELECT count(*) FROM `corporate_customer` WHERE `applicant_id` like \"".$applicant_id."%\"";
		$genid="0";
		
		if (!($stmt2 = $mysqli2->prepare($query))) {
			$return_array['error2'] = "Prepare failed: (" . $mysqli2->errno . ") " . $mysqli2->error ;
		}
		$stmt2->execute();
		$stmt2->bind_result($genid);
		$stmt2->fetch();
        
		$applicant_id=$applicant_id.$genid;
		
		if (!($stmt = $mysqli->prepare($sql))) {
			$return_array['error'] = "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}

$applicant_id=mb_strtoupper($applicant_id);
$applicant_account_type=mb_strtoupper($applicant_account_type);
$applicant_name=mb_strtoupper($applicant_name);
$applicant_doi=mb_strtoupper($applicant_doi);
$applicant_pan=mb_strtoupper($applicant_pan);

$applicant_contact_name=mb_strtoupper($applicant_contact_name); 
$applicant_contact_designation=mb_strtoupper($applicant_contact_designation); 
$applicant_contact_telephone_residence=mb_strtoupper($applicant_contact_telephone_residence); 
$applicant_contact_telephone_office=mb_strtoupper($applicant_contact_telephone_office); 
$applicant_contact_telephone_mobile=mb_strtoupper($applicant_contact_telephone_mobile); 
$applicant_contact_email=mb_strtoupper($applicant_contact_email); 
$applicant_occupation=mb_strtoupper($applicant_occupation); 
$applicant_status=mb_strtoupper($applicant_status); 
$applicant_tax_status=mb_strtoupper($applicant_tax_status);

$applicant_address_permanant_line1=mb_strtoupper($applicant_address_permanant_line1);
$applicant_address_permanent_line2=mb_strtoupper($applicant_address_permanent_line2);
$applicant_address_permanent_line3=mb_strtoupper($applicant_address_permanent_line3);
$applicant_address_permanent_city=mb_strtoupper($applicant_address_permanent_city);
$applicant_address_permanent_state=mb_strtoupper($applicant_address_permanent_state);
$applicant_address_permanent_pincode=mb_strtoupper($applicant_address_permanent_pincode);
$applicant_address_communication_line1=mb_strtoupper($applicant_address_communication_line1);
$applicant_address_communication_line2=mb_strtoupper($applicant_address_communication_line2);
$applicant_address_communication_line3=mb_strtoupper($applicant_address_communication_line3);
$applicant_address_communication_city=mb_strtoupper($applicant_address_communication_city);
$applicant_address_communication_state=mb_strtoupper($applicant_address_communication_state);
$applicant_address_communication_pincode=mb_strtoupper($applicant_address_communication_pincode);
$applicant_bank1_account_number=mb_strtoupper($applicant_bank1_account_number);
$bank1_account_type=mb_strtoupper($bank1_account_type);
$bank1_ifsc_code=mb_strtoupper($bank1_ifsc_code);
$bank1_micr_code=mb_strtoupper($bank1_micr_code);
$bank1_name=mb_strtoupper($bank1_name);
$bank1_branch_address_line1=mb_strtoupper($bank1_branch_address_line1);
$bank1_branch_address_line2=mb_strtoupper($bank1_branch_address_line2);
$bank1_branch_city=mb_strtoupper($bank1_branch_city);
$applicant_bank2_account_number=mb_strtoupper($applicant_bank2_account_number);
$bank2_account_type=mb_strtoupper($bank2_account_type);
$bank2_ifsc_code=mb_strtoupper($bank2_ifsc_code);
$bank2_micr_code=mb_strtoupper($bank2_micr_code);
$bank2_name=mb_strtoupper($bank2_name);
$bank2_branch_address_line1=mb_strtoupper($bank2_branch_address_line1);
$bank2_branch_address_line2=mb_strtoupper($bank2_branch_address_line2);
$bank2_branch_city=mb_strtoupper($bank2_branch_city);
$applicant_bank3_account_number=mb_strtoupper($applicant_bank3_account_number);
$bank3_account_type=mb_strtoupper($bank3_account_type);
$bank3_ifsc_code=mb_strtoupper($bank3_ifsc_code);
$bank3_micr_code=mb_strtoupper($bank3_micr_code);
$bank3_name=mb_strtoupper($bank3_name);
$bank3_branch_address_line1=mb_strtoupper($bank3_branch_address_line1);
$bank3_branch_address_line2=mb_strtoupper($bank3_branch_address_line2);
$bank3_branch_city=mb_strtoupper($bank3_branch_city);
$applicant_nominee_mandate=mb_strtoupper($applicant_nominee_mandate);
$applicant_nominee_name=mb_strtoupper($applicant_nominee_name);
$applicant_nominee_dob=mb_strtoupper($applicant_nominee_dob);
$applicant_nominee_parent_name=mb_strtoupper($applicant_nominee_parent_name);
$applicant_nominee_relationship=mb_strtoupper($applicant_nominee_relationship);
$applicant_sip_mandate=mb_strtoupper($applicant_sip_mandate);
$applicant_sip_mandate_years=mb_strtoupper($applicant_sip_mandate_years);
$appplicant_sip_mandate_maximum_per_month=mb_strtoupper($appplicant_sip_mandate_maximum_per_month);


		if (!$stmt->bind_param("sssssssiiisssssssssisssssiississssississssississssissssiii",$applicant_id,$applicant_account_type,$applicant_name,$applicant_doi,$applicant_pan,$applicant_contact_name,$applicant_contact_designation,$applicant_contact_telephone_residence,$applicant_contact_telephone_office,$applicant_contact_telephone_mobile,$applicant_contact_email,$applicant_occupation,$applicant_status,$applicant_tax_status,$applicant_address_permanant_line1,$applicant_address_permanent_line2,$applicant_address_permanent_line3,$applicant_address_permanent_city,$applicant_address_permanent_state,$applicant_address_permanent_pincode,$applicant_address_communication_line1,$applicant_address_communication_line2,$applicant_address_communication_line3,$applicant_address_communication_city,$applicant_address_communication_state,$applicant_address_communication_pincode,$applicant_bank1_account_number,$bank1_account_type,$bank1_ifsc_code,$bank1_micr_code,$bank1_name,$bank1_branch_address_line1,$bank1_branch_address_line2,$bank1_branch_city,$applicant_bank2_account_number,$bank2_account_type,$bank2_ifsc_code,$bank2_micr_code,$bank2_name,$bank2_branch_address_line1,$bank2_branch_address_line2,$bank2_branch_city,$applicant_bank3_account_number,$bank3_account_type,$bank3_ifsc_code,$bank3_micr_code,$bank3_name,$bank3_branch_address_line1,$bank3_branch_address_line2,$bank3_branch_city,$applicant_nominee_mandate,$applicant_nominee_name,$applicant_nominee_dob,$applicant_nominee_parent_name,$applicant_nominee_relationship,$applicant_sip_mandate,$applicant_sip_mandate_years,$appplicant_sip_mandate_maximum_per_month)) {			
			$return_array['error'] = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
			$return_array['error'] = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}	

		$stmt2->close();
	$mysqli2->close();
	$stmt->close();
	$mysqli->close();

if($return_array['error'] =='0')
$return_array['success'] = '1';
else
$return_array['success'] = '0';

	
}

header('Content-type: text/json');
echo json_encode($return_array);
die();
?>

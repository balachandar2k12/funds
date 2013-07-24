<?php

function request($param, $default){
    return (isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : $default;
}

function Redirect($Str_Location, $Bln_Replace = 1, $Int_HRC = NULL)
{
        if(!headers_sent())
        {
            header('location: ' . urldecode($Str_Location), $Bln_Replace, $Int_HRC);
            exit;
        }

    exit('<meta http-equiv="refresh" content="0; url=' . urldecode($Str_Location) . '"/>'); # | exit('<script>document.location.href=' . urldecode($Str_Location) . ';</script>');
    return;
}
$email=request("email","");

$ref=@$_SERVER['HTTP_REFERER'];
if($ref)
{
	$pattern="/.*corporate_account_opening.*/";
	$pattern2="/.*NRI_acc_opening.*/";
	$pattern3="/.*signup-landing.*/";
	$mat=0;
	if(preg_match($pattern,$ref))
		$mat=1;
	if(preg_match($pattern2,$ref))
		$mat=1;
	if(preg_match($pattern3,$ref))
		$mat=1;
	if(!$mat)
		Redirect("./signup-landing.html");
}
else
	Redirect("./signup-landing.html");

	
if($email=="")
{
Redirect("./signup-landing.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>FundsInn</title>
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/text.css" />
<link rel="stylesheet" href="../css/960_16_col.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/mailchimp.css">
<link rel="stylesheet" type="text/css" href="../css/sign.up.css">
<link rel="stylesheet" type="text/css" href="../css/structure.css">
<link rel="stylesheet" type="text/css" href="../css/form.css">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,700,500,600,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="../js/fundsinn.js"></script>
<script type="text/javascript" src="../js/individualformval.js"></script>
<style type="text/css">
.er {color:red;}
.su {color:green;}
</style>
<script type="text/javascript">
$(function() {
$("#redirectNRI").click(function(){
		var email;
		email=$("#applicantemail").val();
		if(!email)
		email=$("#applicant2contactemail").val();
		window.location.href='./NRI_acc_opening.php?email="'+email+'"';
	});
	$("#redirectCorp").click(function(){
		var email;
		email=$("#applicantemail").val();
		if(!email)
		email=$("#applicant2contactemail").val();
		window.location.href='./corporate_account_opening.php?email="'+email+'"';
	
	
	});
	});
//form submit ajax option
	function formReset()
	{
		document.getElementById("individualform").reset();
		if($("#applicantpaddrcheck").attr("checked"))
		$('#applicantcommunicationaddress').hide();
	else
		$('#applicantcommunicationaddress').show();
		
	if($("#applicantsip").attr("checked"))
		$('#sipmdetails').hide();
	else
		$('#sipmdetails').show();
		
	if($("#aplicantnomcheckbox").attr("checked"))
		$('#appnomineedetails').hide();
	else
		$('#appnomineedetails').show();	
		
	}

	var eattr;
	function send()
	{ 	
	
							$('#errordis').html("");
							$('#errordis').removeClass("er");
							$('#errordis').removeClass("su");
							for ( var attrname in eattr)
							{
								if(eattr[attrname]!="TRUE")
								{
									if(document.getElementById(attrname))
									{	
										$('#'+attrname).removeClass("error");
									}
								}
							}
		if(acceptagreement())
		{
							
		  // make the AJAX request
    var dataString = $('#individualform').serialize();
    $.ajax({
        type: "POST",
        url: 'individual_db_store.php',
        data: dataString,
        dataType: 'json',
        success: function (data) {
			if(data.success==0)
					if(data.error)
					{	
						var	err=data.error;
						
						if(err.search("Duplicate"))
						{	
							
							$('#errordis').html("<h3>You Pan No is already registered with us</h3>");
							$('#errordis').addClass("er");
							window.location.hash = '#topfundsinn';
					
						}	 
						else
						{
							$('#errordis').html("<h3>connection problem please try agian</h3>");
							$('#errordis').addClass("er");
							window.location.hash = '#topfundsinn';
						}
					}
					else
						{
							eattr=data.attr;
							var tempaddrp="Permanent Address Details<br/>";
							var tempaddrc="Current address Details<br/>";
							var tempaddrb="Bank Details<br/>";
							var tempaddrb2=" Second Bank Details<br/>";
							var tempaddrb3="Third Bank Details<br/>";
							var tempsip="SIP Details <br/>";
							for ( var attrname in eattr)
							{
								if(eattr[attrname]!="TRUE")
								{
									if(document.getElementById(attrname))
									{	
										$('#'+attrname).addClass("error");
										if(document.getElementById('instruct'+attrname))
										   $('#instruct'+attrname).html("<small>"+eattr[attrname]+"</small>");
										 else
											{
												if(!(attrname.search("applicantp")))
													tempaddrp=tempaddrp+eattr[attrname]+"<br/>";
												$('#instructapplicantpaddr').html("<small>"+tempaddrp+"</small><br/>");
												
												if(!(attrname.search("applicantc")))
													tempaddrc=tempaddrc+eattr[attrname]+"<br/>";
												$('#instructapplicantcaddr').html("<small>"+tempaddrc+"</small><br/>");
												
												if(!(attrname.search("bank")))
													tempaddrb=tempaddrb+eattr[attrname]+"<br/>";
												$('#instructbank').html("<small>"+tempaddrb+"</small><br/>");
												
												if(!(attrname.search("bank2")))
													tempaddrb2=tempaddrb2+eattr[attrname]+"<br/>";
												$('#instructbank2').html("<small>"+tempaddrb2+"</small><br/>");
												
												if(!(attrname.search("bank3")))
													tempaddrb3=tempaddrb3+eattr[attrname]+"<br/>";
												$('#instructbank3').html("<small>"+tempaddrb3+"</small><br/>");
												
													if(!(attrname.search("applicantvalid")))
													tempsip=tempsip+eattr[attrname]+"<br/>";
												$('#instructapplicantsip').html("<small>"+tempsip+"</small><br/>");
												
												
											}
									}
								}
							}
						}
			else
				{
							$('#errordis').html("<h3>Form submitted you will be redirected shortly</h3>");
							$('#errordis').addClass("su");
							window.location.hash = '#topfundsinn';
						//	$("#headerMenu").scrollTop();
							
				}
				
		},
        error: function (error) {
			{
					
					$('#errordis').html("<h3>Unable to Process your request please try agian</h3>");
							$('#errordis').addClass("er");
							window.location.hash = '#topfundsinn';
					
					//dump(error);
					
			}
	}
    });
	
	}
	
	}
	function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
  alert(out);
  }
	</script>
</head>
<body>
<!--MAIN WRAPPER-->
<div class="wrapper">
<div id="headerBox">
  <div id="header" class="container_16">
    <div id="headerLeft" class="grid_5">
      <div class="theLogo"><a href="../index.html"><img src="../img/logo.png" alt="FundsInn Logo"></a></div>
    </div>
    <div id="headerMenu" class="grid_5">
      <ul>
        <li><a href="#">INVESTMENTS</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">BLOG</a></li>
      </ul>
    </div>
    <div class="loggingContainer grid_4">
      <ul>
        <li class="grid_2 gridFirst"> <a href="#">SIGN-UP</a></li>
        <li class="grid_2 gridLast"> <a href="#">LOG-IN</a></li>
      </ul>
    </div>
  </div>
</div>
<div id="contentBody" class="container_16 signUpPage">
  <div class="pageContent">
    <div class="contentTitleBox">
      <div class="homeContentTitle titleFix" id="topfundsinn">
        <h3>JOIN FUNDSINN</h3>
      </div>
    </div>
    <div class="serviceContainer container_16">
      <div class="generic_pageTitle">
        <h3>Investment Services Account Opening</h3>
      </div>
      <div id="signUp-Container" class="grid_14 gridFirst"> 
       <!-- woofoo forms -->
        <form id="individualform" name="individualform" class="wufoo leftLabel page"  novalidate method="post" action="javascript:send();">
			<div id="errordis">
			
			</div>
           <div class="formHeaderTitle">
                <h3 id="titleindividual"> Individual</h3>
			</div>
		<ul>
            <li class="notranslate">
              <label class="desc" for="redirectIndividual"> Acount Type <span class="req">*</span> </label>
              <div>
                <input id="redirectIndividual" <?php $pattern3="/.*signup-landing.*/";
													if(!preg_match($pattern3,$ref))
														echo 'checked="checked"';
												
												
												?>data-required="true" tabindex="1" name="account_type" type="radio" value="Individual">&nbsp;Individual&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="redirectNRI" name="account_type" type="radio" tabindex="2" value="NRI">&nbsp;NRI&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="redirectCorp"  name="account_type" type="radio" tabindex="3" value="Corporate">&nbsp;Corporate/HUF&nbsp;&nbsp;&nbsp;&nbsp;
              </div>
              <p class="instruct" id="instructaccount_type"><small>Please select A/C type.</small></p>
            </li>
            <!-- investor_details -->
            <li class="notranslate">
             
              <label class="desc" for="applicant_name"> Name of the applicant <span class="req">*</span> </label>
              <div>
                <input id="applicantname" name="applicant_name" type="text" class="field text medium" value="" maxlength="62" tabindex="4" onChange="alphareq(this.value,'applicantname','instructapplicantname')" />
              </div>
              <p class="instruct" id="instructapplicantname"><small>Please Enter your name as per PAN card </small></p>
            </li>
            <li class="notranslate">
              <label class="desc " for="applicant_father_name"> Father's Name <span class="req">*</span> </label>
              <div>
                <input id="applicantfname" name="applicant_father_name" type="text" class="field text nospin medium" onChange="alphareq(this.value,'applicantfname','instructapplicantfname')" value="" maxlength="54" tabindex="5" onKeyUp="" />
              </div>
              <p class="instruct " id="instructapplicantfname"><small>Please enter your father's name as per PAN card</small></p>
            </li>
            <li class="date eurodate notranslate">
              <label class="desc"> Date of Birth <span class="req">*</span> </label>
              <span>
              <input id="applicantdobdd" name="applicant_dob" type="text" class="field text" value="" size="2" onChange="ddval(this.value,'applicantdobdd','instructapplicantdobdd')" maxlength="2" tabindex="6" />
              <label for="applicant_dobdd">DD</label>
              </span> <span class="symbol">/</span> <span>
              <input id="applicantdobmm" name="applicantdobmm" type="text" class="field text" value="" onChange="mmval(this.value,'applicantdobmm','instructapplicantdobdd')" size="2" maxlength="2" tabindex="7" />
              <label for="applicantdobmm">MM</label>
              </span> <span class="symbol">/</span> <span>
              <input id="applicantdobyyyy" name="applicantdobyyyy" type="text" class="field text" value="" onChange="yyval(this.value,'applicantdobyyyy','instructapplicantdobdd')" size="4" maxlength="4" tabindex="8" />
              <label for="applicantdobyyyy">YYYY</label>
              </span>
              <p class="instruct" id="instructapplicantdobdd"><small>Please Enter your date of birth</small></p>
            </li>
            <li class="notranslate">
              <fieldset>
                <legend class="desc"> Gender <span class="req">*</span> </legend>
             <!--[if lt IE 8]>
							<label class="desc">
							Gender
							<span  class="req">*</span>
							</label>
							<![endif]-->
                <div>
                  <span>
                  <input id="applicantmaleradio" name="applicant_gender" type="radio" class="field radio" value="Male" tabindex="9" checked="checked" />
                  <label class="choice" for="applicantmaleradio" > Male</label>
                  </span> <span>
                  <input id="applicantfemaleradio" name="applicant_gender" type="radio" class="field radio" value="Female" tabindex="10" />
                  <label class="choice" for="applicantfemaleradio" > Female</label>
                  </span> 
				 </div>
              </fieldset>
              <p class="instruct" id="instructapplicantgenderradio"><small>Gender</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" for="applicantpan"> PAN Number <span class="req">*</span> </label>
              <div>
                <input id="applicantpan" class="field text medium" name="applicant_pan" onChange="panval(this.value,'applicantpan','instructapplicantpan')" tabindex="11" required maxlength="10" type="text" value="" />
              </div>
              <p class="instruct" id="instructapplicantpan"><small>Please Enter your PAN card number</small></p>
            </li>
            <li class="notranslate">
              <label class="desc"  for="phone_resi"> Tele Number (Residential) </label>
              <div>
                <input id="applicanttelr" class="field text medium" name="phone_resi" onChange="terval(this.value,'applicanttelr','instructapplicanttelr')" tabindex="12" required  type="tel" maxlength="12" value="" />
              </div>
              <p class="instruct" id="instructapplicanttelr"><small>Please Enter your Residential number</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" for="phone_office"> Tele Number (Office):  </label>
              <div>
                <input id="applicanttelo" class="field text medium" name="phone_office" tabindex="13" onChange="teoval(this.value,'applicanttelo','instructapplicanttelo')" required  type="tel" maxlength="15" value="" />
              </div>
              <p class="instruct" id="instructapplicanttelo"><small>Please Enter your office Number</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" for="mobile"> Moblie Number:  <span class="req">*</span> </label>
              <div>
                <input id="applicanttelm" class="field text medium" name="mobile" tabindex="14" required  onChange="temval(this.value,'applicanttelm','instructapplicanttelm')" type="tel" maxlength="11" value="" />
              </div>
              <p class="instruct" id="instructapplicanttelm"><small>Please Enter your mobile no </br> 9XXXXXXXX9</small></p>
            </li>
			  <li class="notranslate">
              <label class="desc" for="email"> Email address :  <span class="req">*</span> </label>
              <div>
                <input id="applicantemail" class="field text medium" name="email" tabindex="15" required  onChange="emval(this.value,'applicantemail','instructapplicantemail')" maxlength="37" type="email" value=<?php echo $email?> readonly />
              </div>
              <p class="instruct" id="instructapplicantemail"><small>Re sign-up to change your email address</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" id="occupation"> Occupation <span class="req">*</span> </label>
              <div>
                <div class="styled-select">
                  <select  name="occupation" class="field select medium" tabindex="16" onChange="ocval(this.value,'applicantocc','instructapplicantocc')" >
                    <option value="--Select--" selected="selected"> --Select-- </option>
                    <option value="Business">Business</option>
                    <option value="Service">Service</option>
                    <option value="Professional">Professional</option>
                    <option value="Agriculturist">Agriculturist</option>
                    <option value="Retired">Retired</option>
                    <option value="Housewife">Housewife</option>
                    <option value="Student">Student</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
              </div>
              <p class="instruct" id="instructapplicantocc"><small>Please select your Occupation</small></p>
            </li>
           </ul>
	   
            <!--FORM 2-->
              <div class="formHeaderTitle">
                <h3 > Address Information</h3>
			</div>
			
			<ul>	
            <li class="complex notranslate">
              <label class="desc"> Permanent Address <span class="req">*</span> </label>
              <div> <label for="applicantpaddr1">Address Line 1</label><span class="full addr1">
                <input id="applicantpaddr1" name="perm_addr1" type="text" class="field text addr" onChange="addrval(this.value,'applicantpaddr1','instructapplicantpaddr')" value="" tabindex="17" maxlength="39" required />
                
                </span>  <label for="applicantpaddr2">Address Line 2</label><span class="full addr2">
                <input id="applicantpaddr2" name="perm_addr2" type="text" class="field text addr" value="" tabindex="18" maxlength="39" />
               
                </span>  <label for="applicantpaddr3">Address Line 3</label><span class="full addr2">
                <input id="applicantpaddr3" name="perm_paddr3" type="text" class="field text addr" value="" tabindex="18" maxlength="39" />
               
                </span> <label for="applicantpcity">City</label> <span class="left city">
                <input id="applicantpcity" name="perm_city" type="text" class="field text addr" value="" tabindex="19" maxlength="27" onChange="cityval(this.value,'applicantpcity','instructapplicantpaddr')" required />
               
                </span>  <label for="applicantpstate">State</label><span class="right state">
                <input id="applicantpstate" name="perm_state" type="text" class="field text addr" value="" tabindex="20" maxlength="20" onChange="stateval(this.value,'applicantpstate','instructapplicantpaddr')" required />
               
                </span><label for="perm_zip">Postal / Zip Code</label> <span class="left zip">
                <input id="applicantpzip" name="perm_zip" type="text" class="field text addr" value="" maxlength="6" tabindex="21" onChange="pinval(this.value,'applicantpzip','instructapplicantpaddr')" required />
                
                </span> 
                </div>
             <p class="complex instruct" id="instructapplicantpaddr"><small>Please enter your address As per your permanent address proof</small></p>
            </li>
           </ul>
		   <ul>
		      <li class="complex notranslate">
			 <label class="desc" for="applicantpaddrcheck">  <input type="checkbox" id="applicantpaddrcheck" name="applicantpaddrcheck" value="same" onChange="javascript:$('#applicantcommunicationaddress').toggle();"> &nbsp; Same Address for communication</label>
			<p class="complex instruct" id="instructapplicantpaddrcheck"><small>Addres for communication</small></p>
			</li>
		   </ul>
		   
		   <ul id="applicantcommunicationaddress" >
		    <li class="complex notranslate">
              <label class="desc" > Communication Address <span class="req">*</span> </label>
              <div> <label for="applicantcaddr1">Address Line 1</label><span class="full addr1">
                <input id="applicantcaddr1" name="temp_addr1" type="text" class="field text addr" value="" tabindex="22" onChange="addrval(this.value,'applicantcaddr1','instructapplicantcaddr')" maxlength="39" required />
                
                </span>  <label for="applicantcaddr2">Address Line 2</label><span class="full addr2">
                <input id="applicantcaddr2" name="temp_addr2" type="text" class="field text addr" value="" tabindex="23"  maxlength="39" />
               
                </span> <label for="applicantcaddr3">Address Line 3</label><span class="full addr2">
                <input id="applicantcaddr3" name="temp_addr3" type="text" class="field text addr" value="" tabindex="23"  maxlength="39" />
               
                </span><label for="applicantccity">City</label> <span class="left city">
                <input id="applicantccity" name="temp_city" type="text" class="field text addr" value="" tabindex="24" onChange="cityval(this.value,'applicantccity','instructapplicantcaddr')" maxlength="27" required />
               
                </span>  <label for="applicantcstate">State</label><span class="right state">
                <input id="applicantcstate" name="temp_state" type="text" class="field text addr" value="" tabindex="25" onChange="stateval(this.value,'applicantcstate','instructapplicantcaddr')"  maxlength="20" required />
               
                </span><label for="applicantczip">Postal / Zip Code</label> <span class="left zip">
                <input id="applicantczip" name="temp_zip" type="text" class="field text addr" value="" maxlength="6" onChange="pinval(this.value,'applicantczip','instructapplicantcaddr')"  tabindex="26" required />
                </span> 
                </div>
             <p class="complex instruct" id="instructapplicantcaddr"><small>Please enter your address As per your communication address proof</small></p>
            </li>
			</ul>
		   
		   	
		  <diV id="Addinvestorsblock" >
				<div id="investor2" hidden>
					<div class="formHeaderTitle">
					<h3> Additional Investor Details</h3>
					</div>
					<ul>
				<li class="notranslate">
				<label class="desc" for="applicant2name"> Name of the second applicant <span class="req">*</span> </label>
				<div>
                <input id="applicant2name" name="applicant2_name" type="text" class="field text medium" value="" maxlength="62" tabindex="27" onKeyUp="" required autofocus />
              </div>
              <p class="instruct" id="instructapplicant2name"><small>Please Enter your second applicant's name</small></p>
				</li>
				
				 <li class="notranslate">
              <label class="desc" for="applicant2pan"> second applicant PAN Number <span class="req">*</span> </label>
             <div>
                <input id="applicant2pan" class="field text medium" name="applicant2_pan" tabindex="28" required  type="text" value="" />
              </div>
				<p class="instruct" id="instructapplicant2pan"><small>Please Enter second Applicant's PAN card NO</small></p>
				</li>
				</ul>
				</div>

				<ul id="investor3" hidden>
				
				<li class="notranslate">
				<label class="desc" for="applicant3name"> Name of the Third applicant <span class="req">*</span> </label>
              <div>
                <input id="applicant3name" name="applicant3_name" type="text" class="field text medium" value="" maxlength="62" tabindex="29" onKeyUp="" required autofocus />
              </div>
              <p class="instruct" id="instructapplicant3name"><small>Please Enter your Third applicant's name</small></p>
				</li>
				
				 <li class="notranslate">
              <label class="desc" for="applicant3pan"> Third applicant PAN Number <span class="req">*</span> </label>
              <div>
                <input id="applicant3pan" class="field text medium" name="applicant3_pan" tabindex="30" required  type="text" value="" />
              </div>
              <p class="instruct" id="instructapplicant3pan"><small>Please Enter your second applicant's PAN card number</small></p>
				</li>
				</ul>
			</div>
		   
	
		      <script type="text/javascript">
		   
		   function addinvestor(val){
		   
				if(val==2)
				{
					$('#investor2').show();
					$('#addmoreinvestorlink').attr('href','javascript:addinvestor(3);');
				}
				
				if(val==3)
				{
					$('#investor3').show();
					$('#addinvestorsbutton').empty();
				}
			}
		   </script>
		   
		   <ul id="addinvestorsbutton">
			<li id="invesorbutton" class="buttons">
				<a id="addmoreinvestorlink" class="btTxt submit fundsInn-btn" href="javascript:addinvestor(2);" >Add More Investors</a>
				</li>
		   </ul>
		   
		   
		   
		   
		   
			 <div class="formHeaderTitle">
                <h3 > Bank Account Details</h3>
			</div>
			<ul>
            <li class="complex notranslate">
              <div id="bank_details"> <span class="full addr1">
                 <label for="bankname">Name of the Bank</label><input id="bankname" maxlength="33"  name="bankname" type="text" class="field text addr" value="" onChange="bankval(this.value,'bankname','instructbank')"  tabindex="31" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bankacctypes" name="bank_acc_type" value="saving" tabindex="32"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bankacctypec" name="bank_acc_type" value="current" tabindex="33"/>&nbsp;Current
				</div>
				<span class="full addr2">
         </span> <label for="bank_micr">MICR Code</label><span class="left zip">
                <input id="bankmicr" name="bankmicr" type="text" class="field text addr" value="" onChange="micrval(this.value,'bankmicr','instructbank')" maxlength="9" tabindex="38"  />
                
               
                </span> <label for="bankifsc">IFSC Code</label><span class="left zip">
                <input id="bankifsc" name="bankifsc" type="text" class="field text addr" value="" onChange="ifscval(this.value,'bankifsc','instructbank')" maxlength="11"  tabindex="39"  />       
				</span> <label for="bankaccno">Account Number</label><span class="left city">
                <input id="bankaccno" name="bank_acc_no" type="text" class="field text addr" value="" tabindex="34" onChange="accval(this.value,'bankaccno','instructbank')" maxlength="20" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bankaddr1">Line 1</label><span class="left zip">
                <input id="bankaddr1" name="bank_addr1" type="text" class="field text addr" value="" maxlength="39" tabindex="35" onChange="bankaddrval(this.value,'bankaddr1','instructbank')" required />
                
                </span> <label for="bankaddr2">Line 2	</label><span class="left zip">
                <input id="bankaddr2" name="bank_addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="36" required />
                
                
                </span> <label for="bankcity">Branch City</label><span class="left zip">
                <input id="bankcity" name="bank_city" type="text" class="field text addr" value="" maxlength="27" onChange="cityval(this.value,'bankcity','instructbank')" tabindex="37"  />
                
                
                
               </span>
            </div>
			  <p class="complex instruct" id="instructbank"><small>Please Enter your Bank details </small></p>
            </li>
		</ul>
			 
			 
			 
			 
			  <diV id="Addbankdetailsblock">
				<div id="bankdetails2" hidden>
					<div class="formHeaderTitle">
					<h3> Additional Bank Details</h3>
					</div>
					<input type='hidden' value='bank2false' name='bank2stat' id="bank2stat">
					<input type='hidden' value='bank3false' name='bank3stat' id="bank3stat">
					
					<ul>
					
            <li class="complex notranslate">
              <div id="bank2details"> <span class="full addr1">
                 <label for="bank2name">Name of the Second Bank</label><input id="bank2name" maxlength="33"  name="bank2name" onChange="bankval(this.value,'bank2name','instructbank2')"  type="text" class="field text addr" value="" tabindex="40" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bank2acctypes" name="bank2acctype" value="saving" tabindex="41"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bank2acctypec" name="bank2acctype" value="current" tabindex="42"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bank2accno">Account Number</label><span class="left city">
                <input id="bank2accno" name="bank2accno" type="text" class="field text addr" value="" maxlength="20"  onChange="accval(this.value,'bank2accno','instructbank2')" tabindex="43" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bank2addr1">Line 1</label><span class="left zip">
                <input id="bank2addr1" name="bank2addr1" type="text" class="field text addr" value="" maxlength="39" onChange="bankaddrval(this.value,'bank2addr1','instructbank2')" tabindex="44" required />
                
                </span> <label for="bank2addr2">Line 2	</label><span class="left zip">
                <input id="bank2addr2" name="bank2addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="45" required />
                
                
                </span> <label for="bank2city">Branch City</label><span class="left zip">
                <input id="bank2city" name="bank2city" type="text" class="field text addr" value="" maxlength="27" onChange="cityval(this.value,'bank2city','instructbank2')" tabindex="46"  />
                
                
                </span> <label for="bank2micr">MICR Code</label><span class="left zip">
                <input id="bank2micr" name="bank2micr" type="text" class="field text addr" value="" maxlength="9" onChange="micrval(this.value,'bank2micr','instructbank2')" tabindex="47"  />
                
               
                </span> <label for="bank2ifsc">IFSC Code</label><span class="left zip">
                <input id="bank2ifsc" name="bank2ifsc" type="text" class="field text addr" value="" maxlength="11" onChange="ifscval(this.value,'bank2ifsc','instructbank2')" tabindex="48"  />
               </span>
            </div>
			  <p class="complex instruct" id="instructbank2"><small>Please Enter your Second Bank details </small></p>
            </li>
		</ul>
					
					
				</div>
				
			<div id="bankdetails3" hidden>
			
				<ul>
            <li class="complex notranslate">
              <div id="bank3details"> <span class="full addr1">
                 <label for="bank3name">Name of the Third Bank</label><input id="bank3name" name="bank3name" maxlength="33"  onChange="bankval(this.value,'bank3name','instructbank3')"  type="text" class="field text addr" value="" tabindex="49" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bank3acctypes" name="bank3acctype" value="saving" tabindex="50"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bank3acctypec" name="bank3acctype" value="current" tabindex="51"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bank3accno">Account Number</label><span class="left city">
                <input id="bank3accno" name="bank3accno" type="text" class="field text addr" maxlength="20"  onChange="accval(this.value,'bank3accno','instructbank3')" value="" tabindex="52" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bank3addr1">Line 1</label><span class="left zip">
                <input id="bank3addr1" name="bank3addr1" type="text" class="field text addr" value="" onChange="bankaddrval(this.value,'bank3addr1','instructbank3')" maxlength="39" tabindex="53" required />
                
                </span> <label for="bank3addr2">Line 2	</label><span class="left zip">
                <input id="bank3addr2" name="bank3addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="54" required />
                
                
                </span> <label for="bank3city">Branch City</label><span class="left zip">
                <input id="bank3city" name="bank3city" type="text" class="field text addr" value="" onChange="cityval(this.value,'bank3city','instructbank3')" maxlength="27" tabindex="55"  />
                
                
                </span> <label for="bank3micr">MICR Code</label><span class="left zip">
                <input id="bank3micr" name="bank3micr" type="text" class="field text addr" value="" maxlength="9" onChange="micrval(this.value,'bank3micr','instructbank3')" tabindex="56"  />
                
               
                </span> <label for="bank3ifsc">IFSC Code</label><span class="left zip">
                <input id="bank3ifsc" name="bank3ifsc" type="text" class="field text addr" value="" maxlength="11" onChange="ifscval(this.value,'bank3ifsc','instructbank3')" tabindex="57"  />
               </span>
            </div>
			  <p class="complex instruct" id="instructbank3"><small>Please Enter your Third Bank details </small></p>
            </li>
		</ul>
		
			</div>			
				
				
			</div>
			 
			    <script type="text/javascript">
		   
		   function addbanksdetails(val){
		   
				if(val==2)
				{
					$('#bankdetails2').show();
					$('#addmorebankdetailslink').attr('href','javascript:addbanksdetails(3);');
					$('#bank2stat').attr('value','bank2true');
				}
				
				if(val==3)
				{
					$('#bankdetails3').show();
					$('#addbankdetailsbutton').empty();
					$('#bank3stat').attr('value','bank3true');
				}
			}
		   </script>
		   
		   <ul id="addbankdetailsbutton">
			<li id="bankdetailsbutton" class="buttons">
				<a id="addmorebankdetailslink" class="btTxt submit fundsInn-btn" href="javascript:addbanksdetails(2);" >Add More Banks</a>
				</li>
		   </ul>
		   
	  <ul>
            <li class="notranslate">
			<span class="left zip">
                
               <label>SIP Mandate</label>
                </span> <label for="applicantsip"><input name="applicantsip" id="applicantsip" onchange="javascript:$('#sipmdetails').toggle();$('#instructapplicantsip').html('<small>SIP Details</small><br/>');" value="sipmandatefalse" type="checkbox" tabindex="58">
			
                &nbsp;&nbsp;I Do not wish to make SIP mandate</label>
					
                
				<div id="sipmdetails">
                <span class="left zip">
                <label for="applicantvalidyfield" id="applicantvalidy" >Number of years validity</label>
				</span>
				 <div class="styled-select">
                  <select class="field select medium" id="applicantvalidyfield" onChange="vyval(this.value,'applicantvalidy','instructapplicantsip')"   name="applicantvalidy" tabindex="59">
				<option value="--Select--" selected="selected"> --Select-- </option>                  
				  <option value="10">10</option>
                  	<option value="11">11</option>
                  	<option value="12">12</option>
                    <option value="13">13</option>
                  	<option value="14">14</option>
                  	<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
                  </select>
                  </div>
				  <span class="left zip">
                <label for="applicantvalidmafield" id="applicantvalidma" >Maximum Per month mandate amount</label>
				 </span>
				  <div class="styled-select">
                  <select id="applicantvalidmafield"  onChange="maval(this.value,'applicantvalidma','instructapplicantsip')" class="field select medium" name="applicantvalidma" tabindex="60">
                  	<option value="--Select--" selected="selected"> --Select-- </option>
					<option value="10">5000</option>
                  	<option value="11">10000</option>
                  	<option value="12">25000</option>
                    <option value="13">50000</option>
                  	<option value="14">75000</option>
                  	<option value="15">100000 </option>
                  </select>
				  </div>
				  </div>
				   <p class="complex instruct" id="instructapplicantsip"><small>SIP details here!</small></p>
				  
			</li>
			
			</ul>
		   
		 <div class="formHeaderTitle">
                <h3> Nominee Information</h3>
			</div>
			<ul>
				  
            <li class="complex notranslate">
             <label for="aplicantnomcheckbox"> <input type="checkbox" name="aplicantnomcheckbox" id="aplicantnomcheckbox" onchange="javascript:$('#appnomineedetails').toggle();" value="appnomineefalse" tabindex="61"> &nbsp;&nbsp;I Do not wish to make nomination<br/><br/></label> 
			  
			<p class="instruct" id="instructnomineedetailcheckbox"><small>Nominee details</small></p>	
			</li>			
			</ul>
			
			<div id="appnomineedetails">
			<ul>
			<li>
			  <span class="left city">
				<label for="appnomname">Nominee Name</label> <input id="appnomname" name="nomineename" type="text" class="field text addr" onChange="appnominval(this.value,'appnomname','instructappnomname')" value="" tabindex="62" maxlength="33" />
                
                </span> 
                <p class="instruct" id="instructappnomname"><small>About Nominee</small></p>
                <li class="date eurodate notranslate      ">
              <label class="desc"> Date Of Birth <span class="req">*</span> </label>
              <span>
              <input id="appnomdobd" name="nomineedobd" type="text" class="field text" onChange="ddval(this.value,'appnomdobd','instructappnomdobd')" value="" size="2" maxlength="2" tabindex="63" required />
              <label for="appnomdobd">DD</label>
              </span> <span class="symbol">/</span> <span>
              <input id="appnomdobm" name="nomineedobm" type="text" class="field text" onChange="mmval(this.value,'appnomdobm','instructappnomdobd')" value="" size="2" maxlength="2" tabindex="64" required />
              <label for="appnomdobm">MM</label>
              </span> <span class="symbol">/</span> <span>
              <input id="appnomdoby" name="nomineedoby" type="text" class="field text" onChange="yyval(this.value,'appnomdoby','instructappnomdobd')" value="" size="4" maxlength="4" tabindex="65" required />
              <label for="appnomdoby">YYYY</label>
              </span>
              <p class="instruct" id="instructappnomdobd"><small>Your date of birth</small></p>
            </li>
            <li>
                <span class="left zip"><label for="appnompname">Name Of Parent (In Case of Minor)	</label>
                <input id="appnompname" name="nominee_parent_name" type="text" class="field text addr" onChange="nomempval(this.value,'appnompname','instructappnompname')" value="" maxlength="30" tabindex="66" />
                
                </span> 
                <p class="instruct" id="instructappnompname"><small>Name Of Parent (In Case of Minor)</small></p>
                </li>
              
                
            <li>
                <span class="left zip"><label for="appnomrel">Relationship	</label>
                <input id="appnomrel" name="nominee_relationship" type="text" class="field text addr" onChange="nomemrval(this.value,'appnomrel','instructappnomrel')" value="" maxlength="16" tabindex="67" />
                
                </span> 
                <p class="instruct" id="instructappnomrel"><small>Relationship</small></p>
                </li>
				
			</ul>
		   
		   </div>
		   <ul>
			<li>
                <span class="left zip">
            <label for="agreementaccept" id="agreementacceptl"><input tabindex="68" id="agreementaccept" name="agreementaccept" value="agree" type="checkbox">&nbsp;&nbsp;I Have read the terms and Conditions Before investing </label>
            </span><p class="instruct" id="instructagreementaccept"><small>Accept before submitting</small></p></li>
            <li class="buttons ">
              <div>
			     <script type="text/javascript">
		   
		   function acceptagreement(){
				
				if($("#agreementaccept").attr("checked"))
				{	
					$("#agreementacceptl").removeClass("error");
					return true;
				}else
				{
					$("#agreementacceptl").addClass("error");
					return false;
				}
			}
		   </script>
                <input id="saveForm"  name="saveForm" class="btTxt submit fundsInn-btn" type="submit" tabindex="69" value="Submit"/>
                <input id="clearForm" onclick="formReset()" name="clearForm" class="btTxt submit fundsInn-btn" type="button" tabindex="70" value="Clear"/>
              </div>
            </li>
           
          </ul>
        </form>
        
        
        <!-- WUFOO FORMS --> 

        
      </div>
    </div>
  </div>
</div>
<!--MAIN WRAPPER-->
<div class="footer">
  <div class="footerBox container_16 ">
    <div class="footerCol grid_3 gridFirst">
      <ul>
        <li class="footerTitle">THE COMPANY</li>
        <li><a href="#">Investments</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Our Team</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
    <div class="footerCol grid_3 ">
      <ul>
        <li class="footerTitle">HELP</li>
        <li><a href="#">FAQ's</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Support</a></li>
      </ul>
    </div>
    <div class="footer-Midbox grid_5">
      <ul>
        <li class="footerTitle">SUBSCRIBE TO OUR NEWSLETTER</li>
      </ul>
      
      <!-- Begin MailChimp Signup Form -->
      <div id="mc_embed_signup">
        <form action="http://basilapparel.us6.list-manage2.com/subscribe/post?u=a853f89dd76f2587cf7e299a8&amp;id=4c947b8c4d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <div class="mc-field-group">
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div id="mce-responses">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div>
          <div class="">
            <input type="submit" value="Sign-Up" name="subscribe" id="mc-embedded-subscribe" class="button">
          </div>
        </form>
      </div>
      
      <!--End mc_embed_signup-->
      <div class="socialIcons grid_5 gridFirst">
        <ul>
          <li><a href="#"><img src="../img/twitter.png" alt=""></a></li>
          <li><a href="#"><img src="../img/fbk.png" alt=""></a></li>
          <li><a href="#"><img src="../img/linkedin.png" alt=""></a></li>
        </ul>
      </div>
    </div>
    <div class="footerCopy grid_5 gridLast">
      <div class="footerLogo"><img src="../img/logo-white.png" alt="Logo"></div>
      <div class="footer-Rights">
        <p>&copy; 2013. All Rights Reserved<br>
          *Mutual Fund investments are subject to market risks,
          Read offer documents carefully.<br>
          ARN - 86384</p>
      </div>
    </div>
  </div>
</div>
</div>

</body>
</html>
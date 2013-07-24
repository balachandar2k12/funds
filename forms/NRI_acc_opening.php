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
$email="";
$ref=@$_SERVER['HTTP_REFERER'];
if($ref)
{
	$pattern="/.*corporate_account_opening.*/";
	$pattern2="/.*Individual_acc_opening.*/";
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


$email=request("email","");
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
	$("#redirectIndividual").click(function(){
		
		var email;
		email=$("#applicantemail").val();
		if(!email)
		email=$("#applicant2contactemail").val();
		window.location.href='./Individual_acc_opening.php?email="'+email+'"';
	
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
		document.getElementById("nriform").reset();
				
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
    var dataString = $('#nriform').serialize();
    $.ajax({
        type: "POST",
        url: 'nri_db_store.php',
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
												if(!(attrname.search("applicanto")))
													tempaddrp=tempaddrp+eattr[attrname]+"<br/>";
												$('#instructapplicantoaddr').html("<small>"+tempaddrp+"</small><br/>");
												
												if(!(attrname.search("applicanti")))
													tempaddrc=tempaddrc+eattr[attrname]+"<br/>";
												$('#instructapplicantiaddr').html("<small>"+tempaddrc+"</small><br/>");
												
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
							
				}
					//dump(data.attr);
					//dump(data);
				
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
        <form id="nriform" name="nriform" class="wufoo leftLabel page"  novalidate method="post" action="javascript:send();">
			<div id="errordis">
			
			</div>
           <div class="formHeaderTitle">
                <h3 id="titleindividual"> NRI</h3>
			</div>
		<ul>
            <li class="notranslate">
              <label class="desc" for="redirectIndividual"> Acount Type <span class="req">*</span> </label>
              <div>
                <input id="redirectIndividual"   tabindex="1" name="account_type" type="radio" value="Individual">&nbsp;Individual&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="redirectNRI"   data-required="true" checked="checked" name="account_type" type="radio" tabindex="2" value="NRI">&nbsp;NRI&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="redirectCorp"  name="account_type" type="radio" tabindex="3" value="Corporate">&nbsp;Corporate/HUF&nbsp;&nbsp;&nbsp;&nbsp;
              </div>
              <p class="instruct" id="instructaccount_type"><small>Please select A/C type.</small></p>
            </li>
            <!-- investor_details -->
            <li class="notranslate">
             
              <label class="desc" for="applicantname"> Name of the applicant <span class="req">*</span> </label>
              <div>
                <input id="applicantname" name="applicantname" type="text" class="field text medium" value="" maxlength="62" tabindex="4" onChange="alphareq(this.value,'applicantname','instructapplicantname')" />
              </div>
              <p class="instruct" id="instructapplicantname"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
            </li>
            <li class="notranslate">
              <label class="desc " for="applicantfname"> Father's Name <span class="req">*</span> </label>
              <div>
                <input id="applicantfname" name="applicantfname" type="text" class="field text nospin medium" onChange="alphareq(this.value,'applicantfname','instructapplicantfname')" value="" maxlength="54" tabindex="5" onKeyUp="" />
              </div>
              <p class="instruct " id="instructapplicantfname"><small>Only letters, Maximum Only 54 Characters all in CAPS</small></p>
            </li>
            <li class="date eurodate notranslate">
              <label class="desc"> Date of Birth <span class="req">*</span> </label>
              <span>
              <input id="applicantdobdd" name="applicantdobdd" type="text" class="field text" value="" size="2" onChange="ddval(this.value,'applicantdobdd','instructapplicantdobdd')" maxlength="2" tabindex="6" />
              <label for="applicantdobdd">DD</label>
              </span> <span class="symbol">/</span> <span>
              <input id="applicantdobmm" name="applicantdobmm" type="text" class="field text" value="" onChange="mmval(this.value,'applicantdobmm','instructapplicantdobdd')" size="2" maxlength="2" tabindex="7" />
              <label for="applicantdobmm">MM</label>
              </span> <span class="symbol">/</span> <span>
              <input id="applicantdobyyyy" name="applicantdobyyyy" type="text" class="field text" value="" onChange="yyval(this.value,'applicantdobyyyy','instructapplicantdobdd')" size="4" maxlength="4" tabindex="8" />
              <label for="applicantdobyyyy">YYYY</label>
              </span>
              <p class="instruct" id="instructapplicantdobdd"><small>Enter date of birth</small></p>
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
                  <input id="applicantmaleradio" name="applicantgenderradio" type="radio" class="field radio" value="Male" tabindex="9" checked="checked" />
                  <label class="choice" for="applicantmaleradio" > Male</label>
                  </span> <span>
                  <input id="applicantfemaleradio" name="applicantgenderradio" type="radio" class="field radio" value="Female" tabindex="10" />
                  <label class="choice" for="applicantfemaleradio" > Female</label>
                  </span> 
				 </div>
              </fieldset>
              <p class="instruct" id="instructapplicantgenderradio"><small>Gender</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" for="applicantpan"> PAN Number <span class="req">*</span> </label>
              <div>
                <input id="applicantpan" class="field text medium" name="applicantpan" onChange="panval(this.value,'applicantpan','instructapplicantpan')" tabindex="11" required maxlength="10" type="text" value="" />
              </div>
              <p class="instruct" id="instructapplicantpan"><small>Your pan number</small></p>
            </li>
            <li class="notranslate">
              <label class="desc"  for="applicanttelr"> Tele Number (Residential) </label>
              <div>
                <input id="applicanttelr" class="field text medium" name="applicanttelr" onChange="terval(this.value,'applicanttelr','instructapplicanttelr')" tabindex="12" required  type="tel" maxlength="12" value="" />
              </div>
              <p class="instruct" id="instructapplicanttelr"><small>Only Number 10 Digits</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" for="applicanttelo"> Tele Number (Office):  </label>
              <div>
                <input id="applicanttelo" class="field text medium" name="applicanttelo" tabindex="13" onChange="teoval(this.value,'applicanttelo','instructapplicanttelo')" required  type="tel" maxlength="15" value="" />
              </div>
              <p class="instruct" id="instructapplicanttelo"><small>Only Number 10 Digits</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" for="applicanttelm"> Moblie Number:  <span class="req">*</span> </label>
              <div>
                <input id="applicanttelm" class="field text medium" name="applicanttelm" tabindex="14" required  onChange="temval(this.value,'applicanttelm','instructapplicanttelm')" type="tel" maxlength="11" value="" />
              </div>
              <p class="instruct" id="instructapplicanttelm"><small>+91 (only ten Digits Number)</small></p>
            </li>
			  <li class="notranslate">
              <label class="desc" for="applicantemail"> Email address :  <span class="req">*</span> </label>
              <div>
                <input id="applicantemail" value=<?php echo $email?> class="field text medium" name="applicantemail" tabindex="14" required  onChange="emval(this.value,'applicantemail','instructapplicantemail')" maxlength="37" type="email" readonly />
              </div>
              <p class="instruct" id="instructapplicantemail"><small>Enter your valid email address</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" id="applicantocc"> Occupation <span class="req">*</span> </label>
              <div>
                <div class="styled-select">
                  <select  name="applicantocc" class="field select medium" tabindex="15" onChange="ocval(this.value,'applicantocc','instructapplicantocc')" >
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
              <p class="instruct" id="instructapplicantocc"><small>Your occupation</small></p>
            </li>
			       
				   <li class="notranslate">
              <label class="desc" id="applicanttaxstatus">Tax Status <span class="req">*</span> </label>
              <div>
                <div class="styled-select">
                  <select  name="applicanttaxstatus" class="field select medium" onChange="statusval(this.value,'applicanttaxstatus','instructapplicanttaxstatus')" >
                    <option value="--Select--" selected="selected"> --Select-- </option>
                <option value="Business">Bank/ Financial Institutuion</option>
                    <option value="Service">Sole Proprietorship</option>
                    <option value="Professional">NRI- Non Repatriable (NRO)</option>
                    <option value="Agriculturist">NRI- Repatriable (NRE)</option>
                    <option value="Retired">Overseas Corporate Body</option>
                    <option value="Housewife">Foreign Institutional Investor</option>
                    <option value="Student">HUF</option>
                    <option value="Others">Provident Fund/EPF</option>
                    <option value="Others">Superammuation Fund</option>
                    <option value="Others">Gratuity Fund</option>
                    <option value="Others">Pension Fund</option>
                    <option value="Others">Company</option>
                    <option value="Others">AOP/BOI</option>
                    <option value="Others">Partnership Firm</option>
                    <option value="Others">Body Corporate</option>
                    <option value="Others">Trust</option>
                    <option value="Others">Society</option>
				</select>
                </div>
              </div>
              <p class="instruct" id="instructapplicanttaxstatus"><small>Your Tax Status</small></p>
            </li>
			
			  <li class="notranslate">
              <label class="desc" id="applicantnat">Nationality <span class="req">*</span> </label>
              <div>
                <div class="styled-select">
                  <select  name="applicantnat" class="field select medium" onChange="natval(this.value,'applicantnat','instructapplicantnat')" >
                    <option value="--Select--" selected="selected"> --Select-- </option>      
<option value="--">none</option>
<option value="AF">Afghanistan</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia and Herzegowina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, the Democratic Republic of the</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Cote d'Ivoire</option>
<option value="HR">Croatia (Hrvatska)</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="TP">East Timor</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="FX">France, Metropolitan</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard and Mc Donald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran (Islamic Republic of)</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People's Republic of</option>
<option value="KR">Korea, Republic of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People's Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libyan Arab Jamahiriya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macau</option>
<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States of</option>
<option value="MD">Moldova, Republic of</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="AN">Netherlands Antilles</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Reunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint LUCIA</option>
<option value="VC">Saint Vincent and the Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia (Slovak Republic)</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and the South Sandwich Islands</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SH">St. Helena</option>
<option value="PM">St. Pierre and Miquelon</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen Islands</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TH">Thailand</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands (British)</option>
<option value="VI">Virgin Islands (U.S.)</option>
<option value="WF">Wallis and Futuna Islands</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="YU">Yugoslavia</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
				</select>
                </div>
              </div>
              <p class="instruct" id="instructapplicantnat"><small>Your Tax Status</small></p>
            </li>
			
           </ul>
	   
            <!--FORM 2-->
              <div class="formHeaderTitle">
                <h3 > Address Information</h3>
			</div>
			
			<ul>	
            <li class="complex notranslate">
              <label class="desc"> Over Seas Address <span class="req">*</span> </label>
              <div> <label for="applicantoaddr1">Address Line 1</label><span class="full addr1">
                <input id="applicantoaddr1" name="applicantoaddr1" type="text" class="field text addr" onChange="addrval(this.value,'applicantoaddr1','instructapplicantoaddr')" value="" tabindex="16" maxlength="39" required />
                
                </span>  <label for="applicantoaddr2">Address Line 2</label><span class="full addr2">
                <input id="applicantoaddr2" name="applicantoaddr2" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
               
                </span> <label for="applicantoaddr3">Address Line 3</label><span class="full addr2">
                <input id="applicantoaddr3" name="applicantoaddr3" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
               
                </span><label for="applicantocity">City</label> <span class="left city">
                <input id="applicantocity" name="applicantocity" type="text" class="field text addr" value="" tabindex="18" maxlength="27" onChange="cityval(this.value,'applicantocity','instructapplicantoaddr')" required />
               
                </span>  <label for="applicantostate">State</label><span class="right state">
                <input id="applicantostate" name="applicantostate" type="text" class="field text addr" value="" tabindex="19" maxlength="20" onChange="stateval(this.value,'applicantostate','instructapplicantoaddr')" required />
               
                </span> 
				  <label class="desc" id="applicantocou">Country <span class="req">*</span> </label>
             
			  <div>
                <div class="styled-select">
				 
                  <select  name="applicantocou" class="field select medium" onChange="ocuoval(this.value,'applicantocou','instructapplicantoaddr')" >
                    <option value="--Select--" selected="selected"> --Select-- </option>      
<option value="--">none</option>
<option value="AF">Afghanistan</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia and Herzegowina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, the Democratic Republic of the</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Cote d'Ivoire</option>
<option value="HR">Croatia (Hrvatska)</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="TP">East Timor</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="FX">France, Metropolitan</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard and Mc Donald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran (Islamic Republic of)</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People's Republic of</option>
<option value="KR">Korea, Republic of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People's Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libyan Arab Jamahiriya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macau</option>
<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States of</option>
<option value="MD">Moldova, Republic of</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="AN">Netherlands Antilles</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Reunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint LUCIA</option>
<option value="VC">Saint Vincent and the Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia (Slovak Republic)</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and the South Sandwich Islands</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SH">St. Helena</option>
<option value="PM">St. Pierre and Miquelon</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen Islands</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TH">Thailand</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">United States</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands (British)</option>
<option value="VI">Virgin Islands (U.S.)</option>
<option value="WF">Wallis and Futuna Islands</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="YU">Yugoslavia</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>  
				</select>
				
                </div>
              </div>
			 
			 <span>  </span><label for="applicantozip">Postal / Zip Code</label> <span class="left zip">
                <input id="applicantozip" name="applicantozip" type="text" class="field text addr" value="" maxlength="6" tabindex="20" onChange="pinval(this.value,'applicantozip','instructapplicantoaddr')" required />
                
                </span>
                </div>
             <p class="complex instruct" id="instructapplicantoaddr"><small>Address here!</small></p>
            </li>
			
			
			
           </ul>
		  
		   	
			<ul>	
            <li class="complex notranslate">
              <label class="desc"> Indian address <span class="req">*</span> </label>
              <div> <label for="applicantiaddr1">Address Line 1</label><span class="full addr1">
                <input id="applicantiaddr1" name="applicantiaddr1" type="text" class="field text addr" onChange="addrval(this.value,'applicantiaddr1','instructapplicantiaddr')" value="" tabindex="16" maxlength="39" required />
                
                </span>  <label for="applicantiaddr2">Address Line 2</label><span class="full addr2">
                <input id="applicantiaddr2" name="applicantiaddr2" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
               
                </span> <label for="applicantiaddr3">Address Line 3</label><span class="full addr2">
                <input id="applicantiaddr3" name="applicantiaddr3" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
               
                </span> <label for="applicanticity">City</label> <span class="left city">
                <input id="applicanticity" name="applicanticity" type="text" class="field text addr" value="" tabindex="18" maxlength="27" onChange="cityval(this.value,'applicanticity','instructapplicantiaddr')" required />
               
                </span>  <label for="applicantistate">State</label><span class="right state">
                <input id="applicantistate" name="applicantistate" type="text" class="field text addr" value="" tabindex="19" maxlength="20" onChange="stateval(this.value,'applicantistate','instructapplicantiaddr')" required />
               
                </span><label for="applicantizip">Postal / Zip Code</label> <span class="left zip">
                <input id="applicantizip" name="applicantizip" type="text" class="field text addr" value="" maxlength="6" tabindex="20" onChange="pinval(this.value,'applicantizip','instructapplicantiaddr')" required />
                
                </span> 
                </div>
             <p class="complex instruct" id="instructapplicantiaddr"><small>Address here!</small></p>
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
                <input id="applicant2name" name="applicant2name" type="text" class="field text medium" value="" maxlength="62" tabindex="26" onKeyUp="" required autofocus />
              </div>
              <p class="instruct" id="instructapplicant2name"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
				</li>
				
				 <li class="notranslate">
              <label class="desc" for="applicant2pan"> second applicant PAN Number <span class="req">*</span> </label>
             <div>
                <input id="applicant2pan" class="field text medium" name="applicant2pan" tabindex="27" required  type="text" value="" />
              </div>
				<p class="instruct" id="instructapplicant2pan"><small>Your pan number</small></p>
				</li>
				</ul>
				</div>

				<ul id="investor3" hidden>
				
				<li class="notranslate">
				<label class="desc" for="applicant3name"> Name of the Third applicant <span class="req">*</span> </label>
              <div>
                <input id="applicant3name" name="applicant3name" type="text" class="field text medium" value="" maxlength="62" tabindex="28" onKeyUp="" required autofocus />
              </div>
              <p class="instruct" id="instructapplicant3name"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
				</li>
				
				 <li class="notranslate">
              <label class="desc" for="applicant3pan"> Third applicant PAN Number <span class="req">*</span> </label>
              <div>
                <input id="applicant3pan" class="field text medium" name="applicant3pan" tabindex="29" required  type="text" value="" />
              </div>
              <p class="instruct" id="instructapplicant3pan"><small>Your pan number</small></p>
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
                 <label for="bankname">Name of the Bank</label><input id="bankname" maxlength="33"  name="bankname" type="text" class="field text addr" value="" onChange="bankval(this.value,'bankname','instructbank')"  tabindex="30" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bankacctypes" name="bankacctype" value="saving" tabindex="31"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bankacctypec" name="bankacctype" value="current" tabindex="32"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bankaccno">Account Number</label><span class="left city">
                <input id="bankaccno" name="bankaccno" type="text" class="field text addr" value="" tabindex="33" onChange="accval(this.value,'bankaccno','instructbank')" maxlength="20" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bankaddr1">Line 1</label><span class="left zip">
                <input id="bankaddr1" name="bankaddr1" type="text" class="field text addr" value="" maxlength="39" tabindex="34" onChange="bankaddrval(this.value,'bankaddr1','instructbank')" required />
                
                </span> <label for="bankaddr2">Line 2	</label><span class="left zip">
                <input id="bankaddr2" name="bankaddr2" type="text" class="field text addr" value="" maxlength="39" tabindex="35" required />
                
                
                </span> <label for="bankcity">Branch City</label><span class="left zip">
                <input id="bankcity" name="bankcity" type="text" class="field text addr" value="" maxlength="27" onChange="cityval(this.value,'bankcity','instructbank')" tabindex="36"  />
                
                
                </span> <label for="bankmicr">MICR Code</label><span class="left zip">
                <input id="bankmicr" name="bankmicr" type="text" class="field text addr" value="" onChange="micrval(this.value,'bankmicr','instructbank')" maxlength="9" tabindex="37"  />
                
               
                </span> <label for="bankifsc">IFSC Code</label><span class="left zip">
                <input id="bankifsc" name="bankifsc" type="text" class="field text addr" value="" onChange="ifscval(this.value,'bankifsc','instructbank')" maxlength="11"  tabindex="38"  />
               </span>
            </div>
			  <p class="complex instruct" id="instructbank"><small>Bank details here!</small></p>
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
                 <label for="bank2name">Name of the Second Bank</label><input id="bank2name" maxlength="33"  name="bank2name" onChange="bankval(this.value,'bank2name','instructbank2')"  type="text" class="field text addr" value="" tabindex="39" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bank2acctypes" name="bank2acctype" value="saving" tabindex="40"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bank2acctypec" name="bank2acctype" value="current" tabindex="41"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bank2accno">Account Number</label><span class="left city">
                <input id="bank2accno" name="bank2accno" type="text" class="field text addr" value="" maxlength="20"  onChange="accval(this.value,'bank2accno','instructbank2')" tabindex="42" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bank2addr1">Line 1</label><span class="left zip">
                <input id="bank2addr1" name="bank2addr1" type="text" class="field text addr" value="" maxlength="39" onChange="bankaddrval(this.value,'bank2addr1','instructbank2')" tabindex="43" required />
                
                </span> <label for="bank2addr2">Line 2	</label><span class="left zip">
                <input id="bank2addr2" name="bank2addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="44" required />
                
                
                </span> <label for="bank2city">Branch City</label><span class="left zip">
                <input id="bank2city" name="bank2city" type="text" class="field text addr" value="" maxlength="27" onChange="cityval(this.value,'bank2city','instructbank2')" tabindex="45"  />
                
                
                </span> <label for="bank2micr">MICR Code</label><span class="left zip">
                <input id="bank2micr" name="bank2micr" type="text" class="field text addr" value="" maxlength="9" onChange="micrval(this.value,'bank2micr','instructbank2')" tabindex="46"  />
                
               
                </span> <label for="bank2ifsc">IFSC Code</label><span class="left zip">
                <input id="bank2ifsc" name="bank2ifsc" type="text" class="field text addr" value="" maxlength="11" onChange="ifscval(this.value,'bank2ifsc','instructbank2')" tabindex="47"  />
               </span>
            </div>
			  <p class="complex instruct" id="instructbank2"><small>Second Bank details here!</small></p>
            </li>
		</ul>
					
					
				</div>
				
			<div id="bankdetails3" hidden>
			
				<ul>
            <li class="complex notranslate">
              <div id="bank3details"> <span class="full addr1">
                 <label for="bank3name">Name of the Third Bank</label><input id="bank3name" name="bank3name" maxlength="33"  onChange="bankval(this.value,'bank3name','instructbank3')"  type="text" class="field text addr" value="" tabindex="48" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bank3acctypes" name="bank3acctype" value="saving" tabindex="49"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bank3acctypec" name="bank3acctype" value="current" tabindex="50"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bank3accno">Account Number</label><span class="left city">
                <input id="bank3accno" name="bank3accno" type="text" class="field text addr" maxlength="20"  onChange="accval(this.value,'bank3accno','instructbank3')" value="" tabindex="51" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bank3addr1">Line 1</label><span class="left zip">
                <input id="bank3addr1" name="bank3addr1" type="text" class="field text addr" value="" onChange="bankaddrval(this.value,'bank3addr1','instructbank3')" maxlength="39" tabindex="52" required />
                
                </span> <label for="bank3addr2">Line 2	</label><span class="left zip">
                <input id="bank3addr2" name="bank3addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="53" required />
                
                
                </span> <label for="bank3city">Branch City</label><span class="left zip">
                <input id="bank3city" name="bank3city" type="text" class="field text addr" value="" onChange="cityval(this.value,'bank3city','instructbank3')" maxlength="27" tabindex="54"  />
                
                
                </span> <label for="bank3micr">MICR Code</label><span class="left zip">
                <input id="bank3micr" name="bank3micr" type="text" class="field text addr" value="" maxlength="9" onChange="micrval(this.value,'bank3micr','instructbank3')" tabindex="55"  />
                
               
                </span> <label for="bank3ifsc">IFSC Code</label><span class="left zip">
                <input id="bank3ifsc" name="bank3ifsc" type="text" class="field text addr" value="" maxlength="11" onChange="ifscval(this.value,'bank3ifsc','instructbank3')" tabindex="56"  />
               </span>
            </div>
			  <p class="complex instruct" id="instructbank3"><small>Third Bank details here!</small></p>
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
                </span> <label for="applicantsip"><input name="applicantsip" id="applicantsip" onchange="javascript:$('#sipmdetails').toggle();$('#instructapplicantsip').html('<small>SIP Details</small><br/>');"  value="sipmandatefalse" type="checkbox" tabindex="57">
			
                &nbsp;&nbsp;I Do not wish to make SIP mandate</label>
					
                
				<div id="sipmdetails">
                <span class="left zip">
                <label for="applicantvalidyfield" id="applicantvalidy">Number of years validity</label>
				</span>
				 <div class="styled-select">
                  <select id="applicantvalidyfield" name="applicantvalidy" onChange="vyval(this.value,'applicantvalidy','instructapplicantsip')" class="field select medium" tabindex="58">
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
                <label for="applicantvalidmafield" id="applicantvalidma">Maximum Per month mandate amount</label>
				 </span>
				  <div class="styled-select">
                  <select id="applicantvalidmafield" name="applicantvalidma" onChange="maval(this.value,'applicantvalidma','instructapplicantsip')" class="field select medium" tabindex="59">
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
             <label for="aplicantnomcheckbox"> <input type="checkbox" name="aplicantnomcheckbox" id="aplicantnomcheckbox" onchange="javascript:$('#appnomineedetails').toggle();" value="appnomineefalse" tabindex="60"> &nbsp;&nbsp;I Do not wish to make nomination<br/><br/></label> 
			  
			<p class="instruct" id="instructnomineedetailcheckbox"><small>Nominee details</small></p>	
			</li>			
			</ul>
			
			<div id="appnomineedetails">
			<ul>
			<li>
			  <span class="left city">
				<label for="appnomname">Nominee Name</label> <input id="appnomname" name="appnomname" type="text" class="field text addr" onChange="appnominval(this.value,'appnomname','instructappnomname')" value="" tabindex="61" maxlength="33" />
                
                </span> 
                <p class="instruct" id="instructappnomname"><small>About Nominee</small></p>
                <li class="date eurodate notranslate      ">
              <label class="desc"> Date Of Birth <span class="req">*</span> </label>
              <span>
              <input id="appnomdobd" name="appnomdobd" type="text" class="field text" onChange="ddval(this.value,'appnomdobd','instructappnomdobd')" value="" size="2" maxlength="2" tabindex="62" required />
              <label for="appnomdobd">DD</label>
              </span> <span class="symbol">/</span> <span>
              <input id="appnomdobm" name="appnomdobm" type="text" class="field text" onChange="mmval(this.value,'appnomdobm','instructappnomdobd')" value="" size="2" maxlength="2" tabindex="63" required />
              <label for="appnomdobm">MM</label>
              </span> <span class="symbol">/</span> <span>
              <input id="appnomdoby" name="appnomdoby" type="text" class="field text" onChange="yyval(this.value,'appnomdoby','instructappnomdobd')" value="" size="4" maxlength="4" tabindex="64" required />
              <label for="appnomdoby">YYYY</label>
              </span>
              <p class="instruct" id="instructappnomdobd"><small>Your date of birth</small></p>
            </li>
            <li>
                <span class="left zip"><label for="appnompname">Name Of Parent (In Case of Minor)	</label>
                <input id="appnompname" name="appnompname" type="text" class="field text addr" onChange="nomempval(this.value,'appnompname','instructappnompname')" value="" maxlength="30" tabindex="65" />
                
                </span> 
                <p class="instruct" id="instructappnompname"><small>Name Of Parent (In Case of Minor)</small></p>
                </li>
              
                
            <li>
                <span class="left zip"><label for="appnomrel">Relationship	</label>
                <input id="appnomrel" name="appnomrel" type="text" class="field text addr" onChange="nomemrval(this.value,'appnomrel','instructappnomrel')" value="" maxlength="16" tabindex="66" />
                
                </span> 
                <p class="instruct" id="instructappnomrel"><small>Relationship</small></p>
                </li>
				
			</ul>
		   
		   </div>
		   <ul>
			<li>
                <span class="left zip">
            <label for="agreementaccept" id="agreementacceptl"><input tabindex="100" id="agreementaccept" name="agreementaccept" value="agree" type="checkbox">&nbsp;&nbsp;I Have read the terms and Conditions Before investing </label>
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
                <input id="saveForm"  name="saveForm" class="btTxt submit fundsInn-btn" type="submit" tabindex="101" value="Submit"/>
                <input id="clearForm" onclick="formReset()" name="clearForm" class="btTxt submit fundsInn-btn" type="button" tabindex="102" value="Clear"/>
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
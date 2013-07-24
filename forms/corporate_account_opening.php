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
	$pattern="/.*NRI_acc_opening.*/";
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
	$("#redirectNRI").click(function(){
		var email;
		email=$("#applicantemail").val();
		if(!email)
		email=$("#applicant2contactemail").val();
		window.location.href='./NRI_acc_opening.php?email="'+email+'"';
	});
	});
//form submit ajax option
	function formReset()
	{

		document.getElementById("corporateform").reset();

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
    var dataString = $('#corporateform').serialize();

    $.ajax({
        type: "POST",
        url: 'corporate_db_store.php',
        data: dataString,
        dataType: 'json',
       success: function (data) {

			// if(data.success==0)
			// 		if(data.error)
			// 		{	
			// 			var	err=data.error;
						
			// 			if(err.search("Duplicate"))
			// 			{	
							
			// 				$('#errordis').html("<h3>You Pan No is already registered with us</h3>");
			// 				$('#errordis').addClass("er");
			// 				window.location.hash = '#topfundsinn';
					
			// 			}	 
			// 			else
			// 			{
			// 				$('#errordis').html("<h3>connection problem please try agian</h3>");
			// 				$('#errordis').addClass("er");
			// 				window.location.hash = '#topfundsinn';
			// 			}
			// 		}
			// 		else
			// 			{
							
			// 				eattr=data.attr;
			// 				var tempaddrp="Permanent Address Details<br/>";
			// 				var tempaddrc="Current address Details<br/>";
			// 				var tempaddrb="Bank Details<br/>";
			// 				var tempaddrb2=" Second Bank Details<br/>";
			// 				var tempaddrb3="Third Bank Details<br/>";
			// 				var tempsip="SIP Details <br/>";
			// 				var tempci="Contact Person Details<br/>";
			// 				for ( var attrname in eattr)
			// 				{
			// 					if(eattr[attrname]!="TRUE")
			// 					{
			// 						if(document.getElementById(attrname))
			// 						{	
			// 							$('#'+attrname).addClass("error");
			// 							if(document.getElementById('instruct'+attrname))
			// 							   $('#instruct'+attrname).html("<small>"+eattr[attrname]+"</small>");
			// 							 else
			// 								{
			// 									if(!(attrname.search("applicantp")))
			// 										tempaddrp=tempaddrp+eattr[attrname]+"<br/>";
			// 									$('#instructapplicantpaddr').html("<small>"+tempaddrp+"</small><br/>");
												
			// 									if(!(attrname.search("applicantc")))
			// 										tempaddrc=tempaddrc+eattr[attrname]+"<br/>";
			// 									$('#instructapplicantcaddr').html("<small>"+tempaddrc+"</small><br/>");
												
			// 									if(!(attrname.search("bank")))
			// 										tempaddrb=tempaddrb+eattr[attrname]+"<br/>";
			// 									$('#instructbank').html("<small>"+tempaddrb+"</small><br/>");
												
			// 									if(!(attrname.search("bank2")))
			// 										tempaddrb2=tempaddrb2+eattr[attrname]+"<br/>";
			// 									$('#instructbank2').html("<small>"+tempaddrb2+"</small><br/>");
												
			// 									if(!(attrname.search("bank3")))
			// 										tempaddrb3=tempaddrb3+eattr[attrname]+"<br/>";
			// 									$('#instructbank3').html("<small>"+tempaddrb3+"</small><br/>");
												
			// 									if(!(attrname.search("applicant2c")))
			// 										tempci=tempci+eattr[attrname]+"<br/>";
			// 									$('#instructapplicant2contact').html("<small>"+tempci+"</small><br/>");
												
			// 										if(!(attrname.search("applicantvalid")))
			// 										tempsip=tempsip+eattr[attrname]+"<br/>";
			// 									$('#instructapplicantsip').html("<small>"+tempsip+"</small><br/>");
											
											
			// 								}
			// 						}
			// 					}
			// 				}
			// 			}
			// else
			// 	{
			// 				$('#errordis').html("<h3>Form submitted you will be redirected shortly</h3>");
			// 				$('#errordis').addClass("su");
			// 				window.location.hash = '#topfundsinn';
			// 			//	$("#headerMenu").scrollTop();
							
			// 	}
			// //	dump(data.attr);
			// 	dump(data);
				alert(data);
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
        <form id="corporateform" name="corporateform" class="wufoo leftLabel page"  novalidate method="post" action="javascript:send();">
			<div id="errordis">
			
			</div>
           <div class="formHeaderTitle">
                <h3 id="titleindividual">Corporate </h3>
			</div>
		<ul>
            <li class="notranslate">
              <label class="desc" for="redirectIndividual"> Acount Type <span class="req">*</span> </label>
              <div>
                <input id="redirectIndividual" tabindex="1" name="account_type" type="radio" value="Individual">&nbsp;Individual&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="redirectNRI" name="account_type" type="radio" tabindex="2" value="NRI">&nbsp;NRI&nbsp;&nbsp;&nbsp;&nbsp;
                <input id="redirectCorp"  checked="checked" name="account_type" type="radio" tabindex="3" value="Corporate">&nbsp;Corporate/HUF&nbsp;&nbsp;&nbsp;&nbsp;
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
            <li class="date eurodate notranslate">
              <label class="desc"> Date of Incorporation <span class="req">*</span> </label>
              <span>

              <input id="applicantdoidd" name="applicantdoidd" type="text" class="field text" value="" size="2" onChange="ddval2(this.value,'applicantdoidd','instructapplicantdoidd')" maxlength="2" tabindex="5" />
              <label for="applicantdoidd">DD</label>
              </span> <span class="symbol">/</span> <span>
              <input id="applicantdoimm" name="applicantdoimm" type="text" class="field text" value="" onChange="mmval2(this.value,'applicantdoimm','instructapplicantdoidd')" size="2" maxlength="2" tabindex="6" />
              <label for="applicantdoimm">MM</label>
              </span> <span class="symbol">/</span> <span>
              <input id="applicantdoiyyyy" name="applicantdoiyyyy" type="text" class="field text" value="" onChange="yyval2(this.value,'applicantdoiyyyy','instructapplicantdoidd')" size="4" maxlength="4" tabindex="7" />
              <label for="applicantdoiyyyy">YYYY</label>
              </span>
              <p class="instruct" id="instructapplicantdoidd"><small>Enter Date of in corporation</small></p>
            </li>
            <li class="notranslate">
              <label class="desc" for="applicantpan"> PAN Number <span class="req">*</span> </label>
              <div>
                <input id="applicantpan" class="field text medium" name="applicantpan" onChange="panval(this.value,'applicantpan','instructapplicantpan')" tabindex="8" required maxlength="10" type="text" value="" />
              </div>
              <p class="instruct" id="instructapplicantpan"><small>Your pan number</small></p>
            </li>
			
			</ul>
			  <div class="formHeaderTitle">
                <h3 > Contact Information</h3>
			</div>
			
			
			<ul>	
            <li class="complex notranslate">
               <div> <label for="applicant2contactname">Contact Person Name</label><span class="full addr1">

                <input id="applicant2contactname" name="applicant2contactname" type="text" class="field text addr" value="" tabindex="9" onChange="alphareq2(this.value,'applicant2contactname','instructapplicant2contact')" maxlength="62" required />
                
                </span>  <label for="applicant2contactdes">Designation of Contact Person</label><span class="full addr2">
                <input id="applicant2contactdes" name="applicant2contactdes" type="text" class="field text addr" value="" tabindex="10" maxlength="54" onChange="alphareq3(this.value,'applicant2contactdes','instructapplicant2contact')" />
               
                </span> <label for="applicant2contactemail">Email address of Contact Person</label> <span class="left city">
                <input id="applicant2contactemail" readonly name="applicant2contactemail" type="text" class="field text addr" value=<?php echo $email?> onChange="emval2(this.value,'applicant2contactemail','instructapplicant2contact')" tabindex="11" maxlength="37" required />
               
                </span>  <label for="applicant2contacttelr">Tele Number (Residential)</label><span class="right state">
                <input id="applicant2contacttelr" name="applicant2contacttelr" type="text" class="field text addr" value="" tabindex="12" maxlength="12" required onChange="terval(this.value,'applicant2contacttelr','instructapplicant2contact')" />
               
                </span><label for="applicant2contacttelo">Tele Number (Office)</label> <span class="left zip">
                <input id="applicant2contacttelo" name="applicant2contacttelo" type="text" class="field text addr" value="" tabindex="13" maxlength="15" onChange="teoval(this.value,'applicant2contacttelo','instructapplicant2contact')"/>
                
                </span><label for="applicant2contacttelm">Mobile Number</label> <span class="left zip">
                <input id="applicant2contacttelm" name="applicant2contacttelm" type="text" class="field text addr" value="" tabindex="14" maxlength="11" onChange="temval2(this.value,'applicant2contacttelm','instructapplicant2contact')" />
                </span> 
				 </div>
             <p class="complex instruct" id="instructapplicant2contact"><small>Contact Person Information here!</small></p>
            </li>
           </ul>
		   
		   
		<ul>	 
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
              <p class="instruct" id="instructapplicantocc"><small>Your Status</small></p>
            </li>
			 <li class="notranslate">
              <label class="desc" id="applicantstatus"> Status <span class="req">*</span> </label>
              <div>
                <div class="styled-select">

                  <select  name="applicantstatus" class="field select medium" tabindex="16" onChange="statusval(this.value,'applicantstatus','instructapplicantstatus')" >
                    <option value="--Select--" selected="selected"> --Select-- </option>
                   <option value="Business">Partnership</option>
                    <option value="Service">Society</option>
                    <option value="Professional">Trust</option>
                    <option value="Agriculturist">Proprietary</option>
                    <option value="Retired">Bank</option>
                    <option value="Housewife">FI</option>
                    <option value="Student">HUF</option>
                    <option value="Others">Company</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
              </div>
              <p class="instruct" id="instructapplicantstatus"><small>Your Status</small></p>
            </li>
           
		   <li class="notranslate">
              <label class="desc" id="applicanttaxstatus">Tax Status <span class="req">*</span> </label>
              <div>
                <div class="styled-select">
                  <select  name="applicanttaxstatus" class="field select medium" tabindex="17" onChange="statusval(this.value,'applicanttaxstatus','instructapplicanttaxstatus')" >
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
			
           </ul>
	   
            <!--FORM 2-->
              <div class="formHeaderTitle">
                <h3 > Address Information</h3>
			</div>
			
			<ul>	
            <li class="complex notranslate">
              <label class="desc"> Permanent Address <span class="req">*</span> </label>
              <div> <label for="applicantpaddr1">Address Line 1</label><span class="full addr1">
                <input id="applicantpaddr1" name="applicantpaddr1" type="text" class="field text addr" onChange="addrval(this.value,'applicantpaddr1','instructapplicantpaddr')" value="" tabindex="18" maxlength="39" required />
                
                </span>  <label for="applicantpaddr2">Address Line 2</label><span class="full addr2">
                <input id="applicantpaddr2" name="applicantpaddr2" type="text" class="field text addr" value="" tabindex="19" maxlength="39" />
               
                </span>  <label for="applicantpaddr3">Address Line 3</label><span class="full addr2">
                <input id="applicantpaddr3" name="applicantpaddr3" type="text" class="field text addr" value="" tabindex="18" maxlength="39" />
               
                </span> <label for="applicantpcity">City</label> <span class="left city">
                <input id="applicantpcity" name="applicantpcity" type="text" class="field text addr" value="" tabindex="20" maxlength="27" onChange="cityval(this.value,'applicantpcity','instructapplicantpaddr')" required />
               
                </span>  <label for="applicantpstate">State</label><span class="right state">
                <input id="applicantpstate" name="applicantpstate" type="text" class="field text addr" value="" tabindex="21" maxlength="20" onChange="stateval(this.value,'applicantpstate','instructapplicantpaddr')" required />
               
                </span><label for="applicantpzip">Postal / Zip Code</label> <span class="left zip">
                <input id="applicantpzip" name="applicantpzip" type="text" class="field text addr" value="" maxlength="6" tabindex="22" onChange="pinval(this.value,'applicantpzip','instructapplicantpaddr')" required />
                </span> 
                </div>
             <p class="complex instruct" id="instructapplicantpaddr"><small>Address here!</small></p>
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
                <input id="applicantcaddr1" name="applicantcaddr1" type="text" class="field text addr" value="" tabindex="23" onChange="addrval(this.value,'applicantcaddr1','instructapplicantcaddr')" maxlength="39" required />
                
                </span>  <label for="applicantcaddr2">Address Line 2</label><span class="full addr2">
                <input id="applicantcaddr2" name="applicantcaddr2" type="text" class="field text addr" value="" tabindex="24"  maxlength="39" />
               
                </span> <label for="applicantcaddr3">Address Line 3</label><span class="full addr2">
                <input id="applicantcaddr3" name="applicantcaddr3" type="text" class="field text addr" value="" tabindex="23"  maxlength="39" />
               
                </span><label for="applicantccity">City</label> <span class="left city">
                <input id="applicantccity" name="applicantccity" type="text" class="field text addr" value="" tabindex="25" onChange="cityval(this.value,'applicantccity','instructapplicantcaddr')" maxlength="27" required />
               
                </span>  <label for="applicantcstate">State</label><span class="right state">
                <input id="applicantcstate" name="applicantcstate" type="text" class="field text addr" value="" tabindex="26" onChange="stateval(this.value,'applicantcstate','instructapplicantcaddr')"  maxlength="20" required />
               
                </span><label for="applicantczip">Postal / Zip Code</label> <span class="left zip">
                <input id="applicantczip" name="applicantczip" type="text" class="field text addr" value="" maxlength="6" onChange="pinval(this.value,'applicantczip','instructapplicantcaddr')"  tabindex="27" required />
                </span> 
                </div>
             <p class="complex instruct" id="instructapplicantcaddr"><small>communication address here</small></p>
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

                <input id="applicant2name" name="applicant2name" type="text" class="field text medium" value="" maxlength="62" tabindex="28" onKeyUp="" required autofocus />
              </div>
              <p class="instruct" id="instructapplicant2name"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
				</li>
				
				 <li class="notranslate">
              <label class="desc" for="applicant2pan"> second applicant PAN Number <span class="req">*</span> </label>
             <div>

                <input id="applicant2pan" class="field text medium" name="applicant2pan" tabindex="29" required  type="text" value="" />
              </div>
				<p class="instruct" id="instructapplicant2pan"><small>Your pan number</small></p>
				</li>
				</ul>
				</div>

				<ul id="investor3" hidden>
				
				<li class="notranslate">
				<label class="desc" for="applicant3name"> Name of the Third applicant <span class="req">*</span> </label>
              <div>

                <input id="applicant3name" name="applicant3name" type="text" class="field text medium" value="" maxlength="62" tabindex="30" onKeyUp="" required autofocus />
              </div>
              <p class="instruct" id="instructapplicant3name"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
				</li>
				
				 <li class="notranslate">
              <label class="desc" for="applicant3pan"> Third applicant PAN Number <span class="req">*</span> </label>
              <div>

                <input id="applicant3pan" class="field text medium" name="applicant3pan" tabindex="31" required  type="text" value="" />
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

                 <label for="bankname">Name of the Bank</label><input id="bankname" maxlength="33"  name="bankname" type="text" class="field text addr" value="" onChange="bankval(this.value,'bankname','instructbank')"  tabindex="32" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bankacctypes" name="bankacctype" value="saving" tabindex="33"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bankacctypec" name="bankacctype" value="current" tabindex="34"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bankaccno">Account Number</label><span class="left city">

                <input id="bankaccno" name="bankaccno" type="text" class="field text addr" value="" tabindex="35" onChange="accval(this.value,'bankaccno','instructbank')" maxlength="20" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bankaddr1">Line 1</label><span class="left zip">
                <input id="bankaddr1" name="bankaddr1" type="text" class="field text addr" value="" maxlength="39" tabindex="36" onChange="bankaddrval(this.value,'bankaddr1','instructbank')" required />
                
                </span> <label for="bankaddr2">Line 2	</label><span class="left zip">
                <input id="bankaddr2" name="bankaddr2" type="text" class="field text addr" value="" maxlength="39" tabindex="37" required />
                
                
                </span> <label for="bankcity">Branch City</label><span class="left zip">
                <input id="bankcity" name="bankcity" type="text" class="field text addr" value="" maxlength="27" onChange="cityval(this.value,'bankcity','instructbank')" tabindex="38"  />
                
                
                </span> <label for="bankmicr">MICR Code</label><span class="left zip">
                <input id="bankmicr" name="bankmicr" type="text" class="field text addr" value="" onChange="micrval(this.value,'bankmicr','instructbank')" maxlength="9" tabindex="39"  />
                
               
                </span> <label for="bankifsc">IFSC Code</label><span class="left zip">
                <input id="bankifsc" name="bankifsc" type="text" class="field text addr" value="" onChange="ifscval(this.value,'bankifsc','instructbank')" maxlength="11"  tabindex="40"  />
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

                 <label for="bank2name">Name of the Second Bank</label><input id="bank2name" maxlength="33"  name="bank2name" onChange="bankval(this.value,'bank2name','instructbank2')"  type="text" class="field text addr" value="" tabindex="41" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bank2acctypes" name="bank2acctype" value="saving" tabindex="42"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bank2acctypec" name="bank2acctype" value="current" tabindex="43"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bank2accno">Account Number</label><span class="left city">

                <input id="bank2accno" name="bank2accno" type="text" class="field text addr" value="" maxlength="20"  onChange="accval(this.value,'bank2accno','instructbank2')" tabindex="44" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bank2addr1">Line 1</label><span class="left zip">

                <input id="bank2addr1" name="bank2addr1" type="text" class="field text addr" value="" maxlength="39" onChange="bankaddrval(this.value,'bank2addr1','instructbank2')" tabindex="45" required />
                
                </span> <label for="bank2addr2">Line 2	</label><span class="left zip">
                <input id="bank2addr2" name="bank2addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="46" required />
                
                
                </span> <label for="bank2city">Branch City</label><span class="left zip">
                <input id="bank2city" name="bank2city" type="text" class="field text addr" value="" maxlength="27" onChange="cityval(this.value,'bank2city','instructbank2')" tabindex="47"  />
                
                
                </span> <label for="bank2micr">MICR Code</label><span class="left zip">
                <input id="bank2micr" name="bank2micr" type="text" class="field text addr" value="" maxlength="9" onChange="micrval(this.value,'bank2micr','instructbank2')" tabindex="48"  />
                
               
                </span> <label for="bank2ifsc">IFSC Code</label><span class="left zip">
                <input id="bank2ifsc" name="bank2ifsc" type="text" class="field text addr" value="" maxlength="11" onChange="ifscval(this.value,'bank2ifsc','instructbank2')" tabindex="49"  />
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

                 <label for="bank3name">Name of the Third Bank</label><input id="bank3name" name="bank3name" maxlength="33"  onChange="bankval(this.value,'bank3name','instructbank3')"  type="text" class="field text addr" value="" tabindex="50" />
               
                </span> <label>Account Type</label> 
				<div>
					<input type="radio" checked id="bank3acctypes" name="bank3acctype" value="saving" tabindex="51"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="bank3acctypec" name="bank3acctype" value="current" tabindex="52"/>&nbsp;Current
				</div>
				<span class="full addr2">
                
				</span> <label for="bank3accno">Account Number</label><span class="left city">

                <input id="bank3accno" name="bank3accno" type="text" class="field text addr" maxlength="20"  onChange="accval(this.value,'bank3accno','instructbank3')" value="" tabindex="53" />
                
                </span><label>Branch Address</label> <span class="right state">
                
                </span> <label for="bank3addr1">Line 1</label><span class="left zip">
                <input id="bank3addr1" name="bank3addr1" type="text" class="field text addr" value="" onChange="bankaddrval(this.value,'bank3addr1','instructbank3')" maxlength="39" tabindex="54" required />
                
                </span> <label for="bank3addr2">Line 2	</label><span class="left zip">
                <input id="bank3addr2" name="bank3addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="55" required />
                
                
                </span> <label for="bank3city">Branch City</label><span class="left zip">
                <input id="bank3city" name="bank3city" type="text" class="field text addr" value="" onChange="cityval(this.value,'bank3city','instructbank3')" maxlength="27" tabindex="56"  />
                
                
                </span> <label for="bank3micr">MICR Code</label><span class="left zip">
                <input id="bank3micr" name="bank3micr" type="text" class="field text addr" value="" maxlength="9" onChange="micrval(this.value,'bank3micr','instructbank3')" tabindex="57"  />
                
               
                </span> <label for="bank3ifsc">IFSC Code</label><span class="left zip">
                <input id="bank3ifsc" name="bank3ifsc" type="text" class="field text addr" value="" maxlength="11" onChange="ifscval(this.value,'bank3ifsc','instructbank3')" tabindex="58"  />
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

                </span> <label for="applicantsip"><input name="applicantsip" id="applicantsip" onchange="javascript:$('#sipmdetails').toggle();$('#instructapplicantsip').html('<small>SIP Details</small><br/>');" value="sipmandatefalse" type="checkbox" tabindex="59">
			
                &nbsp;&nbsp;I Do not wish to make SIP mandate</label>
					
                
				<div id="sipmdetails">
                <span class="left zip">
                <label for="applicantvalidyfield" id="applicantvalidy">Number of years validity</label>
				</span>
				 <div class="styled-select">

                  <select id="applicantvalidyfield" name="applicantvalidy" onChange="vyval(this.value,'applicantvalidy','instructapplicantsip')" class="field select medium" tabindex="60">
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
                <label for="applicantvalidmafiedl" id="applicantvalidma">Maximum Per month mandate amount</label>
				 </span>
				  <div class="styled-select">

                  <select id="applicantvalidmafield" name="applicantvalidma" onChange="maval(this.value,'applicantvalidma','instructapplicantsip')" class="field select medium" tabindex="61">
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

             <label for="aplicantnomcheckbox"> <input type="checkbox" name="aplicantnomcheckbox" id="aplicantnomcheckbox" onchange="javascript:$('#appnomineedetails').toggle();" value="appnomineefalse" tabindex="62"> &nbsp;&nbsp;I Do not wish to make nomination<br/><br/></label> 
			  
			<p class="instruct" id="instructnomineedetailcheckbox"><small>Nominee details</small></p>	
			</li>			
			</ul>
			
			<div id="appnomineedetails">
			<ul>
			<li>
			  <span class="left city">

				<label for="appnomname">Nominee Name</label> <input id="appnomname" name="appnomname" type="text" class="field text addr" onChange="appnominval(this.value,'appnomname','instructappnomname')" value="" tabindex="63" maxlength="33" />
                
                </span> 
                <p class="instruct" id="instructappnomname"><small>About Nominee</small></p>
                <li class="date eurodate notranslate      ">
              <label class="desc"> Date Of Birth <span class="req">*</span> </label>
              <span>

              <input id="appnomdobd" name="appnomdobd" type="text" class="field text" onChange="ddval(this.value,'appnomdobd','instructappnomdobd')" value="" size="2" maxlength="2" tabindex="64" required />
              <label for="appnomdobd">DD</label>
              </span> <span class="symbol">/</span> <span>
              <input id="appnomdobm" name="appnomdobm" type="text" class="field text" onChange="mmval(this.value,'appnomdobm','instructappnomdobd')" value="" size="2" maxlength="2" tabindex="65" required />
              <label for="appnomdobm">MM</label>
              </span> <span class="symbol">/</span> <span>
              <input id="appnomdoby" name="appnomdoby" type="text" class="field text" onChange="yyval(this.value,'appnomdoby','instructappnomdobd')" value="" size="4" maxlength="4" tabindex="66" required />
              <label for="appnomdoby">YYYY</label>
              </span>
              <p class="instruct" id="instructappnomdobd"><small>Your date of birth</small></p>
            </li>
            <li>
                <span class="left zip"><label for="appnompname">Name Of Parent (In Case of Minor)	</label>

                <input id="appnompname" name="appnompname" type="text" class="field text addr" onChange="nomempval(this.value,'appnompname','instructappnompname')" value="" maxlength="30" tabindex="67" />
                
                </span> 
                <p class="instruct" id="instructappnompname"><small>Name Of Parent (In Case of Minor)</small></p>
                </li>
              
                
            <li>
                <span class="left zip"><label for="appnomrel">Relationship	</label>

                <input id="appnomrel" name="appnomrel" type="text" class="field text addr" onChange="nomemrval(this.value,'appnomrel','instructappnomrel')" value="" maxlength="16" tabindex="68" />
                
                </span> 
                <p class="instruct" id="instructappnomrel"><small>Relationship</small></p>
                </li>
				
			</ul>
		   
		   </div>
		   <ul>
			<li>
                <span class="left zip">

            <label for="agreementaccept" id="agreementacceptl"><input tabindex="69" id="agreementaccept" name="agreementaccept" value="agree" type="checkbox">&nbsp;&nbsp;I Have read the terms and Conditions Before investing </label>
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

                <input id="saveForm"  name="saveForm" class="btTxt submit fundsInn-btn" type="submit" tabindex="70" value="Submit"/>
                <input id="clearForm" onclick="formReset()" name="clearForm" class="btTxt submit fundsInn-btn" type="button" tabindex="71" value="Clear"/>
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
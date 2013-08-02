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
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
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
      function tab_index_correction()
         {
          var count=1;
          $("#corporateform :input").each(function(k,v){
            if($(v).attr("type")!="hidden" && $(v).attr("rel")!="extra")
            { 
             $(v).attr("tabindex",count);
             count++;
            //console.log($(v).attr("type")+""+count);
            }
          });
            console.log("tab index corrected");

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
      	if($('#corporateform').valid())
      	{
      						
      		  // make the AJAX request
          var dataString = $('#corporateform').serialize();
      
      		    $.ajax({
      		        type: "POST",
      		        url: 'corporate_db_store.php',
      		        data: dataString,
      		        dataType: 'json',
      		       success: function (data) {
      
      					//window.location.hash = '#topfundsinn';
      				
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
      
    </script>
  </head>
  <body>
    <!--MAIN WRAPPER-->
    <div class="wrapper">
      <div id="headerBox">
        <div id="header" class="container_16">
          <div id="headerLeft" class="grid_5">
            <div class="theLogo"><a href="../"><img src="../img/logo.png" alt="FundsInn Logo"></a></div>
          </div>
          <div id="headerMenu" class="grid_5">
            <ul>
              <li><a href="../Investments.php">INVESTMENTS</a></li>
              <li><a href="#">FAQ</a></li>
              <li><a href="http://www.blog.fundsinn.com/">BLOG</a></li>
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
              <form id="corporateform" name="corporateform" class="wufoo leftLabel page"  novalidate method="post">
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
                    <label class="desc" for="applicantname"> Name of the Applicant <span class="req">*</span> </label>
                    <div>
                      <input id="applicantname" name="applicantname" type="text" class="field text medium" value="" maxlength="62" tabindex="4" />
                    </div>
                    <p class="instruct" id="instructapplicantname"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
                  </li>
                  <li class="date eurodate notranslate">
                    <label class="desc"> Date of Incorporation <span class="req">*</span> </label>
                    <span>
                    <input id="applicantdoidd" name="applicantdoidd" type="text" class="field text" value="" size="2" maxlength="2" tabindex="5" />
                    <label for="applicantdoidd">DD</label>
                    </span> <span class="symbol">/</span> <span>
                    <input id="applicantdoimm" name="applicantdoimm" type="text" class="field text" value="" size="2" maxlength="2" tabindex="6" />
                    <label for="applicantdoimm">MM</label>
                    </span> <span class="symbol">/</span> <span>
                    <input id="applicantdoiyyyy" name="applicantdoiyyyy" type="text" class="field text" value=""  size="4" maxlength="4" tabindex="7" />
                    <label for="applicantdoiyyyy">YYYY</label>
                    </span>
                    <p class="instruct" id="instructapplicantdoidd"><small>Enter Date of in corporation</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="applicantpan"> PAN Number <span class="req">*</span> </label>
                    <div>
                      <input id="applicantpan" class="field text medium" name="applicantpan" tabindex="8" required maxlength="10" type="text" value="" />
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
                      <input id="applicant2contactname" name="applicant2contactname" type="text" class="field text addr" value="" tabindex="9" maxlength="62" />
                      </span>  <label for="applicant2contactdes">Designation of Contact Person</label><span class="full addr2">
                      <input id="applicant2contactdes" name="applicant2contactdes" type="text" class="field text addr" value="" tabindex="10" maxlength="54"/>
                      </span> <label for="applicant2contactemail">Email address of Contact Person</label> <span class="left city">
                      <input id="applicant2contactemail" readonly name="applicant2contactemail" type="text" class="field text addr" value=<?php echo $email?>  tabindex="11" maxlength="37" />
                      </span>  <label for="applicant2contacttelr">Tele Number (Residential)</label><span class="right state">
                      <input id="applicant2contacttelr" name="applicant2contacttelr" type="text" class="field text addr" value="" tabindex="12" maxlength="12" />
                      </span><label for="applicant2contacttelo">Tele Number (Office)</label> <span class="left zip">
                      <input id="applicant2contacttelo" name="applicant2contacttelo" type="text" class="field text addr" value="" tabindex="13" maxlength="15" />
                      </span><label for="applicant2contacttelm">Mobile Number</label> <span class="left zip">
                      <input id="applicant2contacttelm" name="applicant2contacttelm" type="text" class="field text addr" value="" tabindex="14" maxlength="11"  />
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
                        <select  name="applicantocc" id="applicantocc" class="field select medium" tabindex="15" required>
                          <option value="0"> --Select-- </option>
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
                        <select  name="applicantstatus" class="field select medium" tabindex="16" >
                          <option value="0" > --Select-- </option>
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
                        <select  name="applicanttaxstatus" class="field select medium" tabindex="17">
                          <option value="0" > --Select-- </option>
                          <option value="Bank/ Financial Institutuion">Bank/ Financial Institutuion</option>
                          <option value="Sole Proprietorship">Sole Proprietorship</option>
                          <option value="NRI- Non Repatriable (NRO)">NRI- Non Repatriable (NRO)</option>
                          <option value="NRI- Repatriable (NRE)">NRI- Repatriable (NRE)</option>
                          <option value="Overseas Corporate Body">Overseas Corporate Body</option>
                          <option value="Foreign Institutional Investor">Foreign Institutional Investor</option>
                          <option value="HUF">HUF</option>
                          <option value="Provident Fund/EPF">Provident Fund/EPF</option>
                          <option value="Superammuation Fund">Superammuation Fund</option>
                          <option value="Gratuity Fund">Gratuity Fund</option>
                          <option value="Pension Fund">Pension Fund</option>
                          <option value="Company">Company</option>
                          <option value="AOP/BOI">AOP/BOI</option>
                          <option value="Partnership Firm">Partnership Firm</option>
                          <option value="Body Corporate">Body Corporate</option>
                          <option value="Trust">Trust</option>
                          <option value="Society">Society</option>
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
                      <input id="applicantpaddr1" name="applicantpaddr1" type="text" class="field text addr" value="" tabindex="18" maxlength="39" />
                      </span>  <label for="applicantpaddr2">Address Line 2</label><span class="full addr2">
                      <input id="applicantpaddr2" name="applicantpaddr2" type="text" class="field text addr" value="" tabindex="19" maxlength="39" />
                      </span>  <label for="applicantpaddr3">Address Line 3</label><span class="full addr2">
                      <input id="applicantpaddr3" name="applicantpaddr3" type="text" class="field text addr" value="" tabindex="18" maxlength="39" />
                      </span> <label for="applicantpcity">City</label> <span class="left city">
                      <input id="applicantpcity" name="applicantpcity" type="text" class="field text addr" value="" tabindex="20" maxlength="27" />
                      </span>  <label for="applicantpstate">State</label><span class="right state">
                      <div class="styled-select">
                      <select id="applicantpstate" name="applicantpstate" type="text" class="field select medium" value="" tabindex="21" />
                       <option value="0">--select--</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Orissa">Orissa</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        <option value="Andaman and Nicobar">Andaman and Nicobar</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Pondicherry">Pondicherry</option>   
                      </select>
                      </div>
                      </span><label for="applicantpzip">Postal / Zip Code</label> <span class="left zip">
                      <input id="applicantpzip" name="applicantpzip" type="text" class="field text addr" value="" maxlength="6" tabindex="22"/>
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
                      <input id="applicantcaddr1" name="applicantcaddr1" type="text" class="field text addr" value="" tabindex="23" maxlength="39" />
                      </span>  <label for="applicantcaddr2">Address Line 2</label><span class="full addr2">
                      <input id="applicantcaddr2" name="applicantcaddr2" type="text" class="field text addr" value="" tabindex="24"  maxlength="39" />
                      </span> <label for="applicantcaddr3">Address Line 3</label><span class="full addr2">
                      <input id="applicantcaddr3" name="applicantcaddr3" type="text" class="field text addr" value="" tabindex="23"  maxlength="39" />
                      </span><label for="applicantccity">City</label> <span class="left city">
                      <input id="applicantccity" name="applicantccity" type="text" class="field text addr" value="" tabindex="25" maxlength="27" />
                      </span>  <label for="applicantcstate">State</label><span class="right state">
                      <div class="styled-select">
                       <select id="applicantcstate" name="applicantcstate" type="text" class="field text addr" value="" tabindex="26">
                       <option value="0">--select--</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Orissa">Orissa</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        <option value="Andaman and Nicobar">Andaman and Nicobar</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Pondicherry">Pondicherry</option>   
                       </select>
                     </div>
                       </span><label for="applicantczip">Postal / Zip Code</label> <span class="left zip">
                      <input id="applicantczip" name="applicantczip" type="text" class="field text addr" value="" maxlength="6" tabindex="27" />
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
                          <input id="applicant2name" name="applicant2name" type="text" rel="extra" class="field text medium" value="" maxlength="62" tabindex="28" onKeyUp="" required autofocus />
                        </div>
                        <p class="instruct" id="instructapplicant2name"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
                      </li>
                      <li class="notranslate">
                        <label class="desc" for="applicant2pan"> second applicant PAN Number <span class="req">*</span> </label>
                        <div>
                          <input id="applicant2pan" class="field text medium" rel="extra" name="applicant2pan" tabindex="29" required  type="text" value="" />
                        </div>
                        <p class="instruct" id="instructapplicant2pan"><small>Your pan number</small></p>
                      </li>
                    </ul>
                  </div>
                  <ul id="investor3" hidden>
                    <li class="notranslate">
                      <label class="desc" for="applicant3name"> Name of the Third applicant <span class="req">*</span> </label>
                      <div>
                        <input id="applicant3name" name="applicant3name" type="text" rel="extra" class="field text medium" value="" maxlength="62" tabindex="30" onKeyUp="" required autofocus />
                      </div>
                      <p class="instruct" id="instructapplicant3name"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
                    </li>
                    <li class="notranslate">
                      <label class="desc" for="applicant3pan"> Third applicant PAN Number <span class="req">*</span> </label>
                      <div>
                        <input id="applicant3pan" class="field text medium" rel="extra" name="applicant3pan" tabindex="31" required  type="text" value="" />
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
                  tab_index_correction();
                  $('#addmoreinvestorlink').attr('href','javascript:addinvestor(3);');
                  }
                  
                  if(val==3)
                  {
                  $('#investor3').show();
                  tab_index_correction();
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
                    <div id="bank_details">
                      <span class="full addr1">
                      <label for="bankname">Name of the Bank</label><input id="bankname" maxlength="33"  name="bankname" type="text" class="field text addr" value="" tabindex="32" />
                      </span> <label>Account Type</label> 
                      <div>
                        <input type="radio" checked id="bankacctypes" name="bankacctype" value="saving" tabindex="33"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="bankacctypec" name="bankacctype" value="current" tabindex="34"/>&nbsp;Current
                      </div>
                      <span class="full addr2">
                      </span> <label for="bankaccno">Account Number</label><span class="left city">
                      <input id="bankaccno" name="bankaccno" type="text" class="field text addr" value="" tabindex="35" maxlength="20" />
                      </span><label>Branch Address</label> <span class="right state">
                      </span> <label for="bankaddr1">Line 1</label><span class="left zip">
                      <input id="bankaddr1" name="bankaddr1" type="text" class="field text addr" value="" maxlength="39" tabindex="36" />
                      </span> <label for="bankaddr2">Line 2	</label><span class="left zip">
                      <input id="bankaddr2" name="bankaddr2" type="text" class="field text addr" value="" maxlength="39" tabindex="37" />
                      </span> <label for="bankcity">Branch City</label><span class="left zip">
                      <input id="bankcity" name="bankcity" type="text" class="field text addr" value="" maxlength="27" tabindex="38"  />
                      </span> <label for="bankmicr">MICR Code</label><span class="left zip">
                      <input id="bankmicr" name="bankmicr" type="text" class="field text addr" value="" maxlength="9" tabindex="39"  />
                      </span> <label for="bankifsc">IFSC Code</label><span class="left zip">
                      <input id="bankifsc" name="bankifsc" type="text" class="field text addr" value="" maxlength="11"  tabindex="40"  />
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
                        <div id="bank2details">
                          <span class="full addr1">
                          <label for="bank2name">Name of the Second Bank</label><input id="bank2name" maxlength="33"  name="bank2name" type="text" class="field text addr" value="" tabindex="41" />
                          </span> <label>Account Type</label> 
                          <div>
                            <input type="radio" checked id="bank2acctypes" name="bank2acctype" value="saving" tabindex="42"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="bank2acctypec" name="bank2acctype" value="current" tabindex="43"/>&nbsp;Current
                          </div>
                          <span class="full addr2">
                          </span> <label for="bank2accno">Account Number</label><span class="left city">
                          <input id="bank2accno" name="bank2accno" type="text" class="field text addr" value="" maxlength="20" tabindex="44" />
                          </span><label>Branch Address</label> <span class="right state">
                          </span> <label for="bank2addr1">Line 1</label><span class="left zip">
                          <input id="bank2addr1" name="bank2addr1" type="text" class="field text addr" value="" maxlength="39" tabindex="45" required />
                          </span> <label for="bank2addr2">Line 2	</label><span class="left zip">
                          <input id="bank2addr2" name="bank2addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="46" required />
                          </span> <label for="bank2city">Branch City</label><span class="left zip">
                          <input id="bank2city" name="bank2city" type="text" class="field text addr" value="" maxlength="27" tabindex="47"  />
                          </span> <label for="bank2micr">MICR Code</label><span class="left zip">
                          <input id="bank2micr" name="bank2micr" type="text" class="field text addr" value="" maxlength="9" tabindex="48"  />
                          </span> <label for="bank2ifsc">IFSC Code</label><span class="left zip">
                          <input id="bank2ifsc" name="bank2ifsc" type="text" class="field text addr" value="" maxlength="11" tabindex="49"  />
                          </span>
                        </div>
                        <p class="complex instruct" id="instructbank2"><small>Second Bank details here!</small></p>
                      </li>
                    </ul>
                  </div>
                  <div id="bankdetails3" hidden>
                    <ul>
                      <li class="complex notranslate">
                        <div id="bank3details">
                          <span class="full addr1">
                          <label for="bank3name">Name of the Third Bank</label><input id="bank3name" name="bank3name" maxlength="33"  type="text" class="field text addr" value="" tabindex="50" />
                          </span> <label>Account Type</label> 
                          <div>
                            <input type="radio" checked id="bank3acctypes" name="bank3acctype" value="saving" tabindex="51"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="bank3acctypec" name="bank3acctype" value="current" tabindex="52"/>&nbsp;Current
                          </div>
                          <span class="full addr2">
                          </span> <label for="bank3accno">Account Number</label><span class="left city">
                          <input id="bank3accno" name="bank3accno" type="text" class="field text addr" maxlength="20"  value="" tabindex="53" />
                          </span><label>Branch Address</label> <span class="right state">
                          </span> <label for="bank3addr1">Line 1</label><span class="left zip">
                          <input id="bank3addr1" name="bank3addr1" type="text" class="field text addr" value=""  maxlength="39" tabindex="54" required />
                          </span> <label for="bank3addr2">Line 2	</label><span class="left zip">
                          <input id="bank3addr2" name="bank3addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="55" required />
                          </span> <label for="bank3city">Branch City</label><span class="left zip">
                          <input id="bank3city" name="bank3city" type="text" class="field text addr" value="" length="27" tabindex="56"  />
                          </span> <label for="bank3micr">MICR Code</label><span class="left zip">
                          <input id="bank3micr" name="bank3micr" type="text" class="field text addr" value="" maxlength="9" tabindex="57"  />
                          </span> <label for="bank3ifsc">IFSC Code</label><span class="left zip">
                          <input id="bank3ifsc" name="bank3ifsc" type="text" class="field text addr" value="" maxlength="11" tabindex="58"  />
                          </span>
                        </div>
                        <p class="complex instruct" id="instructbank3"><small>Third Bank details here!</small></p>
                      </li>
                    </ul>
                  </div>
                </div>
                <script type="text/javascript">
                  // function addbanksdetails(val){
                  
                  // if(val==2)
                  // {
                  // $('#bankdetails2').show();
                  // $('#addmorebankdetailslink').attr('href','javascript:addbanksdetails(3);');
                  // $('#bank2stat').attr('value','bank2true');
                  // }
                  
                  // if(val==3)
                  // {
                  // $('#bankdetails3').show();
                  // $('#addbankdetailsbutton').empty();
                  // $('#bank3stat').attr('value','bank3true');
                  // }
                  // }
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
                        <select id="applicantvalidyfield" name="applicantvalidy" class="field select medium" tabindex="60">
                          <option value="0" > --Select-- </option>
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
                        <select id="applicantvalidmafield" name="applicantvalidma" class="field select medium" tabindex="61">
                          <option value="0" > --Select-- </option>
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
                      <label for="appnomname">Nominee Name</label> <input id="appnomname" name="appnomname" type="text" class="field text addr medium" value="" tabindex="63" maxlength="33" />
                      </span> 
                      <p class="instruct" id="instructappnomname"><small>About Nominee</small></p>
                    <li class="date eurodate notranslate      ">
                      <label class="desc"> Date Of Birth <span class="req">*</span> </label>
                      <span>
                      <input id="appnomdobd" name="appnomdobd" type="text" class="field text"  value="" size="2" maxlength="2" tabindex="64" />
                      <label for="appnomdobd">DD</label>
                      </span> <span class="symbol">/</span> <span>
                      <input id="appnomdobm" name="appnomdobm" type="text" class="field text"  value="" size="2" maxlength="2" tabindex="65" />
                      <label for="appnomdobm">MM</label>
                      </span> <span class="symbol">/</span> <span>
                      <input id="appnomdoby" name="appnomdoby" type="text" class="field text" value="" size="4" maxlength="4" tabindex="66" />
                      <label for="appnomdoby">YYYY</label>
                      </span>
                      <p class="instruct" id="instructappnomdobd"><small>Your date of birth</small></p>
                    </li>
                    <li>
                      <span class="left zip"><label for="appnompname">Name Of Parent (In Case of Minor)	</label>
                      <input id="appnompname" name="appnompname" type="text" class="field text addr medium" value="" maxlength="30" tabindex="67" />
                      </span> 
                      <p class="instruct" id="instructappnompname"><small>Name Of Parent (In Case of Minor)</small></p>
                    </li>
                    <li>
                      <span class="left zip"><label for="appnomrel">Relationship	</label>
                      <input id="appnomrel" name="appnomrel" type="text" class="field text addr medium" value="" maxlength="16" tabindex="68" />
                      </span> 
                      <p class="instruct" id="instructappnomrel"><small>Relationship</small></p>
                    </li>
                  </ul>
                </div>
                <ul>
                  <li>
                    <span class="left zip">
                    <label for="agreementaccept" id="agreementacceptl"><input tabindex="69" id="agreementaccept" name="agreementaccept" value="agree" type="checkbox">&nbsp;&nbsp;I Have read the terms and Conditions Before investing </label>
                    </span>
                    <p class="instruct" id="instructagreementaccept"><small>Accept before submitting</small></p>
                  </li>
                  <li class="buttons ">
                    <div>
                      <button id="saveForm" name="saveForm" class="btTxt submit fundsInn-btn" tabindex="70">Preview</button>
                     <button id="clearForm" name="clearForm" class="btTxt submit fundsInn-btn" tabindex="71">Clear</button>
                    </div>
                  </li>
                </ul>
              </form>
              <!-- WUFOO FORMS --> 
            </div>
          </div>
        </div>
      </div>
      <?php require("footer.php"); ?>
    </div> <!-- Main Wrapper -->
    <!-- validations -->
    <script type="text/javascript">
      $(document).ready(function(){
        //cp
        tab_index_correction();
       	var post_code_regx = /^\d{6}$/;
      	var panPat = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
      	var ifscPat = /^([a-zA-Z]{4})(\d{3,10})$/;
      	var currentTime = new Date();
      	var month = currentTime.getMonth() + 1;
      	var day = currentTime.getDate();
      	var cyear = currentTime.getFullYear();
      
      	$.validator.addMethod('postalCode',function (value, element){
      	    return this.optional(element) || post_code_regx.test(value);
      	}, 'Please enter a valid Postal/Zip  Code');
      
      	$.validator.addMethod('isPAN',function (value, element){
      	    return this.optional(element) || panPat.test(value);
      	},'Please enter a valid PAN number');
      
      	$.validator.addMethod('isValidAge',function (value, element){
      	    if( ( cyear-( Number(value) ) ) <= 100){
      	    	return true;
      	    }else{
      	    	return false;
      	    }
      	},'this is a Not valid D.O.B');
      
      	$.validator.addMethod('isIFSC',function (value, element){
      	    return this.optional(element) || ifscPat.test(value);
      	}, 'Please enter a valid IFSC code');
                
	  	 $.validator.addMethod("valueNotEquals", function(value, element, arg){
	  		  return arg != value;
	       }, "Please Select the options!");
      
      
        $("#corporateform").validate({
          focusInvalid: false,
              rules:{
               	// "account_type":{required:true},
      			"applicantname":{required:true, maxlength: 62 },
      			"applicantdoidd":{required:true, min: 1, max: 31  },
      			"applicantdoimm":{required:true, min: 1, max: 12  },
      			"applicantdoiyyyy" : {required:true},
      			"applicantpan" : {required:true, isPAN:true },
      			"applicant2contactname" : {required:true},
      			"applicant2contactdes" : {required:true},
      			//"applicant2contactemail":{required:true},
      			"applicant2contacttelr" : {digits: true},
      			"applicant2contacttelo" : {required:true},
      			"applicant2contacttelm" : {required:true, digits: true, minlength:10, maxlength: 10},
      			"applicantocc": {valueNotEquals: "0" }, 
      			"applicantstatus" : {valueNotEquals: "0"},
      			"applicanttaxstatus" : {valueNotEquals: "0"},
      			"applicantpaddr1" : {required:true, maxlength:39},
      			"applicantpaddr2" : {maxlength:39},
      			"applicantpaddr3" : {maxlength:39},
      			"applicantpcity"  : {required:true, maxlength:24}, 
      			"applicantpstate" : {required:true, maxlength:24}, 
      			"applicantpzip"   : {required:true}, 
      			"applicantcaddr1" : {required:true, maxlength:39},
      			"applicantcaddr2" : {maxlength:39},
      			"applicantcaddr3" : {maxlength:39},
      			"applicantccity"  : {required:true, maxlength:24}, 
      			"applicantcstate" : {required:true, maxlength:24}, 
      			"applicantczip"  : {required:true}, 
      			"applicant2_name" : {maxlength: 62 },
      			"applicant2pan" : { isPan:true },
      			"applicant3name" : {maxlength: 62 },
      			"applicant3pan" : { isPan:true }, 
      			"bankname" : { required:true, minlength:2},
      			"bankacctype" : { required:true},
      			"bankaccno" : { required:true, digits:true, maxlength:20},
      			"bankaddr1" : { required:true, maxlength:39},
      			"bankaddr2" : { maxlength:39},
      			"bankcity" : {required:true, maxlength:24},
      			"bankmicr" : {required:true,digits:true,max:999999999},
      			"bankifsc" : {required:true,isIFSC:true},
      			// "bank2name" : {minlength:2},
      			// "bank2accno" : {digits:true, maxlength:20},
      			// "bank2addr1" : { maxlength:39},
      			// "bank2addr2" : { maxlength:39},
      			// "bank2city" : {maxlength:24},
      			// "bank2micr" : {digits:true,max:999999999},
      			// "bank2ifsc" : {isIFSC:true},
      			// "bank3name" : {minlength:2}, 
      			// "bank3accno" : {digits:true, maxlength:20},
      			// "bank3addr1" : { maxlength:39},
      			// "bank3addr2" : { maxlength:39},
      			// "bank3city" : {maxlength:24},
      			// "bank3micr" : {digits:true,max:999999999},
      			//"bank3ifsc" : {isIFSC:true},
      			"appnomname" : { minlength:2},
      			"appnomdobd" : { min: 1, max: 31  },
      			'appnomdobm' : { min: 1, max: 12  },
      			// "appnomdoby" : {isValidAge:true },
      			"appnompname": { minlength:2},
      			"nominee_relationship" :{ maxlength:39},
      			"agreementaccept" :{required:true}
              },
              messages:{
                'applicantname':"Enter Your Full Name!",
                "applicantdoidd":{required:"0-31", min:"0-31", max: "0-31"  },
      		  "applicantdoimm":{required:"0-12", min:"0-12", max:"0-12"  },
      		  "applicantdoiyyyy" : {required:"ex : 1980"}, 
      		  "applicant2contacttelm" : {required:"Enter Your Mobile Number", digits:"Enter Your Mobile Number", minlength:"Enter Your Mobile Number", maxlength: "Enter Your Mobile Number"},
                "appnomdobd" :{required:"0-31", min:"0-31", max: "0-31"  },
      		  'appnomdobm' :{required:"0-12", min:"0-12", max:"0-12"  },
      		  "appnomdoby" :{required:"ex : 1980"},
      		  "agreementaccept" :{required:"Please Accept Terms & Conditions !"}
              },
             errorPlacement: function (error, element) {
             		if($(element).prop("tagName") =="SELECT")
             			error.insertAfter(element.closest(".styled-select"));
             		else
                 		error.insertAfter(element);
             }
         });
     // agreements
       function prevent_default(){
         $("#corporateform input").each(function(key,value){ 
            if($(value).removeAttr("id")!="saveForm" && $(value).attr("id")!="clearForm"){  
            $(value).removeAttr("disabled");} });
          $("#corporateform select").each(function(key,value){ $(value).removeAttr("disabled","disabled");});
          $("#saveForm").text("Preview");
          $("#clearForm").text("Clear");
          alert("chaged Default")
        }
        
        function scroll_top(){
           $("html, body").animate({ scrollTop: 180 }, 600);
        }

       $(document).on("click","#saveForm","click",function(){
        
        if($("#saveForm").text()=="Submit"){
          if($("#corporateform").valid()){
          alert("Please verify all the fields Before Submit !");
          prevent_default();
          send();}else{
            scroll_top();
          }
        }else if($("#saveForm").text()=="Preview"){
          if($("#corporateform").valid()){
          $("#corporateform input").each(function(key,value){ 
            if(($(value).attr("id")!="saveForm") && ($(value).attr("id")!="clearForm")){  
            $(value).attr("disabled","disabled");} });
          $("#corporateform select").each(function(key,value){$(value).attr("disabled","disabled");});
           $("#saveForm").removeAttr("disabled");
          $("#clearForm").removeAttr("disabled");
          $("#saveForm").text("Submit");
          $("#clearForm").text("Edit");
          scroll_top();
          }else{
             scroll_top();
          }
        }
        return false;
       });
       
       // 
       $(document).on("click","#clearForm",function(){
        if($("#clearForm").text()=="Clear"){
         formReset();
         scroll_top();
        }else if($("#clearForm").text()=="Edit"){
          prevent_default();
          scroll_top();
        }
        return false;
       });


      });
    </script>
  </body>
</html>
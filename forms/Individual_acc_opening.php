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
        //tab Correction
        function tab_index_correction()
         {
          var count=1;
          $("#individualform :input").each(function(k,v){
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
          // for ( var attrname in eattr)
          // {
          //  if(eattr[attrname]!="TRUE")
          //  {
          //    if(document.getElementById(attrname))
          //    { 
          //      $('#'+attrname).removeClass("error");
          //    }
          //  }
          // }
          if($('#individualform').valid())
          {     // make the AJAX request
          var dataString = $('#individualform').serialize();
          $.ajax({
              type: "POST",
              url: 'individual_db_store.php',
              data: dataString,
              dataType: 'json',
              success: function (data) {
                console.log(data);
                 if(data=="1"){
                
                  window.location.hash = '#topfundsinn';
                }else{
                
                    //window.location.hash = '#topfundsinn';
                    $("#headerMenu").scrollTop();
                    
              }
              
          },
          error: function (error) {
            {
                  $('#errordis').html("<h3>Unable to Process your request please try agian</h3>");
                    $('#errordis').addClass("er");
                    window.location.hash = '#topfundsinn';
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
              <form id="individualform" name="individualform" class="wufoo leftLabel page"  novalidate method="post" > <!-- action="javascript:send();"> -->
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
                        
                        
                        ?>data-required="true" tabindex="1" name="account_type" type="radio" value="Individual" checked>&nbsp;Individual&nbsp;&nbsp;&nbsp;&nbsp;
                      <input id="redirectNRI" name="account_type" type="radio" tabindex="2" value="NRI">&nbsp;NRI&nbsp;&nbsp;&nbsp;&nbsp;
                      <input id="redirectCorp"  name="account_type" type="radio" tabindex="3" value="Corporate">&nbsp;Corporate/HUF&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <p class="instruct" id="instructaccount_type"><small>Please select A/C type.</small></p>
                  </li>
                  <!-- investor_details -->
                  <li class="notranslate">
                    <label class="desc" for="applicant_name"> Name of the Applicant <span class="req">*</span> </label>
                    <div>
                      <input id="applicantname" name="applicant_name" type="text" class="field text medium" value="" maxlength="62" tabindex="4" />
                    </div>
                    <p class="instruct" id="instructapplicantname"><small>Please Enter your name as per PAN card </small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc " for="applicant_father_name"> Father's Name <span class="req">*</span> </label>
                    <div>
                      <input id="applicantfname" name="applicant_father_name" type="text" class="field text nospin medium" value="" maxlength="54" tabindex="5" onKeyUp="" />
                    </div>
                    <p class="instruct " id="instructapplicantfname"><small>Please enter your father's name as per PAN card</small></p>
                  </li>
                  <li class="date eurodate notranslate">
                    <label class="desc"> Date of Birth <span class="req">*</span> </label>
                    <span>
                    <input id="applicantdobdd" name="applicant_dob" type="text" class="field text" value="" size="2" maxlength="2" tabindex="6" />
                    <label for="applicant_dobdd">DD</label>
                    </span> <span class="symbol">/</span> <span>
                    <input id="applicantdobmm" name="applicantdobmm" type="text" class="field text" value="" size="2" maxlength="2" tabindex="7" />
                    <label for="applicantdobmm">MM</label>
                    </span> <span class="symbol">/</span> <span>
                    <input id="applicantdobyyyy" name="applicantdobyyyy" type="text" class="field text" value="" size="4" maxlength="4" tabindex="8" />
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
                    <fieldset>
                      <legend class="desc">  Maritial Status <span class="req">*</span> </legend>
                      <div>
                        <span>
                        <input id="applicantmaleradio" name="maritial_status" type="radio" class="field radio" value="Single" tabindex="11" checked="checked" />
                        <label class="choice" for="applicantmaleradio" > Single</label>
                        </span> <span>
                        <input id="applicantfemaleradio" name="maritial_status" type="radio" class="field radio" value="Married" tabindex="12" />
                        <label class="choice" for="applicantfemaleradio" > Married</label>
                        </span> 
                      </div>
                    </fieldset>
                    <p class="instruct" id="maritial-status-radio"><small>Maritial Status</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="applicantpan"> PAN Number <span class="req">*</span> </label>
                    <div>
                      <input id="applicantpan" class="field text medium" name="applicant_pan" tabindex="13" maxlength="13" type="text" value="" />
                    </div>
                    <p class="instruct" id="instructapplicantpan"><small>Please Enter your PAN card number</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc"  for="phone_resi"> Tele Number (Residential) </label>
                    <div>
                      <input id="applicanttelr" class="field text medium" name="phone_resi" tabindex="14" type="tel" maxlength="12" value="" />
                    </div>
                    <p class="instruct" id="instructapplicanttelr"><small>Please Enter your Residential number</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="phone_office"> Tele Number (Office):  </label>
                    <div>
                      <input id="applicanttelo" class="field text medium" name="phone_office" tabindex="15" type="tel" maxlength="15" value="" />
                    </div>
                    <p class="instruct" id="instructapplicanttelo"><small>Please Enter your office Number</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="mobile"> Moblie Number:  <span class="req">*</span> </label>
                    <div>
                      <input id="applicanttelm" class="field text medium" name="mobile" tabindex="16" type="tel" maxlength="11" value="" />
                    </div>
                    <p class="instruct" id="instructapplicanttelm"><small>Please Enter your mobile no </br> 9XXXXXXXX9</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="email"> Email address :  <span class="req">*</span> </label>
                    <div>
                      <input id="applicantemail" class="field text medium" name="email" tabindex="17" maxlength="37" type="email" value=<?php echo $email?> readonly />
                    </div>
                    <p class="instruct" id="instructapplicantemail"><small>Re sign-up to change your email address</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" id="occupation"> Occupation <span class="req">*</span> </label>
                    <div>
                      <div class="styled-select">
                        <select  name="occupation" class="field select medium" tabindex="18">
                          <option value="0" selected="selected"> --Select-- </option>
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
                      <input id="applicantpaddr1" name="perm_addr1" type="text" class="field text addr" value="" tabindex="19" maxlength="39" />
                      </span>  <label for="applicantpaddr2">Address Line 2</label><span class="full addr2">
                      <input id="applicantpaddr2" name="perm_addr2" type="text" class="field text addr" value="" tabindex="20" maxlength="39" />
                      </span>  <label for="applicantpaddr3">Address Line 3</label><span class="full addr2">
                      <input id="applicantpaddr3" name="perm_paddr3" type="text" class="field text addr" value="" tabindex="21" maxlength="39" />
                      </span> <label for="applicantpcity">City</label> <span class="left city">
                      <input id="applicantpcity" name="perm_city" type="text" class="field text addr" value="" tabindex="22" maxlength="27"/>
                      </span>  <label for="applicantpstate">State</label><span class="right state">
                      <div class="styled-select">
                      <select id="applicantpstate" name="perm_state" type="text" class="field select medium" value="" tabindex="23">
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
                      </span><label for="perm_zip">Postal / Zip Code</label> <span class="left zip">
                      <input id="applicantpzip" name="perm_zip" type="text" class="field text addr" value="" maxlength="6" tabindex="24"/>
                      </span> 
                    </div>
                    <p class="complex instruct" id="instructapplicantpaddr"><small>Please enter your address As per your permanent address proof</small></p>
                  </li>
                </ul>
                <ul>
                  <li class="complex notranslate">
                    <label class="desc" for="applicantpaddrcheck">  <input type="checkbox" tabindex="25" id="applicantpaddrcheck" name="applicantpaddrcheck" value="same" onChange="javascript:$('#applicantcommunicationaddress').toggle();"> &nbsp; Same Address for communication</label>
                    <p class="complex instruct" id="instructapplicantpaddrcheck"><small>Addres for communication</small></p>
                  </li>
                </ul>
                <ul id="applicantcommunicationaddress" >
                  <li class="complex notranslate">
                    <label class="desc" > Communication Address <span class="req">*</span> </label>
                    <div> <label for="applicantcaddr1">Address Line 1</label><span class="full addr1">
                      <input id="applicantcaddr1" name="temp_addr1" type="text" class="field text addr" value="" tabindex="" maxlength="39"/>
                      </span>  <label for="applicantcaddr2">Address Line 2</label><span class="full addr2">
                      <input id="applicantcaddr2" name="temp_addr2" type="text" class="field text addr" value="" tabindex=""  maxlength="39" />
                      </span> <label for="applicantcaddr3">Address Line 3</label><span class="full addr2">
                      <input id="applicantcaddr3" name="temp_addr3" type="text" class="field text addr" value="" tabindex=""  maxlength="39" />
                      </span><label for="applicantccity">City</label> <span class="left city">
                      <input id="applicantccity" name="temp_city" type="text" class="field text addr" value="" tabindex="" maxlength="27"/>
                      </span>  <label for="applicantcstate">State</label><span class="right state">
                       <div class="styled-select">
                      <select id="applicantcstate" name="temp_state" type="text" class="field select medium" value="" tabindex="">
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
                      <input id="applicantczip" name="temp_zip" type="text" class="field text addr" value="" maxlength="6" tabindex=""/>
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
                          <input id="applicant2name" name="applicant2_name" type="text" class="field text medium" value="" rel="extra" maxlength="62" tabindex="" onKeyUp="" autofocus />
                        </div>
                        <p class="instruct" id="instructapplicant2name"><small>Please Enter your second applicant's name</small></p>
                      </li>
                      <li class="notranslate">
                        <label class="desc" for="applicant2pan"> second applicant PAN Number <span class="req">*</span> </label>
                        <div>
                          <input id="applicant2pan" class="field text medium" name="applicant2_pan" rel="extra" tabindex="28" type="text" value="" />
                        </div>
                        <p class="instruct" id="instructapplicant2pan"><small>Please Enter second Applicant's PAN card NO</small></p>
                      </li>
                    </ul>
                  </div>
                  <ul id="investor3" hidden>
                    <li class="notranslate">
                      <label class="desc" for="applicant3name"> Name of the Third applicant <span class="req">*</span> </label>
                      <div>
                        <input id="applicant3name" name="applicant3_name" type="text" class="field text medium" rel="extra" value="" maxlength="62" tabindex="29" onKeyUp=""  autofocus />
                      </div>
                      <p class="instruct" id="instructapplicant3name"><small>Please Enter your Third applicant's name</small></p>
                    </li>
                    <li class="notranslate">
                      <label class="desc" for="applicant3pan"> Third applicant PAN Number <span class="req">*</span> </label>
                      <div>
                        <input id="applicant3pan" class="field text medium" name="applicant3_pan" tabindex="30" rel="extra" type="text" value="" />
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
                      <label for="bankname">Name of the Bank</label><input id="bankname" maxlength="33"  name="bankname" type="text" class="field text addr" value="" onChange="bankval(this.value,'bankname','instructbank')"  tabindex="27" />
                      </span> <label>Account Type</label> 
                      <div>
                        <input type="radio" checked id="bankacctypes" name="bank_acc_type" value="saving" tabindex="32"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="bankacctypec" name="bank_acc_type" value="current" tabindex="33"/>&nbsp;Current
                      </div>
                      <span class="full addr2">
                            
                      </span> <label for="bankaccno">Account Number</label><span class="left city">
                      <input id="bankaccno" name="bank_acc_no" type="text" class="field text addr" value="" tabindex="28" maxlength="20" />
                      </span><label>Branch Address</label> <span class="right state">
                      </span> <label for="bankaddr1">Line 1</label><span class="left zip">
                      <input id="bankaddr1" name="bank_addr1" type="text" class="field text addr" value="" maxlength="39" tabindex="29" />
                      </span> <label for="bankaddr2">Line 2 </label><span class="left zip">
                      <input id="bankaddr2" name="bank_addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="30" />
                      </span> <label for="bankcity">Branch City</label><span class="left zip">
                      <input id="bankcity" name="bank_city" type="text" class="field text addr" value="" maxlength="27" tabindex="31"/>
                    
                       </span> <label for="bank_micr">MICR Code</label><span class="left zip">
                      <input id="bankmicr" name="bankmicr" type="text" class="field text addr" value="" maxlength="9" tabindex="32"  />
                      </span> <label for="bankifsc">IFSC Code</label><span class="left zip">
                      <input id="bankifsc" name="bankifsc" type="text" class="field text addr" value="" maxlength="11"  tabindex="33"  />
                    </div>
                    <p class="complex instruct" id="instructbank"><small>Please Enter your Bank details </small></p>
                  </span> 
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
                            <label for="bank2name">Name of the Second Bank</label><input id="bank2name" maxlength="33"  name="bank2name" type="text" class="field text addr" value="" tabindex="40" />
                          </span> <label>Account Type</label> 
                          <div>
                            <input type="radio" checked id="bank2acctypes" name="bank2acctype" value="saving" tabindex="41"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="bank2acctypec" name="bank2acctype" value="current" tabindex="42"/>&nbsp;Current
                          </div>
                          <span class="full addr2">
                          </span> <label for="bank2accno">Account Number</label><span class="left city">
                          <input id="bank2accno" name="bank2accno" type="text" class="field text addr" value="" maxlength="20" tabindex="43" />
                          </span><label>Branch Address</label> <span class="right state">
                          </span> <label for="bank2addr1">Line 1</label><span class="left zip">
                          <input id="bank2addr1" name="bank2addr1" type="text" class="field text addr" value="" maxlength="39" tabindex="44"/>
                          </span> <label for="bank2addr2">Line 2  </label><span class="left zip">
                          <input id="bank2addr2" name="bank2addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="45" />
                          </span> <label for="bank2city">Branch City</label><span class="left zip">
                          <input id="bank2city" name="bank2city" type="text" class="field text addr" value="" maxlength="27" tabindex="46"  />
                          </span> <label for="bank2micr">MICR Code</label><span class="left zip">
                          <input id="bank2micr" name="bank2micr" type="text" class="field text addr" value="" maxlength="9" tabindex="47"  />
                          </span> <label for="bank2ifsc">IFSC Code</label><span class="left zip">
                          <input id="bank2ifsc" name="bank2ifsc" type="text" class="field text addr" value="" maxlength="11" tabindex="48"  />
                          </span>
                        </div>
                        <p class="complex instruct" id="instructbank2"><small>Please Enter your Second Bank details </small></p>
                      </li>
                    </ul>
                  </div>
                  <div id="bankdetails3" hidden>
                    <ul>
                      <li class="complex notranslate">
                        <div id="bank3details">
                          <span class="full addr1">
                          <label for="bank3name">Name of the Third Bank</label>
                          <input id="bank3name" name="bank3name" maxlength="33" type="text" class="field text addr" value="" tabindex="49" />
                          </span> <label>Account Type</label> 
                          <div>
                            <input type="radio" checked id="bank3acctypes" name="bank3acctype" value="saving" tabindex="50"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="bank3acctypec" name="bank3acctype" value="current" tabindex="51"/>&nbsp;Current
                          </div>
                          <span class="full addr2">
                          </span> <label for="bank3accno">Account Number</label><span class="left city">
                          <input id="bank3accno" name="bank3accno" type="text" class="field text addr" maxlength="20" value="" tabindex="52" />
                          </span><label>Branch Address</label> <span class="right state">
                          </span> <label for="bank3addr1">Line 1</label><span class="left zip">
                          <input id="bank3addr1" name="bank3addr1" type="text" class="field text addr" value="" maxlength="39" tabindex="53" />
                          </span> <label for="bank3addr2">Line 2  </label><span class="left zip">
                          <input id="bank3addr2" name="bank3addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="54" />
                          </span> <label for="bank3city">Branch City</label><span class="left zip">
                          <input id="bank3city" name="bank3city" type="text" class="field text addr" value="" maxlength="27" tabindex="55"  />
                          </span> <label for="bank3micr">MICR Code</label><span class="left zip">
                          <input id="bank3micr" name="bank3micr" type="text" class="field text addr" value="" maxlength="9" tabindex="56"  />
                          </span> <label for="bank3ifsc">IFSC Code</label><span class="left zip">
                          <input id="bank3ifsc" name="bank3ifsc" type="text" class="field text addr" value="" maxlength="11" tabindex="57"  />
                          </span>
                        </div>
                        <p class="complex instruct" id="instructbank3"><small>Please Enter your Third Bank details </small></p>
                      </li>
                    </ul>
                  </div>
                </div>
                <script type="text/javascript">
                  // function addbanksdetails(val){
                  //   if(val==2)
                  //   {
                  //   $('#bankdetails2').show();
                  //   $('#addmorebankdetailslink').attr('href','javascript:addbanksdetails(3);');
                  //   $('#bank2stat').attr('value','bank2true');
                  //   }
                    
                  //   if(val==3)
                  //   {
                  //   $('#bankdetails3').show();
                  //   $('#addbankdetailsbutton').empty();
                  //   $('#bank3stat').attr('value','bank3true');
                  //   }
                  // }
                </script>
                 <!--<ul id="addbankdetailsbutton">
                  <li id="bankdetailsbutton" class="buttons">
                    <a id="addmorebankdetailslink" class="btTxt submit fundsInn-btn" href="javascript:addbanksdetails(2);" >Add More Banks</a>
                  </li> 
                </ul>-->
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
                        <select class="field select medium" id="applicantvalidyfield" name="applicantvalidy" tabindex="59">
                          <option value="" selected="selected"> --Select-- </option>
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
                        <select id="applicantvalidmafield" class="field select medium" name="applicantvalidma" tabindex="60">
                          <option value="" selected="selected"> --Select-- </option>
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
                    <label for="aplicantnomcheckbox"> 
                    <input type="checkbox" name="aplicantnomcheckbox" id="aplicantnomcheckbox" onchange="javascript:$('#appnomineedetails').toggle();" value="appnomineefalse" tabindex="61"> &nbsp;&nbsp;I Do not wish to make nomination<br/><br/></label> 
                    <p class="instruct" id="instructnomineedetailcheckbox"><small>Nominee details</small></p>
                  </li>
                </ul>
                <div id="appnomineedetails">
                  <ul>
                    <li>
                      <span class="left city">
                      <label for="appnomname">Nominee Name</label> 
                      <input id="appnomname" name="nomineename" type="text" class="field text addr medium" value="" tabindex="62" maxlength="33" />
                      </span> 
                      <p class="instruct" id="instructappnomname"><small>About Nominee</small></p>
                    <li class="date eurodate notranslate      ">
                      <label class="desc"> Date Of Birth <span class="req">*</span> </label>
                      <span>
                      <input id="appnomdobd" name="nomineedobd" type="text" class="field text"  value="" size="2" maxlength="2" tabindex="63"  />
                      <label for="appnomdobd">DD</label>
                      </span> <span class="symbol">/</span> <span>
                      <input id="appnomdobm" name="nomineedobm" type="text" class="field text " value="" size="2" maxlength="2" tabindex="64"  />
                      <label for="appnomdobm">MM</label>
                      </span> <span class="symbol">/</span> <span>
                      <input id="appnomdoby" name="nomineedoby" type="text" class="field text " value="" size="4" maxlength="4" tabindex="65" />
                      <label for="appnomdoby">YYYY</label>
                      </span>
                      <p class="instruct" id="instructappnomdobd"><small>Your date of birth</small></p>
                    </li>
                    <li>
                      <span class="left zip"><label for="appnompname">Name Of Parent (In Case of Minor) </label>
                      <input id="appnompname" name="nominee_parent_name" type="text" class="field text addr medium" value="" maxlength="30" tabindex="66" />
                      </span> 
                      <p class="instruct" id="instructappnompname"><small>Name Of Parent (In Case of Minor)</small></p>
                    </li>
                    <li>
                      <span class="left zip"><label for="appnomrel">Relationship  </label>
                      <input id="appnomrel" name="nominee_relationship" type="text" class="field text addr medium" value="" maxlength="16" tabindex="67" />
                      </span> 
                      <p class="instruct" id="instructappnomrel"><small>Relationship</small></p>
                    </li>
                  </ul>
                </div>
                <ul>
                  <li>
                    <span class="left zip">
                    <label for="agreementaccept" id="agreementacceptl"><input tabindex="68" id="agreementaccept" name="agreementaccept" value="agree" type="checkbox">&nbsp;&nbsp;I Have read the terms and Conditions Before investing </label>
                    </span>
                    <p class="instruct" id="instructagreementaccept"><small>Accept before submitting</small></p>
                  </li>
                  <li class="buttons ">
                    <div>
                      <button id="saveForm" name="saveForm" class="btTxt submit fundsInn-btn" tabindex="69">Preview</button>
                      <button id="clearForm" name="clearForm" class="btTxt submit fundsInn-btn" tabindex="70">Clear</button>
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
      <?php require("footer.php"); ?>
    </div>
    <!-- validations -->
    <script type="text/javascript">
      $(document).ready(function(){
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
        }, 'Please enter a valid Postal/Zip Code');
      
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
      
        $("#individualform").validate({
          focusInvalid: false,
              rules:{
            // "account_type":{required:true},
            "applicant_name":{required:true, maxlength: 62 },
            "applicant_father_name":{required:true, maxlength: 54 },
            "applicant_dob":{required:true, min: 1, max: 31  },
            "applicantdobmm":{required:true, min: 1, max: 12  },
            "applicantdobyyyy" : {required:true, isValidAge:true },
            "applicant_gender": {required:true},
            "applicant_pan" : {required:true, isPAN:true },
            "phone_resi": {digits: true},
            "phone_office" : {digits: true},
            "mobile" : {required:true, digits: true, minlength:10, maxlength: 10},
            "occupation": {required:true, valueNotEquals: "0" },  
            "perm_addr1": {required:true, maxlength:39},
            "perm_addr2" : {maxlength:39},
            "perm_addr3" : {maxlength:39},
            "perm_city"  : {required:true, maxlength:24}, 
            "perm_state" : {required:true}, 
            "perm_zip"  : {required:true, postalCode:true}, 
            "temp_addr1" : {required:true, maxlength:39},
            "temp_addr2" : {maxlength:39},
            "temp_addr3" : {maxlength:39},
            "temp_city" : {required:true, maxlength:24}, 
            "temp_state" : {required:true}, 
            "temp_zip"  : {required:true, postalCode:true}, 
            "applicant2_name" : {maxlength: 62 },
            "applicant2_pan" : { isPan:true },
            "applicant3_name" : {maxlength: 62 },
            "applicant3_pan" : { isPan:true }, 
            "bankname" :{ required:true, minlength:2},
            "bank_acc_type" :{ required:true},
            "bank_acc_no"   :{ required:true, digits:true, maxlength:20},
            "bank_addr1" : { required:true, maxlength:39},
            "bank_addr2" : { maxlength:39},
            "bank_city" : {required:true, maxlength:24},
            "bankmicr" : {required:true,digits:true,max:999999999},
            "bankifsc" : {required:true, isIFSC:true},
            // "bank2name" : {minlength:2},
            // "bank2accno" :{digits:true, maxlength:20},
            // "bank2addr1" : { maxlength:39},
            // "bank2addr2" : { maxlength:39},
            // "bank2city" :{maxlength:24},
            // "bank2micr" :{digits:true,max:999999999},
            // "bank2ifsc" :{isIFSC:true},
            // "bank3name" : {minlength:2}, 
            // "bank3accno" :{digits:true, maxlength:20},
            // "bank3addr1" : { maxlength:39},
            // "bank3addr2" :{ maxlength:39},
            // "bank3city" :{maxlength:24},
            // "bank3micr" : {digits:true,max:999999999},
            // "bank3ifsc" :{isIFSC:true},
            "nomineename" :{ minlength:2},
            "nomineedobd" :{ min: 1, max: 31  },
            'nomineedobm' :{ min: 1, max: 12  },
            //"nomineedoby" :{isValidAge:true },
            "nominee_parent_name": { minlength:2},
            "appnomrel" :{ maxlength:39},
            "agreementaccept" :{required:true}
              },
              messages:{
                'applicant_name':"Enter Your Full Name!",
                "applicant_dob":{required:"0-31", min:"0-31", max: "0-31"  },
                "applicantdobmm":{required:"0-12", min:"0-12", max:"0-12"  },
                "applicantdobyyyy" : {required:"ex : 1980"}, 
                "mobile" : {required:"Enter Your Mobile Number", digits:"Enter Your Mobile Number", minlength:"Enter Your Mobile Number", maxlength: "Enter Your Mobile Number"},
                "nomineedobd" :{required:"0-31", min:"0-31", max: "0-31"  },
                'nomineedobm' :{required:"0-12", min:"0-12", max:"0-12"  },
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
         $("#individualform input").each(function(key,value){ 
            if($(value).removeAttr("id")!="saveForm" && $(value).attr("id")!="clearForm"){  
            $(value).removeAttr("disabled");} });
          $("#individualform select").each(function(key,value){ $(value).removeAttr("disabled","disabled");});
          $("#saveForm").text("Preview");
          $("#clearForm").text("Clear");
          //alert("chaged Default")
        }
        
        function scroll_top(){
           $("html, body").animate({ scrollTop: 180 }, 600);
        }

       $(document).on("click","#saveForm","click",function(){
        
        if($("#saveForm").text()=="Submit"){
          if($("#individualform").valid()){
          alert("Please verify all the fields Before Submit !");
          prevent_default();
          send();}else{
            scroll_top();
          }
        }else if($("#saveForm").text()=="Preview"){
          if($("#individualform").valid()){
          $("#individualform input").each(function(key,value){ 
            if(($(value).attr("id")!="saveForm") && ($(value).attr("id")!="clearForm")){  
            $(value).attr("disabled","disabled");} });
          $("#individualform select").each(function(key,value){$(value).attr("disabled","disabled");});
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
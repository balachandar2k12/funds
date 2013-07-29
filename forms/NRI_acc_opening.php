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
          if($('#nriform').valid())
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
                  var err=data.error;
                  
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
              <form id="nriform" name="nriform" class="wufoo leftLabel page" method="post" > <!-- action="javascript:send();"> -->
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
                      <input id="applicantname" name="applicantname" type="text" class="field text medium" value="" maxlength="62" tabindex="4"  />
                      <!-- onChange="alphareq(this.value,'applicantname','instructapplicantname') -->
                    </div>
                    <p class="instruct" id="instructapplicantname"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc " for="applicantfname"> Father's Name <span class="req">*</span> </label>
                    <div>
                      <input id="applicantfname" name="applicantfname" type="text" class="field text nospin medium" value="" maxlength="54" tabindex="5" onKeyUp="" />
                    </div>
                    <p class="instruct " id="instructapplicantfname"><small>Only letters, Maximum Only 54 Characters all in CAPS</small></p>
                  </li>
                  <li class="date eurodate notranslate">
                    <label class="desc"> Date of Birth <span class="req">*</span> </label>
                    <span>
                    <input id="applicantdobdd" name="applicantdobdd" type="text" class="field text" value="" size="2" maxlength="2" tabindex="6" />
                    <label for="applicantdobdd">DD</label>
                    </span> <span class="symbol">/</span> <span>
                    <input id="applicantdobmm" name="applicantdobmm" type="text" class="field text" value="" size="2" maxlength="2" tabindex="7" />
                    <label for="applicantdobmm">MM</label>
                    </span> <span class="symbol">/</span> <span>
                    <input id="applicantdobyyyy" name="applicantdobyyyy" type="text" class="field text" value="" size="4" maxlength="4" tabindex="8" />
                    <label for="applicantdobyyyy">YYYY</label>
                    </span>
                    <p class="instruct" id="instructapplicantdobdd"><small>Enter date of birth</small></p>
                  </li>
                  <li class="notranslate">
                    <fieldset>
                      <legend class="desc"> Gender <span class="req">*</span> </legend>
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
                      <input id="applicantpan" class="field text medium" name="applicantpan" tabindex="11" maxlength="10" type="text" value="" />
                    </div>
                    <p class="instruct" id="instructapplicantpan"><small>Your pan number</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc"  for="applicanttelr"> Tele Number (Residential) </label>
                    <div>
                      <input id="applicanttelr" class="field text medium" name="applicanttelr" tabindex="12" type="tel" maxlength="12" value="" />
                    </div>
                    <p class="instruct" id="instructapplicanttelr"><small>Only Number 10 Digits</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="applicanttelo"> Tele Number (Office):  </label>
                    <div>
                      <input id="applicanttelo" class="field text medium" name="applicanttelo" tabindex="13" type="tel" maxlength="15" value="" />
                    </div>
                    <p class="instruct" id="instructapplicanttelo"><small>Only Number 10 Digits</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="applicanttelm"> Moblie Number:  <span class="req">*</span> </label>
                    <div>
                      <input id="applicanttelm" class="field text medium" name="applicanttelm" tabindex="14" type="tel" maxlength="11" value="" />
                    </div>
                    <p class="instruct" id="instructapplicanttelm"><small>+91 (only ten Digits Number)</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" for="applicantemail"> Email address :  <span class="req">*</span> </label>
                    <div>
                      <input id="applicantemail" value=<?php echo $email?> class="field text medium" name="applicantemail" tabindex="14" maxlength="37" type="email" readonly />
                    </div>
                    <p class="instruct" id="instructapplicantemail"><small>Enter your valid email address</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" id="applicantocc"> Occupation <span class="req">*</span> </label>
                    <div>
                      <div class="styled-select">
                        <select  name="applicantocc" class="field select medium required" tabindex="15">
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
                    <p class="instruct" id="instructapplicantocc"><small>Your occupation</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" id="applicanttaxstatus">Tax Status <span class="req">*</span> </label>
                    <div>
                      <div class="styled-select">
                        <select  name="applicanttaxstatus" class="field select medium" >
                          <option value="0" selected="selected"> --Select-- </option>
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
                          <option value="Others">Others</option>
                        </select>
                      </div>
                    </div>
                    <p class="instruct" id="instructapplicanttaxstatus"><small>Your Tax Status</small></p>
                  </li>
                  <li class="notranslate">
                    <label class="desc" id="applicantnat">Nationality <span class="req">*</span> </label>
                    <div>
                      <div class="styled-select">
                        <select  name="applicantnat" class="field select medium">
                          <option value="0" selected="selected"> --Select-- </option>
                          <option value="0">none</option>
                          <option value="Afghanistan">Afghanistan</option>
                          <option value="Albania">Albania</option>
                          <option value="Algeria">Algeria</option>
                          <option value="American Samoa">American Samoa</option>
                          <option value="Andorra">Andorra</option>
                          <option value="Angola">Angola</option>
                          <option value="Anguilla">Anguilla</option>
                          <option value="Antarctica">Antarctica</option>
                          <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                          <option value="Argentina">Argentina</option>
                          <option value="Armenia">Armenia</option>
                          <option value="Aruba">Aruba</option>
                          <option value="Australia">Australia</option>
                          <option value="Austria">Austria</option>
                          <option value="Azerbaijan">Azerbaijan</option>
                          <option value="Bahamas">Bahamas</option>
                          <option value="Bahrain">Bahrain</option>
                          <option value="Bangladesh">Bangladesh</option>
                          <option value="Barbados">Barbados</option>
                          <option value="Belarus">Belarus</option>
                          <option value="Belgium">Belgium</option>
                          <option value="Belize">Belize</option>
                          <option value="Benin">Benin</option>
                          <option value="Bermuda">Bermuda</option>
                          <option value="Bhutan">Bhutan</option>
                          <option value="Bolivia">Bolivia</option>
                          <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                          <option value="Botswana">Botswana</option>
                          <option value="Bouvet Island">Bouvet Island</option>
                          <option value="Brazil">Brazil</option>
                          <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                          <option value="Brunei Darussalam">Brunei Darussalam</option>
                          <option value="Bulgaria">Bulgaria</option>
                          <option value="Burkina Faso">Burkina Faso</option>
                          <option value="Burundi">Burundi</option>
                          <option value="Cambodia">Cambodia</option>
                          <option value="Cameroon">Cameroon</option>
                          <option value="Canada">Canada</option>
                          <option value="Cape Verde">Cape Verde</option>
                          <option value="Cayman Islands">Cayman Islands</option>
                          <option value="Central African Republic">Central African Republic</option>
                          <option value="Chad">Chad</option>
                          <option value="Chile">Chile</option>
                          <option value="China">China</option>
                          <option value="Christmas">Christmas Island</option>
                          <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                          <option value="Colombia">Colombia</option>
                          <option value="Comoros">Comoros</option>
                          <option value="Congo">Congo</option>
                          <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                          <option value="Cook Islands">Cook Islands</option>
                          <option value="Costa Rica">Costa Rica</option>
                          <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                          <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                          <option value="Cuba">Cuba</option>
                          <option value="Cyprus">Cyprus</option>
                          <option value="Czech Republic">Czech Republic</option>
                          <option value="Denmark">Denmark</option>
                          <option value="Djibouti">Djibouti</option>
                          <option value="Dominica">Dominica</option>
                          <option value="Dominican Republic">Dominican Republic</option>
                          <option value="East Timor">East Timor</option>
                          <option value="Ecuador">Ecuador</option>
                          <option value="Egypt">Egypt</option>
                          <option value="El Salvador">El Salvador</option>
                          <option value="Equatorial Guinea">Equatorial Guinea</option>
                          <option value="Eritrea">Eritrea</option>
                          <option value="Estonia">Estonia</option>
                          <option value="Ethiopia">Ethiopia</option>
                          <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                          <option value="Faroe Islands">Faroe Islands</option>
                          <option value="Fiji">Fiji</option>
                          <option value="Finland">Finland</option>
                          <option value="France">France</option>
                          <option value="France, Metropolitan">France, Metropolitan</option>
                          <option value="French Guiana">French Guiana</option>
                          <option value="French Polynesia">French Polynesia</option>
                          <option value="French Southern Territories">French Southern Territories</option>
                          <option value="Gabon">Gabon</option>
                          <option value="Gambia">Gambia</option>
                          <option value="Georgia">Georgia</option>
                          <option value="Germany">Germany</option>
                          <option value="Ghana">Ghana</option>
                          <option value="Gibraltar">Gibraltar</option>
                          <option value="Greece">Greece</option>
                          <option value="Greenland">Greenland</option>
                          <option value="Grenada">Grenada</option>
                          <option value="Guadeloupe">Guadeloupe</option>
                          <option value="Guam">Guam</option>
                          <option value="Guatemala">Guatemala</option>
                          <option value="Guinea">Guinea</option>
                          <option value="Guinea-Bissau">Guinea-Bissau</option>
                          <option value="Guyana">Guyana</option>
                          <option value="Haiti">Haiti</option>
                          <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                          <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                          <option value="Honduras">Honduras</option>
                          <option value="Hong Kong">Hong Kong</option>
                          <option value="Hungary">Hungary</option>
                          <option value="Iceland">Iceland</option>
                          <option value="India">India</option>
                          <option value="Indonesia">Indonesia</option>
                          <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                          <option value="Iraq">Iraq</option>
                          <option value="Ireland">Ireland</option>
                          <option value="Israel">Israel</option>
                          <option value="Italy">Italy</option>
                          <option value="Jamaica">Jamaica</option>
                          <option value="Japan">Japan</option>
                          <option value="Jordan">Jordan</option>
                          <option value="Kazakhstan">Kazakhstan</option>
                          <option value="Kenya">Kenya</option>
                          <option value="Kiribati">Kiribati</option>
                          <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                          <option value="Korea, Republic of">Korea, Republic of</option>
                          <option value="Kuwait">Kuwait</option>
                          <option value="Kyrgyzstan">Kyrgyzstan</option>
                          <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                          <option value="Latvia">Latvia</option>
                          <option value="Lebanon">Lebanon</option>
                          <option value="Lesotho">Lesotho</option>
                          <option value="Liberia">Liberia</option>
                          <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                          <option value="Liechtenstein">Liechtenstein</option>
                          <option value="Lithuania">Lithuania</option>
                          <option value="Luxembourg">Luxembourg</option>
                          <option value="Macau">Macau</option>
                          <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                          <option value="Madagascar">Madagascar</option>
                          <option value="Malawi">Malawi</option>
                          <option value="Malaysia">Malaysia</option>
                          <option value="Maldives">Maldives</option>
                          <option value="Mali">Mali</option>
                          <option value="Malta">Malta</option>
                          <option value="Marshall Islands">Marshall Islands</option>
                          <option value="Martinique">Martinique</option>
                          <option value="Mauritania">Mauritania</option>
                          <option value="Mauritius">Mauritius</option>
                          <option value="Mayotte">Mayotte</option>
                          <option value="Mexico">Mexico</option>
                          <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                          <option value="Moldova, Republic of">Moldova, Republic of</option>
                          <option value="Monaco">Monaco</option>
                          <option value="Mongolia">Mongolia</option>
                          <option value="Montserrat">Montserrat</option>
                          <option value="Morocco">Morocco</option>
                          <option value="Mozambique">Mozambique</option>
                          <option value="Myanmar">Myanmar</option>
                          <option value="Namibia">Namibia</option>
                          <option value="Nauru">Nauru</option>
                          <option value="Nepal">Nepal</option>
                          <option value="Netherlands">Netherlands</option>
                          <option value="Netherlands Antilles">Netherlands Antilles</option>
                          <option value="New Caledonia">New Caledonia</option>
                          <option value="New Zealand">New Zealand</option>
                          <option value="Nicaragua">Nicaragua</option>
                          <option value="Niger">Niger</option>
                          <option value="Nigeria">Nigeria</option>
                          <option value="Niue">Niue</option>
                          <option value="Norfolk Island">Norfolk Island</option>
                          <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                          <option value="Norway">Norway</option>
                          <option value="Oman">Oman</option>
                          <option value="Pakistan">Pakistan</option>
                          <option value="Palau">Palau</option>
                          <option value="Panama">Panama</option>
                          <option value="Papua New Guinea">Papua New Guinea</option>
                          <option value="Paraguay">Paraguay</option>
                          <option value="Peru">Peru</option>
                          <option value="Philippines">Philippines</option>
                          <option value="Pitcairn">Pitcairn</option>
                          <option value="Poland">Poland</option>
                          <option value="Portugal">Portugal</option>
                          <option value="Puerto Rico">Puerto Rico</option>
                          <option value="Qatar">Qatar</option>
                          <option value="Reunion">Reunion</option>
                          <option value="Romania">Romania</option>
                          <option value="Russian Federation">Russian Federation</option>
                          <option value="Rwanda">Rwanda</option>
                          <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                          <option value="Saint LUCIA">Saint LUCIA</option>
                          <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                          <option value="Samoa">Samoa</option>
                          <option value="San Marino">San Marino</option>
                          <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                          <option value="Saudi Arabia">Saudi Arabia</option>
                          <option value="Senegal">Senegal</option>
                          <option value="Seychelles">Seychelles</option>
                          <option value="Sierra Leone">Sierra Leone</option>
                          <option value="Singapore">Singapore</option>
                          <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
                          <option value="Slovenia">Slovenia</option>
                          <option value="Solomon Islands">Solomon Islands</option>
                          <option value="Somalia">Somalia</option>
                          <option value="South Africa">South Africa</option>
                          <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                          <option value="Spain">Spain</option>
                          <option value="Sri Lanka">Sri Lanka</option>
                          <option value="St. Helena">St. Helena</option>
                          <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                          <option value="Sudan">Sudan</option>
                          <option value="Suriname">Suriname</option>
                          <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                          <option value="waziland">Swaziland</option>
                          <option value="Sweden">Sweden</option>
                          <option value="Switzerland">Switzerland</option>
                          <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                          <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                          <option value="Tajikistan">Tajikistan</option>
                          <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                          <option value="Thailand">Thailand</option>
                          <option value="Togo">Togo</option>
                          <option value="Tokelau">Tokelau</option>
                          <option value="Tonga">Tonga</option>
                          <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                          <option value="Tunisia">Tunisia</option>
                          <option value="Turkey">Turkey</option>
                          <option value="Turkmenistan">Turkmenistan</option>
                          <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                          <option value="Tuvalu">Tuvalu</option>
                          <option value="Uganda">Uganda</option>
                          <option value="Ukraine">Ukraine</option>
                          <option value="United Arab Emirates">United Arab Emirates</option>
                          <option value="United Kingdom">United Kingdom</option>
                          <option value="United States">United States</option>
                          <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                          <option value="Uruguay">Uruguay</option>
                          <option value="Uzbekistan">Uzbekistan</option>
                          <option value="Vanuatu">Vanuatu</option>
                          <option value="Venezuela">Venezuela</option>
                          <option value="Viet Nam">Viet Nam</option>
                          <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                          <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                          <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                          <option value="Western Sahara">Western Sahara</option>
                          <option value="Yemen">Yemen</option>
                          <option value="Yugoslavia">Yugoslavia</option>
                          <option value="Zambia">Zambia</option>
                          <option value="Zimbabwe">Zimbabwe</option>
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
                    <div>
                      <label for="applicantoaddr1">Address Line 1</label><span class="full addr1">
                      <input id="applicantoaddr1" name="applicantoaddr1" type="text" class="field text addr" value="" tabindex="16" maxlength="39" />
                      </span>  <label for="applicantoaddr2">Address Line 2</label><span class="full addr2">
                      <input id="applicantoaddr2" name="applicantoaddr2" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
                      </span> <label for="applicantoaddr3">Address Line 3</label><span class="full addr2">
                      <input id="applicantoaddr3" name="applicantoaddr3" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
                      </span><label for="applicantocity">City</label> <span class="left city">
                      <input id="applicantocity" name="applicantocity" type="text" class="field text addr" value="" tabindex="18" maxlength="27" />
                      </span>  <label for="applicantostate">State</label><span class="right state">
                      <input id="applicantostate" name="applicantostate" type="text" class="field text addr" value="" tabindex="19" maxlength="20" />
                      </span> 
                      <label class="desc" id="applicantocou">Country <span class="req">*</span> </label>
                      <div>
                        <div class="styled-select">
                          <select  name="applicantocou" class="field select medium">
                            <option value="0" selected="selected"> --Select-- </option>
                            <option value="--">none</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas">Christmas Island</option>
                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                            <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="France, Metropolitan">France, Metropolitan</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>
                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                            <option value="Korea, Republic of">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint LUCIA">Saint LUCIA</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Helena">St. Helena</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                            <option value="waziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Viet Nam">Viet Nam</option>
                            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                            <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                          </select>
                        </div>
                      </div>
                      <span>  </span><label for="applicantozip">Postal / Zip Code</label> <span class="left zip">
                      <input id="applicantozip" name="applicantozip" type="text" class="field text addr" value="" maxlength="6" tabindex="20"/>
                      </span>
                    </div>
                    <p class="complex instruct" id="instructapplicantoaddr"><small>Address here!</small></p>
                  </li>
                </ul>
                <ul>
                  <li class="complex notranslate">
                    <label class="desc"> Indian address <span class="req">*</span> </label>
                    <div> <label for="applicantiaddr1">Address Line 1</label><span class="full addr1">
                      <input id="applicantiaddr1" name="applicantiaddr1" type="text" class="field text addr" value="" tabindex="16" maxlength="39"/>
                      </span>  <label for="applicantiaddr2">Address Line 2</label><span class="full addr2">
                      <input id="applicantiaddr2" name="applicantiaddr2" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
                      </span> <label for="applicantiaddr3">Address Line 3</label><span class="full addr2">
                      <input id="applicantiaddr3" name="applicantiaddr3" type="text" class="field text addr" value="" tabindex="17" maxlength="39" />
                      </span> <label for="applicanticity">City</label> <span class="left city">
                      <input id="applicanticity" name="applicanticity" type="text" class="field text addr" value="" tabindex="18" maxlength="27"/>
                      </span>  <label for="applicantistate">State</label><span class="right state">
                      <input id="applicantistate" name="applicantistate" type="text" class="field text addr" value="" tabindex="19" maxlength="20"/>
                      </span><label for="applicantizip">Postal / Zip Code</label> <span class="left zip">
                      <input id="applicantizip" name="applicantizip" type="text" class="field text addr" value="" maxlength="6" tabindex="20"/>
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
                          <input id="applicant2name" name="applicant2name" type="text" class="field text medium" value="" maxlength="62" tabindex="26" onKeyUp=""/>
                        </div>
                        <p class="instruct" id="instructapplicant2name"><small>Only letters, maximum only 62 characters all in CAPS</small></p>
                      </li>
                      <li class="notranslate">
                        <label class="desc" for="applicant2pan"> second applicant PAN Number <span class="req">*</span> </label>
                        <div>
                          <input id="applicant2pan" class="field text medium" name="applicant2pan" tabindex="27" type="text" value="" />
                        </div>
                        <p class="instruct" id="instructapplicant2pan"><small>Your pan number</small></p>
                      </li>
                    </ul>
                  </div>
                  <ul id="investor3" hidden>
                    <li class="notranslate">
                      <label class="desc" for="applicant3name"> Name of the Third applicant <span class="req">*</span> </label>
                      <div>
                        <input id="applicant3name" name="applicant3name" type="text" class="field text medium" value="" maxlength="62" tabindex="28" onKeyUp="" />
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
                    <div id="bank_details">
                      <span class="full addr1">
                      <label for="bankname">Name of the Bank</label><input id="bankname" maxlength="33"  name="bankname" type="text" class="field text addr" value="" tabindex="30" />
                      </span> <label>Account Type</label> 
                      <div>
                        <input type="radio" checked id="bankacctypes" name="bankacctype" value="saving" tabindex="31"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="bankacctypec" name="bankacctype" value="current" tabindex="32"/>&nbsp;Current
                      </div>
                      <span class="full addr2">
                      </span> <label for="bankaccno">Account Number</label><span class="left city">
                      <input id="bankaccno" name="bankaccno" type="text" class="field text addr" value="" tabindex="33" maxlength="20" />
                      </span><label>Branch Address</label> <span class="right state">
                      </span> <label for="bankaddr1">Line 1</label><span class="left zip">
                      <input id="bankaddr1" name="bankaddr1" type="text" class="field text addr" value="" maxlength="39" tabindex="34" />
                      </span> <label for="bankaddr2">Line 2 </label><span class="left zip">
                      <input id="bankaddr2" name="bankaddr2" type="text" class="field text addr" value="" maxlength="39" tabindex="35" />
                      </span> <label for="bankcity">Branch City</label><span class="left zip">
                      <input id="bankcity" name="bankcity" type="text" class="field text addr" value="" maxlength="27" tabindex="36"  />
                      </span> <label for="bankmicr">MICR Code</label><span class="left zip">
                      <input id="bankmicr" name="bankmicr" type="text" class="field text addr" value="" maxlength="9" tabindex="37"  />
                      </span> <label for="bankifsc">IFSC Code</label><span class="left zip">
                      <input id="bankifsc" name="bankifsc" type="text" class="field text addr" value=""  maxlength="11"  tabindex="38"  />
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
                          <label for="bank2name">Name of the Second Bank</label><input id="bank2name" maxlength="33"  name="bank2name" type="text" class="field text addr" value="" tabindex="39" />
                          </span> <label>Account Type</label> 
                          <div>
                            <input type="radio" checked id="bank2acctypes" name="bank2acctype" value="saving" tabindex="40"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="bank2acctypec" name="bank2acctype" value="current" tabindex="41"/>&nbsp;Current
                          </div>
                          <span class="full addr2">
                          </span> <label for="bank2accno">Account Number</label><span class="left city">
                          <input id="bank2accno" name="bank2accno" type="text" class="field text addr" value="" maxlength="20"  tabindex="42" />
                          </span><label>Branch Address</label> <span class="right state">
                          </span> <label for="bank2addr1">Line 1</label><span class="left zip">
                          <input id="bank2addr1" name="bank2addr1" type="text" class="field text addr" value="" maxlength="39" tabindex="43" required />
                          </span> <label for="bank2addr2">Line 2  </label><span class="left zip">
                          <input id="bank2addr2" name="bank2addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="44" required />
                          </span> <label for="bank2city">Branch City</label><span class="left zip">
                          <input id="bank2city" name="bank2city" type="text" class="field text addr" value="" maxlength="27" tabindex="45"  />
                          </span> <label for="bank2micr">MICR Code</label><span class="left zip">
                          <input id="bank2micr" name="bank2micr" type="text" class="field text addr" value="" maxlength="9"  tabindex="46"  />
                          </span> <label for="bank2ifsc">IFSC Code</label><span class="left zip">
                          <input id="bank2ifsc" name="bank2ifsc" type="text" class="field text addr" value="" maxlength="11" tabindex="47"  />
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
                          <label for="bank3name">Name of the Third Bank</label><input id="bank3name" name="bank3name" maxlength="33" type="text" class="field text addr" value="" tabindex="48" />
                          </span> <label>Account Type</label> 
                          <div>
                            <input type="radio" checked id="bank3acctypes" name="bank3acctype" value="saving" tabindex="49"/>&nbsp;Savings&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="bank3acctypec" name="bank3acctype" value="current" tabindex="50"/>&nbsp;Current
                          </div>
                          <span class="full addr2">
                          </span> <label for="bank3accno">Account Number</label><span class="left city">
                          <input id="bank3accno" name="bank3accno" type="text" class="field text addr" maxlength="20" value="" tabindex="51" />
                          </span><label>Branch Address</label> <span class="right state">
                          </span> <label for="bank3addr1">Line 1</label><span class="left zip">
                          <input id="bank3addr1" name="bank3addr1" type="text" class="field text addr" value="" maxlength="39" tabindex="52" required />
                          </span> <label for="bank3addr2">Line 2  </label><span class="left zip">
                          <input id="bank3addr2" name="bank3addr2" type="text" class="field text addr" value="" maxlength="39" tabindex="53" required />
                          </span> <label for="bank3city">Branch City</label><span class="left zip">
                          <input id="bank3city" name="bank3city" type="text" class="field text addr" value="" maxlength="27" tabindex="54"  />
                          </span> <label for="bank3micr">MICR Code</label><span class="left zip">
                          <input id="bank3micr" name="bank3micr" type="text" class="field text addr" value="" maxlength="9" tabindex="55"  />
                          </span> <label for="bank3ifsc">IFSC Code</label><span class="left zip">
                          <input id="bank3ifsc" name="bank3ifsc" type="text" class="field text addr" value="" maxlength="11" tabindex="56"  />
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
                        <select id="applicantvalidyfield" name="applicantvalidy" class="field select medium" tabindex="58">
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
                      <label for="applicantvalidmafield" id="applicantvalidma">Maximum Per month mandate amount</label>
                      </span>
                      <div class="styled-select">
                        <select id="applicantvalidmafield" name="applicantvalidma" class="field select medium" tabindex="59">
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
                    <label for="aplicantnomcheckbox"> <input type="checkbox" name="aplicantnomcheckbox" id="aplicantnomcheckbox" onchange="javascript:$('#appnomineedetails').toggle();" value="appnomineefalse" tabindex="60"> &nbsp;&nbsp;I Do not wish to make nomination<br/><br/></label> 
                    <p class="instruct" id="instructnomineedetailcheckbox"><small>Nominee details</small></p>
                  </li>
                </ul>
                <div id="appnomineedetails">
                  <ul>
                    <li>
                      <span class="left city">
                      <label for="appnomname">Nominee Name</label> <input id="appnomname" name="appnomname" type="text" class="field text addr medium" value="" tabindex="61" maxlength="33" />
                      </span> 
                      <p class="instruct" id="instructappnomname"><small>About Nominee</small></p>
                    <li class="date eurodate notranslate      ">
                      <label class="desc"> Date Of Birth <span class="req">*</span> </label>
                      <span>
                      <input id="appnomdobd" name="appnomdobd" type="text" class="field text" value="" size="2" maxlength="2" tabindex="62"/>
                      <label for="appnomdobd">DD</label>
                      </span> <span class="symbol">/</span> <span>
                      <input id="appnomdobm" name="appnomdobm" type="text" class="field text" value="" size="2" maxlength="2" tabindex="63"/>
                      <label for="appnomdobm">MM</label>
                      </span> <span class="symbol">/</span> <span>
                      <input id="appnomdoby" name="appnomdoby" type="text" class="field text" value="" size="4" maxlength="4" tabindex="64" />
                      <label for="appnomdoby">YYYY</label>
                      </span>
                      <p class="instruct" id="instructappnomdobd"><small>Your date of birth</small></p>
                    </li>
                    <li>
                      <span class="left zip"><label for="appnompname">Name Of Parent (In Case of Minor) </label>
                      <input id="appnompname" name="appnompname" type="text" class="field text addr medium" value="" maxlength="30" tabindex="65" />
                      </span> 
                      <p class="instruct" id="instructappnompname"><small>Name Of Parent (In Case of Minor)</small></p>
                    </li>
                    <li>
                      <span class="left zip"><label for="appnomrel">Relationship  </label>
                      <input id="appnomrel" name="appnomrel" type="text" class="field text addr medium" value="" maxlength="16" tabindex="66" />
                      </span> 
                      <p class="instruct" id="instructappnomrel"><small>Relationship</small></p>
                    </li>
                  </ul>
                </div>
                <ul>
                  <li>
                    <span class="left zip">
                    <label for="agreementaccept" id="agreementacceptl"><input tabindex="100" id="agreementaccept" name="agreementaccept" value="agree" type="checkbox">&nbsp;&nbsp;I Have read the terms and Conditions Before investing </label>
                    </span>
                    <p class="instruct" id="instructagreementaccept"><small>Accept before submitting</small></p>
                  </li>
                  <li class="buttons ">
                    <div>
                      <button id="saveForm"  name="saveForm" class="btTxt submit fundsInn-btn"  tabindex="101" value="">Preview</button>
                      <button id="clearForm" name="clearForm" class="btTxt submit fundsInn-btn"  tabindex="102" value="">Clear</button>
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
      <!--MAIN WRAPPER-->
    </div>
    <!-- validations -->
    <script type="text/javascript">
      $(document).ready(function(){
      
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
      
      
        $("#nriform").validate({
              rules:{
            "account_type":{required:true},
            "applicantname":{required:true, maxlength: 62 },
            "applicantfname":{required:true, maxlength: 54 },
            "applicantdobdd":{required:true, min: 1, max: 31  },
            "applicantdobmm":{required:true, min: 1, max: 12  },
            "applicantdobyyyy" : {required:true, isValidAge:true },
            "applicantgenderradio": {required:true},
            "applicantpan" : {required:true, isPAN:true },
            "applicanttelr": {digits: true},
            "applicanttelo" : {digits: true},
            "applicanttelm" : {required:true, digits: true, minlength:10, maxlength: 10},
            "applicantocc": {required:true, valueNotEquals: "0" },
            "applicanttaxstatus": {required:true, valueNotEquals: "0" }, 
            "applicantnat": {required:true, valueNotEquals: "0" },  
            "applicantoaddr1": {required:true, maxlength:39},
            "applicantoaddr2" : {maxlength:39},
            "applicantoaddr3" : {maxlength:39},
            "applicantocity"  : {required:true, maxlength:24}, 
            "applicantostate" : {required:true, maxlength:24}, 
            "applicantozip"  : {required:true, postalCode:true}, 
            "applicantiaddr1" : {required:true, maxlength:39},
            "applicantiaddr2" : {maxlength:39},
            "applicantiaddr3" : {maxlength:39},
            "applicanticity" : {required:true, maxlength:24}, 
            "applicantistate" : {required:true, maxlength:24}, 
            "applicantizip"  : {required:true,postalCode:true}, 
            "applicant2name" : {maxlength: 62 },
            "applicant2pan" : { isPan:true },
            "applicant3name" : {maxlength: 62 },
            "applicant3pan" : { isPan:true }, 
            "bankname" :{ required:true, minlength:2},
            "bankacctype" :{ required:true},
            "bankaccno"   :{ required:true, digits:true, maxlength:20},
            "bankaddr1" : { required:true, maxlength:39},
            "bankaddr2" : { maxlength:39},
            "bankcity" : {required:true, maxlength:24},
            "bankmicr" : {required:true,digits:true,max:999999999},
            "bankifsc" : {required:true,isIFSC:true},
            "bank2name" : {minlength:2},
            "bank2accno" :{digits:true, maxlength:20},
            "bank2addr1" : { maxlength:39},
            "bank2addr2" : { maxlength:39},
            "bank2city" :{maxlength:24},
            "bank2micr" :{digits:true,max:999999999},
            "bank2ifsc" :{isIFSC:true},
            "bank3name" : {minlength:2}, 
            "bank3accno" :{digits:true, maxlength:20},
            "bank3addr1" : { maxlength:39},
            "bank3addr2" :{ maxlength:39},
            "bank3city" :{maxlength:24},
            "bank3micr" : {digits:true,max:999999999},
            "bank3ifsc" :{isIFSC:true},
            "appnomname" :{ minlength:2},
            "appnomdobd" :{ min: 1, max: 31  },
            'appnomdobm' :{ min: 1, max: 12  },
            "appnomdoby" :{isValidAge:true },
            "appnompname": { minlength:2},
            "appnomrel" :{ maxlength:39},
            "agreementaccept" :{required:true}
              },
              messages:{
            'applicantname':"Enter Your Full Name!",
            "applicantdobdd":{required:"0-31", min:"0-31", max: "0-31"  },
            "applicantdobmm":{required:"0-12", min:"0-12", max:"0-12"  },
            "applicantdobyyyy" : {required:"ex : 1980"}, 
            "applicanttelm" : {required:"Enter Your Mobile Number", digits:"Enter Your Mobile Number", minlength:"Enter Your Mobile Number", maxlength: "Enter Your Mobile Number"},
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

         
        // agreements onclick="formReset()" 
         function prevent_default(){
         $("#nriform input").each(function(key,value){ 
            if($(value).removeAttr("id")!="saveForm" && $(value).attr("id")!="clearForm"){  
            $(value).removeAttr("disabled");} });
          $("#nriform select").each(function(key,value){ $(value).removeAttr("disabled","disabled");});
          $("#saveForm").text("Preview");
          $("#clearForm").text("Clear");
          alert("chaged Default")
        }
        
        function scroll_top(){
           $("html, body").animate({ scrollTop: 180 }, 600);
        }

       $(document).on("click","#saveForm","click",function(){
        
        if($("#saveForm").text()=="Submit"){
          if($("#nriform").valid()){
          alert("Please verify all the fields Before Submit !");
          prevent_default();
          send();}else{
            scroll_top();
          }
        }else if($("#saveForm").text()=="Preview"){
          if($("#nriform").valid()){
          $("#nriform input").each(function(key,value){ 
            if(($(value).attr("id")!="saveForm") && ($(value).attr("id")!="clearForm")){  
            $(value).attr("disabled","disabled");} });
          $("#nriform select").each(function(key,value){$(value).attr("disabled","disabled");});
           $("#saveForm").removeAttr("disabled");
          $("#clearForm").removeAttr("disabled");
          $("#saveForm").text("Submit");
          $("#clearForm").text("Edit");
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
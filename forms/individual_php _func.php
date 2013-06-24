<?php


echo "test \n";


//TODO:not found

function form_insertdata_display($form, $message){
    $applicant_id = request("applicant_id", "");
    $applicant_account_type = request("applicant_account_type", "");
    $applicant_name = request("applicant_name", "");
    $applicant_father_name = request("applicant_father_name", "");
    $applicant_dob_year = request("applicant_dob_year", "");
    $applicant_dob_month = request("applicant_dob_month", "");
    $applicant_dob_day = request("applicant_dob_day", "");
    if (($applicant_dob_year != "")
     && ($applicant_dob_month != "")
     && ($applicant_dob_day != "")) {
        $applicant_dob = $applicant_dob_year."-".$applicant_dob_month."-".$applicant_dob_day;
    } else {
        $applicant_dob = "";
    }
    $applicant_gender = request("applicant_gender", "");
    $applicant_pan = request("applicant_pan", "");
    $applicant_telephone_residence = request("applicant_telephone_residence", "");
    $applicant_telephone_office = request("applicant_telephone_office", "");
    $applicant_telephone_mobile = request("applicant_telephone_mobile", "");
    $applicant_email = request("applicant_email", "");
    $applicant_occupation = request("applicant_occupation", "");
    $applicant_address_permanant_line1 = request("applicant_address_permanant_line1", "");
    $applicant_address_permanent_line2 = request("applicant_address_permanent_line2", "");
    $applicant_address_permanent_city = request("applicant_address_permanent_city", "");
    $applicant_address_permanent_state = request("applicant_address_permanent_state", "");
    $applicant_address_permanent_pincode = request("applicant_address_permanent_pincode", "");
    $applicant_address_communication_line1 = request("applicant_address_communication_line1", "");
    $applicant_address_communication_line2 = request("applicant_address_communication_line2", "");
    $applicant_address_communication_city = request("applicant_address_communication_city", "");
    $applicant_address_communication_state = request("applicant_address_communication_state", "");
    $applicant_address_communication_pincode = request("applicant_address_communication_pincode", "");
    $application_application_form = request("application_application_form", "");
    $applicant_bank1_account_number = request("applicant_bank1_account_number", "");
    $bank1_account_type = request("bank1_account_type", "");
    $bank1_ifsc_code = request("bank1_ifsc_code", "");
    $bank1_micr_code = request("bank1_micr_code", "");
    $bank1_name = request("bank1_name", "");
    $bank1_branch_name = request("bank1_branch_name", "");
    $bank1_branch_address_line1 = request("bank1_branch_address_line1", "");
    $bank1_branch_address_line2 = request("bank1_branch_address_line2", "");
    $bank1_branch_city = request("bank1_branch_city", "");
    $bank1_branch_state = request("bank1_branch_state", "");
    $bank1_branch_pincode = request("bank1_branch_pincode", "");
    $applicant_bank2_account_number = request("applicant_bank2_account_number", "");
    $bank2_account_type = request("bank2_account_type", "");
    $bank2_ifsc_code = request("bank2_ifsc_code", "");
    $bank2_micr_code = request("bank2_micr_code", "");
    $bank2_name = request("bank2_name", "");
    $bank2_branch_name = request("bank2_branch_name", "");
    $bank2_branch_address_line1 = request("bank2_branch_address_line1", "");
    $bank2_branch_address_line2 = request("bank2_branch_address_line2", "");
    $bank2_branch_city = request("bank2_branch_city", "");
    $bank2_branch_state = request("bank2_branch_state", "");
    $bank2_branch_pincode = request("bank2_branch_pincode", "");
    $applicant_bank3_account_number = request("applicant_bank3_account_number", "");
    $bank3_account_type = request("bank3_account_type", "");
    $bank3_ifsc_code = request("bank3_ifsc_code", "");
    $bank3_micr_code = request("bank3_micr_code", "");
    $bank3_name = request("bank3_name", "");
    $bank3_branch_name = request("bank3_branch_name", "");
    $bank3_branch_address_line1 = request("bank3_branch_address_line1", "");
    $bank3_branch_address_line2 = request("bank3_branch_address_line2", "");
    $bank3_branch_city = request("bank3_branch_city", "");
    $bank3_branch_state = request("bank3_branch_state", "");
    $bank3_branch_pincode = request("bank3_branch_pincode", "");
    $applicant_nominee_mandate = request("applicant_nominee_mandate", "");
    $applicant_nominee_name = request("applicant_nominee_name", "");
    $applicant_nominee_dob_year = request("applicant_nominee_dob_year", "");
    $applicant_nominee_dob_month = request("applicant_nominee_dob_month", "");
    $applicant_nominee_dob_day = request("applicant_nominee_dob_day", "");
    if (($applicant_nominee_dob_year != "")
     && ($applicant_nominee_dob_month != "")
     && ($applicant_nominee_dob_day != "")) {
        $applicant_nominee_dob = $applicant_nominee_dob_year."-".$applicant_nominee_dob_month."-".$applicant_nominee_dob_day;
    } else {
        $applicant_nominee_dob = "";
    }
    $applicant_nominee_parent_name = request("applicant_nominee_parent_name", "");
    $applicant_nominee_relationship = request("applicant_nominee_relationship", "");
    $applicant_sip_mandate = request("applicant_sip_mandate", "");
    $applicant_sip_mandate_years = request("applicant_sip_mandate_years", "");
    $appplicant_sip_mandate_maximum_per_month = request("appplicant_sip_mandate_maximum_per_month", "");
    $disabled = "";
    set_session('form_loaded', 0);
    $check = "";
    $gridtitle = "Individual Customer Add";
    print "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"  width=\"100%\" align=\"center\">\n";
    print "<tr>\n";
    print "<td>\n";
    print "<div id=\"mainmenu_defaulttheme\">\n";
    print "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"  width=\"100%\">\n";
    print "    <tr>\n";
    print "    <td colspan=\"3\" valign=\"top\" class=\"mainMenuBG\" >\n";
    print "        <table align=\"right\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
    print "            <tr>\n";
    $sessionlevel = session('user_level', -1);
    $menuprint = false;
    if ($sessionlevel < 0) {
        if ($menuprint) {
          print "                <td>\n";
          print "                    <span class=\"mainMenuText\">\n";
          print "                        &nbsp;|&nbsp;\n";
          print "                    </span>\n";
          print "                </td>\n";
          $menuprint = false;
        }
        print "                <td>\n";
        print "<a href=\"" . "./user_logout.php". "\"" . " title=\"Login\" class=\"mainMenuLink\"><div><p>Login</p></div></a>";
        print "                </td>\n";
        $menuprint = true;
    }
    if ($sessionlevel > 0) {
        if ($menuprint) {
          print "                <td>\n";
          print "                    <span class=\"mainMenuText\">\n";
          print "                        &nbsp;|&nbsp;\n";
          print "                    </span>\n";
          print "                </td>\n";
          $menuprint = false;
        }
        print "                <td>\n";
        print "<a href=\"" . "./user_logout.php". "\"" . " title=\"Logout\" class=\"mainMenuLink\"><div><p>Logout</p></div></a>";
        print "                </td>\n";
        $menuprint = true;
    }
    print "            </tr>\n";
    print "        </table>\n";
    print "    </td>\n";
    print "    </tr>\n";
    print "</table>\n";
    print "</div>\n";

    print "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
    print "<tr>\n";
    print "<td width=\"1\" align=\"left\" valign=\"top\">\n";
    sitemenu_display("individual_customer_add", "defaulttheme");
    print "</td>\n";
    print "<td align=\"left\" class=\"siteMenuGap\">&nbsp;</td>\n";
    print "<td valign=\"top\">\n";
    print "<br />\n";

    print "<div id=\"defaulttheme\">";
    print "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"  width=\"90%\" >\n";
    print "    <tr>\n";
    print "        <td class=\"formHeaderBGLeft\" nowrap >&nbsp;</td>\n";
    print "        <td class=\"formHeaderBG\"><span class=\"formHeaderText\">" . $gridtitle . "</span>&nbsp;</td>\n";
    print "        <td class=\"formHeaderBGRight\" nowrap >&nbsp;</td>\n";
    print "    </tr>\n";
    print "    <tr>\n";
    print "        <td class=\"formColumnBGLeft\" align=\"left\">&nbsp;</td>\n";
    print "        <td>\n";
    print "            <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"formBody\" >\n";
    if ($message != "" ){
        print "<tr>\n";
        print "<td class=\"formColumnCaption\">Message</td>\n";
        print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
        print "<td class=\"formColumnData\" align=\"left\">\n";
        print "<label class=\"errMsg\" >" . $message . "</label>\n";
        print "</td>\n";
        print "</tr>\n";
    }
    $value = $applicant_id;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_id = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_id = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Id</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_id\" name=\"applicant_id\" type=\"text\" value=\"" . $value . "\"  size=\"10\" maxlength=\"10\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_account_type;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_account_type = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_account_type = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Account Type</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_account_type\" name=\"applicant_account_type\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"50\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_name\" name=\"applicant_name\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_father_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_father_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_father_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Father Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_father_name\" name=\"applicant_father_name\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_dob;
    if (($value == "") || ($value == null)) {
        $value = "";
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_dob = $value;
    }
    $v_year = "";
    $v_month = "";
    $v_day = "";
    $v_hour = "";
    $v_minute = "";
    $v_second = "";
    if ($value != "") {
      $datevalue = getdate(strtotime($value));
      if (is_array($datevalue)) {
        $v_year = $datevalue['year'];
        $v_month = str_pad($datevalue['mon'], 2, '0', STR_PAD_LEFT);
        $v_day = str_pad($datevalue['mday'], 2, '0', STR_PAD_LEFT);
        $v_hour = str_pad($datevalue['hours'], 2, '0', STR_PAD_LEFT);
        $v_minute = str_pad($datevalue['minutes'], 2, '0', STR_PAD_LEFT);
        $v_second = str_pad($datevalue['seconds'], 2, '0', STR_PAD_LEFT);
      }
    }

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Dob</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>\n";
    print "<td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<select class=\"combobox\" name=\"applicant_dob_day\" id=\"applicant_dob_day\" style=\"width: 50px\">";
    print "<option value=\"\"></option>";
    if ($v_day == "01") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"01\" $selected >01</option>";
    if ($v_day == "02") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"02\" $selected >02</option>";
    if ($v_day == "03") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"03\" $selected >03</option>";
    if ($v_day == "04") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"04\" $selected >04</option>";
    if ($v_day == "05") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"05\" $selected >05</option>";
    if ($v_day == "06") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"06\" $selected >06</option>";
    if ($v_day == "07") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"07\" $selected >07</option>";
    if ($v_day == "08") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"08\" $selected >08</option>";
    if ($v_day == "09") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"09\" $selected >09</option>";
    if ($v_day == "10") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"10\" $selected >10</option>";
    if ($v_day == "11") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"11\" $selected >11</option>";
    if ($v_day == "12") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"12\" $selected >12</option>";
    if ($v_day == "13") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"13\" $selected >13</option>";
    if ($v_day == "14") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"14\" $selected >14</option>";
    if ($v_day == "15") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"15\" $selected >15</option>";
    if ($v_day == "16") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"16\" $selected >16</option>";
    if ($v_day == "17") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"17\" $selected >17</option>";
    if ($v_day == "18") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"18\" $selected >18</option>";
    if ($v_day == "19") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"19\" $selected >19</option>";
    if ($v_day == "20") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"20\" $selected >20</option>";
    if ($v_day == "21") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"21\" $selected >21</option>";
    if ($v_day == "22") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"22\" $selected >22</option>";
    if ($v_day == "23") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"23\" $selected >23</option>";
    if ($v_day == "24") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"24\" $selected >24</option>";
    if ($v_day == "25") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"25\" $selected >25</option>";
    if ($v_day == "26") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"26\" $selected >26</option>";
    if ($v_day == "27") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"27\" $selected >27</option>";
    if ($v_day == "28") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"28\" $selected >28</option>";
    if ($v_day == "29") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"29\" $selected >29</option>";
    if ($v_day == "30") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"30\" $selected >30</option>";
    if ($v_day == "31") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"31\" $selected >31</option>";
    print "</select>&nbsp;";
    print "</td><td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<select class=\"combobox\" name=\"applicant_dob_month\" id=\"applicant_dob_month\" style=\"width: 50px\">";
    print "<option value=\"\"></option>";
    if ($v_month == "01") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"01\" $selected >Jan</option>";
    if ($v_month == "02") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"02\" $selected >Feb</option>";
    if ($v_month == "03") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"03\" $selected >Mar</option>";
    if ($v_month == "04") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"04\" $selected >Apr</option>";
    if ($v_month == "05") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"05\" $selected >May</option>";
    if ($v_month == "06") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"06\" $selected >Jun</option>";
    if ($v_month == "07") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"07\" $selected >Jul</option>";
    if ($v_month == "08") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"08\" $selected >Aug</option>";
    if ($v_month == "09") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"09\" $selected >Sep</option>";
    if ($v_month == "10") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"10\" $selected >Oct</option>";
    if ($v_month == "11") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"11\" $selected >Nov</option>";
    if ($v_month == "12") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"12\" $selected >Dec</option>";
    print "</select>&nbsp;";
    print "</td><td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<input class=\"textbox\" name=\"applicant_dob_year\" type=\"text\" value=\"$v_year\" id=\"applicant_dob_year\" size=\"4\"/>";
    print "</td>\n";
    print "<td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<input type=\"image\" name=\"applicant_dob_btn\" id=\"applicant_dob_btn\" src=\"components/calendar/basicgray/images/img_calendar.gif\" onclick =\"displayCalendarSelectBox('applicant_dob_year','applicant_dob_month','applicant_dob_day',false,false,this); return false;\"style=\"border-width:0px;cursor: hand\" />";
    print "</td></tr></table>\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_gender;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_gender = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_gender = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Gender</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_gender\" name=\"applicant_gender\" type=\"text\" value=\"" . $value . "\"  size=\"6\" maxlength=\"6\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_pan;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_pan = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_pan = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Pan</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_pan\" name=\"applicant_pan\" type=\"text\" value=\"" . $value . "\"  size=\"10\" maxlength=\"10\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_telephone_residence;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_telephone_residence = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_telephone_residence = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Telephone Residence</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_telephone_residence\" name=\"applicant_telephone_residence\" type=\"text\" value=\"" . $value . "\"  size=\"10\" maxlength=\"10\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_telephone_office;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_telephone_office = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_telephone_office = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Telephone Office</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_telephone_office\" name=\"applicant_telephone_office\" type=\"text\" value=\"" . $value . "\"  size=\"10\" maxlength=\"10\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_telephone_mobile;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_telephone_mobile = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_telephone_mobile = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Telephone Mobile</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_telephone_mobile\" name=\"applicant_telephone_mobile\" type=\"text\" value=\"" . $value . "\"  size=\"10\" maxlength=\"10\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_email;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_email = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_email = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Email</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_email\" name=\"applicant_email\" type=\"text\" value=\"" . $value . "\"  size=\"37\" maxlength=\"37\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_occupation;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_occupation = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_occupation = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Occupation</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_occupation\" name=\"applicant_occupation\" type=\"text\" value=\"" . $value . "\"  size=\"45\" maxlength=\"45\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_permanant_line1;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_permanant_line1 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_permanant_line1 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Permanant Line1</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_permanant_line1\" name=\"applicant_address_permanant_line1\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_permanent_line2;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_permanent_line2 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_permanent_line2 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Permanent Line2</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_permanent_line2\" name=\"applicant_address_permanent_line2\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_permanent_city;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_permanent_city = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_permanent_city = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Permanent City</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_permanent_city\" name=\"applicant_address_permanent_city\" type=\"text\" value=\"" . $value . "\"  size=\"30\" maxlength=\"30\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_permanent_state;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_permanent_state = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_permanent_state = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Permanent State</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_permanent_state\" name=\"applicant_address_permanent_state\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_permanent_pincode;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_permanent_pincode = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_permanent_pincode = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Permanent Pincode</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_permanent_pincode\" name=\"applicant_address_permanent_pincode\" type=\"text\" value=\"" . $value . "\"  size=\"6\" maxlength=\"6\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_communication_line1;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_communication_line1 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_communication_line1 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Communication Line1</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_communication_line1\" name=\"applicant_address_communication_line1\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_communication_line2;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_communication_line2 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_communication_line2 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Communication Line2</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_communication_line2\" name=\"applicant_address_communication_line2\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_communication_city;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_communication_city = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_communication_city = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Communication City</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_communication_city\" name=\"applicant_address_communication_city\" type=\"text\" value=\"" . $value . "\"  size=\"30\" maxlength=\"30\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_communication_state;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_communication_state = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_communication_state = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Communication State</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_communication_state\" name=\"applicant_address_communication_state\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_address_communication_pincode;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_address_communication_pincode = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_address_communication_pincode = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Address Communication Pincode</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_address_communication_pincode\" name=\"applicant_address_communication_pincode\" type=\"text\" value=\"" . $value . "\"  size=\"6\" maxlength=\"6\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $application_application_form;
    if (($value == "") || ($value == null)) {
        $value = "";
        $application_application_form = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $application_application_form = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Application Application Form</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<textarea class=\"textarea\" id=\"application_application_form\" name=\"application_application_form\"  cols=\"50\" rows=\"5\">" . $value . "</textarea>\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_bank1_account_number;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_bank1_account_number = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_bank1_account_number = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Bank1 Account Number</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_bank1_account_number\" name=\"applicant_bank1_account_number\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_account_type;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_account_type = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_account_type = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Account Type</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_account_type\" name=\"bank1_account_type\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_ifsc_code;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_ifsc_code = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_ifsc_code = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Ifsc Code</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_ifsc_code\" name=\"bank1_ifsc_code\" type=\"text\" value=\"" . $value . "\"  size=\"11\" maxlength=\"11\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_micr_code;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_micr_code = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_micr_code = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Micr Code</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_micr_code\" name=\"bank1_micr_code\" type=\"text\" value=\"" . $value . "\"  size=\"9\" maxlength=\"9\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_name\" name=\"bank1_name\" type=\"text\" value=\"" . $value . "\"  size=\"45\" maxlength=\"45\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_branch_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_branch_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_branch_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Branch Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_branch_name\" name=\"bank1_branch_name\" type=\"text\" value=\"" . $value . "\"  size=\"45\" maxlength=\"45\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_branch_address_line1;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_branch_address_line1 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_branch_address_line1 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Branch Address Line1</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_branch_address_line1\" name=\"bank1_branch_address_line1\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_branch_address_line2;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_branch_address_line2 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_branch_address_line2 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Branch Address Line2</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_branch_address_line2\" name=\"bank1_branch_address_line2\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_branch_city;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_branch_city = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_branch_city = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Branch City</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_branch_city\" name=\"bank1_branch_city\" type=\"text\" value=\"" . $value . "\"  size=\"30\" maxlength=\"30\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_branch_state;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_branch_state = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_branch_state = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Branch State</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_branch_state\" name=\"bank1_branch_state\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank1_branch_pincode;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank1_branch_pincode = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank1_branch_pincode = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank1 Branch Pincode</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank1_branch_pincode\" name=\"bank1_branch_pincode\" type=\"text\" value=\"" . $value . "\"  size=\"6\" maxlength=\"6\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_bank2_account_number;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_bank2_account_number = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_bank2_account_number = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Bank2 Account Number</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_bank2_account_number\" name=\"applicant_bank2_account_number\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_account_type;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_account_type = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_account_type = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Account Type</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_account_type\" name=\"bank2_account_type\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_ifsc_code;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_ifsc_code = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_ifsc_code = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Ifsc Code</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_ifsc_code\" name=\"bank2_ifsc_code\" type=\"text\" value=\"" . $value . "\"  size=\"11\" maxlength=\"11\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_micr_code;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_micr_code = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_micr_code = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Micr Code</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_micr_code\" name=\"bank2_micr_code\" type=\"text\" value=\"" . $value . "\"  size=\"9\" maxlength=\"9\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_name\" name=\"bank2_name\" type=\"text\" value=\"" . $value . "\"  size=\"45\" maxlength=\"45\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_branch_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_branch_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_branch_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Branch Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_branch_name\" name=\"bank2_branch_name\" type=\"text\" value=\"" . $value . "\"  size=\"45\" maxlength=\"45\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_branch_address_line1;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_branch_address_line1 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_branch_address_line1 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Branch Address Line1</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_branch_address_line1\" name=\"bank2_branch_address_line1\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_branch_address_line2;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_branch_address_line2 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_branch_address_line2 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Branch Address Line2</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_branch_address_line2\" name=\"bank2_branch_address_line2\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_branch_city;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_branch_city = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_branch_city = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Branch City</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_branch_city\" name=\"bank2_branch_city\" type=\"text\" value=\"" . $value . "\"  size=\"30\" maxlength=\"30\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_branch_state;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_branch_state = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_branch_state = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Branch State</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_branch_state\" name=\"bank2_branch_state\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank2_branch_pincode;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank2_branch_pincode = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank2_branch_pincode = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank2 Branch Pincode</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank2_branch_pincode\" name=\"bank2_branch_pincode\" type=\"text\" value=\"" . $value . "\"  size=\"6\" maxlength=\"6\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_bank3_account_number;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_bank3_account_number = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_bank3_account_number = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Bank3 Account Number</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_bank3_account_number\" name=\"applicant_bank3_account_number\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_account_type;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_account_type = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_account_type = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Account Type</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_account_type\" name=\"bank3_account_type\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_ifsc_code;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_ifsc_code = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_ifsc_code = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Ifsc Code</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_ifsc_code\" name=\"bank3_ifsc_code\" type=\"text\" value=\"" . $value . "\"  size=\"11\" maxlength=\"11\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_micr_code;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_micr_code = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_micr_code = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Micr Code</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_micr_code\" name=\"bank3_micr_code\" type=\"text\" value=\"" . $value . "\"  size=\"9\" maxlength=\"9\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_name\" name=\"bank3_name\" type=\"text\" value=\"" . $value . "\"  size=\"45\" maxlength=\"45\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_branch_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_branch_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_branch_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Branch Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_branch_name\" name=\"bank3_branch_name\" type=\"text\" value=\"" . $value . "\"  size=\"45\" maxlength=\"45\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_branch_address_line1;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_branch_address_line1 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_branch_address_line1 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Branch Address Line1</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_branch_address_line1\" name=\"bank3_branch_address_line1\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_branch_address_line2;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_branch_address_line2 = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_branch_address_line2 = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Branch Address Line2</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_branch_address_line2\" name=\"bank3_branch_address_line2\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_branch_city;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_branch_city = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_branch_city = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Branch City</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_branch_city\" name=\"bank3_branch_city\" type=\"text\" value=\"" . $value . "\"  size=\"30\" maxlength=\"30\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_branch_state;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_branch_state = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_branch_state = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Branch State</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_branch_state\" name=\"bank3_branch_state\" type=\"text\" value=\"" . $value . "\"  size=\"40\" maxlength=\"40\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $bank3_branch_pincode;
    if (($value == "") || ($value == null)) {
        $value = "";
        $bank3_branch_pincode = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $bank3_branch_pincode = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Bank3 Branch Pincode</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"bank3_branch_pincode\" name=\"bank3_branch_pincode\" type=\"text\" value=\"" . $value . "\"  size=\"6\" maxlength=\"6\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_nominee_mandate;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_nominee_mandate = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_nominee_mandate = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Nominee Mandate</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_nominee_mandate\" name=\"applicant_nominee_mandate\" type=\"text\" value=\"" . $value . "\"  size=\"3\" maxlength=\"3\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_nominee_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_nominee_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_nominee_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Nominee Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_nominee_name\" name=\"applicant_nominee_name\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_nominee_dob;
    if (($value == "") || ($value == null)) {
        $value = "";
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_nominee_dob = $value;
    }
    $v_year = "";
    $v_month = "";
    $v_day = "";
    $v_hour = "";
    $v_minute = "";
    $v_second = "";
    if ($value != "") {
      $datevalue = getdate(strtotime($value));
      if (is_array($datevalue)) {
        $v_year = $datevalue['year'];
        $v_month = str_pad($datevalue['mon'], 2, '0', STR_PAD_LEFT);
        $v_day = str_pad($datevalue['mday'], 2, '0', STR_PAD_LEFT);
        $v_hour = str_pad($datevalue['hours'], 2, '0', STR_PAD_LEFT);
        $v_minute = str_pad($datevalue['minutes'], 2, '0', STR_PAD_LEFT);
        $v_second = str_pad($datevalue['seconds'], 2, '0', STR_PAD_LEFT);
      }
    }

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Nominee Dob</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>\n";
    print "<td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<select class=\"combobox\" name=\"applicant_nominee_dob_day\" id=\"applicant_nominee_dob_day\" style=\"width: 50px\">";
    print "<option value=\"\"></option>";
    if ($v_day == "01") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"01\" $selected >01</option>";
    if ($v_day == "02") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"02\" $selected >02</option>";
    if ($v_day == "03") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"03\" $selected >03</option>";
    if ($v_day == "04") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"04\" $selected >04</option>";
    if ($v_day == "05") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"05\" $selected >05</option>";
    if ($v_day == "06") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"06\" $selected >06</option>";
    if ($v_day == "07") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"07\" $selected >07</option>";
    if ($v_day == "08") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"08\" $selected >08</option>";
    if ($v_day == "09") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"09\" $selected >09</option>";
    if ($v_day == "10") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"10\" $selected >10</option>";
    if ($v_day == "11") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"11\" $selected >11</option>";
    if ($v_day == "12") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"12\" $selected >12</option>";
    if ($v_day == "13") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"13\" $selected >13</option>";
    if ($v_day == "14") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"14\" $selected >14</option>";
    if ($v_day == "15") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"15\" $selected >15</option>";
    if ($v_day == "16") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"16\" $selected >16</option>";
    if ($v_day == "17") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"17\" $selected >17</option>";
    if ($v_day == "18") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"18\" $selected >18</option>";
    if ($v_day == "19") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"19\" $selected >19</option>";
    if ($v_day == "20") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"20\" $selected >20</option>";
    if ($v_day == "21") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"21\" $selected >21</option>";
    if ($v_day == "22") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"22\" $selected >22</option>";
    if ($v_day == "23") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"23\" $selected >23</option>";
    if ($v_day == "24") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"24\" $selected >24</option>";
    if ($v_day == "25") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"25\" $selected >25</option>";
    if ($v_day == "26") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"26\" $selected >26</option>";
    if ($v_day == "27") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"27\" $selected >27</option>";
    if ($v_day == "28") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"28\" $selected >28</option>";
    if ($v_day == "29") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"29\" $selected >29</option>";
    if ($v_day == "30") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"30\" $selected >30</option>";
    if ($v_day == "31") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"31\" $selected >31</option>";
    print "</select>&nbsp;";
    print "</td><td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<select class=\"combobox\" name=\"applicant_nominee_dob_month\" id=\"applicant_nominee_dob_month\" style=\"width: 50px\">";
    print "<option value=\"\"></option>";
    if ($v_month == "01") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"01\" $selected >Jan</option>";
    if ($v_month == "02") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"02\" $selected >Feb</option>";
    if ($v_month == "03") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"03\" $selected >Mar</option>";
    if ($v_month == "04") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"04\" $selected >Apr</option>";
    if ($v_month == "05") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"05\" $selected >May</option>";
    if ($v_month == "06") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"06\" $selected >Jun</option>";
    if ($v_month == "07") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"07\" $selected >Jul</option>";
    if ($v_month == "08") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"08\" $selected >Aug</option>";
    if ($v_month == "09") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"09\" $selected >Sep</option>";
    if ($v_month == "10") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"10\" $selected >Oct</option>";
    if ($v_month == "11") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"11\" $selected >Nov</option>";
    if ($v_month == "12") {$selected = "selected";} else {$selected = "";}
    print "<option value=\"12\" $selected >Dec</option>";
    print "</select>&nbsp;";
    print "</td><td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<input class=\"textbox\" name=\"applicant_nominee_dob_year\" type=\"text\" value=\"$v_year\" id=\"applicant_nominee_dob_year\" size=\"4\"/>";
    print "</td>\n";
    print "<td valign=\"top\" style=\"padding-left:2px\">\n";
    print "<input type=\"image\" name=\"applicant_nominee_dob_btn\" id=\"applicant_nominee_dob_btn\" src=\"components/calendar/basicgray/images/img_calendar.gif\" onclick =\"displayCalendarSelectBox('applicant_nominee_dob_year','applicant_nominee_dob_month','applicant_nominee_dob_day',false,false,this); return false;\"style=\"border-width:0px;cursor: hand\" />";
    print "</td></tr></table>\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_nominee_parent_name;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_nominee_parent_name = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_nominee_parent_name = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Nominee Parent Name</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_nominee_parent_name\" name=\"applicant_nominee_parent_name\" type=\"text\" value=\"" . $value . "\"  size=\"50\" maxlength=\"62\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_nominee_relationship;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_nominee_relationship = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_nominee_relationship = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Nominee Relationship</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_nominee_relationship\" name=\"applicant_nominee_relationship\" type=\"text\" value=\"" . $value . "\"  size=\"20\" maxlength=\"20\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_sip_mandate;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_sip_mandate = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_sip_mandate = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Sip Mandate</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_sip_mandate\" name=\"applicant_sip_mandate\" type=\"text\" value=\"" . $value . "\"  size=\"3\" maxlength=\"3\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $applicant_sip_mandate_years;
    if (($value == "") || ($value == null)) {
        $value = "";
        $applicant_sip_mandate_years = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $applicant_sip_mandate_years = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Applicant Sip Mandate Years</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"applicant_sip_mandate_years\" name=\"applicant_sip_mandate_years\" type=\"text\" value=\"" . $value . "\"  size=\"10\" maxlength=\"10\" >\n";
    print "</td>\n";
    print "</tr>\n";
    $value = $appplicant_sip_mandate_maximum_per_month;
    if (($value == "") || ($value == null)) {
        $value = "";
        $appplicant_sip_mandate_maximum_per_month = $value;
    }
    $artsv_postback = request("artsys_postback", "");
    if (($artsv_postback == null) || ($artsv_postback == "")){
        $value = "";
        $appplicant_sip_mandate_maximum_per_month = $value;
    }
    $value = htmlspecialchars($value);

    print "<tr>\n";
    print "<td class=\"formColumnCaption\">Appplicant Sip Mandate Maximum Per Month</td>\n";
    print "<td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "<td class=\"formColumnData\" align=\"left\">\n";
    print "<input class=\"textbox\" id=\"appplicant_sip_mandate_maximum_per_month\" name=\"appplicant_sip_mandate_maximum_per_month\" type=\"text\" value=\"" . $value . "\"  size=\"10\" maxlength=\"10\" >\n";
    print "</td>\n";
    print "</tr>\n";
    print "	              <tr>\n";
    print "	                  <td class=\"formColumnCaption\"></td>\n";
    print "	                  <td width=\"3\" class=\"formColumnData\">&nbsp;</td>\n";
    print "	                  <td class=\"formColumnData\" align=\"left\"></br>\n";
    print "		                      <input name=\"btn_save\" id=\"btn_save\" type=\"submit\" value=\"" . CAP_BUTTON_SAVE . "\" class=\"button\" >\n";
    $urldatapage = "href='" . "./individual_customer.php" . "'";
    print "		                      <input name=\"btn_cancel\" id=\"btn_cancel\" type=\"reset\" value=\"" . CAP_BUTTON_CANCEL . "\" class=\"button\" onClick=\"javascript:window.location." . $urldatapage . " \">\n";
    print "                       <input type=\"hidden\" name=\"artsys_postback\" value=\"1\" >\n";
    print "	                  </br></br>\n";
    print "	                  </td>\n";
    print "	              </tr>\n";
    print "            </table>\n";
    print "        </td>\n";
    print "        <td class=\"formColumnBGRight\">&nbsp;</td>\n";
    print "    </tr>\n";
    print "    <tr>\n";
    print "        <td class=\"formFooterLeft\" nowrap >&nbsp;</td>\n";
    print "        <td class=\"formFooter\" align=\"center\" valign=\"middle\">&nbsp;</td>\n";
    print "        <td class=\"formFooterRight\" nowrap >&nbsp;</td>\n";
    print "    </tr>\n";
    print "</table>\n";
    print "</div>";

    print "</td>\n";
    print "</tr>\n";
    print "</table>\n";
    print "</td>\n";
    print "</tr>\n";
    print "</table>\n";

}

function insert_data() {
    $msg = "";
    $report = "";
    $err_require = "";
    $message = request("message", "");
    $applicant_id = request("applicant_id", "");
    $applicant_account_type = request("applicant_account_type", "");
    $applicant_name = request("applicant_name", "");
    $applicant_father_name = request("applicant_father_name", "");
    $applicant_dob_year = request("applicant_dob_year", "");
    $applicant_dob_month = request("applicant_dob_month", "");
    $applicant_dob_day = request("applicant_dob_day", "");
    if (($applicant_dob_year != "")
     && ($applicant_dob_month != "")
     && ($applicant_dob_day != "")) {
        $applicant_dob = $applicant_dob_year."-".$applicant_dob_month."-".$applicant_dob_day;
    } else {
        $applicant_dob = "";
    }
    $applicant_gender = request("applicant_gender", "");
    $applicant_pan = request("applicant_pan", "");
    $applicant_telephone_residence = request("applicant_telephone_residence", "");
    $applicant_telephone_office = request("applicant_telephone_office", "");
    $applicant_telephone_mobile = request("applicant_telephone_mobile", "");
    $applicant_email = request("applicant_email", "");
    $applicant_occupation = request("applicant_occupation", "");
    $applicant_address_permanant_line1 = request("applicant_address_permanant_line1", "");
    $applicant_address_permanent_line2 = request("applicant_address_permanent_line2", "");
    $applicant_address_permanent_city = request("applicant_address_permanent_city", "");
    $applicant_address_permanent_state = request("applicant_address_permanent_state", "");
    $applicant_address_permanent_pincode = request("applicant_address_permanent_pincode", "");
    $applicant_address_communication_line1 = request("applicant_address_communication_line1", "");
    $applicant_address_communication_line2 = request("applicant_address_communication_line2", "");
    $applicant_address_communication_city = request("applicant_address_communication_city", "");
    $applicant_address_communication_state = request("applicant_address_communication_state", "");
    $applicant_address_communication_pincode = request("applicant_address_communication_pincode", "");
    $application_application_form = request("application_application_form", "");
    $applicant_bank1_account_number = request("applicant_bank1_account_number", "");
    $bank1_account_type = request("bank1_account_type", "");
    $bank1_ifsc_code = request("bank1_ifsc_code", "");
    $bank1_micr_code = request("bank1_micr_code", "");
    $bank1_name = request("bank1_name", "");
    $bank1_branch_name = request("bank1_branch_name", "");
    $bank1_branch_address_line1 = request("bank1_branch_address_line1", "");
    $bank1_branch_address_line2 = request("bank1_branch_address_line2", "");
    $bank1_branch_city = request("bank1_branch_city", "");
    $bank1_branch_state = request("bank1_branch_state", "");
    $bank1_branch_pincode = request("bank1_branch_pincode", "");
    $applicant_bank2_account_number = request("applicant_bank2_account_number", "");
    $bank2_account_type = request("bank2_account_type", "");
    $bank2_ifsc_code = request("bank2_ifsc_code", "");
    $bank2_micr_code = request("bank2_micr_code", "");
    $bank2_name = request("bank2_name", "");
    $bank2_branch_name = request("bank2_branch_name", "");
    $bank2_branch_address_line1 = request("bank2_branch_address_line1", "");
    $bank2_branch_address_line2 = request("bank2_branch_address_line2", "");
    $bank2_branch_city = request("bank2_branch_city", "");
    $bank2_branch_state = request("bank2_branch_state", "");
    $bank2_branch_pincode = request("bank2_branch_pincode", "");
    $applicant_bank3_account_number = request("applicant_bank3_account_number", "");
    $bank3_account_type = request("bank3_account_type", "");
    $bank3_ifsc_code = request("bank3_ifsc_code", "");
    $bank3_micr_code = request("bank3_micr_code", "");
    $bank3_name = request("bank3_name", "");
    $bank3_branch_name = request("bank3_branch_name", "");
    $bank3_branch_address_line1 = request("bank3_branch_address_line1", "");
    $bank3_branch_address_line2 = request("bank3_branch_address_line2", "");
    $bank3_branch_city = request("bank3_branch_city", "");
    $bank3_branch_state = request("bank3_branch_state", "");
    $bank3_branch_pincode = request("bank3_branch_pincode", "");
    $applicant_nominee_mandate = request("applicant_nominee_mandate", "");
    $applicant_nominee_name = request("applicant_nominee_name", "");
    $applicant_nominee_dob_year = request("applicant_nominee_dob_year", "");
    $applicant_nominee_dob_month = request("applicant_nominee_dob_month", "");
    $applicant_nominee_dob_day = request("applicant_nominee_dob_day", "");
    if (($applicant_nominee_dob_year != "")
     && ($applicant_nominee_dob_month != "")
     && ($applicant_nominee_dob_day != "")) {
        $applicant_nominee_dob = $applicant_nominee_dob_year."-".$applicant_nominee_dob_month."-".$applicant_nominee_dob_day;
    } else {
        $applicant_nominee_dob = "";
    }
    $applicant_nominee_parent_name = request("applicant_nominee_parent_name", "");
    $applicant_nominee_relationship = request("applicant_nominee_relationship", "");
    $applicant_sip_mandate = request("applicant_sip_mandate", "");
    $applicant_sip_mandate_years = request("applicant_sip_mandate_years", "");
    $appplicant_sip_mandate_maximum_per_month = request("appplicant_sip_mandate_maximum_per_month", "");
    $err_require = "";

    if ($err_require != "") {
	      return $err_require;
    }

    $result = "";
    if ($result != ""){
        return $result;
    }

    if (($result == "") && (session('form_loaded', 0) != 1)){
        $sql = "INSERT INTO `individual_customer`";
        $sql .= " (";
        $sql .= "individual_customer.applicant_id"; 
        $sql .= ",individual_customer.applicant_account_type"; 
        $sql .= ",individual_customer.applicant_name"; 
        $sql .= ",individual_customer.applicant_father_name"; 
        $sql .= ",individual_customer.applicant_dob"; 
        $sql .= ",individual_customer.applicant_gender"; 
        $sql .= ",individual_customer.applicant_pan"; 
        $sql .= ",individual_customer.applicant_telephone_residence"; 
        $sql .= ",individual_customer.applicant_telephone_office"; 
        $sql .= ",individual_customer.applicant_telephone_mobile"; 
        $sql .= ",individual_customer.applicant_email"; 
        $sql .= ",individual_customer.applicant_occupation"; 
        $sql .= ",individual_customer.applicant_address_permanant_line1"; 
        $sql .= ",individual_customer.applicant_address_permanent_line2"; 
        $sql .= ",individual_customer.applicant_address_permanent_city"; 
        $sql .= ",individual_customer.applicant_address_permanent_state"; 
        $sql .= ",individual_customer.applicant_address_permanent_pincode"; 
        $sql .= ",individual_customer.applicant_address_communication_line1"; 
        $sql .= ",individual_customer.applicant_address_communication_line2"; 
        $sql .= ",individual_customer.applicant_address_communication_city"; 
        $sql .= ",individual_customer.applicant_address_communication_state"; 
        $sql .= ",individual_customer.applicant_address_communication_pincode"; 
        $sql .= ",individual_customer.application_application_form"; 
        $sql .= ",individual_customer.applicant_bank1_account_number"; 
        $sql .= ",individual_customer.bank1_account_type"; 
        $sql .= ",individual_customer.bank1_ifsc_code"; 
        $sql .= ",individual_customer.bank1_micr_code"; 
        $sql .= ",individual_customer.bank1_name"; 
        $sql .= ",individual_customer.bank1_branch_name"; 
        $sql .= ",individual_customer.bank1_branch_address_line1"; 
        $sql .= ",individual_customer.bank1_branch_address_line2"; 
        $sql .= ",individual_customer.bank1_branch_city"; 
        $sql .= ",individual_customer.bank1_branch_state"; 
        $sql .= ",individual_customer.bank1_branch_pincode"; 
        $sql .= ",individual_customer.applicant_bank2_account_number"; 
        $sql .= ",individual_customer.bank2_account_type"; 
        $sql .= ",individual_customer.bank2_ifsc_code"; 
        $sql .= ",individual_customer.bank2_micr_code"; 
        $sql .= ",individual_customer.bank2_name"; 
        $sql .= ",individual_customer.bank2_branch_name"; 
        $sql .= ",individual_customer.bank2_branch_address_line1"; 
        $sql .= ",individual_customer.bank2_branch_address_line2"; 
        $sql .= ",individual_customer.bank2_branch_city"; 
        $sql .= ",individual_customer.bank2_branch_state"; 
        $sql .= ",individual_customer.bank2_branch_pincode"; 
        $sql .= ",individual_customer.applicant_bank3_account_number"; 
        $sql .= ",individual_customer.bank3_account_type"; 
        $sql .= ",individual_customer.bank3_ifsc_code"; 
        $sql .= ",individual_customer.bank3_micr_code"; 
        $sql .= ",individual_customer.bank3_name"; 
        $sql .= ",individual_customer.bank3_branch_name"; 
        $sql .= ",individual_customer.bank3_branch_address_line1"; 
        $sql .= ",individual_customer.bank3_branch_address_line2"; 
        $sql .= ",individual_customer.bank3_branch_city"; 
        $sql .= ",individual_customer.bank3_branch_state"; 
        $sql .= ",individual_customer.bank3_branch_pincode"; 
        $sql .= ",individual_customer.applicant_nominee_mandate"; 
        $sql .= ",individual_customer.applicant_nominee_name"; 
        $sql .= ",individual_customer.applicant_nominee_dob"; 
        $sql .= ",individual_customer.applicant_nominee_parent_name"; 
        $sql .= ",individual_customer.applicant_nominee_relationship"; 
        $sql .= ",individual_customer.applicant_sip_mandate"; 
        $sql .= ",individual_customer.applicant_sip_mandate_years"; 
        $sql .= ",individual_customer.appplicant_sip_mandate_maximum_per_month"; 
        $sql .= ") ";
        $sql .= " VALUES "; 
        $sql .= " (";
        $sql .=  quote_strval($applicant_id); 
        $sql .= " , " .  quote_strval($applicant_account_type); 
        $sql .= " , " .  quote_strval($applicant_name); 
        $sql .= " , " .  quote_strval($applicant_father_name); 
        $sql .= " , " .  quote_dateval($applicant_dob); 
        $sql .= " , " .  quote_strval($applicant_gender); 
        $sql .= " , " .  quote_strval($applicant_pan); 
        $sql .= " , " .  quote_intval($applicant_telephone_residence); 
        $sql .= " , " .  quote_intval($applicant_telephone_office); 
        $sql .= " , " .  quote_intval($applicant_telephone_mobile); 
        $sql .= " , " .  quote_strval($applicant_email); 
        $sql .= " , " .  quote_strval($applicant_occupation); 
        $sql .= " , " .  quote_strval($applicant_address_permanant_line1); 
        $sql .= " , " .  quote_strval($applicant_address_permanent_line2); 
        $sql .= " , " .  quote_strval($applicant_address_permanent_city); 
        $sql .= " , " .  quote_strval($applicant_address_permanent_state); 
        $sql .= " , " .  quote_intval($applicant_address_permanent_pincode); 
        $sql .= " , " .  quote_strval($applicant_address_communication_line1); 
        $sql .= " , " .  quote_strval($applicant_address_communication_line2); 
        $sql .= " , " .  quote_strval($applicant_address_communication_city); 
        $sql .= " , " .  quote_strval($applicant_address_communication_state); 
        $sql .= " , " .  quote_intval($applicant_address_communication_pincode); 
        $sql .= " , " .  quote_strval($application_application_form); 
        $sql .= " , " .  quote_intval($applicant_bank1_account_number); 
        $sql .= " , " .  quote_strval($bank1_account_type); 
        $sql .= " , " .  quote_strval($bank1_ifsc_code); 
        $sql .= " , " .  quote_intval($bank1_micr_code); 
        $sql .= " , " .  quote_strval($bank1_name); 
        $sql .= " , " .  quote_strval($bank1_branch_name); 
        $sql .= " , " .  quote_strval($bank1_branch_address_line1); 
        $sql .= " , " .  quote_strval($bank1_branch_address_line2); 
        $sql .= " , " .  quote_strval($bank1_branch_city); 
        $sql .= " , " .  quote_strval($bank1_branch_state); 
        $sql .= " , " .  quote_intval($bank1_branch_pincode); 
        $sql .= " , " .  quote_intval($applicant_bank2_account_number); 
        $sql .= " , " .  quote_strval($bank2_account_type); 
        $sql .= " , " .  quote_strval($bank2_ifsc_code); 
        $sql .= " , " .  quote_intval($bank2_micr_code); 
        $sql .= " , " .  quote_strval($bank2_name); 
        $sql .= " , " .  quote_strval($bank2_branch_name); 
        $sql .= " , " .  quote_strval($bank2_branch_address_line1); 
        $sql .= " , " .  quote_strval($bank2_branch_address_line2); 
        $sql .= " , " .  quote_strval($bank2_branch_city); 
        $sql .= " , " .  quote_strval($bank2_branch_state); 
        $sql .= " , " .  quote_intval($bank2_branch_pincode); 
        $sql .= " , " .  quote_intval($applicant_bank3_account_number); 
        $sql .= " , " .  quote_strval($bank3_account_type); 
        $sql .= " , " .  quote_strval($bank3_ifsc_code); 
        $sql .= " , " .  quote_intval($bank3_micr_code); 
        $sql .= " , " .  quote_strval($bank3_name); 
        $sql .= " , " .  quote_strval($bank3_branch_name); 
        $sql .= " , " .  quote_strval($bank3_branch_address_line1); 
        $sql .= " , " .  quote_strval($bank3_branch_address_line2); 
        $sql .= " , " .  quote_strval($bank3_branch_city); 
        $sql .= " , " .  quote_strval($bank3_branch_state); 
        $sql .= " , " .  quote_intval($bank3_branch_pincode); 
        $sql .= " , " .  quote_intval($applicant_nominee_mandate); 
        $sql .= " , " .  quote_strval($applicant_nominee_name); 
        $sql .= " , " .  quote_dateval($applicant_nominee_dob); 
        $sql .= " , " .  quote_strval($applicant_nominee_parent_name); 
        $sql .= " , " .  quote_strval($applicant_nominee_relationship); 
        $sql .= " , " .  quote_intval($applicant_sip_mandate); 
        $sql .= " , " .  quote_intval($applicant_sip_mandate_years); 
        $sql .= " , " .  quote_intval($appplicant_sip_mandate_maximum_per_month); 
       $sql .= ") ";
    }

    if ($result == "") {
		    $query = mysql_query($sql);
			  if (!$query) {
				    $result .= MSG_INSERT_RECORD_FAIL;
				    $result .= "</br>Error: " . mysql_error();
			  } else {

            $result = "SUCCESS";
            set_session('form_loaded', 1);
        }
    }
    return $result;
}

function rowdata($row, $index){
    return (isset($row[$index]) && (trim($row[$index]) != "")) ? trim($row[$index]) : "";
}

function rowdata_byname($row, $field_names, $field_name){
    $index = array_search($field_name, $field_names);
    if ($index === false){
        return "";
    } else {
        return (isset($row[$index]) && (trim($row[$index]) != "")) ? trim($row[$index]) : "";
    }
}

function db_connection_close(){
    global $dblink;
    if (isset($dblink)) { mysql_close($dblink); }
}

function check_request($param){
    return (isset($_REQUEST[$param]));
}

function request($param, $default){
    return (isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : $default;
}

function set_request($param, $value){
    if(isset($_REQUEST[$param])){
        $_REQUEST[$param] = $value;
    }
}

function request_checkbox($param, $checked_value, $unchecked_value){
    $value = ((isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : false);
    if ($value){
	       return $checked_value;
    } else {
        return $unchecked_value;
    }
}
?>

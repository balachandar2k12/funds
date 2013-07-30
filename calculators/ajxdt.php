<?php
require_once ("conf.inc");
function request($param, $default){
    return (isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : $default;
}
?>
<script type="text/javascript">
	 $("#frmdate").datepicker("destroy"); 
	  $("#todate").datepicker("destroy"); 
	
	<?php  $mysqli = new mysqli($dbhost, $dbusername,$dbpassword,$dbnavscraper);
		 $frmdt="";
		 $todt="";
		 $hashtx="";
		 	$query="SELECT startDate,scrapStartDate,hashTxDetails  FROM `navdetails` WHERE status='ENABLED' and mutualFundValue=\"".request("mfsel","0000")."\" and mutualFundSchemeValue=\"".request("mfscsel","0000")."\" limit 1";
		 		if (($stmt2 = $mysqli->prepare($query))) 
				if($stmt2->execute())
				if($stmt2->bind_result($frmdt,$todt,$hashtx))
				{
						$stmt2->fetch();
						@$stmt2->close();
						@$mysqli->close();
				}
				
		?>		
	$( "#frmdate").datepicker({ dateFormat: "yy-mm-dd", minDate: "<?php echo $frmdt;?>" ,maxDate: "<?php echo $todt;?>",constrainInput: true,changeMonth: true,
      changeYear: true});
	$( "#todate").datepicker({ dateFormat: "yy-mm-dd", minDate: "<?php echo $frmdt;?>" ,maxDate: "<?php echo $todt;?>",constrainInput: true,changeMonth: true,
      changeYear: true});
</script>
<li class="notranslate">
              <label class="desc " for="frmdate"> From Date<span class="req">*</span> </label>
              <div>
                <input id="frmdate" name="frmdate" type="text" class="field text nospin medium" value="" maxlength="54" tabindex="5"  />
				<input id="hashtx" name="hashtx" type="hidden" value="<?php echo $hashtx; ?>"  />
              </div>
              <p class="instruct " id="instructfrmdate"><small>Please enter From Date</small></p>
				
				</li>
		
		<li class="notranslate">
              <label class="desc " for="todate">To Date<span class="req">*</span> </label>
              <div>
                <input id="todate" name="todate" type="text" class="field text nospin medium" value="" maxlength="54" tabindex="5"  />
              </div>
              <p class="instruct " id="instructtodate"><small>Please enter To Date</small></p>
				</li>
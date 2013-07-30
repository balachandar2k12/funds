 <li class="notranslate" >
 <label class="desc" id="mutualfscsell"> Select Mutual Fund Scheme </label>
					<div class="styled-select">
 
 <select id="mutalfundscsel" name="mutalfundscsel" class="field select medium" tabindex="1" onchange="slidertog3(this.value);">
    <option value="0" selected="selected"> --Select-- </option>
<?php 

require_once ("conf.inc");
function request($param, $default){
    return (isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : $default;
}
  $mysqli = new mysqli($dbhost, $dbusername,$dbpassword,$dbnavscraper);
		 $mfsname="";
		 $mfsval="";
		 	$query="SELECT mutualFundScheme,mutualFundSchemeValue  FROM `navdetails` WHERE status='ENABLED' and mutualFundValue=\"".request("mfsel","0000")."\" ORDER BY mutualFundScheme";
		 		if (($stmt2 = $mysqli->prepare($query))) 
				if($stmt2->execute())
				if($stmt2->bind_result($mfsname,$mfsval))
				{
						while($stmt2->fetch())
						{
							 echo "<option value=\"".$mfsval."\">".$mfsname."</option>";
						}
						@$stmt2->close();
				@$mysqli->close();
				}
				
?>
  </select>
    </div>
         
              <p class="instruct" id="instructmutualfundscheme"><small>Please select Mutual Fund Scheme</small></p>
			     </li>
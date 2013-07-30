<?php 
require_once ("conf.inc");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>FundsInn</title>
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/text.css" />
<link rel="stylesheet" href="../css/960_16_col.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/mailchimp.css">
<link rel="stylesheet" type="text/css" href="../css/sign.up.css">
<link rel="stylesheet" type="text/css" href="../css/structure.css">
<link rel="stylesheet" type="text/css" href="../css/form.css">
<link rel="stylesheet" href="../css/bootstrap.override.css" />
<link href='http://fonts.googleapis.com/css?family=Raleway:400,700,500,600,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/fundsinn.js"></script>
<script type="text/javascript" src="../js/individualformval.js"></script>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style type="text/css">
.er {color:red;}
.su {color:green;}
input.medium, select.medium {
width: 310px !important;
height: 34px !important;
}
#loading{
	position: absolute;
top: 357px;
left: 48%;
}
caption{
	font-family: sans-serif;
font-size: 18px !important;
}

#table-heading{
	font-style: italic;
font-size: 15px;
color: rgb(9, 105, 9);
}

#table-heading span{
	font-weight: bold;
color: rgba(2, 2, 2, 0.94);
}

</style>
<script type="text/javascript">
	
</script>
</head>
<body>
<!--MAIN WRAPPER-->
<div class="wrapper">
	<div id="loading"><img src="../img/ajax-loader.gif"></div>
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
<div id="contentBody" class="container_16 signUpPage " >
  <div class="pageContent">
    <div class="contentTitleBox">
      <div class="homeContentTitle titleFix" id="topfundsinn">
        <h3>JOIN FUNDSINN</h3>
      </div>
    </div>
    <div class="serviceContainer container_16" >
      <div class="generic_pageTitle">
        <h3>Mutual Funds Returns Calculator</h3>
      </div>
      <div id="signUp-Container" class="grid_14 gridFirst"> 
       <!-- woofoo forms -->
        <form id="sipcalform" name="sipcalform" class="wufoo leftLabel page"  autocomplete="off" novalidate method="post" action="sip_calculator.php">
			<div id="errordis">
			
			</div>
           <div class="formHeaderTitle">
                <h3 id="titleindividual">Mutual Funds</h3>
			</div>
			<ul>
            <li class="notranslate">
                                   <?php 
		  $mysqli = new mysqli($dbhost, $dbusername,$dbpassword,$dbnavscraper);
		 $mfname="";
		 $mfval="";
		 	$query="SELECT DISTINCT mutualFundName,mutualFundValue  FROM `navdetails` WHERE status='ENABLED' ORDER BY mutualFundName";
		 
				if (($stmt2 = $mysqli->prepare($query))) 
				if($stmt2->execute())
				if($stmt2->bind_result($mfname,$mfval))
				{?>
						<label class="desc" id="mutualfsell"> Select Mutual Fund </label>
					<div  class="styled-select">
                  <select id="mutualfsel" name="mutalfundel" class="field select medium" tabindex="1" onchange="slidertog2(this.value);">
                	<option value="0" id="mutualfsel0" selected="selected"> --Select-- </option>
						<?php
						while($stmt2->fetch())
						{
							  echo "<option value=\"".$mfval."\">".$mfname."</option>";
						}
						$stmt2->close();
						$mysqli->close();
				}
				
		  ?>
		       </select>
			  </div>
         
              <p class="instruct" id="instructmutualfund"><small>Please select Mutual Fund</small></p>
            </li>
			
			 
           <div id="mfscheme" hidden>
		   </div>
		    <div id="datesel" hidden>
				
         </div>
			   <li class="buttons ">
              <div>
			       <button id="sipcalForm-button" name="sipcalForm" class="btTxt submit fundsInn-btn" tabindex="69" type="button" >Submit</button>
              </div>
            </li>
		 </ul>
        </form>
        
   </div>
         
        <!-- WUFOO FORMS --> 
		
		
		<?php 
				
			function request($param, $default){
				return (isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : $default;
			}
				$postmfsel=request("mutalfundel","0");
				$psotmfscsel=request("mutalfundscsel","0");
				$postfrmdate=request("frmdate","0");
				$psottodate=request("todate","0");
				$posthashtx=request("hashtx","0");
				
				if(($postmfsel!="0") && ($psotmfscsel!="0") && ($postfrmdate!="0") && ($psottodate!="0") && ($posthashtx!="0"))
				{
					$mysqli = new mysqli($dbhost, $dbusername,$dbpassword,$dbnavscraper);
					$navdate="";
					$navprice="";
					$mfname="";
					$mfscname="";
					$mflatestdate="";
					$mflatestnav="";
					
					$query1="SELECT mutualFundName,mutualFundScheme,latestNav,latestDate FROM navlatest,navdetails WHERE navdetails.status=\"ENABLED\" and navlatest.hashTxDetails=\"".$posthashtx."\" and navdetails.hashTxDetails=\"".$posthashtx."\"  ORDER BY latestDate DESC limit 1";
					$query="SELECT navDate,navPrice FROM navdata,navdetails WHERE navdetails.status=\"ENABLED\" AND DATE(navDate)>=DATE(\"".$postfrmdate."\") and DATE(navDate)<=DATE(\"".$psottodate."\") and navdata.hashTxDetails=\"".$posthashtx."\" and navdetails.hashTxDetails=\"".$posthashtx."\"  ORDER BY navDate";
					if (($stmt = $mysqli->prepare($query1))) 
					if($stmt->execute())
					if($stmt->bind_result($mfname,$mfscname,$mflatestnav,$mflatestdate))
						$stmt->fetch();
					@$stmt->close();
					
					if (($stmt2 = $mysqli->prepare($query))) 
					if($stmt2->execute())
					if($stmt2->bind_result($navdate,$navprice))
					{
					?>
								<div id="results">
									 <div id="table_container ">
								<div class="row">
								<div class="span3"></div>
									
								<table class="span6 table table-bordered table-striped"> 
										<caption>NAV DETAILS</caption>
										<thead>
													<tr>
													<th colspan="2" id="table-heading"><?php echo  $mfname; ?>,&nbsp; <span> Scheme : </span><?php echo  $mfscname; ?></th>
													
												</tr>
												<tr>
													<th>NAV Date&nbsp;&nbsp;&nbsp</th>
													<th>Price &nbsp;&nbsp;</th>
												 </tr>	
													<tr>
													<th><?php echo  $mflatestdate; ?></th>
													<th><?php echo  $mflatestnav; ?></th>
												</tr>
												</thead>
											<tbody>
   
						<?php
								while($stmt2->fetch())
								{
										echo "<tr> <th>".$navdate."</th> <td>".$navprice."</td>  </tr>";
								}
									@$stmt2->close();
									@$mysqli->close();
						echo "</tbody> </table></div> </div><div class='span3'></div>
								</div>";
					}
					@$mysqli->close();
				}
		?>
  </div>
 </div>
</div>



  <div class="contactUs container_16">
    <div class="homeContentTitle conttactUsTitle grid_4 push_6">
      <h3>CONTACT US</h3>
    </div>
    <div id="contactInfoBox" class="container_16">
      <div class="contactInfo grid_8">
       <div class="contactInfo-Title"> PHONE NUMBER </div>
        <div class="contactInfo-Path"> (080) 412-444-24</div>
      </div>
      <div class="contactInfo grid_8">
        <div class="contactInfo-Title"> E-MAIL </div>
        <div class="contactInfo-Path"><a href="mailto:invest@fundsinn.com?">invest@fundsinn.com</a></div>
      </div>
    </div>
  </div>
  
<!--MAIN WRAPPER-->
<?php include("../forms/footer.php"); ?>
</div>
<script type="text/javascript">
function slidertog2(selval)
	{
	
		if(selval=="0")
		{
			alert("please select option");
			$("#mfscheme").hide();
			$("#datesel").hide();
		}
		else
		{
			$("#mfscheme").hide();
			$.ajax({
					type: "POST",
					url: './ajax_select_scheme.php?mfsel='+selval,
					success: function (data) {
						$("#mfscheme").html(data);
					}});
	
			$("#mfscheme").slideToggle("slow");
		}
	}
	
	function slidertog3(selval)
	{
	
		if(selval=="0")
		{
			alert("please select option");
			$("#datesel").hide();
		}
		else
		{
			$("#datesel").hide();
			$.ajax({
					type: "POST",
					url: './ajax_fetch_details.php?mfscsel='+selval+'&mfsel='+$('#mutualfsel').val(),
					success: function (data) {
						$("#datesel").html(data);
					}});
	
			$("#datesel").slideToggle("slow");
		}
	}

$(document).ready(function(){
	$("#loading").hide();
	$.ajaxSetup({
    beforeSend:function(){
        // show gif
        $("#loading").show();
    },
    complete:function(){
        // hide gif 
        $("#loading").hide();
    }
});
	$(document).on("change","#todate",function(){
		var frmdate=$("#frmdate").val();
		var todate=$("#todate").val();
		if( +frmdate >= +todate ){
			alert("Please Select The valid Date");
		}
	});

	$(document).on("click","#sipcalForm-button",function(){
		console.log("form");
    var frmdate=$("#frmdate").val();
		var todate=$("#todate").val();
		var toDate = new Date(todate);
		var fromDate = new Date(frmdate);
		//alert(toDate - fromDate < 0);
		if(toDate - fromDate < 0){
			alert("Please Select The valid Date");
			$("#frmdate").val("");
			$("#todate").val("");
		}else{
			//alert("soon");
			$("#sipcalform").submit();
		}
	});	
});	
</script>
</body>
</html>
$(function() {
	
	/* redirection script */
	$("#redirectIndividual").click(function(){
		window.location.href='Individual_acc_opening.html';
	});
	$("#redirectNRI").click(function(){
		window.location.href='NRI_acc_opening.html';
	});
	$("#redirectCorp").click(function(){
		window.location.href='corporate_account_opening.html';
	});
	
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
		
		
		
	$('#investor2').hide();
	$('#investor3').hide();
	$('#bankdetails2').hide();
	$('#bankdetails3').hide();
	$('#bank3stat').attr('value','bank3false');
	$('#bank2stat').attr('value','bank2false');
	
	
});


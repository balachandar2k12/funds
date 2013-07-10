$(function() {
	
	/* redirection script */

	
if($("#applicantpaddrcheck").attr("checked"))
		$('#applicantcommunicationaddress').hide();
	else
		$('#applicantcommunicationaddress').show();
		
	if($("#applicantsip").attr("checked"))
		{
			$('#sipmdetails').hide();
			$('#instructapplicantsip').html("<small>SIP Details</small><br/>");
		}
	else
		{
		$('#sipmdetails').show();
		$('#instructapplicantsip').html("<small>SIP Details</small><br/>");
		}
		
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


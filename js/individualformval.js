
//check validation and defaults /formatting

	// app id generate unique
	
	var alphapattern=/^[A-Za-z]+[A-Za-z ]*$/;

	
	function alphareq(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Applicant Name cannot be empty";
		else
		if(alphapattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Only alphabhats are allowed for name";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter your name as per pancard</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	function alphareq2(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(alphapattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Only alphabhats are allowed for contact name";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter your contact person name </small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function alphareq3(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(alphapattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Only alphabhats are allowed for contact designation";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter contact person's designation </small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	var ddpattern=/^(0?[1-9]|[12][0-9]|3[01])$/;
	function ddval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Date cannot be empty";
		else
		if(ddpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Date";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter Date of birth </small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function ddval2(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Date cannot be empty";
		else
		if(ddpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Date";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter Date of Incorporation</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	var mmpattern=/^(0?[1-9]|1[012])$/;
	
	function mmval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Date cannot be empty";
		else
		if(mmpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Date";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter Date of birth </small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function mmval2(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Date cannot be empty";
		else
		if(mmpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Date";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter Date of Incorporation</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}


	var yypattern=/^(19|20)?[0-9]{2}$/;
		function yyval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Date cannot be empty";
		else
		if(yypattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Date";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter Date of Birth</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	
	var yypattern2=/^(1)?[0-9]{3}$/;
		function yyval2(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Date cannot be empty";
		else
		if(yypattern2.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Date";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter Date of incorporation</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	var panpattern=/^[a-zA-Z]{4,4}[cphfatbljgCPHFATBLJG]{1,1}[0-9]{4,4}[a-zA-Z]/;
	
	function panval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="PAN number cannot be empty";
		else
		if(panpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid PAN";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter your PAN number</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	var terpattern=/^[0-9]{6,12}$/;
	
	function terval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(terpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Tele Phone number";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter Residential number</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
		var teopattern=/^[0-9]{6,15}$/;
	
	function teoval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(teopattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Tele Phone number";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter office number</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
			var tempattern=/^[0-9]{10,11}$/;
	
	function temval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="mobile number cannot be empty";
		else
		if(tempattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid mobile Phone number";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter your mobile number<br/>9XXXXXXXX9</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	function temval2(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(tempattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid mobile Phone number";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter your mobile number</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
				var empattern=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
	
	function emval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Email cannot be empty";
		else
		if(empattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Email";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Re sign-up to change your email address</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function emval2(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(empattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Email";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Re sign-up to change your email address</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	function ocval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="--Select--")
			return_attr="Please select the occupation ";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please Select your Occupation</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	function statusval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="--Select--")
			return_attr="Please select Status ";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please select your Status</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
function natval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="--Select--")
			return_attr="Please select Nationality ";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small> Please Select your Nationality</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	function ocuoval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="--Select--")
			return_attr="Please select country ";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please select  your country</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	

	function tstatusval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="--Select--")
			return_attr="Please select the Tax Status ";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please select  your Tax Status</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function addrval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Address Cannot be empty";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please Enter address</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function cityval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="City  Cannot be empty";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please Enter City</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function stateval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="State Cannot be empty";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please Enter State</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	var pinpattern=/^[0-9]{6,7}$/;
	
	function pinval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Pin/Zip cannot be empty";
		else
		if(pinpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Pin/Zip";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter Pincode/Zip</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	var accpattern=/^[0-9]{1,20}$/;
	
	
	function accval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Account number cannot be empty";
		else
		if(accpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid Account No";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter your account no</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
		
	function ifscval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="IFSC code Cannot be empty";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please enter your IFSC CODE</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	var micrpattern=/^[0-9]{9}$/;
	
	function micrval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="MICR code nocannot be empty";
		else
		if(micrpattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Invalid MICR No";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please enter MICR number</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function bankval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Bank Name Cannot be empty";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please enter your Bank Name</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	function bankaddrval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Bank address Cannot be empty";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Enter Bank Address</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	


	function appnominval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="Nominee Name Cannot be empty";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Please Enter your Nominee Name</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
	
	
	function nomempval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(alphapattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Only alphabets are allowed";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please Enter Nominee's Parent name in case of minor</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	
		function nomemrval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="")
			return_attr="TRUE";
		else
		if(alphapattern.test(val))
			return_attr="TRUE";
		else
			return_attr="Only alphabets are allowed";
			
		if(return_attr=="TRUE")
		{
				$('#'+errocontainer).html("<small>Please your enter Nominee Realtion</small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	function vyval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="--Select--")
			return_attr="Please select No years of validity ";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Enter your SIP Details  </small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
	function maval(val,fieldname,errocontainer)
	{
		var return_attr;
		if(val=="--Select--")
			return_attr="Please select Mandate amount ";
		else
			return_attr="TRUE";
		
		if(return_attr=="TRUE")
		{
			$('#'+errocontainer).html("<small>Enter your SIP Details </small><br/>");
			$('#'+fieldname).removeClass("error");
		}
		else
		{
			$('#'+errocontainer).html("<small>"+return_attr+"</small><br/>");
			$('#'+fieldname).addClass("error");
		}
	}
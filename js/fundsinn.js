$(function() {
	content = "";
	content_investor = "";
	
	$("#addmorebank").click(function(){
		if(content == "done"){
			return;
		}
		if(content == ""){
			content = $("#bank_details").html();
		}else{
			content = " ";
		}
		$("#bank_details").append(content);
	});
	
	$("#addmoreinvestor").click(function(){
		if(content_investor == "done"){
			return;
		}
		if(content_investor == ""){
			content_investor = $("#investor_details").html();
		}else{
			content_investor = " ";
		}
		$("#investor_details").append("<br><br><br>"+content_investor);
	});
	
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
	
});
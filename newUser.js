$("#repass").keyup(function(event){
	var pass1 = $('#password').val();
	var pass2 = $('#repass');
	
	var goodColor = "#66cc66";
	var badColor = "#ff6666";
	
	if (pass1 === pass2.val()){
		$("#submit").removeAttr('disabled');
		pass2.css("backgroundColor", goodColor);
	} else {
		$("#submit").attr('disabled', 'disabled');
		pass2.css("backgroundColor", badColor);
	}
});
						
function clearFields(){
	$('#repass').css("backgroundColor", "#ffffff");
}
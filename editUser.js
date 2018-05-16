function enableDisable(bEnable){
	$('#password').prop( "disabled", !bEnable );
	$('#repass').prop( "disabled", !bEnable );
	
	$('#password').css("backgroundColor", "white");
	$('#repass').css("backgroundColor", "white");
	
	if(!bEnable)
	{
		$('#password').val("");
		$('#repass').val("");
		
		$('#password').prop('required',false);
		$('#repass').prop('required',false);
		
		$('#password').css("backgroundColor", "#C3C3C3");
		$('#repass').css("backgroundColor", "#C3C3C3");
		
		$('#submit').prop( "disabled", false );
	}
	else
	{
		$('#password').prop('required',true);
		$('#repass').prop('required',true);
	}
}

		$('#password').css("backgroundColor", "#C3C3C3");
		$('#repass').css("backgroundColor", "#C3C3C3");

$("#repass").keyup(function(event){
	var pass1 = $('#password').val();
	var pass2 = $('#repass');
	
	var goodColor = "#66cc66";
	var badColor = "#ff6666";
	
	if (pass1 === pass2.val()){
		$('#submit').prop( "disabled", false );
		pass2.css("backgroundColor", goodColor);
	} else {
		$('#submit').prop( "disabled", true );
		pass2.css("backgroundColor", badColor);
	}
});
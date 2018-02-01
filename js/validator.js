$(document).ready(function(){
  handleEvents();  
});

function handleEvents(){
  $("#inputPassword2").keyup(function(event) {
    //Store the password field objects into variables ...
     
    var pass1 = $('#Password').val();
    var pass2 = $('#inputPassword2');
    //Store the Confimation Message Object ...
    var message = $('#confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1 == pass2.val()) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.css("backgroundColor",goodColor);
        message.css("color",goodColor);  
        message.html("¡Contraseñas coinciden!");
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.css("backgroundColor",badColor);
        message.css("color",badColor);
        message.html("¡Contraseñas no coinciden!");
    }
  });
}
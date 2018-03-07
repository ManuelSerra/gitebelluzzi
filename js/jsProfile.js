$(document).ready(function () {
  $("#wrapper").load("backend/profile.php");
});
function myFunction() {
    var x = document.getElementById("password");
    var y = document.getElementById("confirm_password");
    if (x.type === "password" && y.type === "password" ) {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

/*var saveButton = function(button) {
      button.innerHTML = 'Saving <span class="spinner"></span>';
      button.disabled = true;
      var password = document.getElementById("password")
      ,confirm_password = document.getElementById("confirm_password");
    setTimeout(function(){
    button.innerHTML = 'Saved';
    button.className = 'done';
  }, 3000);
    this.form.submit();
 };
function validatePassword(){
      if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Le password non combaciano");
      } else {
          confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
*/

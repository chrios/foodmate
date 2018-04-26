document.querySelector('#inputEmail0').addEventListener('click', function(){
  var passwordField = document.querySelector('#fm-signin');
  passwordField.setAttribute("style", "visibility: visible; opacity: 1;");
});

document.querySelector('#inputPassword0').addEventListener('click', function(){
  var loginButtons = document.querySelector('#enter-buttons');
  loginButtons.setAttribute("style", "visibility: visible; opacity: 1;");
});

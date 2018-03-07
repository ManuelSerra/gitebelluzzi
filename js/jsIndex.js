document.getElementById('loginError').style.display = 'none';
if(location.search.split('loginError=')[1] == '1'){
  document.getElementById('loginError').style.display = 'block';
}
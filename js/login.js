function validate() {
  var username = document.getElementById("uname");
  var password = document.getElementById("password");
  var error = document.getElementById("error");
  var error1 = document.getElementById("error1");
  var temp = true;
  if (username.value.trim() == "") {
    error.innerHTML = "* Empty username!!";
    temp = false;
  } else {
    var regex = /^[a-zA-Z0-9][a-zA-Z0-9]{5,}$/;
    if (regex.test(username.value)) {
    } else {
      error.innerHTML = "* Length of username is more than 4 character!!";
      temp = false;
    }
  }
  if (password.value.trim() == "") {
    error1.innerHTML = "* Empty password!!";
    temp = false;
  } else {
    var regex = /^[a-zA-Z0-9@_]{5,}$/;
    if (regex.test(password.value)) {
    } else {
      error1.innerHTML = "* Length of password is more than 4 character!!";
      temp = false;
    }
  }
  return temp;
}

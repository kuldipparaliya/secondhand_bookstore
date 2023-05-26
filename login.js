/* validation for username  */
var save = document.getElementById("save");
var username = document.getElementById("uname");
var password = document.getElementById("password");
var error1 = document.getElementById("error1");
var error = document.getElementById("error");

username.addEventListener("change", validate);
password.addEventListener("change", validate1);

save.disabled = true;
var passBoolean = true;
var userBoolean = true;
var content = "";

function validate(e) {
  content = e.target.value;
  userBoolean = true;
  error.innerHTML = "";
  if (content == "") {
    error.innerHTML = "* Username is Empty!!";
    userBoolean = false;
  } else if (content.length < 4) {
    error.innerHTML = "* Minimum lenght is 4 required!!";
    userBoolean = false;
  } else if (/[a-zA-Z][a-zA-Z0-9]{3,}/.test(content)) {
    error.innerHTML = "";
  } else {
    error.innerHTML = "* Username start with Character.";
    userBoolean = false;
  }
  check();
}

content = "";
function validate1(e) {
  content = e.target.value;
  passBoolean = true;
  error1.innerHTML = "";
  if (content == "") {
    error1.innerHTML = "* Password is Empty!!";
    passBoolean = false;
  } else if (content.length < 5) {
    error1.innerHTML = "* Minimum lenght is 5 required!!";
    passBoolean = false;
  }
  check();
}

function check() {
  if (userBoolean && passBoolean) {
    save.disabled = false;
  }
}

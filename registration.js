var fname = document.getElementById("fname");
var lname = document.getElementById("lname");
var uname = document.getElementById("uname");
var password = document.getElementById("password");
var gmail = document.getElementById("gmail");
var contact = document.getElementById("contact");
var error = document.getElementById("error");
var error1 = document.getElementById("error1");
var error2 = document.getElementById("error2");
var error3 = document.getElementById("error3");
var error4 = document.getElementById("error4");
var error5 = document.getElementById("error5");
var save = document.getElementById("save");

save.disabled = true;
var content = "";
var firstBoolean = true;
var lastBoolean = true;
var userBoolean = true;
var passBoolean = true;
var gmailBoolean = true;
var contactBoolean = true;

fname.addEventListener("change", validateFirst);
lname.addEventListener("change", validateLast);
uname.addEventListener("change", validateUser);
password.addEventListener("change", validatePassword);
gmail.addEventListener("change", validateGmail);
// contact.addEventListener("change", validateContact);

function validateFirst(e) {
  content = e.target.value;
  firstBoolean = true;
  error.innerHTML = "";

  if (content == "") {
    error.innerHTML = "* FirstName is Empty!!";
    firstBoolean = false;
  } else if (content.length < 4) {
    error.innerHTML = "* Minimum lenght is 4 required!!";
    firstBoolean = false;
  } else if (/[a-zA-Z][a-zA-Z]{3,}/.test(content)) {
    error.innerHTML = "";
  } else {
    error.innerHTML = "* Only Character allowed!!";
    firstBoolean = false;
  }
  check();
}

function validateLast(e) {
  content = e.target.value;
  lastBoolean = true;
  error1.innerHTML = "";

  if (content == "") {
    error1.innerHTML = "* LastName is Empty!!";
    lastBoolean = false;
  } else if (content.length < 4) {
    error1.innerHTML = "* Minimum lenght is 4 required!!";
    lastBoolean = false;
  } else if (/[a-zA-Z][a-zA-Z]{3,}/.test(content)) {
    error1.innerHTML = "";
  } else {
    error1.innerHTML = "* Only Character allowed!!";
    lastBoolean = false;
  }
  check();
}

function validateUser(e) {
  content = e.target.value;
  userBoolean = true;
  error2.innerHTML = "";

  if (content == "") {
    error.innerHTML = "* UserName is Empty!!";
    userBoolean = false;
  } else if (content.length < 4) {
    error2.innerHTML = "* Minimum lenght is 4 required!!";
    userBoolean = false;
  } else if (/[a-zA-Z][a-zA-Z0-9]{3,}/.test(content)) {
    error2.innerHTML = "";
  } else {
    error2.innerHTML = "* Username start with character!!";
    userBoolean = false;
  }
  check();
}

function validatePassword(e) {
  content = e.target.value;
  passBoolean = true;
  error3.innerHTML = "";

  if (content == "") {
    error3.innerHTML = "* Password is Empty!!";
    passBoolean = false;
  } else if (content.length < 5) {
    error3.innerHTML = "* Minimum length 5 is required!!";
    passBoolean = false;
  }

  check();
}

function validateGmail(e) {
  content = e.target.value;
  gmailBoolean = true;
  error4.innerHTML = "";

  if (content == "") {
    error4.innerHTML = "* Gmail is Empty!!";
    gmailBoolean = false;
  } else if (
    /^[a-zA-Z][a-zA-Z0-9]*@[a-zA-Z0-9]*.[a-zA-Z]{2,3}$/.test(content)
  ) {
    error4.innerHTML = "";
  } else {
    error4.innerHTML = "* Invalid Username!!";
    gmailBoolean = false;
  }
  check();
}

// function validateContact(e) {
//   content = e.target.value;
//   console.log(content);
//   contactBoolean = true;
//   error5.innerHTML = "";
//   if ((content = "")) {
//     error5.innerHTML = "* Contact is Empty!!";
//     contactBoolean = false;
//   } else if (content.length == 10) {
//   } else {
//     error5.innerHTML = "* Length 10 is Required!!";
//     contactBoolean = false;
//   }

//   check();
// }

function check() {
  if (
    firstBoolean &&
    lastBoolean &&
    userBoolean &&
    passBoolean &&
    gmailBoolean &&
    contactBoolean
  ) {
    save.disabled = false;
  }
}

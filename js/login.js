// function validate(e) {
//   var username = document.getElementById("uname");
//   var password = document.getElementById("password");
//   var error = document.getElementById("error");
//   var error1 = document.getElementById("error1");
// }

// document.getElementById("save").addEventListener("click", validate(e));

//   if (username.value.trim() == "") {
//     error.innerHTML = "* Empty username!!";
//     // return false;
//   } else {
//     var regex = /^[a-zA-Z0-9][a-zA-Z0-9]{5,}$/;
//     if (regex.test(username.value)) {
//     } else {
//       error.innerHTML = "* Length of username is more than 4 character!!";
//       // return false;
//     }
//   }
//   if (password.value.trim() == "") {
//     error1.innerHTML = "* Empty password!!";
//     // return false;
//   } else {
//     var regex = /^[a-zA-Z0-9@_]{5,}$/;
//     if (regex.test(password.value)) {
//     } else {
//       error1.innerHTML = "* Length of password is more than 4 character!!";
//       // return false;
//     }
//   }
//   // return true;
// }

var error = document.getElementById("error");
var username = document.getElementById("uname");

document
  .querySelectorAll("input")
  .forEach((input) => input.addEventListener("change", () => validate()));

function validate() {
  console.log("hello world!!");
  // if (username.value.trim() == "") {
  //   error.innerHTML = "* Empty Username!!";
  // }
}

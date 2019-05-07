const d_form = document.forms[0];
const form_c = document.querySelector(".form-container form .emp");
const adm_email_error_msg = document.querySelector(".adm_email-error");
const adm_password_error_msg = document.querySelector(".adm_password-error");
const inp_adm_email = document.getElementById("adm_email");
const inp_adm_password = document.getElementById("adm_password");
const pwd_strength_meter = document.getElementById("pwd-strength-meter");

inp_adm_password.addEventListener("focusout", function() {
  inp_adm_password.style.borderColor = "rgba(0, 0, 0, 0)";
});

inp_adm_password.addEventListener("focusin", function() {
  inp_adm_password.style.borderColor = "rgba(0, 0, 0, 1)";
});

function validateInput() {
  event.preventDefault();
  let is_valid_adm_email = true;
  let is_valid_adm_password = true;

  if (inp_adm_email.value === "") {
    is_valid_adm_email = false;
    inp_adm_email.classList.add("error");
    adm_email_error_msg.innerText = "Employee ID Cannot be Empty!";
  } else {
    is_valid_adm_email = true;
    inp_adm_email.classList.remove("error");
    adm_email_error_msg.innerText = "";
  }

  if (inp_adm_password.value === "") {
    is_valid_adm_password = false;
    inp_adm_password.classList.add("error");
    adm_password_error_msg.innerText = "Password Cannot be Empty!";
  } else {
    is_valid_adm_password = true;
    inp_adm_password.classList.remove("error");
    adm_password_error_msg.innerText = "";
  }

  if (is_valid_adm_email && is_valid_adm_password) {
    d_form.submit();
  }
}

// function validatePassword(password) {
//   // Do not show anything when the length of password is zero.
//   if (password.length === 0) {
//     pwd_strength_meter.innerHTML = "";
//     inp_adm_password.style.borderColor = "black";
//     return;
//   }
//   // Create an array and push all possible values that you want in password
//   const matchedCase = new Array();
//   matchedCase.push("[$@$!%*#?&]"); // Special Charector
//   matchedCase.push("[A-Z]"); // Uppercase Alpabates
//   matchedCase.push("[0-9]"); // Numbers
//   matchedCase.push("[a-z]"); // Lowercase Alphabates

//   // Check the conditions
//   let ctr = 0;
//   for (let i = 0; i < matchedCase.length; i++) {
//     if (new RegExp(matchedCase[i]).test(password)) {
//       ctr++;
//     }
//   }

//   if (password.length >= 8) {
//     ctr++;
//   }

//   // Display it
//   let color = "";
//   let strength = "";
//   switch (ctr) {
//     case 0:
//     case 1:
//     case 2:
//       strength = "Password Strength: <b>Weak</b>";
//       color = "red";
//       break;
//     case 3:
//       strength = "Password Strength: <b>Medium</b>";
//       color = "yellow";
//       break;
//     case 4:
//       strength = "Password Strength: <b>Strong</b>";
//       color = "orange";
//       break;
//     case 5:
//       strength = "Password Strength: <b>Very Strong</b>";
//       color = "green";
//       break;
//   }
//   pwd_strength_meter.innerHTML = strength;
//   inp_adm_password.style.borderColor = color;
// }

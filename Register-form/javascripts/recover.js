var logbtn = document.getElementById("verbtn");
var recbtn = document.getElementById("recbtn");
var resbtn = document.getElementById("resbtn");

let recform = document.getElementById("recform");
let form = document.getElementById("form");
let resetform = document.getElementById("resetform");

logbtn.addEventListener("click", () => {
  var email = document.querySelector("#email").value;
  var error = document.querySelector("#error");

  let req = new XMLHttpRequest();
  req.open("POST", "recover.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("email=" + email);

  req.responseType = "document";
  req.onload = () => {
    let result = req.response.body.querySelector("span");

    if (result.style.color == "green") {
      //what happens if login is successfull

      recform.style.display = "flex";
      form.style.display = "none"
      error.style.color = "green";
      error.innerHTML = result.innerHTML;
    } else {
      //what happens if login fails

      error.style.color = "red";
      error.innerHTML = result.innerHTML;
    }
  };
});

recbtn.addEventListener("click", () => {
  var recoverycode = document.querySelector("#recoverycode").value;
  var error = document.querySelector("#error");

  let req = new XMLHttpRequest();
  req.open("POST", "verify.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("recoverycode=" + recoverycode);

  req.responseType = "document";
  req.onload = () => {
    let result = req.response.body.querySelector("span");
    if (result.style.color == "green") {
      //what happens if login is successfull

      resetform.style.display = "flex";
      recform.style.display = "none"
      error.style.color = "green";
      error.innerHTML = result.innerHTML;
    } else {
      //what happens if login fails

      error.style.color = "red";
      error.innerHTML = result.innerHTML;
    }
  };
});

resbtn.addEventListener("click", () => {
  var newpass = document.querySelector("#newpass").value;
  var cnewpass = document.querySelector("#cnewpass").value;
  var error = document.querySelector("#error");

  let req = new XMLHttpRequest();
  req.open("POST", "passreset.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("newpass=" + newpass + "&cnewpass=" + cnewpass);

  req.responseType = "document";
  req.onload = () => {
    let result = req.response.body;
    if (result.style.color == "green") {
      //what happens if login is successfull
      error.style.color = "green";
      error.innerHTML = result.innerHTML;
    } else {
      //what happens if login fails

      error.style.color = "red";
      error.innerHTML = result.innerHTML;
    }
  };
});

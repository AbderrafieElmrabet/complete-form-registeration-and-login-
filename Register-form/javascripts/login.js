var logbtn = document.getElementById("logbtn");

logbtn.addEventListener("click", () => {
  var email = document.querySelector("#email").value;
  var password = document.querySelector("#password").value;
  var error = document.querySelector("#error");

  let req = new XMLHttpRequest();
  req.open("POST", "login.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send("email=" + email + "&password=" + password);

  req.responseType = "document";
  req.onload = () => {
    let result = req.response.body.querySelector("span");
    if (result.style.color == "green") {
      //what happens if login is successfull
      location = "welcome.html";
    } else {
      //what happens if login fails
      if (result.innerHTML == "⚠ wrong password!") {
        let recover = document.getElementById("forgot");
        recover.innerHTML = "Forgot your password?";
      }

      error.style.color = "red";
      error.innerHTML = result.innerHTML;
    }
  };
});

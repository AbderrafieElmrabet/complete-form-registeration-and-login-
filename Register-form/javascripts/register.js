var regbtn = document.getElementById("regbtn");

regbtn.addEventListener("click", () => {
  var fullname = document.querySelector("#fullName").value;
  var username = document.querySelector("#username").value;
  var email = document.querySelector("#email").value;
  var password = document.querySelector("#password").value;
  var cpassword = document.querySelector("#cpassword").value;
  var check = document.querySelector(".check").checked;
  var error = document.querySelector("#error");

  let req = new XMLHttpRequest();
  req.open("POST", "register.php");
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  req.send(
    "email=" + email +
    "&password=" + password +
    "&username=" + username +
    "&fullName=" + fullname +
    "&cpassword=" + cpassword +
    "&check=" + check
  );
  
  req.responseType = "document";
  req.onload = () => {
    esponse = req.response.body.querySelector("span");
    newFunction();
    function newFunction() {
      error.innerHTML = esponse.innerHTML;
      error.style.color = esponse.style.color;
    }
  };
});

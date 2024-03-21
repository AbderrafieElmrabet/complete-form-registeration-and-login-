let input = document.getElementById("input");
let box = document.getElementById("box");

box.style.display = "none";
document.addEventListener("keydown", function (event) {
  if (event.key == "Enter") {
    if (box.style.display == "none") {
      if (input.value != "") {
        if (input.value == "secret code!") {
          box.style.display = "flex";
        } else {
          alert("wrong answer");
        }
      } else {
        alert("enter the code!")
      }
    }
  }
})
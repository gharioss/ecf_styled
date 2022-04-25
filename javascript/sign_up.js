let error = document.getElementById("register_error");

let fname = document.getElementById("register_fname").value;
let lname = document.getElementById("register_lname").value;
let email = document.getElementById("register_email").value;
let password = document.getElementById("register_password").value;
let adress = document.getElementById("register_adress").value;
let city = document.getElementById("register_city").value;
let zip_code = document.getElementById("register_zip_code").value;

document.querySelector(".signup form").addEventListener("submit", (event) => {
  event.preventDefault();
  fetch("index.php?controller=user&task=insert")
    .then((response) => response.json())
    .then((data) => console.log(data));
});

//json encore sur user.php

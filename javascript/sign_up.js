let error = document.getElementById("register_error");

document.querySelector(".signup form").addEventListener("submit", (event) => {
  let fname = document.getElementById("register_fname").value;
  let lname = document.getElementById("register_lname").value;
  let email = document.getElementById("register_email").value;
  let pwd = document.getElementById("register_password").value;
  let adress = document.getElementById("register_adress").value;
  let city = document.getElementById("register_city").value;
  let zip_code = document.getElementById("register_zip_code").value;
  event.preventDefault();
  fetch("index.php?controller=user&task=insert", {
    method: "POST",
    body: JSON.stringify({
      fname,
      lname,
      email,
      pwd,
      adress,
      city,
      zip_code,
    }),
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  })
    .then((response) => response.json())
    // .then((data) => (error.innerHTML = data), (error.style.display = "block"));

    .then(function (data) {
      if (data == "success") {
        location.reload();
      } else {
        error.innerHTML = data;
        error.style.display = "block";
      }
    });
});

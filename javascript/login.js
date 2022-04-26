let error_login = document.getElementById("login_error");

document.querySelector(".login form").addEventListener("submit", (event) => {
  let email = document.getElementById("login_email").value;
  let pwd = document.getElementById("login_password").value;

  event.preventDefault();
  fetch("index.php?controller=user&task=login", {
    method: "POST",
    body: JSON.stringify({
      email,
      pwd,
    }),
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  })
    .then((response) => response.json())

    .then(function (data) {
      if (data == "success") {
        location.reload();
      } else {
        error_login.innerHTML = data;
        error_login.style.display = "block";
      }
    });
});

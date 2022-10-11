$(document).ready(function () {
  login();
});

function login() {
  $("#login").on("click", function () {
    let email = $("#email").val();
    let password = $("#password").val();
    console.log(email);
    console.log(password);

    //Send data with get request
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxquery/checkLogin.php",
      data: { email: email, password: password },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    //redirect to adminList.php if login is successful
    request.done(function (msg) {
      if (msg == "success") {
        window.location.href = "../adminList/adminList.php";
      } else {
        alert("Login failed");
      }
    });
  });
}

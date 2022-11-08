$(document).ready(function () {
  $("#error-msg").hide();
  $("#login").attr("disabled", "disabled");
  login();
  validateInputs();
});

function validateInputs() {
  $(".forms").keyup(function () {
    if ($("#email").val() !== "" && $("#password").val() !== "") {
      $("#login").removeAttr("disabled");
    } else {
      $("#login").attr("disabled", "disabled");
    }
  });
}

function login() {
  $("#login").on("click", function () {
    let email = $("#email").val();
    let password = $("#password").val();

    //Send data with get request
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/login/checkLogin.php",
      data: { email: email, password: password },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    //redirect to adminList.php if login is successful
    request.done(function (msg) {
      if (msg == "success") {
        window.location.href = "../contactList/contactList.php";
      } else {
        $("#error-msg").html(msg);
        $("#error-msg").show();
        $("#email").addClass("is-invalid");
        $("#password").addClass("is-invalid");
      }
    });
  });
}

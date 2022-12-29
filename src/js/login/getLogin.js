$(document).ready(function () {
  $("#error-msg").hide();
  $("#login").attr("disabled", "disabled");
  login();
  enterLogin();
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

function enterLogin() {
  $(".forms").keyup(function (event) {
    if (event.keyCode === 13) {
      $("#login").click();
    }
  });
}

function login() {
  $("#login").on("click", function () {
    //set the html text of the login button to loading
    $("#login").html("Singin in...");

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
      //if the first string is success then redirect to adminList.php
      if (msg.substring(0, 7) === "success") {
        if (msg === "success admin") {
          window.location.href = "../countriesList/countriesListAdmin.php";
        } else {
          window.location.href = "../countriesList/countriesListContacts.php";
        }
      } else {
        $("#login").html("Login");
        $("#error-msg").html(msg);
        $("#error-msg").show();
        $("#email").addClass("is-invalid");
        $("#password").addClass("is-invalid");
      }
    });
  });
}

function clearError() {
  $("#email").removeClass("is-invalid");
  $("#password").removeClass("is-invalid");
  $("#error-msg").hide();
}

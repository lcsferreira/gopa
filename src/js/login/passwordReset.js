$(document).ready(function () {
  $("#error-msg-pw1").hide();
  $("#error-msg-pw2").hide();
  $("#post-password").attr("disabled", "disabled");
  validateInputs();
  postPassword();
  validateSecurePassword();
  validateIfConfirmEqualsPassword();
});

function validateInputs() {
  $(".form").keyup(function () {
    if (
      $("#create-password").val() !== "" &&
      $("#confirm-password").val() !== ""
    ) {
      $("#post-password").removeAttr("disabled");
    } else {
      $("#post-password").attr("disabled", "disabled");
    }
  });
}

function validateSecurePassword() {
  $("#create-password").on("blur", function () {
    let password = $("#create-password").val();
    var strongRegex = new RegExp(
      "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
    );
    if (strongRegex.test(password)) {
      $("#create-password").removeClass("is-invalid");
      $("#error-msg-pw1").hide();
    } else {
      $("#create-password").addClass("is-invalid");
      $("#post-password").attr("disabled", "disabled");
      $("#error-msg-pw1").show();
    }
  });
}

function validateIfConfirmEqualsPassword() {
  $("#confirm-password").on("keyup", function () {
    if ($("#confirm-password").val() !== $("#create-password").val()) {
      $("#confirm-password").addClass("is-invalid");
      $("#post-password").attr("disabled", "disabled");
      $("#error-msg-pw2").show();
    } else {
      $("#confirm-password").removeClass("is-invalid");
      $("#post-password").removeAttr("disabled");
      $("#error-msg-pw2").hide();
    }
  });
}

function postPassword() {
  $("#post-password").on("click", function () {
    let password = $("#create-password").val();
    let confirmPassword = $("#confirm-password").val();
    //get id from url
    let url = window.location.href;
    let urlClass = new URL(url);
    let id = urlClass.searchParams.get("id");

    if (password !== confirmPassword) {
      alert("Passwords do not match");
    } else {
      let request = $.ajax({
        method: "POST",
        url: "../../ajaxQuerys/login/savePassword.php",
        data: { id: id, password: password },
        dataType: "text",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
      });

      request.done(function (msg) {
        if (msg == "success") {
          window.location.href = "../login/login.php";
        } else {
          alert(msg);
        }
      });
    }
  });
}

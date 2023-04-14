$(document).ready(function () {
  $("#error-msg").hide();
  $("#sendEmail").attr("disabled", "disabled");
  validateInputs();
  sendEmail();
});

function validateInputs() {
  $(".forms").keyup(function () {
    if ($("#email").val() !== "") {
      $("#sendEmail").removeAttr("disabled");
    } else {
      $("#sendEmail").attr("disabled", "disabled");
    }
  });
}

function clearError() {
  $("#error-msg").hide();
  $("#email").removeClass("is-invalid");
}

function sendEmail() {
  $("#sendEmail").on("click", function () {
    $("#sendEmail").html("Sending email...");
    let email = $("#email").val();
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/login/sendEmail.php",
      data: { email: email },
      dataType: "text",
      type: "post",
    });
    request.done(function (msg) {
      if (msg == "success") {
        $("#error-msg").hide();
        window.location.href = "../login/login.php";
      } else {
        $("#error-msg").show();
        $("#email").addClass("is-invalid");
        $("#sendEmail").html("Send email");
      }
    });
  });
}

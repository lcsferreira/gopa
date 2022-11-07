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

function sendEmail() {
  $("#sendEmail").on("click", function () {
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
        window.location.href = "../login/login.php";
      } else {
        $("#error-msg").show();
      }
    });
  });
}

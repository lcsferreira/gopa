$(document).ready(function () {
  $("#errorMsg").hide();
  $("#sendEmail").attr("disabled", "disabled");
  validateInputs();
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
      url: "../../ajaxquery/sendEmail.php",
      data: { email: email },
      dataType: "text",
      type: "post",
    });
    request.done(function (msg) {
      if (msg == "success") {
        $("#errorMsg").hide();
        $("#email").val("");
        $("#sendEmail").attr("disabled", "disabled");
        $("#successMsg").show();
      } else {
        $("#successMsg").hide();
        $("#errorMsg").show();
      }
    });
  });
}

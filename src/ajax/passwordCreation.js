$(document).ready(function () {
  validateInputs();
  postPassword();
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

function postPassword() {
  $("#post-password").on("click", function () {
    let password = $("#create-password").val();
    let confirmPassword = $("#confirm-password").val();
    //get id from url
    let url = window.location.href;
    let id = url.substring(url.lastIndexOf("=") + 1);

    if (password !== confirmPassword) {
      alert("Passwords do not match");
    } else {
      let request = $.ajax({
        method: "POST",
        url: "../../ajaxquery/savePassword.php",
        data: { id: id, password: password },
        dataType: "text",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
      });
    }
  });
}

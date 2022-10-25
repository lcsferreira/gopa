$(document).ready(function () {
  $("#email-error").hide();
  $("#name-error").hide();
  validateInputs();
  postAdmin();
  validateEmail();
});

function validateInputs() {
  $(".form").keyup(function () {
    $('input[type="text"]').each(function () {
      if ($(this).val() === "") {
        $("#saveCountry").attr("disabled", "disabled");
      } else {
        $("#saveCountry").removeAttr("disabled");
      }
    });
  });
}

function validateEmail() {
  $("#adm-email").on("keyup", function () {
    let email = $("#adm-email").val();
    if (email.includes("@")) {
      $("#email-error").hide();
      $("#saveadmin").removeAttr("disabled");
      $("#adm-email").removeClass("is-invalid");
    } else {
      $("#email-error").show();
      $("#saveadmin").attr("disabled", "disabled");
      $("#adm-email").addClass("is-invalid");
    }
  });
}

function postAdmin() {
  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/admins/saveAdmin.php",
      data: { name: admName, email: admEmail },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg == "success") {
        window.location.href = "../adminList/adminList.php";
      } else {
        //open modelError with msg
        alert("Admin creation failed");
      }
    });
  });
}

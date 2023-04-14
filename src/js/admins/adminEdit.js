$(document).ready(function () {
  $("#email-error").hide();
  $("#name-error").hide();
  validateInputs();
  validateName();
  validateEmail();
  putAdmin();
});

function validateInputs() {
  $(".form").keyup(function () {
    if ($("#adm-email").val() !== "" && $("#adm-name").val() !== "") {
      $("#saveadmin").removeAttr("disabled");
    } else {
      $("#saveadmin").attr("disabled", "disabled");
    }
  });
}

function validateName() {
  $("#adm-name").on("keyup", function () {
    let name = $("#adm-name").val();
    if (name.length > 3) {
      $("#name-error").hide();
      $("#saveadmin").removeAttr("disabled");
      $("#adm-name").removeClass("is-invalid");
    } else {
      $("#name-error").show();
      $("#saveadmin").attr("disabled", "disabled");
      $("#adm-name").addClass("is-invalid");
    }
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

function putAdmin() {
  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();
    let isActivated = $("#is-active").is(":checked");
    let is_active = 0;
    if (isActivated) {
      is_active = 1;
    }
    let url = window.location.href;
    let urlClass = new URL(url);
    let admId = urlClass.searchParams.get("admId");

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/admins/saveAdminEdited.php",
      data: { id: admId, name: admName, email: admEmail, is_active: is_active },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg.substring(0, 7) == "success") {
        window.location.href = "../adminList/adminList.php";
      } else {
        alert("Admin update failed");
      }
    });
  });
}

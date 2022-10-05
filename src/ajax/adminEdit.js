$(document).ready(function () {
  checkbox();
  validateInputs();
  putAdmin();
});

function checkbox() {
  $("#is-active").on("click", function () {
    if ($("#is-active").is(":checked")) {
      console.log("checked");
    } else {
      console.log("not checked");
    }
  });
}
function validateInputs() {
  $(".form").keyup(function () {
    console.log($("#adm-email").val());
    console.log($("#adm-name").val());

    if ($("#adm-email").val() !== "" && $("#adm-name").val() !== "") {
      $("#saveadmin").removeAttr("disabled");
    } else {
      $("#saveadmin").attr("disabled", "disabled");
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

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxquery/saveAdminEdited.php",
      data: { name: admName, email: admEmail, is_active: is_active },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });
  });
}

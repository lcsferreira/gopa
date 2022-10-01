$(document).ready(function () {
  validateInputs();
  postAdmin();
});

function validateInputs() {
  $("#adm-name", "#adm-email").on("input change", function () {
    if ($("#adm-email").val() !== "" && $("#adm-name").val() !== "") {
      $("#saveadmin").prop("disabled", false);
    } else {
      $("#saveadmin").prop("disabled", true);
    }
  });
}

function postAdmin() {
  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxquery/saveadmin_ajax.php",
      data: { name: admName, email: admEmail },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
      setTimeout(() => {
        window.location.href = "../pages/adminList/adminList.php";
      }, 1000);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
      // Log the error to the console
      console.error("The following error occurred: " + textStatus, errorThrown);
    });
  });
}

$(document).ready(function () {
  validateInputs();
  postAdmin();
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

function postAdmin() {
  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();

    let request = $.ajax({
      method: "POST",
      url: "../../ajaxquery/saveAdmin.php",
      data: { name: admName, email: admEmail },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg == "success") {
        window.location.href = "../adminList/adminList.php";
      } else {
        alert("Admin creation failed");
      }
    });
  });
}

$(document).ready(function () {
  updateAdmin();
});

function updateAdmin() {
  $("#saveadmin").on("click", function () {
    let admName = $("#adm-name").val();
    let admEmail = $("#adm-email").val();
    let isActive = $("#is-active").val();
    let key = null;
    console.log(admEmail, admName, isActive);
    if (isActive) {
      console.log("User activated!");
      key = Date.now().toString();
      key = calcMD5(key);
    }
    $.ajax({
      method: "POST",
      url: "../../ajaxquery/saveAdminEdited.php",
      data: { name: admName, email: admEmail, key: key },
      dataType: "json",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });
  });
}

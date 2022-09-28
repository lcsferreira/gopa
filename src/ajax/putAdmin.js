$(document).ready(function () {
  updateAdmin();
});

function updateAdmin() {
  $("#saveadmin").on("click", function () {
    var admName = $("#adm-name").val();
    var admEmail = $("#adm-email").val();
    var isActive = $("#is-active").val();
    if (!isActive) {
      console.log("User not activated!");
    } else {
      var key = Date.now().toString();
      key = calcMD5(key);
      $.ajax({
        method: "POST",
        url: "../../ajaxquery/saveAdminEdited.php",
        data: { name: admName, email: admEmail, key: key },
        dataType: "json",
        type: "post",
        contentType: "application/x-www-form-urlencoded",
      });
    }
  });
}

$(function () {
  $("#saveadmin").on("click", function () {
    var admName = $("#adm-name").val();
    var admEmail = $("#adm-email").val();

    var key = Date.now().toString();
    key = calcMD5(key);

    $.ajax({
      method: "PUT",
      url: "../../ajaxquery/saveAdminEdited.php",
      data: { name: admName, email: adEmail, key: key },
      dataType: "json",
      type: "put",
      contentType: "application/x-www-form-urlencoded",
      success: function (result) {
        console.log(result);

        if (result === 1) {
          setTimeout(function () {
            window.location.href = "../pages/adminList/adminList.php";
          }, 2000);
        }
      },
    });
  });
});

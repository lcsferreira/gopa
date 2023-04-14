$(document).ready(function () {
  confirmDelete();
  closeModal();
});

window.onunload = function () {
  closeModal();
};

function showModal(id) {
  admid = id;
  // Get the modal
  var modal = document.getElementById("modalDelete");
  modal.style.display = "block";
  //disable pointer events on the id="main" element except for the modal
  document.getElementById("main").style.pointerEvents = "none";
  //enable pointer events on the modal
  document.getElementById("modalDelete").style.pointerEvents = "auto";
}

function closeModal() {
  // Get the modal
  $("#cancel").on("click", function () {
    admid = null;
    var modal = document.getElementById("modalDelete");
    modal.style.display = "none";
    //enable pointer events on the id="main" element
    document.getElementById("main").style.pointerEvents = "auto";
  });
}

function confirmDelete() {
  $("#delete").on("click", function () {
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/admins/adminDelete.php",
      data: { id: admid },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg.substring(0, 7) == "success") {
        closeModal();
        window.location.href = "../adminList/adminList.php";
      } else {
        closeModal();
        alert(msg);
      }
    });
  });
}

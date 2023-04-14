$(document).ready(function () {
  closeModalConfirm();
});

function saveStatus(id) {
  let request = $.ajax({
    method: "POST",
    url: "../../ajaxQuerys/indicators/saveStatus.php",
    data: { id: id, value: "waiting admin" },
    dataType: "text",
    type: "post",
    contentType: "application/x-www-form-urlencoded",
  });
  request.done(function (msg) {
    //redirect to progress page
    window.location.href =
      "../../pages/countriesList/countriesListContacts.php?id=" + id;
  });
}

function confirmation(id) {
  showModalConfirm(
    "Do you want to send the information? This action will disable the possibility of modifying the data."
  );
  $("#confirm").on("click", function () {
    saveStatus(id);
  });
}

function showModalConfirm(msg) {
  // Get the modal
  var modal = document.getElementById("modalConfirm");
  modal.style.display = "block";
  //disable pointer events on the id="main" element except for the modal
  document.getElementById("main").style.pointerEvents = "none";
  //enable pointer events on the modal
  document.getElementById("modalConfirm").style.pointerEvents = "auto";
  $("#msg-confirm").html(msg);
}

function closeModalConfirm() {
  // Get the modal
  $("#cancel-confirm").on("click", function () {
    countryid = null;
    var modal = document.getElementById("modalConfirm");
    modal.style.display = "none";
    //enable pointer events on the id="main" element
    document.getElementById("main").style.pointerEvents = "auto";
  });
}

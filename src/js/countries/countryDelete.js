$(document).ready(function () {
  confirmDelete();
  closeModal();
  closeModalConfirm();
});

window.onunload = function () {
  closeModal();
  // closeModalConfirm();
};

function showModal(id) {
  countryid = id;
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
    countryid = null;
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
      url: "../../ajaxQuerys/countries/countryDelete.php",
      data: { id: countryid },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg.substring(0, 7) == "success") {
        closeModal();
        window.location.href = "../countriesList/countriesListAdmin.php";
      } else {
        closeModal();
        alert(msg);
      }
    });
  });
}

function startTranslation(countryId) {
  countryid = countryId;
  showModalConfirm(
    "Make sure you have completed all the required information. This step will be conducted just once."
  );
  $("#confirm").on("click", function () {
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/countries/countryStartTranslation.php",
      data: { id: countryid },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      if (msg.substring(0, 7) == "success") {
        closeModalConfirm();
        window.location.href =
          "../translation/translation_form.php?id=" + countryid;
      } else {
        closeModalConfirm();
        alert(msg);
      }
    });
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

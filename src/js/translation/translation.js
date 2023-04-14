$(document).ready(function (e) {
  closeModalConfirm();
  checkAllFilled();
  handleAllInputs();
});

function confirmation() {
  showModalConfirm(
    "Make sure you have completed all the required information. This step will be conducted just once."
  );
  $("#confirm").on("click", function () {
    //trigger the button with name submit
    $("input[name='submit']").trigger("click");
  });
}

function handleAllInputs() {
  //on change of any textarea
  $("textarea").on("keyup", function () {
    checkAllFilled();
  });
}

function checkAllFilled() {
  let allFilled = true;
  $("textarea").each(function () {
    if ($(this).val() == "" || $(this).val() == null) {
      allFilled = false;
    }
  });
  if (allFilled) {
    $("input[name='confirmval']").prop("disabled", false);
  } else {
    $("input[name='confirmval']").prop("disabled", true);
  }
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

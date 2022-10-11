function showModalDelete(id) {
  // Get the modal
  let modal = document.getElementById("modalDelete");
  modal.style.display = "block";
  admid = id;
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      closeModal();
    }
  };
}

function closeModal() {
  var modal = document.getElementById("modalDelete");
  modal.style.display = "none";
}

function confirmDelete() {
  console.log(admid);
  console.log("confirmDelete");
}

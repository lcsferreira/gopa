function saveStatus(id) {
  let value;
  //if the adjust input is checked, then the status is waiting admin
  if ($("#adjust").is(":checked")) {
    value = "waiting admin";
  } else if ($("#approve").is(":checked")) {
    value = "approved";
  } else {
    value = "waiting contact";
  }

  let request = $.ajax({
    method: "POST",
    url: "../../ajaxQuerys/indicators/saveStatus.php",
    data: { id: id, value: value },
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

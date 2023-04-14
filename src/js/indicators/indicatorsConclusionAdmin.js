$(document).ready(function () {});

function sendToContactReview(id) {
  //get the review value from the checkbox
  let review = $("input[name=review]:checked").val();
  let clarification = $("#clarification").val();

  if (review == "need-review") {
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/indicators/sendToContactReview.php",
      data: { id: id, clarification: clarification },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });
    request.done(function (msg) {
      // redirect to progress page
      window.location.href = "../../pages/indicators/progress.php?id=" + id;
    });
  } else {
    console.log("approved");
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/indicators/saveStatus.php",
      data: { id: id, value: "approved" },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });
    request.done(function (msg) {
      //redirect to progress page
      window.location.href =
        "../../pages/countriesList/countriesListAdmin.php?filter=approved&submit=Filter";
    });
    //redirect to progress page
  }
}

$(document).ready(function () {});

function sendToContactReview(id) {
  //get the review value from the checkbox
  let review = $("input[name=review]:checked").val();
  if (review == "need-review") {
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/indicators/sendToContactReview.php",
      data: { id: id },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });
    request.done(function (msg) {
      //redirect to progress page
      window.location.href = "../../pages/indicators/progress.php?id=" + id;
    });
  } else {
    //redirect to progress page
    window.location.href = "../../pages/indicators/progress.php?id=" + id;
  }
}

$(document).ready(function (e) {
  closeModalConfirm();
  $("#msg").fadeOut();
  $("#form").on("submit", function (e) {
    // $("#form")[0].reset();
    $("#msg").html("Uploading...").fadeIn();
    e.preventDefault();
    $.ajax({
      url: "ajaxUpload.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $("#preview").fadeOut();
        $("#err").fadeOut();
      },
      success: function (data) {
        if (data == "invalid") {
          // invalid file format.
          $("#err").html("Invalid File !").fadeIn();
        } else {
          setTimeout(function () {
            window.location.href = "cardUpload.php?id=" + data;
          }, 2000);
        }
      },
      error: function (e) {
        $("#err").html(e).fadeIn();
      },
    });
  });

  $("#preview").ready(function () {
    let id = $("input[name=country_id]").val();
    getPDF(id);
  });

  $("#form-contact").on("submit", function (e) {
    e.preventDefault();
    $("#msg").html("Uploading...").fadeIn();
    $.ajax({
      url: "cardUploadContact.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $("#msg-file-contact").fadeOut();
      },
      success: function (data) {
        if (data == "invalid") {
          // invalid file format.
          $("#msg-file-contact").html("Invalid File !").fadeIn();
        } else if (data == "success") {
          $("#msg-file-contact").html("File uploaded!").fadeIn();
          $("#msg").fadeOut();
        } else {
          $("#msg-file-contact").html(data).fadeIn();
        }
      },
      error: function (e) {
        $("#msg-file-contact").html(e).fadeIn();
      },
    });
  });
});

function getPDF(id) {
  pdfjsLib
    .getDocument(
      "https://work.globalphysicalactivityobservatory.com/uploads/card_english/" +
        id +
        ".pdf"
    )
    .promise.then(function (doc) {
      var pages = [];
      while (pages.length < doc.numPages) pages.push(pages.length + 1);
      return Promise.all(
        pages.map(function (num) {
          // create a div for each page and build a small canvas for it
          var div = document.createElement("div");
          $("#preview").html(div);
          return doc
            .getPage(num)
            .then(makeThumb)
            .then(function (canvas) {
              div.appendChild(canvas);
            });
        })
      );
    })
    .catch(console.error);
}

function makeThumb(page) {
  // draw page to fit into 96x96 canvas
  var vp = page.getViewport({ scale: 1 });
  var canvas = document.createElement("canvas");
  var scalesize = 1;
  canvas.width = vp.width * scalesize;
  canvas.height = vp.height * scalesize;

  var scalesize = 1;
  var scale = Math.min(canvas.width / vp.width, canvas.height / vp.height);
  return page
    .render({
      canvasContext: canvas.getContext("2d", { willReadFrequently: true }),
      viewport: page.getViewport(scale),
    })
    .promise.then(function () {
      return canvas;
    });
}

function saveComment() {
  let id = $("input[name=country_id]").val();
  let comment = $("textarea[name=comment]").val();
  let request = $.ajax({
    method: "POST",
    url: "../../ajaxQuerys/cards/cardCommentsContacts.php",
    data: { value: comment, id: id },
    dataType: "text",
    type: "post",
    contentType: "application/x-www-form-urlencoded",
  });
}

function submitValue() {
  let id = $("input[name=country_id]").val();
  let status;
  if ($("input[name=status]:checked").val() == "approve") {
    status = "approved";
    confirmation(id);
  } else if ($("input[name=status]:checked").val() == "adjust") {
    status = "waiting admin";
    saveValue(status, id);
  }
}

function saveValue(status, id) {
  let request = $.ajax({
    method: "POST",
    url: "../../ajaxQuerys/cards/saveStatus.php",
    data: { id: id, value: status },
    dataType: "text",
    type: "post",
    contentType: "application/x-www-form-urlencoded",
  });

  request.done(function (msg) {
    //redirect to progress page
    if (msg == "approved") {
      window.location.href =
        "../../pages/cardUpload/cardApproved.php?id=" + id + "&version=english";
    } else {
      window.location.href =
        "../../pages/countriesList/countriesListContacts.php?id=" + id;
    }
  });
}

function submitValueAdmin() {
  let id = $("input[name=country_id]").val();
  let status;
  if ($("input[name=status]:checked").val() == "review") {
    status = "review";
  }

  console.log(status);

  if (status == "review") {
    let request = $.ajax({
      method: "POST",
      url: "../../ajaxQuerys/cards/sendToContactReview.php",
      data: { id: id },
      dataType: "text",
      type: "post",
      contentType: "application/x-www-form-urlencoded",
    });

    request.done(function (msg) {
      //redirect to progress page
      window.location.href = "../../pages/countriesList/countriesListAdmin.php";
    });
  }
}

function confirmation(id) {
  showModalConfirm(
    "Do you want to approve this step? This action will disable the possibility of modifying the data."
  );
  $("#confirm").on("click", function () {
    saveValue("approved", id);
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

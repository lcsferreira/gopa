$(document).ready(function (e) {
  $("#form").on("submit", function (e) {
    // $("#form")[0].reset();
    $("#msg").html("Loading...").fadeIn();
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
            window.location.href = "cardUploadAdmin.php?id=" + data;
          }, 4000);
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
        console.log(data);
        // if (data == "invalid") {
        //   // invalid file format.
        //   $("#msg-file-contact").html("Invalid File !").fadeIn();
        // } else if (data == "success") {
        //   $("#msg-file-contact").html(data).fadeIn();
        //   $("#msg").html("Uploading...").fadeOut();
        // }
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
          document.getElementById("preview").appendChild(div);
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
    console.log("approve");
  } else if ($("input[name=status]:checked").val() == "adjust") {
    console.log("adjust");
  }
}

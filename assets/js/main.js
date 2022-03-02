$(window).on("load", function () {
  $(".preloader").fadeOut("slow");
});

$(document).ready(function () {

  "use strict";

  /*--------------- Features Carousel ------------------ */
  $(".features-carousel").owlCarousel({
    loop: true,
    margin: 0,
    autoplay: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  /*--------------- Copy Email One Click ------------------ */

  let clipboard = new ClipboardJS(".custom-email-botton");

  $('[data-toggle="tooltip"]').tooltip();

  /*--------------- Fetch All Messages ------------------ */


  try {
    function messages() {
      var email = $("#trsh_mail");
      var btn_copy = $(".custom-email-botton");

      if (email.val().length == 0) {
        btn_copy.attr("disabled", "disabled");
        email.val("landing");
        var myLand = setInterval(function () {
          var val = "";
          switch (email.val()) {
            case "landing":
              val = "landing.";
              break;

            case "landing.":
              val = "landing..";
              break;

            case "landing..":
              val = "landing...";
              break;
            case "landing...":
              val = "landing";
              break;
          }
          email.val(val);
        }, 300);
      }

      $.ajax({
        url: url,
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        type: "get",
        success: function (data) {

          clearInterval(myLand);
          btn_copy.removeAttr("disabled");

          Progress.configure({ color: [color] });
          Progress.configure({ speed: 0.8 });
          Progress.complete();


          var d = JSON.parse(data);

          email.val(d.mailbox);

          if (d.messages.length > 0) {
            $("#mailbox").html("");
          }

          $.each(d.messages, function (key, value) {
            var is_seen = "";
            if (!value.is_seen) {
              is_seen = '<span class="badge badge-success" >new</span>';
            }
            $("#mailbox").append(
              '<div class="message-item">' +
                is_seen +
                '<div class="row">' +
                '<div class="col-10 col-md-4 ov-h"><a href="view/' +
                value.id +
                '" class="sender_email">' +
                value.from +
                "<span>" +
                value.from_email +
                '</span><span class="d_show">'+ value.subject +'</span></a></div>' +
                '<div class="col-md-6 ov-h d_hide"><a href="view/' +
                value.id +
                '" class="subject_email">' +
                value.subject +
                "</div>" +
                '<div class="col-2  text-right"><a href="view/' +
                value.id +
                '" class="view_email"><i class="fas fa-chevron-right"></i></a></div>'
            );
          });
        },
      });
    }

    messages();
    setInterval(messages, fetch_time * 1000);
  } catch (error) {}

  /*--------------- Page Scrolling - scrollIt ------------------ */

  $.scrollIt({
    topOffset: 50,
  });

  /*--------------- Navbar Collapse ------------------ */
  $(".nav-link").on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });


  /*--------------- iframe height ------------------ */
  try {
    // Selecting the iframe element
    var iframe = document.getElementById("myIframe");
      
    // Adjusting the iframe height onload event
    $('iframe').on('load', function() {
      iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
    });

  } catch (error) {}

});

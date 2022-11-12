$(document).ready(function () {
  var has_errors = false;
  $("#form_validation").validate({
    rules: {
      title: {
        required: true,
        minlength: 10,
      },
      location: {
        required: true,
        minlength: 10,
      },
      date: {
        customdate: true,
      },
    },
    highlight: function (input) {
      $(input).parents(".form-line").addClass("error");
    },
    unhighlight: function (input) {
      $(input).parents(".form-line").removeClass("error");
    },
    errorPlacement: function (error, element) {
      $(element).parents(".form-group").append(error);
    },
  });
  // Upload Sermon
  /*  $("form.sermon_submit").on("submit", function (e) {
     e.preventDefault();
     var form = $(this);
     const url= form.attr("action")
     server_result_display = $(".server_response");   
     fetch(url)
     .then(data => data.json())
     .then(data => { console.log(data) })
      
    
   }); */

  // Upload Series
  $("form.upload_series").on("submit", function (e) {
    e.preventDefault();
    server_result_display = $(".server_response");
    $(this).ajaxSubmit({
      target: "#targetLayer",
      beforeSubmit: function () {
        $(".progressbar").hide();
        $(".progressbar").width("0%");
      },
      uploadProgress: function (event, progress, total, percentComplete) {
        $(".progressbar").show();
        $(".progress-bar").width(percentComplete + "%");
        $(".progress-bar").html(
          `<div id="progress-status"> ${percentComplete}%</div>`
        );
        $("button").addClass("disabled");
      },
      success: function (response) {
        if (response) {
          server_result_display
            .empty()
            .html(
              `<div class="alert alert-success form-group form-float" role="alert"><strong>Event successfully Added<strong/><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button></div>`
            );
        }
      },
      error: function (error) {
        server_result_display
          .empty()
          .html(
            `<div class="alert alert-danger form-group form-float" role="alert"><strong>An Error Occured: ${error}, Please Retry<strong/><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button></div>`
          );
      },
      reserForm: true,
    });
    return false;
  });

  // Upload Events
  $("form.event_submit").on("submit", async function (e) {
    alert('You feel me')
    e.preventDefault();
    var has_errors = false,
      form = $(this),
      form_fields = form.find("input"),
      server_result_display = $(".server_response");
    form_fields.each(function () {
      if ($(this).hasClass("error")) {
        has_errors = true;
      }
    });
    var formData = form.serialize();
    if (!has_errors) {
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        dataType: "json",
        async: false,
        encode: true,
      }).done(function (data) {
        if (data.success) {
          server_result_display
            .empty()
            .html(
              `<div class="alert alert-success form-group form-float" role="alert"><strong>${data.message}<strong/><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button></div>`
            );
        }
        if (!data.success) {
          server_result_display
            .empty()
            .html(
              `<div class="alert alert-danger form-group form-float" role="alert">
              ${data.message}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button></div>`
            );
        }
      }).fail(function (error) {
        server_result_display
          .empty()
          .html(
            '<div class="alert alert-danger form-group form-float" role="alert">Could not reach server, please try again later.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button></div>'
          );
      });
    }
  });
 
});

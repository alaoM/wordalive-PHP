$(document).ready(function () {
  $("form.mf_form_validate").each(function () {
    $(this).validate({
      rules: {
        fname: {
          required: true,
          minlength: 2,
        },
        email: {
          required: true,
          email: true,
        },
        phone: {
          required: true,
          number: true,
        },
        subject: {
          required: true,
          minlength: 10,
        },
        message: {
          required: true,
          minlength: 20,
        },
      },
    });
  });

  $("form.ajax_submit").on("submit", function (e) {      
    e.preventDefault();
    var has_errors = false,
      form = $(this),
      form_fields = form.find("input"),
      form_message = form.find("textarea"),
      server_result_display = form.find(".server_response");

    form_fields.each(function () {
      if ($(this).hasClass("error")) {
        has_errors = true;
      }
    });
    if (form_message.length > 0) {
      if (form_message.hasClass("error")) {
        has_errors = true;
      }
    }
    var formData = form.serialize();
    if (!has_errors) {
    $('.preloader-image').show();
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        dataType: "json",
        data: formData,        
        success: function (response) {           
          if (response.success === true) {               
            server_result_display
              .empty()
              .html(
                `<div class="mb-0 mt-3 alert alert-success  alert-dismissible">Message Sent, You would get feedback from us soon<button type="button" class="close" data-bs-dismiss="alert">&times;</button></div>`
              );
          } else {
           
            server_result_display
              .empty()
              .html(
                `<div class="mb-0 mt-3 alert alert-danger  alert-dismissible">Something went wrong. Please try to reach us via other channels<button type="button" class="close" data-bs-dismiss="alert">&times;</button></div>`
              );
          }
        },
        error: function (error) {
          server_result_display
            .empty()
            .html(
              '<div class="mb-0 mt-3 alert alert-danger  alert-dismissible">' +
                error +
                ' <button type="button" class="close" data-bs-dismiss="alert">&times;</button></div>'
            );         
        }        
      });
    }
  });
});

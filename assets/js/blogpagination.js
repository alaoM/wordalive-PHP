$(document).ready(function () {
    var itemDispay = 6;
    var total = $(".count .col-md-6").length;
    var numPages = total / itemDispay;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $("#tab").append(
        `<li class="page-item" rel="${i}"><a class="page-link active" href="#" >${pageNum}</a></li>
        `
      );
    }
    $(".count .col-md-6").hide();
    $(".count .col-md-6").slice(0, itemDispay).show();
    $("#tab li:first").addClass("active");
    $("#tab li").bind("click", function (e) {
      e.preventDefault();
      $("#tab li").removeClass("active");
      $(this).addClass("active");
      var currPage = $(this).attr("rel");
      var startItem = currPage * itemDispay;
      var endItem = startItem + itemDispay;
      $(".count .col-md-6")
        .css("opacity", "0")
        .hide()
        .slice(startItem, endItem)
        .css("display", "flex")
        .animate(
          {
            opacity: 1,
          },
          300
        );
    });
  });
$(document).ready(function () {
    var itemDispay = 6;
    var total = $(".count .col-lg-4").length;
    var numPages = total / itemDispay;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $("#tab").append(
        `<li class="page-item" rel="${i}"><a class="page-link active" href="#" >${pageNum}</a></li>
        `
      );
    }
    $(".count .col-lg-4").hide();
    $(".count .col-lg-4").slice(0, itemDispay).show();
    $("#tab li:first").addClass("active");
    $("#tab li").bind("click", function (e) {
      e.preventDefault();
      $("#tab li").removeClass("active");
      $(this).addClass("active");
      var currPage = $(this).attr("rel");
      var startItem = currPage * itemDispay;
      var endItem = startItem + itemDispay;
      $(".count .col-lg-4")
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
function ajaxGetMore() {
  if ($("#bottom").data('status') == 1 || $("#next .page-link").text() == "loading...") {
    return false;
  }
  $("#next .page-link").text("loading...");
  var url = $("#next a").attr("href");
  $.ajax({
    type: "POST",
    url: url,
    async: true,
    success: function (data) {
      result = $(data).find(".post-card");
      nextHref = $(data).find(".next").attr("href");
      $("#blockGroup").append(result.fadeIn(500));

      if (nextHref != undefined) {
        $("#next a").attr("href", nextHref);
        $("#next a").text("加载更多");
      } else {
        $("#next").html("<span id=\"bottom\" data-status=\"1\">到底啦 ~</span>");
      }
    }
  });
  return false;
}

$(window).scroll(function () {
  var scrollTop = $(this).scrollTop();
  var scrollHeight = $(document).height();
  var windowHeight = $(this).height();
  if (Math.abs((scrollTop + windowHeight) - scrollHeight) < 1) {
    ajaxGetMore();
  }
});

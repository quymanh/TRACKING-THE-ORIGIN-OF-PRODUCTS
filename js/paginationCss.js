

let paginationLeftPos = "20px";
let paginationOpacity = 0;
let checkPaginationClick = 0;

$(".page-link").click(function() {
  $(".page-link").removeClass("active");
  $(this).addClass("active");
  paginationLeftPos = $(this).prop("offsetLeft") + "px";
  paginationOpacity = 1;
  checkPaginationClick = 1;

  $(".pagination-hover-overlay").css({
    left: paginationLeftPos,
    backgroundColor: "#00178a",
    opacity: paginationOpacity
  });
  $(this).css({
    color: "#fff"
  });
});

$(".page-link").hover(
  function() {
    paginationOpacity = 1;
    $(".pagination-hover-overlay").css({
      backgroundColor: "#00c1dd",
      left: $(this).prop("offsetLeft") + "px",
      opacity: paginationOpacity
    });

    $(".page-link.active").css({
      color: "#333d45"
    });

    $(this).css({
      color: "#fff"
    });
  },
  function() {
    if (checkPaginationClick) {
      paginationOpacity = 1;
    } else {
      paginationOpacity = 0;
    }

    $(".pagination-hover-overlay").css({
      backgroundColor: "#00178a",
      opacity: paginationOpacity,
      left: paginationLeftPos
    });

    $(this).css({
      color: "#333d45"
    });

    $(".page-link.active").css({
      color: "#fff"
    });
  }
);

(function($) {
  var pagify = {
    items: {},
    container: null,
    totalPages: 1,
    perPage: 6,
    currentPage: 0,
    createNavigation: function() {
      this.totalPages = Math.ceil(this.items.length / this.perPage);

      $('.paginationCustom', this.container.parent()).remove();
      var paginationCustom = $('<div class="paginationCustom mt-3"></div>').append('<a class="nav prev disabled" data-next="false"><</a>');

      for (var i = 0; i < this.totalPages; i++) {
        var pageElClass = "page";
        if (!i)
          pageElClass = "page current";
        var pageEl = '<a class="' + pageElClass + '" data-page="' + (
        i + 1) + '">' + (
        i + 1) + "</a>";
        paginationCustom.append(pageEl);
      }
      paginationCustom.append('<a class="nav next" data-next="true">></a>');

      this.container.after(paginationCustom);

      var that = this;
      $("body").off("click", ".nav");
      this.navigator = $("body").on("click", ".nav", function() {
        var el = $(this);
        that.navigate(el.data("next"));
      });

      $("body").off("click", ".page");
      this.pageNavigator = $("body").on("click", ".page", function() {
        var el = $(this);
        that.goToPage(el.data("page"));
      });
    },
    navigate: function(next) {
      // default perPage to 5
      if (isNaN(next) || next === undefined) {
        next = true;
      }
      $(".paginationCustom .nav").removeClass("disabled");
      if (next) {
        this.currentPage++;
        if (this.currentPage > (this.totalPages - 1))
          this.currentPage = (this.totalPages - 1);
        if (this.currentPage == (this.totalPages - 1))
          $(".paginationCustom .nav.next").addClass("disabled");
        }
      else {
        this.currentPage--;
        if (this.currentPage < 0)
          this.currentPage = 0;
        if (this.currentPage == 0)
          $(".paginationCustom .nav.prev").addClass("disabled");
        }

      this.showItems();
    },
    updateNavigation: function() {

      var pages = $(".paginationCustom .page");
      pages.removeClass("current");
      $('.paginationCustom .page[data-page="' + (
      this.currentPage + 1) + '"]').addClass("current");
    },
    goToPage: function(page) {

      this.currentPage = page - 1;

      $(".paginationCustom .nav").removeClass("disabled");
      if (this.currentPage == (this.totalPages - 1))
        $(".paginationCustom .nav.next").addClass("disabled");

      if (this.currentPage == 0)
        $(".paginationCustom .nav.prev").addClass("disabled");
      this.showItems();
    },
    showItems: function() {
      this.items.hide();
      var base = this.perPage * this.currentPage;
      this.items.slice(base, base + this.perPage).show();

      this.updateNavigation();
    },
    init: function(container, items, perPage) {
      this.container = container;
      this.currentPage = 0;
      this.totalPages = 1;
      this.perPage = perPage;
      this.items = items;
      this.createNavigation();
      this.showItems();
    }
  };

  // stuff it all into a jQuery method!
  $.fn.pagify = function(perPage, itemSelector) {
    var el = $(this);
    var items = $(itemSelector, el);

    // default perPage to 5
    if (isNaN(perPage) || perPage === undefined) {
      perPage = 3;
    }

    // don't fire if fewer items than perPage
    if (items.length <= perPage) {
      return true;
    }

    pagify.init(el, items, perPage);
  };
})(jQuery);

$(".show-paginationCustom").pagify(6, ".single-item");

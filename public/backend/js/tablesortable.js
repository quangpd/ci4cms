(function ($) {
  "use strict";
  $.fn.tablesortable = function (options) {
    var self = this;
    var settings = $.extend(
      {
        url: window.location.href,
        params: {},
      },
      options
    );
    var base_url = settings.url;
    var result = {};
    self.sorter = function () {
      $.post(
        settings.url,
        settings.params,
        function (data) {
          if (data.success) {
            $(self).find("tbody").html(data.rows);
            if ($.type(data.page) !== "undefined") {
              $(self).find(".paging").html(data.page.links);
              $(self)
                .find(".start_row")
                .html(parseInt(data.page.start_row) + 1);
              $(self).find(".end_row").html(parseInt(data.page.end_row));
              $(self).find(".total_rows").html(data.page.total_rows);
            }
            $(self).trigger("sort", data);
          } else if (data.message) {
            toastr.error(data.message);
          }
          self.result = data;
          // handle_Select();
          // handle_DatePicker();
          // handle_InputNumber();
        },
        "json"
      );
    };
    self.filter = function (params) {
      var flag = 0;
      $.each(params, function (i, o) {
        if ($(o).val() != "") {
          settings.params[$(o).attr("name")] = $(o).val();
          flag = 1;
        } else {
          delete settings.params[$(o).attr("name")];
        }
      });
      self.sorter();
    };
    $(self).find("thead").find("input, select").val("");

    if (!$(self).hasClass("tablesortable")) {
      $(self).addClass("tablesortable");
    }

    $(self).on("click", ".sorting", function (event) {
      event.preventDefault();
      settings.params.field = $(this).data("field");
      if ($(this).hasClass("asc")) {
        $(this).removeClass("asc").addClass("desc");
        settings.params.dir = "asc";
      } else {
        $(this).removeClass("desc").addClass("asc");
        settings.params.dir = "desc";
      }
      $(this).siblings().removeClass("asc").removeClass("desc");
      settings.url = base_url;
      self.sorter();
    });

    $(self).on("click", "a.btn-ajax", function (event) {
      event.preventDefault();
      if ($(this).hasClass("btn-confirm")) {
        if (confirm($(this).attr("title"))) {
          $.post(
            $(this).attr("href"),
            function (response) {
              if (response.success == 1) {
                self.sorter();
              } else {
                toastr.error(response.message);
              }
            },
            "json"
          );
        }
      } else {
        $.post(
          $(this).attr("href"),
          function (response) {
            if (response.success == 1) {
              self.sorter();
            } else {
              toastr.error(response.message);
            }
          },
          "json"
        );
      }
      return false;
    });
    // $(self).on("click", ".pagination a", function (event) {
    //   event.preventDefault();
    //   settings.url = $(this).attr("href");
    //   self.sorter();
    // });
    $(self).on("click", "#btn_filter", function (event) {
      event.preventDefault();
      self.filter($(this).parents("tr").find("input, select"));
    });
    $(self).on("click", "#btn_clear", function (event) {
      event.preventDefault();
      $.each($(this).parents("tr").find("input, select"), function (i, o) {
        $(o).val("").trigger("change");
      });
      settings.params = {};
      $(self).find(".sorting").removeClass("desc, asc");
      self.sorter();
    });
    $(self).on("select2:select", "select.filter", function (event) {
      settings.url = base_url;
      self.filter($(this));
    });
    $(self).on("select2:unselect", "select.filter", function (event) {
      settings.url = base_url;
      self.filter($(this));
    });
    $(self).on("changeDate", ".filter.date-picker", function (event) {
      settings.url = base_url;
      self.filter($(this));
    });
    $(self).on("keyup", ".filter", function (event) {
      settings.url = base_url;
      self.filter($(this));
    });
    return {
      init: function () {
        // settings.params = {};
        settings.params["length"] = $(self).find('[name="length"]').val();
        self.sorter();
        return self;
      },
      reload: function () {
        self.sorter();
        return self;
      },
      filter: function (params) {
        self.filter(params);
        return self;
      },
      load: function (url) {
        $(self).find("thead .select2").val("").trigger("change");
        settings.params["length"] = $(self).find('[name="length"]').val();
        settings.url = url;
        base_url = settings.url;
        self.sorter();
        return self;
      },
      sum_float: function (cell_class, cell_display) {
        var sum = 0;
        $(self)
          .find(cell_class)
          .each(function (i, o) {
            sum += parseFloat($(o).val());
          });
        $(cell_display).text(sum);
      },
      sum_int: function (cell_class, cell_display) {
        var sum = 0;
        $(self)
          .find(cell_class)
          .each(function () {
            sum += parseInt($(o).val());
          });
        $(cell_display).text(sum);
      },
    };
  };
})(jQuery);

// Ajax Load More
var ppp = 6; // Post per page
var pageNumber = 1;

function load_posts() {
  pageNumber++;
  var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=ajax_pagination';
  jQuery.ajax({
    type: "POST",
    dataType: "html",
    url: ajaxpagination.ajaxurl,
    data: str,
    success: function(data) {
      var $data = jQuery(data);
      if ($data.length) {
        jQuery(".projects-grid").append($data);
        jQuery("#more_posts").attr("disabled",false);
      } else {
        jQuery("#more_posts").attr("disabled",true);
      }
    },
    error : function(jqXHR, textStatus, errorThrown) {
      $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
    }

  });
  return false;
  }

  jQuery("#more_posts").on("click",function() {
    jQuery("#more_posts").attr("disabled",true);
    load_posts();
  });
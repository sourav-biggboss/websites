$(document).ready(function(){
    //stage active
     var path = window.location.href;
     $('#track_status .status').each(function() {
      if ($(this).find('a')[0].href === path) {
       $(this).addClass('card-active-status');
      }
     });

});

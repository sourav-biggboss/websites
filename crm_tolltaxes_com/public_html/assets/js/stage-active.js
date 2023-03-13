$(document).ready(function(){
    //stage active
     var path = window.location.href;
     $('#stage_form a').each(function() {
      if (this.href === path) {
       $(this).addClass('card-active-stage');
       $(this).addClass('w3-teal');
      }
     });

});

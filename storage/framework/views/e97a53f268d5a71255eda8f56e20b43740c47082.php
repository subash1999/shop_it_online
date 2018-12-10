

<script src="<?php echo e(asset('js/app.js')); ?>"></script>

<script src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script class="include" type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/jquery.dcjqaccordion.2.7.js')); ?>"></script>
<script src="<?php echo e(asset('page_assets/seller/dashio/lib/jquery.scrollTo.min.js')); ?>"></script>
<script src="<?php echo e(asset('page_assets/seller/dashio/lib/jquery.nicescroll.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('page_assets/seller/dashio/lib/jquery.sparkline.js')); ?>"></script>
<!--common script for all pages-->
<script src="<?php echo e(asset('page_assets/seller/dashio/lib/common-scripts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/gritter/js/jquery.gritter.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/gritter-conf.js')); ?>"></script>
<!--script for this page-->
<script src="<?php echo e(asset('page_assets/seller/dashio/lib/sparkline-chart.js')); ?>"></script> 
<script src="<?php echo e(asset('page_assets/seller/dashio/lib/zabuto_calendar.js')); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Seller Dashboard! <?php echo e(Auth::user()->username); ?>',
        // (string | mandatory) the text inside the notification
        text: 'Manage Your Selling Account.',
        // (string | optional) the image to display on the left
        image: '<?php echo e(Auth::user()->getPhotoUrl()); ?>',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

    return false;
  });
</script>
<script type="application/javascript">
  $(document).ready(function() {
    $("#date-popover").popover({
      html: true,
      trigger: "manual"
    });
    $("#date-popover").hide();
    $("#date-popover").click(function(e) {
      $(this).hide();
    });

    $("#my-calendar").zabuto_calendar({
      action: function() {
        return myDateFunction(this.id, false);
      },
      action_nav: function() {
        return myNavFunction(this.id);
      },
      ajax: {
        url: "show_data.php?action=1",
        modal: true
      },
      legend: [{
        type: "text",
        label: "Special event",
        badge: "00"
      },
      {
        type: "block",
        label: "Regular event",
      }
      ]
    });
  });

  function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
  }
</script>
<script >
  var url = window.location;
// var element = $('ul.nav a').filter(function() {
//     return this.href == url;
// }).addClass('active').parent().parent().addClass('in').parent();
// for the submenu
var element = $('ul.sub a').filter(function() {
  return this.href == url;
}).parent();
element.addClass('active');
var parent_element = element.parent();
parent_element = parent_element.parent();
parent_element = parent_element.children('a');
parent_element.addClass('active');
//for the single element without sub menus
var element = $("div#sidebar.nav-collapse ul#nav-accordion.sidebar-menu li.no-sub-menu a").filter(function(){     
  if(this.href==url){
    return true; 
  }
  else{
    return false;
  }

});
element.addClass('active');

</script>
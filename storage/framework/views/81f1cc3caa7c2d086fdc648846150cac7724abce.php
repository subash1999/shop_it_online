<script >
  $(document).ready(function() {
    console.log("ready");
    var readURL = function(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#pp_input_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    

    $("#pp_input").on('change', function(){
      readURL(this);
      console.log('pp_changed');
    });
  }); 
</script>
<div class="container bootstrap snippet">
  <div class="row m-3">
    <div class="col-sm-10"><h1 class="h1">User name</h1></div>
    <div class="col-sm-2"><a href="/users" class="pull-right"><img id="pp" height="100" width="100" title="profile image" class="rounded-circle img-responsive" src="<?php echo e(asset('prof_pic.jpeg')); ?>"></a></div>
  </div>
  <hr>
  <style type="text/css">
  #pp_input_image {
    opacity: 1;
    display: block;
    width: 100%;
    height: auto;
    transition: .5s ease;
    backface-visibility: hidden;
  }
  #pp_upload_btn {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 80%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
  }

  #pp_input_container:hover #pp_input_image {
    opacity: 0.3;    
  }

  #pp_input_container:hover #pp_upload_btn {
    opacity: 1;
  }
  .customer_sidebar a {
    text-decoration: none;
}
.customer_sidebar a:link, .customer_sidebar a:visited {
    color: black;
}
.customer_sidebar a:hover {
    color: #17a2b8;
    text-decoration: underline;
    cursor: pointer;

}

</style>
<div class="row">
  <div class="col-sm-3 customer_sidebar"><!--left col-->
    <div class="card mb-3 text-center">    
     <div class="card-img-top" id="pp_input_container">
      <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="img-thumbnail img-responsive" alt="Profile Pic Input Image" id="pp_input_image">
      <div id="pp_upload_btn" style="cursor: pointer;">       
       <div class="file btn btn-lg btn-primary" style=" position: relative;overflow: hidden;cursor: pointer;">
        Upload
        <input type="file" name="pp_input" id="pp_input" class="text-center center-block" style=" position: absolute;opacity: 0;right: 0;top: 0;cursor: pointer;" />
      </div>
    </div>
  </div>  
</div>   


<div class="card mb-3" >
  <div class="card-header card-info">Account</div>
  <div class="card-body">
    <ul>
      <li class="font-weight-bold mb-2"><a href="<?php echo e(url('customer/my_account')); ?>">Manage My Account</a></li>
      <li>
        <ul class="ml-2">
         <li class="m-2"><a href="<?php echo e(url('customer/profile')); ?>">My Profile</a><i class="fa fa-dashboard fa-1x"></i></li>
         <li class="m-2"><a href="<?php echo e(url('customer/address')); ?>">Address</a><i class="fa fa-dashboard fa-1x"></i></li>
         <li class="m-2"><a href="<?php echo e(url('customer/discount_coupons')); ?>">Discount Coupons</a></li>  
       </ul>
     </li>
   </ul>    
 </div>
</div>
<div class="card mb-3" >
  <div class="card-header card-info">Products</div>
  <div class="card-body">
    <ul>
      <style type="text/css">

    </style>
    <li class="font-weight-bold mb-2"><a class="user_side_menu_links" href="<?php echo e(url('/')); ?>">My Purched Products</a></li>
    <li class="font-weight-bold mb-2"><a href="<?php echo e(url('wishlist')); ?>">My Wishlist</a></li>
    <li class="font-weight-bold mb-2"><a href="<?php echo e(url('cart')); ?>">My Cart</a></li>  
  </ul>    
</div>
</div>     

</div><!--/col-3-->
</div>
</div>

<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 200px;
  height: 200px;
  margin: -100px 0 0 -100px;
  border: 20px solid #f3f3f3;
  border-radius: 50%;
  border-top: 20px solid #3498db;
  border-bottom: 20px solid #3498db;
  opacity: 0.7;
  background-image: url(<?php echo e(asset('img/system/website_logo_2.png')); ?>);
  background-size: 150px;
  background-attachment: fixed;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  overflow: hidden;
  width: 200px;
  height: 200px;
  /*padding-top: 100%;*/
  -webkit-animation: spin 3s linear infinite;
  animation: spin 3s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes  spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes  animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

</style>

<script type="text/javascript">  
  window.addEventListener("resize",function(event) {
    // two elements with their ids passing as argument
    if(isOverlap('#loading-text','#loader')){
      $('#loader').hide('fast');
    }
    else{
      $('#loader').show('slow');
    }
  });

  window.addEventListener("load",function() {
    $("#overlay").fadeOut('slow');
  });

  function checkOverlap() {
    // two elements with their ids passing as argument
    if(isOverlap('#loading-text','#loader')){
      $('#loader').hide('fast');
    }
    else{
      $('#loader').show('slow');
    }
  }
  // to check if two elements overlap in user interference
  function isOverlap(idOne,idTwo){
    var objOne=$(idOne),
    objTwo=$(idTwo),
    offsetOne = objOne.offset(),
    offsetTwo = objTwo.offset(),
    topOne=offsetOne.top,
    topTwo=offsetTwo.top,
    leftOne=offsetOne.left,
    leftTwo=offsetTwo.left,
    widthOne = objOne.width(),
    widthTwo = objTwo.width(),
    heightOne = objOne.height(),
    heightTwo = objTwo.height();
    var leftTop = leftTwo > leftOne && leftTwo < leftOne+widthOne   && topTwo > topOne && topTwo < topOne+heightOne;
    var rightTop = leftTwo+widthTwo > leftOne && leftTwo+widthTwo < leftOne+widthOne                  && topTwo > topOne && topTwo < topOne+heightOne;
    var leftBottom = leftTwo > leftOne && leftTwo < leftOne+widthOne  && topTwo+heightTwo > topOne && topTwo+heightTwo < topOne+heightOne;          
    var rightBottom = leftTwo+widthTwo > leftOne && leftTwo+widthTwo < leftOne+widthOne                  && topTwo+heightTwo > topOne && topTwo+heightTwo < topOne+heightOne;
    return leftTop || rightTop || leftBottom || rightBottom;
  }

</script>

<style type="text/css">
#loading{margin:0;}
#loading{ font: 200 20px/1 sans-serif; }
#page-loading-image{ width:32.2%; }

#overlay{
  position:fixed;
  z-index:99999;
  top:0;
  left:0;
  bottom:0;
  right:0;
  /*background:rgba(0,0,0,0.9);*/
  background-color: #ffffff;
  opacity:1;
  transition: 1s 0.5s;
}

</style>
<div style="width: 100%;">
  <div id="overlay"  onload="checkOverlap()">
    <div style="z-index:1;" id="loading-text" >
     <h6 class=" h6 text-center text-info">Please Wait While The Page is Fully Loaded</h6> 
     <h3 class="h3 text-center text-secondary">Loading <img src="<?php echo e(asset('img/system/webpage_loading.gif')); ?>" alt=""></h3>              
   </div>      
   <div id="loader" class="img-responsive"></div>
 </div>
</div>

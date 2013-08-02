<?php require_once('header.php');  ?>
<?php require_once('header2.php');  ?>
<script src="css/masonry.pkgd.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var container = document.querySelector('#myContent');
    var msnry = new Masonry( container, {
      // options
      columnWidth: 150,
      itemSelector: '.item',
      isAnimated: true,
      animationOptions: {
        duration: 300,
        easing: 'linear',
        queue:true
      }
    });
    });

</script>
<style type="text/css">
.inner_header{
width: 87px !important;
}
.company{
/*display: inline-block;
padding: 10px;*/
}
.company a{
  /*display: block;*/

width: 180px;
height: 100px;
border: 1px solid #ccc;
color: #333;
text-decoration: none;
font-weight: bold;
line-height: 1.3em;
background: #f7f7f7;
-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .3);
-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .3);
box-shadow: inset 0 -4px 27px rgba(0, 0, 0, 0.3) !important;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}
#partners_list{

}

.item{
  border: 1px solid #ccc;
color: #333;
text-decoration: none;
font-weight: bold;
line-height: 1.3em;
background: #f7f7f7;
-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .3);
-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .3);
box-shadow: inset 0 -4px 27px rgba(0, 0, 0, 0.3) !important;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}


    #container {
      padding-top: 140px;
        width: auto;
    }
}
</style>

  <div id="contentBody_inner2" class="container_16">
  	<div class="inner_content2">
    	<span class="inner_header">PARTNERS</span>
  	</div>
    <div class="serviceContainer container_16"> 
      <div id="partners_list">
        <!-- <div class="company"><a href="#">company 1</a></div>
        <div class="company"><a href="#">company 2</a></div>
        <div class="company"><a href="#">company 3</a></div>
        <div class="company"><a href="#">company 4</a></div>
        <div class="company"><a href="#">company 5</a></div>
        <div class="company"><a href="#">company 6</a></div>
        <div class="company"><a href="#">company 7</a></div>
        <div class="company"><a href="#">company 8</a></div> -->

        <div id="container">
            <div id="myContent"> 
                <div class="item"><img src="logos/axis-logo.png" alt=""></div>
                <div class="item"><img src="logos/logo3.gif" alt=""></div>
               <div class="item"><img src="logos/company-logo.jpg" alt=""></div>
               <div class="item"><img src="logos/logo9.gif" alt=""></div>
               <div class="item"><img src="logos/logo26.gif" alt=""></div>
               <div class="item"><img src="logos/logo44.gif" alt=""></div>
               <div class="item"><img src="logos/company-logo.jpg" alt=""></div>
               <div class="item"><img src="logos/logo3.gif" alt=""></div>
              <div class="item"><img src="logos/logo63.gif" alt=""></div>
               <div class="item"><img src="logos/logo54.gif" alt=""></div>
               <div class="item"><img src="logos/logo41.gif" alt=""></div>
               <div class="item"><img src="logos/company-logo.jpg" alt=""></div>
               <div class="item"><img src="logos/logo48.gif" alt=""></div>
               <div class="item"><img src="logos/logo57.gif" alt=""></div>
              </div>
        </div>
        
      </div>
 
    </div>
  </div>
  <div class="contactUs container_16">
    <div class="homeContentTitle conttactUsTitle grid_4 push_6">
      <h3>CONTACT US</h3>
    </div>
    <div id="contactInfoBox" class="container_16">
      <div class="contactInfo grid_8">
       <div class="contactInfo-Title"> PHONE NUMBER </div>
        <div class="contactInfo-Path"> (080) 412-444-24</div>
      </div>
      <div class="contactInfo grid_8">
        <div class="contactInfo-Title"> E-MAIL </div>
        <div class="contactInfo-Path"><a href="mailto:invest@fundsinn.com?">invest@fundsinn.com</a></div>
      </div>
    </div>
  </div>
  <div class="push"></div>
</div>
<!--MAIN WRAPPER-->
<?php require_once('footer.php');  ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>FundsInn</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/text.css" />
<link rel="stylesheet" href="css/960_16_col.css" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link type="text/css" rel="Stylesheet" href="css/bjqs.css" />
<link rel="stylesheet" type="text/css" href="css/mailchimp.css">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,700,500,600,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen"/>
<script type="text/javascript" src="js/jquery.js"></script>

<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bjqs-1.3.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/apprise-1.5.min.js"></script>
<link rel="stylesheet" href="css/apprise.css" type="text/css" />
<script>
$(document).ready(function(){
    $('#the-slideshow').bjqs({
        height : 455,
        width : 960,
        responsive : false,
		animtype   : 'slide',
		nexttext : '', // Text for 'next' button (can use HTML)
        prevtext : '', // Text for 'previous' button (can use HTML)
    });
	 $("a[rel^='prettyPhoto']").prettyPhoto({
			social_tools:false
		});
});

function mcsubscribe()
{
	$.ajax({
			url: 'inc/store-address.php',
			data: 'ajax=true&email=' + escape($('#mce-EMAIL').val()),
			success: function(msg) {
				apprise(msg);
			}
		});
}
</script>
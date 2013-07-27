<?php

function request($param, $default){
    return (isset($_REQUEST[$param]) && (trim($_REQUEST[$param]) != "")) ? trim($_REQUEST[$param]) : $default;
}

function Redirect($Str_Location, $Bln_Replace = 1, $Int_HRC = NULL)
{
        if(!headers_sent())
        {
            header('location: ' . urldecode($Str_Location), $Bln_Replace, $Int_HRC);
            exit;
        }

    exit('<meta http-equiv="refresh" content="0; url=' . urldecode($Str_Location) . '"/>'); # | exit('<script>document.location.href=' . urldecode($Str_Location) . ';</script>');
    return;
}
$email=request("email","");

$ref=@$_SERVER['HTTP_REFERER'];
if($ref)
{
  $pattern="/.*corporate_account_opening.*/";
  $pattern2="/.*NRI_acc_opening.*/";
  $pattern3="/.*signup-landing.*/";
  $mat=0;
  if(preg_match($pattern,$ref))
    $mat=1;
  if(preg_match($pattern2,$ref))
    $mat=1;
  if(preg_match($pattern3,$ref))
    $mat=1;
  if(!$mat)
    Redirect("./signup-landing.html");
}
else
  Redirect("./signup-landing.html");

  
if($email=="")
{
Redirect("./signup-landing.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>FundsInn</title>
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/text.css" />
<link rel="stylesheet" href="../css/960_16_col.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/mailchimp.css">
<link rel="stylesheet" type="text/css" href="../css/sign.up.css">
<link rel="stylesheet" type="text/css" href="../css/structure.css">
<link rel="stylesheet" type="text/css" href="../css/form.css">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,700,500,600,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/fundsinn.js"></script>
<script type="text/javascript" src="../js/individualformval.js"></script>
<style type="text/css">
.er {color:red;}
.su {color:green;}
#mce-EMAIL{
  margin-top: 0.5px; height: 35px;
}
</style>
</head>
<body>
<!--MAIN WRAPPER-->
<div class="wrapper">
<div id="headerBox">
  <div id="header" class="container_16">
    <div id="headerLeft" class="grid_5">
      <div class="theLogo"><a href="../index.html"><img src="../img/logo.png" alt="FundsInn Logo"></a></div>
    </div>
    <div id="headerMenu" class="grid_5">
      <ul>
        <li><a href="#">INVESTMENTS</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">BLOG</a></li>
      </ul>
    </div>
    <div class="loggingContainer grid_4">
      <ul>
        <li class="grid_2 gridFirst"> <a href="#">SIGN-UP</a></li>
        <li class="grid_2 gridLast"> <a href="#">LOG-IN</a></li>
      </ul>
    </div>
  </div>
</div>
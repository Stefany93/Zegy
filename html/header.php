<?php 
session_start();
// Report all PHP errors
error_reporting(-1);
require 'config/constants.php'; 
require 'config/global_vars.php'; 
date_default_timezone_set("America/Chicago");
 spl_autoload_register(function ($class) {
    if( strpos($class, 'Monolog') === false )
    {
      include 'classes/' . $class . '.php';
    }
    });



/*
Session::set('user_id', 1);
Session::set('username', 'Stefany');*/
echo Session::get('username');
$handleExceptions = new HandleExceptions($mode);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <base href="/">
  <!-- Including the css and javascript documents -->
     <!-- Genericons -->
        <link rel="stylesheet" href="css/genericons/genericons.css">
  <!-- End of Genericons -->
  <!-- CSS for computers -->
  <link rel="stylesheet" type="text/css" href="css/stylesheets/screen.css" media="screen" />
  <!-- The stylesheet for other devices such as phones and tablets -->
  <link rel="stylesheet" type="text/css" href="css/other_devices.css" media="screen" />
  <!-- The print style sheet -->
     <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
    <!-- End of The print style sheet -->
  <!-- The JS -->
    <script type="text/javascript" src="js/javascript.js"></script>
  <!-- End of the JS -->
  <!-- Meta -->
  <meta name="author" content="Stefany Dyulgerova" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
  <meta name="revised" content="" />
  <!-- This meta is used for responsiveness -->
      <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- End of the responsiveness meta -->
  <!-- End of Meta -->
</head>
<body>
<div id="container">
<!-- The header with the logo, the nav and other stuff -->  
  <div id="header" class="red_border">
  <!--  <form action="" method="post" id="header_login" class="right" >
        <input type="text" name="users_email" id="" placeholder="Email"  />
        <input type="password" name="users_password" id="" placeholder="Password" />
    
        <input type="submit" class="right">

    </form> -->
       
    <div id="greeting" class="right">Hello <?php echo Links::makeLink('user', array(Session::get('username'), Session::get('user_id')), Session::get('username') ); ?>
  <a href="inbox"><i class="genericon genericon-mail"></i></a>
  </div>      

    <div class="logo">
      <a href="index.php"><img src="images/logo.jpg" alt="NAME OF THE WEBSITE" width="365" /></a>
  </div>
    
    <ul id="navigation">
        <li><a href="home">Home</a></li>
        <li><a href="blog">Search</a></li>
        <li><a href="about">About</a></li>
        <li><a href="contact">Contact The Admins</a></li>
    </ul>
  </div>

<div id="inner_container">
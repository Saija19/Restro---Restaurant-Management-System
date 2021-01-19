<?php 

session_start();
  $db = mysqli_connect('localhost', 'root', '', 'restro');
  mysqli_select_db($db,'restro') or die("could not select database");

  $username = "";
  $password = "";
  $customerId = 0;
  $name = "";
  $tableNo = "";
  $billAmount = "";
  $mid = "";
  $mname = "";
  $mprice = "";
  $wid = "";
  $wname = "";
  $update = false;

  ?>
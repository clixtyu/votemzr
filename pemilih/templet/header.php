<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="kb.jpg" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Aplikasi eVoting OSIS berbasis website menggunakan PHP native">
  <meta name="author" content="IT Support SMAN 2 Kota Tangerang Selatan">

  <title><?php

if(isset($_GET['title'])){
	echo $_GET['title'];
}else{

}

   ?></title>
  <!-- jquery -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <!-- chartjs -->
  <script src="../assets/js/Chart.js"></script>
  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../assets/datatable/css/jquery.dataTables.css"/>
<!-- sweetalert -->
<script src="../assets/sweetalert/sweetalert2.all.min.js" ></script>
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  



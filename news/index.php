<?php
  if(isset($_COOKIE["admin"])){ 
    if($_COOKIE["admin"]!="123")
      header("Location: sign_in.php");
  }
  else
      header("Location: sign_in.php");    

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Quản lý Website tin tức</title>

    

    <!-- Bootstrap core CSS -->
<link href="assets\bootstrap-5.0.0\css\bootstrap.min.css" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets\bootstrap-5.0.0\dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">News CĐTH 19C</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="sign_out.php">Sign out</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">

    <?php include("include/left-menu.php"); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">        
        <?php 
          $dir="the-loai";
          if(isset($_GET["dir"])&&!empty($_GET["dir"]))
          $dir=$_GET["dir"];

          $page="danh-sach"; 
          if(isset($_GET["page"])&&!empty($_GET["page"]))
          $page=$_GET["page"];              

          $dsDir = ["the-loai","tin-tuc"];
          $dsPage=["danh-sach","them-moi","cap-nhat","xoa"];

          if(!in_array($dir, $dsDir))
            $dir="the-loai";
          if(!in_array($page, $dsPage))
            $page="danh-sach";
          include("$dir/$page.php");

        ?>
    </main>
  </div>
</div>


    <script src="assets/bootstrap-5.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/ckeditor5/ckeditor.js"></script>

    <script>
      ClassicEditor
        .create( document.querySelector( '#textarea-noidung' ), {
          // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        } )
        .then( editor => {
          window.editor = editor;
        } )
        .catch( err => {
          console.error( err.stack );
        } );
    </script>
  </body>
</html>

<!DOCTYPE html>
<html>
<head>
<title>NewsFeed | Pages | Contact</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="../assets/css/font.css">
<link rel="stylesheet" type="text/css" href="../assets/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="../assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="../assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<!--[if lt IE 9]>
<script src="../assets/js/html5shiv.min.js"></script>
<script src="../assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">

  <?php 

    include("../include/header_pages.php");
    include("../include/navArea_pages.php");
    include("../include/newsSection_pages.php");

  ?>
  
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2>Phản hồi cho chúng tôi</h2>
            <p>Điền thông tin phản hồi ở đây</p>
            <form action="#" class="contact_form">
              <input class="form-control" type="text" placeholder="Name*">
              <input class="form-control" type="email" placeholder="Email*">
              <textarea class="form-control" cols="30" rows="10" placeholder="Message*"></textarea>
              <input type="submit" value="Send Message">
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <h2><span>Bài viết có thể bị bỏ lỡ</span></h2>
            <ul class="spost_nav">

              <?php
              require("../db.php");
              try {

                  $sql="SELECT * FROM tin_tuc ORDER BY ngay_tao DESC LIMIT 1, 5";
                  $stmt=$conn->prepare($sql);
                  $stmt->execute();
                  $stmt->setFetchMode(PDO::FETCH_ASSOC);
                  $dem=0;
                  foreach($stmt->fetchALL() as $row){
                    $tieu_de=$row["tieu_de"];
                    $hinh_anh=$row["hinh_anh"];
                    $id=$row["id"];                    
                    echo "<li>
                            <div class=\"media wow fadeInDown\"> <a href=\"../pages/single_page.php?id=$id\" class=\"media-left\"> <img alt=\"\" src=\"../images/$hinh_anh\"> </a>
                              <div class=\"media-body\"> <a href=\"../pages/single_page.php?id=$id\" class=\"catg_title\"> $tieu_de</a> </div>
                            </div>
                          </li>";
                    $dem=$dem+1;
                    if($dem==5)
                      break;
                  }
                }
                catch (PDOException $e){
                echo "Lỗi: ".$e->getMessage();
                }
              ?>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <?php

    include("../include/footer_pages.php");

  ?>

</div>
<script src="../assets/js/jquery.min.js"></script> 
<script src="../assets/js/wow.min.js"></script> 
<script src="../assets/js/bootstrap.min.js"></script> 
<script src="../assets/js/slick.min.js"></script> 
<script src="../assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="../assets/js/jquery.newsTicker.min.js"></script> 
<script src="../assets/js/jquery.fancybox.pack.js"></script> 
<script src="../assets/js/custom.js"></script>
</body>
</html>
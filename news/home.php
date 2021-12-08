<!DOCTYPE html>
<html>
  <head>
    <title>NewsFeed</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font.css">
    <link rel="stylesheet" type="text/css" href="assets/css/li-scroller.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>

    <div id=/*"preloader"*/>
      <div id="status">&nbsp;</div>
    </div>

    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    <div class="container">
      <?php 
        $the_loai_id=0;
        if(isset($_GET["the_loai_id"])&&!empty($_GET["the_loai_id"]))
          $the_loai_id=$_GET["the_loai_id"];

        require("db.php");
        $count=0;
        try {
            $sql="SELECT count(*) 'dem' FROM the_loai WHERE id=$the_loai_id";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchALL() as $row){
              $count=$row["dem"];
              break;
            }
          }
          catch (PDOException $e){
          echo "Lỗi: ".$e->getMessage();              
          }

          if($count==0)
            $the_loai_id=0;

          if($the_loai_id!=0)
          try {
            $sql="SELECT count(*) 'dem' FROM tin_tuc WHERE the_loai_id=$the_loai_id";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchALL() as $row){
              $count=$row["dem"];
              break;
            }
          }
          catch (PDOException $e){
          echo "Lỗi: ".$e->getMessage();              
          }  

        include("include/header_home.php"); 
        include("include/navArea_home.php");
        include("include/newsSection_home.php");
        if($the_loai_id==0)
          include("include/sliderSection_home.php");
        if($the_loai_id==0)
          include("include/contentSection_home.php");
        else
          include("include/contentSection_type_home.php");

        include("include/footer_home.php");
      ?>
    </div>

    <script src="assets/js/jquery.min.js"></script> 
    <script src="assets/js/wow.min.js"></script> 
    <script src="assets/js/bootstrap.min.js"></script> 
    <script src="assets/js/slick.min.js"></script> 
    <script src="assets/js/jquery.li-scroller.1.0.js"></script> 
    <script src="assets/js/jquery.newsTicker.min.js"></script> 
    <script src="assets/js/jquery.fancybox.pack.js"></script> 
    <script src="assets/js/custom.js"></script>
  </body>
</html>
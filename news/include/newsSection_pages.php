  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Latest News</span>
          <ul id="ticker01" class="news_sticker">
            
          <?php
            require("../db.php");
            try {
                $number_last_new=6;
                $sql="SELECT * FROM tin_tuc ORDER BY ngay_tao DESC LIMIT 0, $number_last_new";
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchALL() as $row){
                  $tieu_de=$row["tieu_de"];
                  $id=$row["id"];
                  echo "<li><a href=\"../pages/single_page.php?id=$id\"><img src=\"../images/news_thumbnail3.jpg\" alt=\"\">$tieu_de</a></li>";
                }
              }
              catch (PDOException $e){
              echo "Lỗi: ".$e->getMessage();
              }
          ?>
          </ul>
          <div class="social_area">
            <ul class="social_nav">
              <li class="facebook"><a href="#"></a></li>
              <li class="twitter"><a href="#"></a></li>
              <li class="flickr"><a href="#"></a></li>
              <li class="pinterest"><a href="#"></a></li>
              <li class="googleplus"><a href="#"></a></li>
              <li class="vimeo"><a href="#"></a></li>
              <li class="youtube"><a href="#"></a></li>
              <li class="mail"><a href="#"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="sliderSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="slick_slider">

          <?php
            require("db.php");
            try {
                $number_last_new=6;
                $sql="SELECT * FROM tin_tuc ORDER BY ngay_tao DESC LIMIT 0, $number_last_new";
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $dem=0;
                foreach($stmt->fetchALL() as $row){
                  $tieu_de=$row["tieu_de"];
                  $tom_tat=$row["tom_tat"];
                  $hinh_anh=$row["hinh_anh"];
                  $id=$row["id"];                  
                  echo "<div class=\"single_iteam\"> <a href=\"pages/single_page.php?id=$id\"> <img src=\"images/$hinh_anh\" alt=\"\"></a>
                          <div class=\"slider_article\">
                            <h2><a class=\"slider_tittle\" href=\"pages/single_page.php?id=$id\">$tieu_de</a></h2>
                            <p>$tom_tat</p>
                          </div>
                        </div>";
                }
              }
              catch (PDOException $e){
              echo "Lỗi: ".$e->getMessage();
              }
          ?>
         
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Bài viết mới nhất</span></h2>
          <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">

            <?php
              require("db.php");
              try {
                  $number_last_new=5;
                  $sql="SELECT * FROM tin_tuc ORDER BY ngay_tao DESC LIMIT 0, $number_last_new";
                  $stmt=$conn->prepare($sql);
                  $stmt->execute();
                  $stmt->setFetchMode(PDO::FETCH_ASSOC);
                  $dem=0;
                  foreach($stmt->fetchALL() as $row){
                    $tieu_de=$row["tieu_de"];
                    $hinh_anh=$row["hinh_anh"];
                    $id=$row["id"];                    
                    echo "<li>
                            <div class=\"media\"> <a href=\"pages/single_page.php?id=$id\" class=\"media-left\"> <img alt=\"\" src=\"images/$hinh_anh\"> </a>
                              <div class=\"media-body\"> <a href=\"pages/single_page.php?id=$id\" class=\"catg_title\"> $tieu_de</a> </div>
                            </div>
                          </li>";
                  }
                }
                catch (PDOException $e){
                echo "Lỗi: ".$e->getMessage();
                }
            ?>
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
          </div>
        </div>
      </div>
    </div>
  </section>
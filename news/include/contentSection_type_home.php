  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">

        <?php
          require("db.php");
          try {
            $sql="SELECT * FROM the_loai WHERE id=$the_loai_id";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchALL() as $row){
              $ten=$row["ten"];
              echo "<div class=\"single_post_content\">            
                      <h2><span>$ten</span></h2>";
              $sql2="SELECT * FROM tin_tuc WHERE the_loai_id=$the_loai_id ORDER BY ngay_tao DESC";            
              $stmt2=$conn->prepare($sql2);
              $stmt2->execute();
              $stmt2->setFetchMode(PDO::FETCH_ASSOC);
              $dem=0;
              foreach($stmt2->fetchALL() as $row2){
                $tieu_de=$row2["tieu_de"];
                $tom_tat=$row2["tom_tat"];
                $hinh_anh=$row2["hinh_anh"];
                $id=$row["id"];                
                $dem=$dem+1;
                if($dem==1)
                  echo "<div class=\"single_post_content_left\">
                          <ul class=\spost_nav\">
                            <li>
                              <div class=\"media wow fadeInDown\"> <a href=\"pages/single_page.php?id=$id\" class=\"media-left\"> <img alt=\"\" src=\"images/$hinh_anh\"> </a>
                                <div class=\"media-body\"> <a href=\"pages/single_page.php?id=$id\" class=\"catg_title\"> $tieu_de</a> </div>
                              </div>
                            </li>";   

                else if($dem==ceil($count/2)+1)
                  echo "<div class=\"single_post_content_right\">
                          <ul class=\spost_nav\">
                            <li>
                              <div class=\"media wow fadeInDown\"> <a href=\"pages/single_page.php?id=$id\" class=\"media-left\"> <img alt=\"\" src=\"images/$hinh_anh\"> </a>
                                <div class=\"media-body\"> <a href=\"pages/single_page.php?id=$id\" class=\"catg_title\"> $tieu_de</a> </div>
                              </div>
                            </li>";  
                else if($dem>1&&$dem<=ceil($count/2))                          
                  echo "<li>
                          <div class=\"media wow fadeInDown\"> <a href=\"pages/single_page.php?id=$id\" class=\"media-left\"> <img alt=\"\" src=\"images/$hinh_anh\"> </a>
                            <div class=\"media-body\"> <a href=\"pages/single_page.php?id=$id\" class=\"catg_title\"> $tieu_de</a> </div>
                          </div>
                        </li>";  
                else if($dem>ceil($count/2)+1&&$dem<=$count)
                  echo "<li>
                          <div class=\"media wow fadeInDown\"> <a href=\"pages/single_page.php?id=$id\" class=\"media-left\"> <img alt=\"\" src=\"images/$hinh_anh\"> </a>
                            <div class=\"media-body\"> <a href=\"pages/single_page.php?id=$id\" class=\"catg_title\"> $tieu_de</a> </div>
                          </div>
                        </li>";     
                if($dem==ceil($count/2)||$dem==$count)
                  echo  "</ul>
                      </div>";                           
              }
              echo "</div>";   
            }
          }
          catch (PDOException $e){
            echo "Lỗi: ".$e->getMessage();
          }
        ?>

        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <h2><span>Bài viết có thể bị bỏ lỡ</span></h2>
            <ul class="spost_nav">

              <?php
              require("db.php");
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
                            <div class=\"media wow fadeInDown\"> <a href=\"pages/single_page.php?id=$id\" class=\"media-left\"> <img alt=\"\" src=\"images/$hinh_anh\"> </a>
                              <div class=\"media-body\"> <a href=\"pages/single_page.php?id=$id\" class=\"catg_title\"> $tieu_de</a> </div>
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


          <div class="single_sidebar">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab" data-toggle="tab">Thể loại</a></li>
              <li role="presentation"><a href="#video" aria-controls="profile" role="tab" data-toggle="tab">Video</a></li>
              <li role="presentation"><a href="#comments" aria-controls="messages" role="tab" data-toggle="tab">Comments</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="category">
                <ul>
                  <?php
                    require("db.php");
                    try {

                        $sql="SELECT * FROM the_loai";
                        $stmt=$conn->prepare($sql);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach($stmt->fetchALL() as $row){
                          $ten=$row["ten"];
                          echo "<li class=\"cat-item\"><a href=\"#\">$ten</a></li>";
                        }
                      }
                      catch (PDOException $e){
                      echo "Lỗi: ".$e->getMessage();
                      }
                    ?>
                </ul>
              </div>
              <div role="tabpanel" class="tab-pane" id="video">
                <div class="vide_area">
                  <iframe width="100%" height="250" src="http://www.youtube.com/embed/h5QWbURNEpA?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="comments">
                <ul class="spost_nav">
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.php?id=$id" class="media-left"> <img alt="" src="images/post_img1.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.php?id=$id" class="catg_title"> Aliquam malesuada diam eget turpis varius 1</a> </div>
                    </div>
                  </li>
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.php?id=$id" class="media-left"> <img alt="" src="images/post_img2.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.php?id=$id" class="catg_title"> Aliquam malesuada diam eget turpis varius 2</a> </div>
                    </div>
                  </li>
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.php?id=$id" class="media-left"> <img alt="" src="images/post_img1.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.php?id=$id" class="catg_title"> Aliquam malesuada diam eget turpis varius 3</a> </div>
                    </div>
                  </li>
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.php?id=$id" class="media-left"> <img alt="" src="images/post_img2.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.php?id=$id" class="catg_title"> Aliquam malesuada diam eget turpis varius 4</a> </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Sponsor</span></h2>
            <a class="sideAdd" href="#"><img src="images/add_img.jpg" alt=""></a> </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Category Archive</span></h2>
            <select class="catgArchive">
              <option>Select Category</option>
              <option>Life styles</option>
              <option>Sports</option>
              <option>Technology</option>
              <option>Treads</option>
            </select>
          </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Links</span></h2>
            <ul>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Rss Feed</a></li>
              <li><a href="#">Login</a></li>
              <li><a href="#">Life &amp; Style</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </section>
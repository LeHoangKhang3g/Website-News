  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="../home.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Trang chủ</span></a></li>
          <?php
            require("../db.php");
            try {
                $sql="SELECT * FROM the_loai";
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchALL() as $row){
                  $ten=$row["ten"];
                  $id=$row["id"];
                  echo "<li><a href=\"../home.php?the_loai_id=$id\">$ten</a></li>";
                }
              }
              catch (PDOException $e){
              echo "Lỗi: ".$e->getMessage();
              }
          ?>
          <li><a href="../pages/contact.php">Phản hồi với chúng tôi</a></li>
          <li><a href="../pages/404.php">404 Page</a></li>
        </ul>
      </div>
    </nav>
  </section>
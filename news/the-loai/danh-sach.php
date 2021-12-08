      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
        <h1 class="h2">Thể loại</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="index.php?dir=the-loai&page=them-moi" class="btn btn-sm btn-outline-secondary">Thêm mới</a>
          </div>
        </div>
      </div>


      <h2>Danh sách thể loại</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên</th>
              <th>Tác vụ</th>
            </tr>
          </thead>
          <tbody>
            <?php
              try {
                $host="localhost";
                $dbname="news_db";
                $username="root";
                $password="";
                $sql="SELECT * FROM the_loai";
                $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchALL() as $row){
                  $id=$row["id"];
                  echo "<tr>";
                  echo "  <td>$id</td>";
                  echo "  <td>".$row["ten"]."</td>";
                  echo "  <td><a href=\"index.php?dir=the-loai&page=cap-nhat&id=$id\" class=\"btn btn-sm btn-outline-secondary\">Cập nhật</a><a href=\"index.php?dir=the-loai&page=xoa&id=$id\" class=\"btn btn-sm btn-outline-secondary\">Xoá</a></td>";
                  echo "</tr>";
                }
              }
              catch (PDOException $e){
              echo "Lỗi: ".$e->getMessage();
              }
            ?>
          </tbody>
        </table>
      </div>
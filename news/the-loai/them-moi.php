<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
  <h1 class="h2">Thêm mới thể loại</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
      <a href="index.php?dir=the-loai&page=danh-sach" class="btn btn-sm btn-outline-secondary">Quay lại</a>
    </div>
  </div>        
</div>

<div class="row">
  <div class="col-4">
    <form action="" method="POST">
      <div class="mb-3">
          <label for="txt-ten" class="form-lable">Tên</label>
          <input type="text" class="form-control" id="txt-ten" name="txt_ten" placeholder="Tên thể loại" required>
      </div>
      <button type="submit" class="btn btn-sm btn-outline-secondary">Thêm mới</button>
    </form>
  </div>
</div>

<?php 

  if(isset($_POST["txt_ten"])&&!empty($_POST["txt_ten"])){
    $host="localhost";
    $dbname="news_db";
    $username="root";
    $password="";
    $ten=$_POST["txt_ten"];
    $count=0;
    $sqlSelect="SELECT COUNT(*) 'dem' FROM the_loai WHERE ten='$ten'";
        $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
        $stmt=$conn->prepare($sqlSelect);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchALL() as $row){
            $count=$row["dem"];
            break;
        }

    if($count==0){
      $sql="INSERT INTO the_loai(ten) VALUES('$ten')";
      try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $conn->exec($sql);
        
        header("Location: index.php?dir=the-loai&page=danh-sach");

        $conn=null;
      }
      catch (PDOException $e){
          echo "Lỗi: ".$e->getMessage();
      }
    }
    else{
      echo "Tên đã tồn tại!";
    }

  }
?>
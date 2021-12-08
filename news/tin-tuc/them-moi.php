<?php
	try{
	    $host="localhost";
		$dbname="news_db";
		$username="root";
		$password="";				    
		$conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
	}
	catch (PDOException $e){
		echo "Lỗi: ".$e->getMessage();
	}

		$count=-1;
	  	if(isset($_POST["txt_tieu_de"])&&!empty($_POST["txt_tieu_de"])&&isset($_POST["pic_anh"])&&!empty($_POST["pic_anh"])&&isset($_POST["textarea_tomtat"])&&!empty($_POST["textarea_tomtat"])&&isset($_POST["textarea_noidung"])&&!empty($_POST["textarea_noidung"])){ 
		    $id_the_loai=$_POST["the_loai"];
		    $tieu_de=$_POST["txt_tieu_de"];
		    $ten_hinh_anh=$_POST["pic_anh"];
		    $tom_tat=$_POST["textarea_tomtat"];
		    $noi_dung=$_POST["textarea_noidung"];
		    $count=-1;
		    $sql="SELECT COUNT(*) dem FROM the_loai WHERE id=$id_the_loai";
		    try{
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
		    if($count==1){
			    $sql="INSERT INTO tin_tuc(the_loai_id,tieu_de,hinh_anh,tom_tat,noi_dung) VALUES($id_the_loai,'$tieu_de','$ten_hinh_anh','$tom_tat','$noi_dung')";
			    try{
			        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

			        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			        $conn->exec($sql);

					header("Location: index.php?dir=tin-tuc&page=danh-sach");
			    }
			    catch (PDOException $e){
			          echo "Lỗi: ".$e->getMessage();
			    }
			}
	    }
	if($count==0)
		echo "Không tồn tại thể loại đã chọn!";
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
  <h1 class="h2">Thêm mới tin tức</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
      <a href="index.php?dir=tin-tuc&page=danh-sach" class="btn btn-sm btn-outline-secondary">Quay lại</a>
    </div>
  </div>        
</div>
<div class="row">
  	<div class="col-10">
    	<form action="" method="POST">
      		<div class="mb-3">
      			<label for="the-loai" class="form-lable">Thể loại</label>
      			<select name="the_loai" id="the-loai" class="form-control">
					<?php
						try{
							$sqlSelect="SELECT * FROM the_loai";	
							$stmt=$conn->prepare($sqlSelect);
							$stmt->execute();
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							foreach($stmt->fetchALL() as $row){
								$id=$row["id"];
								$ten=$row["ten"];
								echo "<option value=$id>$ten</option>";
							}
						}
						catch (PDOException $e){
							echo "Lỗi: ".$e->getMessage();
						}				
						$conn=null;	
					?>
      			</select>
	          	<label for="txt-tieu-de" class="form-lable">Tiêu đề</label>
	          	<input type="text" class="form-control" id="txt-tieu-de" name="txt_tieu_de" placeholder="Tiêu đề" required>
	          	<lable for="pic-anh" class="form-lable">Ảnh bìa</lable>
	          	<input type="file" name="pic_anh" id="pic-anh" placeholder="Ảnh" class="form-control" required accept="image/png, image/jpeg">
	          	<label for="textarea-tomtat" class="form-lable"></label>
	          	<textarea class="form-control" id="textarea-tomtat" name="textarea_tomtat" rows="5" required placeholder="Tóm tắt"></textarea>
	          	<label for="textarea-noidung" class="form-lable"></label>
	          	<textarea class="form-control" id="textarea-noidung" name="textarea_noidung" placeholder="Nội dung"></textarea><br>
      			<button type="submit" class="btn btn-sm btn-outline-secondary">Thêm mới</button>
	      	</div>
    	</form>
  	</div>
</div>

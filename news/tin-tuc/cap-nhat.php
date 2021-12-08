<?php
	$ko_the_loai=false;
	$thay_doi_hinh_anh=false;
	$host="localhost";
    $dbname="news_db";
    $username="root";
    $password="";	
    $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
	if(!isset($_POST["txt_tieu_de"]))
    try {
        $id=$_GET["id"];
        $sql="SELECT * FROM tin_tuc WHERE id=$id";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmt->fetch();
        $tieu_de=$result["tieu_de"];
        if($tieu_de==null)
			header("Location: index.php?dir=tin-tuc&page=danh-sach");        	
    }
    catch (PDOException $e){
        echo "Lỗi: ".$e->getMessage();
    }
    else if(isset($_POST["txt_tieu_de"])&&!empty($_POST["txt_tieu_de"])&&isset($_POST["textarea_tomtat"])&&!empty($_POST["textarea_tomtat"])&&isset($_POST["textarea_noidung"])&&!empty($_POST["textarea_noidung"])){ 
        $id=$_GET["id"];	
		$the_loai_id=$_POST["the_loai"];
		$tieu_de=$_POST["txt_tieu_de"];
		if(!empty($_POST["pic_anh"])){
			$thay_doi_hinh_anh=true;
			$hinh_anh=$_POST["pic_anh"];			
		}
		$tom_tat=$_POST["textarea_tomtat"];
		$noi_dung=$_POST["textarea_noidung"];
        try{
	        $count=0;
	    	$sqlSelect="SELECT COUNT(*) 'dem' FROM the_loai WHERE id=$the_loai_id";
	        $stmt=$conn->prepare($sqlSelect);
	        $stmt->execute();
	        $stmt->setFetchMode(PDO::FETCH_ASSOC);
	        $result=$stmt->fetch();
	        $count=$result["dem"];
	        
	    }
	    catch (PDOException $e){
	    	echo "Lỗi: ".$e->getMessage();
	    }
	    
        if($count==1){
		    if($thay_doi_hinh_anh)
		    	$sql="UPDATE tin_tuc SET the_loai_id=$the_loai_id,tieu_de='$tieu_de',hinh_anh='$hinh_anh',tom_tat='$tom_tat',noi_dung='$noi_dung' WHERE id=$id";
		    else
		    	$sql="UPDATE tin_tuc SET the_loai_id=$the_loai_id,tieu_de='$tieu_de',tom_tat='$tom_tat',noi_dung='$noi_dung' WHERE id=$id";		    	
		    try{
		      	$stmt=$conn->prepare($sql);
		      	$stmt->execute();
        		header("Location: index.php?dir=tin-tuc&page=danh-sach");
		    }
		    catch (PDOException $e){
		        echo "Lỗi: ".$e->getMessage();
		    }
		}
		else{
			$ko_the_loai=true;
		}
    }		
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
	<h1 class="h2">Cập nhật tin tức</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          	<a href="index.php?dir=tin-tuc&page=danh-sach" class="btn btn-sm btn-outline-secondary">Quay lại</a>
        </div>
    </div>        
</div>

<div class="row">
  	<div class="col-8">
    	<form action="" method="POST">
      		<div class="mb-3">
      			<label for="the-loai" class="form-lable">Thể loại</label>
      			<select name="the_loai" id="the-loai" class="form-control">
					<?php
						try{
							$sqlSelect="SELECT * FROM tin_tuc WHERE id=".$_GET["id"];	
							$stmt=$conn->prepare($sqlSelect);
							$stmt->execute();
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							$tin_tuc=$stmt->fetch();
							$the_loai_id=$tin_tuc["the_loai_id"];
							$tieu_de=$tin_tuc["tieu_de"];
							$hinh_anh=$tin_tuc["hinh_anh"];
							$tom_tat=$tin_tuc["tom_tat"];
							$noi_dung=$tin_tuc["noi_dung"];
						}
						catch (PDOException $e){
							echo "Lỗi: ".$e->getMessage();
						}			

						try{
							$sqlSelect="SELECT * FROM the_loai";	
							$stmt=$conn->prepare($sqlSelect);
							$stmt->execute();
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							foreach($stmt->fetchALL() as $row){
								$id=$row["id"];
								$ten=$row["ten"];
								$selected="";
								if($id==$the_loai_id)
									$selected="selected";
								echo "<option value=$id $selected>$ten</option>";
							}
						}
						catch (PDOException $e){
							echo "Lỗi: ".$e->getMessage();
						}		

						

						$conn=null;	
					?>
      			</select>
	          	<label for="txt-tieu-de" class="form-lable">Tiêu đề</label>
	          	<?php echo "<input type=\"text\" class=\"form-control\" id=\"txt-tieu-de\" name=\"txt_tieu_de\" placeholder=\"Tiêu đề\" required value=\"$tieu_de\">" ?>
	          	<lable for="pic-anh" class="form-lable">Ảnh bìa</lable>
	          	<?php echo "<br><img src=\"images/$hinh_anh\" height=\"300\"><br><br>"?>
	          	<?php echo "<input type=\"file\" name=\"pic_anh\" id=\"pic-anh\" placeholder=\"Ảnh\" class=\"form-control\"  accept=\"image/png, image/jpeg\" value=\"image/$hinh_anh\">"?>
	          	<label for="textarea-tomtat" class="form-lable"></label>
	          	<textarea class="form-control" id="textarea-tomtat" name="textarea_tomtat" rows="5" required placeholder="Tóm tắt"><?=$tom_tat?></textarea>
	          	<label for="textarea-noidung" class="form-lable"></label>
	          	<textarea class="form-control" id="textarea-noidung" name="textarea_noidung" placeholder="Nội dung"><?=$noi_dung?></textarea><br>
      			<button type="submit" class="btn btn-sm btn-outline-secondary">Cập nhật</button>
	      	</div>
    	</form>
  	</div>
</div>

<?php
	if($ko_the_loai)
		echo "Không có thể loại đã chọn";
?>
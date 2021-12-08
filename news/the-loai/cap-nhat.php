<?php
	$same=false;
	if(!isset($_POST["txt_ten"]))
    try {
        $host="localhost";
        $dbname="news_db";
        $username="root";
        $password="";
        $id=$_GET["id"];
        $sql="SELECT * FROM the_loai WHERE id=$id";
        $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchALL() as $row){
            $ten=$row["ten"];
            break;
        }
        if($ten==null)
			header("Location: index.php?dir=the-loai&page=danh-sach");        	
        $conn=null;
    }
    catch (PDOException $e){
        echo "Lỗi: ".$e->getMessage();
    }
    else if(isset($_POST["txt_ten"])&&!empty($_POST["txt_ten"])){
	    $host="localhost";
	    $dbname="news_db";
	    $username="root";
	    $password="";
	    $ten=$_POST["txt_ten"];
      $id=$_GET["id"];	

        try{
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
	        $conn=null;
	    }
	    catch (PDOException $e){
	    	echo "Lỗi: ".$e->getMessage();
	    }
	    
        if($count==0){
		    $sql="UPDATE the_loai SET ten='$ten' WHERE id=$id";
		    try{
		      	$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

		      	$stmt=$conn->prepare($sql);
		      	$stmt->execute();
        		header("Location: index.php?dir=the-loai&page=danh-sach");
		      	$conn=null;
		    }
		    catch (PDOException $e){
		        echo "Lỗi: ".$e->getMessage();
		    }
		}
		else{
			$same=true;
		}
    }		
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
	<h1 class="h2">Cập nhật thể loại</h1>
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
      			<h4>ID: <?php echo $_GET["id"];?> <h4><br>
          		<label for="txt-ten" class="form-lable">Tên</label>
          		<?php
          			echo "<input type=\"text\" class=\"form-control\" id=\"txt-ten\" name=\"txt_ten\" placeholder=\"Tên thể loại\" required value=\"$ten\">"
          		?>
      		</div>
      		<button type="submit" class="btn btn-sm btn-outline-secondary">Cập nhật</button>
    	</form>
  	</div>
</div>

<?php
	if($same)
		echo "Tên đã tồn tại";
?>
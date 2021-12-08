<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
    <h1 class="h2">Xoá thể loại</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="index.php?dir=the-loai&page=danh-sach" class="btn btn-sm btn-outline-secondary">Quay lại</a>
        </div>
    </div>        
</div>

<?php
	$host="localhost";
	$dbname="news_db";
	$username="root";
	$password="";
	$id=0;
    if(isset($_GET["id"])&&!empty($_GET["id"]))
    	$id=$_GET["id"];	
	$count=-1;
    try{
	  	$sqlSelect="SELECT COUNT(*) 'dem' FROM the_loai WHERE id=$id";
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
    if($count==1){
    	try{
			$sql="DELETE FROM the_loai WHERE id=$id";
		    $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
		    $stmt=$conn->prepare($sql);
		    $stmt->execute();
		    $conn=null;
		    header("Location: index.php?dir=the-loai&page=danh-sach");
		}
		catch (PDOException $e){
			echo "Lỗi: ".$e->getMessage();
		}
    }
    else{
    	echo "Không tìm thấy thể loại để xoá!";
    }
?>


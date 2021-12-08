<?php
	$host="localhost";
	$dbname="news_db";
	$username="root";
	$password="";
    if(isset($_GET["id"]))
    	$id=$_GET["id"];	
    else
    	header("Location: index.php?dir=tin-tuc&page=danh-sach");
	$count=-1;
    try{
	  	$sqlSelect="SELECT COUNT(*) 'dem' FROM tin_tuc WHERE id=$id";
	    $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
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
    	try{
			$sql="DELETE FROM tin_tuc WHERE id=$id";
		    $stmt=$conn->prepare($sql);
		    $stmt->execute();
		    $conn=null;
		    header("Location: index.php?dir=tin-tuc&page=danh-sach");
		}
		catch (PDOException $e){
			echo "Lỗi: ".$e->getMessage();
		}
    }
    else{
    	echo "Không tìm thấy tin tức để xoá!";
    }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">        
    <h1 class="h2">Xoá tin tức</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="index.php?dir=tin-tuc&page=danh-sach" class="btn btn-sm btn-outline-secondary">Quay lại</a>
        </div>
    </div>        
</div>
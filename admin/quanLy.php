<?php
	session_start();
	$url=$_SESSION["url"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
	if(isset($_GET["tbv"])) echo("Thêm bài viết");
	else if(isset($_GET["dsbv"])) echo("Danh sách bài viết");
	else if(isset($_GET["dstl"])) echo("Danh sách thể loại");
	else if(isset($_GET["dsuser"])) echo("Danh sách người dùng");
	else if(isset($_GET["thongKe"])) echo("Thống kê");
?>
</title>
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>

<body>
<div>
	<?php
		include ("../Connectdb/open.php");
		$maUser=$_SESSION["idUser"];
		$resultNotice=mysqli_query($con,"select * from tblbaiviet where tinhTrangBv=0");
		$resultNoticeWriter=mysqli_query($con,"select * from tblbaiviet where tinhTrangBv=0 and maUser=1");
		$notice=mysqli_num_rows($resultNotice);
		$noticeWriter=mysqli_num_rows($resultNoticeWriter);
		if($_SESSION["phanQuyen"]==1)
		{
	?>
			<button type="button" onclick="location.href='?tbv'" id="a3" >Thêm bài viết</button>
            <button type="button" onclick="location.href='?dsbv'" id="a3">Danh sách bài viết</button>
           	<button type="button" onclick="location.href='?dstl'" id="a3">Danh sách thể loại</button>
            <button type="button" onclick="location.href='../giaoDien/index.php'">Thoát</button>
            <font color="#FF0000">THÔNG BÁO: Bạn có "<?php echo($notice);?>"bài viết chưa được Admin duyệt!</font>
    <?php
		}
		else if($_SESSION["phanQuyen"]==2)
		{
	?>
            <button type="button"><a href="?tbv" id="a3" >Thêm bài viết</a></button>
            <button type="button"><a href="?dsbv" id="a3">Danh sách bài viết</a></button>
    		<button type="button"><a href="?dstl" id="a3">Danh sách thể loại</a></button>
            <button type="button"><a href="?dsuser" id="a3">Danh sách người viết bài và người đọc</a></button>
            <button type="button"> <a href='../giaoDien/index.php'" id="a3">Thoát </a></button>
            <font color="#FF0000">THÔNG BÁO: Bạn có "<?php echo($notice);?>" bài viết chưa duyệt!</font>
    <?php
		}
		else if($_SESSION["phanQuyen"]==3)
		{
	?>
            <button type="button"><a href="?tbv" id="a3" >Thêm bài viết</a></button>
            <button type="button"><a href="?dsbv" id="a3">Danh sách bài viết</a></button>
    		<button type="button"><a href="?dstl" id="a3">Danh sách thể loại</a></button>
            <button type="button"><a href="?dsuser" id="a3">Danh sách người dùng</a></button>
            <button type="button"><a href="?thongKe" id="a3">Thống kê</a></button>
            <button type="button"> <a href='../giaoDien/index.php'" id="a3">Thoát </a></button>
            <font color="#FF0000">THÔNG BÁO: Bạn có "<?php echo($notice);?>" bài viết chưa duyệt!</font>
    <?php
		}
	?>
    	<br /><br />
    	<b>Welcome</b> <?php if($_SESSION["phanQuyen"]==1) echo "Biên tập viên: "; else if($_SESSION["phanQuyen"]==2) echo "Admin: "; 	else if($_SESSION["phanQuyen"]==3) echo "Super-Admin: "; ?>
        <a href="?ttcn=<?php echo($_SESSION["username"]);?>" style=" text-decoration:underline; color: #000">
	<?php 
		$maUser=$_SESSION["idUser"];
		$resultTenUser=mysqli_query($con,"select tenUser from tbluser where maUser=$maUser");
		$tenUser=mysqli_fetch_array($resultTenUser);
		echo ($tenUser["tenUser"]);
	?>!</a>
        <a href="../quanLyTaiKhoan/dangXuatProcess.php" style="margin-right:5px; color:black; text-decoration: none"><b>Đăng Xuất</b></a>
</div>
<div>
<center>
<?php
		if(isset($_GET["tbv"]))
		{
			include("themBaiViet.php");
    	}
		else if(isset($_GET["dsbv"]))
		{
			include("danhSachBaiViet.php");
        }
		else if(isset($_GET["dstl"]))
		{
			include("danhSachTheLoai.php");
        }
		else if(isset($_GET["dsuser"]))
		{
			include("danhSachUser.php");
        }
		else if(isset($_GET["thongKe"]))
		{
			include("thongKe.php");
        }
		else if(isset($_GET["ttcn"]))
		{
			header("location:../giaoDien/index.php?ttcn&ad");	
		}
		else header("location:../giaoDien/index.php");	
	?>
</center>
</div>
</body>
</html>
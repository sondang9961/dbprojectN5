<?php
session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
		include ("../Connectdb/open.php");
		if(isset($_GET["pcat"]))
		{
			$maTheLoai=$_GET["pcat"];
			$resultTitle=mysqli_query($con,"select * from tbltheloai where maTheLoai=$maTheLoai");
			$title=mysqli_fetch_array($resultTitle);
			echo($title["tenTheLoai"]);
		}
		else if(isset($_GET["cat"]))
		{
			$maTheLoaiCon=$_GET["cat"];
			$resultTitle=mysqli_query($con,"select * from tbltheloaicon where maTheLoaiCon=$maTheLoaiCon");
			$title=mysqli_fetch_array($resultTitle);
			echo($title["tenTheLoaiCon"]);
		}
		else if(isset($_GET["id"]))
		{
			$maBaiViet=$_GET["id"];
			$resultTitle=mysqli_query($con,"select * from tblbaiviet where maBaiViet=$maBaiViet");
			$title=mysqli_fetch_array($resultTitle);
			echo $title["tenBaiViet"];
		}
		else if(isset($_GET["ttcn"])) { echo($_SESSION["tenUser"]); echo(" | Profile");}
		else if(isset($_GET["bvl"])) echo("Bài viết đã lưu");
		else if(isset($_GET["dn"])) echo("Đăng nhập");
		else if(isset($_GET["dk"])) echo("Đăng ký");
		else if(isset($_GET["dmk"])) echo("Đổi mật khẩu");
		else if(isset($_GET["hdbl"])) echo("Hoạt động bình luận");
		else if(isset($_GET["llmk"])) echo("Lấy lại mật khẩu");
		else echo("Nhóm 5");
	?>
</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="shortcut icon" href="/dbprojectN5/Images/favicon.JPG"  />
</head>

<body>
<button onclick="topFunction()" id="scroll" title="Go to top"><img src="../Images/iconfinder_arrow-top_4115227.png" height="20"/></button>
<div id="main">
<div id="header">
  <div id="topBanner">			
    <?php
	if(isset($_SESSION["username"]))
	{
   		if($_SESSION["phanQuyen"]>0)
		{
		?>
			<a href="../admin/quanLy.php?dsbv" style="color:#FFF; border-right:1px white solid; padding-right:8px">Trang quản trị</a>	
		<?php
        }
		?>
    	<b>Welcome</b> <?php if($_SESSION["phanQuyen"]==1) echo "Biên tập viên: "; else if($_SESSION["phanQuyen"]==2) echo "Admin: "; 	else if($_SESSION["phanQuyen"]==3) echo "Super-Admin: "; else echo"User: ";?>
        <a href="?ttcn=<?php echo($_SESSION["username"]);?>" style=" text-decoration:underline; color:#FFFFFF">
	<?php 
		$maUser=$_SESSION["idUser"];
		$resultTenUser=mysqli_query($con,"select tenUser from tbluser where maUser=$maUser");
		$resultNotice=mysqli_query($con,"select * from tblbaiviet where tinhTrangBv=0");
		$resultNoticeWriter=mysqli_query($con,"select * from tblbaiviet where tinhTrangBv=0 and maUser=1");
		$notice=mysqli_num_rows($resultNotice);
		$noticeWriter=mysqli_num_rows($resultNoticeWriter);
		$tenUser=mysqli_fetch_array($resultTenUser);
		echo ($tenUser["tenUser"]);
	?>!</a>
        <a href="../quanLyTaiKhoan/dangXuatProcess.php" id="a1" style="padding-right:5px">Đăng Xuất</a>
    <?php
	}
	else
	{
	?>
		<a href="?dn" id="a1">Đăng nhập</a> <a href="?dk" id="a1">Đăng ký</a>
    <?php
	}
	?>
  </div>
  <div id="banner">
    <div style="float:left; font-size:50px; padding-top:40px"><a href="."> Nhóm 5</a></div>
    <div id="bannerImage"> <img src="../Images/banner.jpg" width="700px" height="150px" /> </div>
  </div>
  <div id="menu">
    <ul>
      <li id="icon1" class="li0"><a href="."><img src="../Images/homePageIcon.png" width="30px" id="icon" /></a></li>
      <?php
		include ("../Connectdb/open.php");
		$resultTheLoai=mysqli_query ($con,"select * from tbltheloai");
		while ($tl=mysqli_fetch_array($resultTheLoai))
		{
			$maTheLoai=$tl["maTheLoai"];
			$resultsltl=mysqli_query($con,"select count(*) as tongBv from (select maBaiViet from tblTheLoai inner join (select tblTheLoaiCon.maTheLoaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, maTheLoai, tinhTrangBv from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai where a.maTheLoai = $maTheLoai and tinhTrangBv=1)b");
		$sltl=mysqli_fetch_array($resultsltl);
		$demTl=$sltl["tongBv"];
		//Nếu thể loại chưa có bài viết thì sẽ ko hiện trên thanh menu
		if($demTl!=0)
		{
		?>
        <a href="?pcat=<?php echo($tl["maTheLoai"]) ?>">
	      	<li class="li0">
		    <img src="<?php echo($tl["anhTheLoai"]) ?>" height="22px"><br>
	        <div><?php echo($tl["tenTheLoai"]); ?></div>
	        <ul>
	          <?php
					$maTheLoai=$tl["maTheLoai"];
					$resultTheLoaiCon=mysqli_query($con,"select * from tblTheLoaiCon where maTheLoai=$maTheLoai");
					while($tlc=mysqli_fetch_array($resultTheLoaiCon))
					{
					$maTheLoaiCon=$tlc["maTheLoaiCon"];
					$resultsltlc=mysqli_query($con,"select count(*) as tongBv1 from tblbaiviet where maTheLoaiCon=$maTheLoaiCon");
					$sltlc=mysqli_fetch_array($resultsltlc);
					$demTlc=$sltlc["tongBv1"];
					if($demTlc!=0)
					{	
			  ?>
	          <li class="li1"><a id="a" href="?cat=<?php echo($tlc["maTheLoaiCon"]); ?>"><?php echo($tlc["tenTheLoaiCon"]); ?></a> </li>
	          <?php
					}
					}
				?>
	        </ul>
	      </li>
      </a>
      <?php
		}
  		}
		include("../Connectdb/close.php");
	?>
    </ul>
  </div>
  <form id="form" >
    <button type="button" id="searchButton" onclick="validateSearch()"><img src="../Images/585e4ae1cb11b227491c3393.png" height="20px" width="20px" /></button>
    <input type="search" id="searchBox" name="txtSearch" placeholder="Tên bài viết hoặc mô tả ..." value="<?php if (isset($_GET["txtSearch"])) echo $_GET["txtSearch"]; ?>"  />
  </form>
</div>
<div id="content">
<?php
	if (isset($_GET["ttcn"]) || isset($_GET["dmk"]) || isset($_GET["bvl"]) || isset($_GET["hdbl"]))
	{
?>
	<div id="QLTTCN" style="top:20%">
        <ul class="ul1">
          <li class="li2"><a href="../giaoDien/index.php?ttcn=<?php echo($_SESSION["username"]);?>" id="a8">Thông tin cá nhân</a></li>
          <li class="li2"><a href="../giaoDien/index.php?dmk=<?php echo($_SESSION["username"]);?>" id="a8">Đổi mật khẩu</a></li>
          <li class="li2"><a href="../giaoDien/index.php?bvl=<?php echo($_SESSION["username"]);?>" id="a8">Bài viết đã lưu</a></li>
          <li class="li2"><a href="../giaoDien/index.php?hdbl=<?php echo($_SESSION["username"]);?>" id="a8">Hoạt động bình luận</a></li>
         </ul>
     </div>
<?php
	}
	if (isset($_GET["dn"]))
	{
?>
	<div id="dn">
    	<?php include ("../quanLyTaiKhoan/dangNhap.php") ?>	
    </div>
<?php
	}
	if(isset($_GET["dk"]))
	{
?>
	<div id="dk">
    	<?php include ("../quanLyTaiKhoan/dangKy.php") ?>	
    </div>
<?php		
	}
	if(isset($_GET["llmk"]))
	{
?>
	<div id="llmk">
    	<?php include ("../quanLyTaiKhoan/layLaiMatKhau.php") ?>	
    </div>
<?php
	}
	if(!isset($_GET["dn"]) && !isset($_GET["dk"]) && !isset($_GET["llmk"]))
	{
?>
<div id="mainContent">
<?php
	 if (isset($_GET["id"]))
		{
			$maBv=$_GET["id"];
			include ("../quanLyBaiViet/baiVietChiTiet.php");
		}
	 else if (isset($_GET["ttcn"]))
		{
			$ttcn=$_GET["ttcn"];
			?>
            	<div id="ttcn">
			<?php
				include ("../quanLyTaiKhoan/thongTinCaNhan.php");
			?>
                </div>
			<?php
		}
	else if (isset($_GET["dmk"]))
		{
			$dmk=$_GET["dmk"];
			include ("../quanLyTaiKhoan/doiMatKhau.php");
		}
	else if (isset($_GET["bvl"]))
		{
			$bvl=$_GET["bvl"];
			include ("../quanLyBaiViet/xemBvDaLuu.php");
		}
	else if (isset($_GET["hdbl"]))
		{
			$hdbl=$_GET["hdbl"];
			include ("../quanLyBaiViet/hoatDongBinhLuan.php");
		}
	else if (isset($_GET["pcat"])||isset($_GET["cat"])||isset($_GET["txtSearch"]))
		{
			include ("../quanLyBaiViet/baiViet.php");
		}
	else include ("../quanLyBaiViet/trangChu.php");
?>
</div>
<?php
	}
?>
<?php
	 if (!isset($_GET["ttcn"]) && !isset($_GET["dn"]) && !isset($_GET["dk"]) && !isset($_GET["dmk"])&& !isset($_GET["hdbl"]) && !isset($_GET["bvl"]) && !isset($_GET["llmk"]))
	{
?>
<div id="rightBanner">
  <div style="border-bottom:#000 2px solid; height:30px; margin-left:10px">
    <h2>BÀI VIẾT NỔI BẬT</h2>
  </div>
  <?php
				include ("../Connectdb/open.php");
				$resultNb=mysqli_query($con,"select * from tblbaiviet where tinhTrangBv=1 order by luotXem desc limit 5");
				?>
  <table>
    <?php
				while ($tnb=mysqli_fetch_array($resultNb))
				{
					?>
    <tr>
      <td><table>
          <tr>
            <td rowspan="3" valign="top" ><a href="?id=<?php echo ($tnb["maBaiViet"]); ?>"><img src="<?php echo ($tnb["anh"]); ?>" height="150px" width="150px" /></a></td>
          </tr>
          <tr>
            <td height="30px" style="vertical-align:top; padding-top:0px; font-size:20px; font-weight:bold"><a href="?id=<?php echo ($tnb["maBaiViet"]); ?>" style="text-decoration:none; color:#000000"><?php echo substr($tnb["tenBaiViet"],0,150)."..." ;?></a></td>
          </tr>
          <tr>
            <td valign="top" style=" vertical-align:top;padding-top:2px;text-align: justify"><a href="?id=<?php echo ($tnb["maBaiViet"]); ?>"><?php echo substr($tnb["moTa"],0,109)."...";?></a></td>
          </tr>
        </table></td>
    </tr>
    <?php
				}
				include("../Connectdb/close.php");
				?>
  </table>
 </div>
	<?php
	}
	?>
</div>
<div id="footer">Đặng Xuân Sơn - Phạm Minh Tú</div>
</div>
</body>
</html>
<script>
//Khi người dùng cuộn chuột gọi hàm scrollFunction
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	//Khi nội dung cách phần đầu trang 20px thì hiện nút về đầu trang  
    document.getElementById("scroll").style.display = "block";
  } 
  	//Nếu không thì không hiện nút về đầu trang 
  else {
    document.getElementById("scroll").style.display = "none";
  }
}

// Khi người dùng ấn nút thì set khoảng cách giữa nội dung và phần đầu trang = 0 (về đầu trang)
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
//Function search
function validateSearch(){
	var searchBox=document.getElementById("searchBox").value;
	if(searchBox.length==0)
	{
		alert ("Bạn chưa nhập từ khóa tìm kiếm!");
	}
	else
	{
		document.getElementById("form").submit();	
	}
}
</script>

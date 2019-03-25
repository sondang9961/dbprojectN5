<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<body>
<?php
if(isset($_GET["id"]))
{
	include ("../Connectdb/open.php");
	$maBaiViet=$_GET["id"];
	$result=mysqli_query($con,"select tblbaiviet.tenBaiViet, ngayDangBai, moTa, tblbaiviet.noiDung, tblbaiviet.tinhTrangBv, luotXem, anh,tbltheloaicon.maTheLoaiCon , tenTheLoaiCon, tbluser.tenUser from tblBaiViet inner join tbluser on tblbaiviet.maUser=tbluser.maUser LEFT join tbltheloaicon ON tblbaiviet.maTheLoaiCon=tbltheloaicon.maTheLoaiCon where maBaiViet=$maBaiViet ");
	$_SESSION["url"]="?id=$maBaiViet";
	$bv=mysqli_fetch_array($result);
	if($bv["tinhTrangBv"]==1)
	{
		$luotXem=$bv["luotXem"]+1;
		mysqli_query($con,"update tblbaiviet set luotXem=$luotXem where maBaiViet=$maBaiViet");
	}
	?>
	<table id="table">
		<tr>
			<td style="border-bottom: thin gray solid;text-transform: uppercase ">
				<a href='?cat=<?php echo($bv["maTheLoaiCon"]);?>'><font size="5px"><?php echo($bv["tenTheLoaiCon"]); ?></font></a>
			</td>
		</tr>
		<tr>
			<td><h1><?php echo ($bv["tenBaiViet"]);?></h1></td>
		</tr>
		<tr>
			<td  style=" color:#999; font-size:14px">Ngày đăng bài: <?php echo ($bv["ngayDangBai"]);?></td>
		</tr>
        <tr>
			<td></td>
		</tr>
		<tr>
			<td><b><i><?php echo $bv["moTa"];?></i></b></td>
		</tr>
		<tr>
			<td><p><?php echo base64_decode($bv["noiDung"]);?></p></td>
		</tr>
		<tr>
			<td align="right"><b>Theo</b> - <i><?php echo ($bv["tenUser"]);?></i></td>
		</tr>
	</table>
	<form>
	<table id="table1">
    	<a name="luu">
			<tr>
				<td>
				<?php
				if (!isset($_SESSION["username"]))
				{
					echo ("<a href='?dn' style='color:blue'/>Đăng nhập </a> hoặc <a href='?dk' style='color:blue'/>Đăng ký</a> để bình luận, lưu bài viết, xem bài viết đã lưu!");
				}
				?>
				<h3>Ý kiến của bạn:</h3>
				</td>
			</tr>
			<tr>
            <a name="boLuu">
				<td width="100px">
					<input type="hidden" name="id" value="<?php echo $id=$_GET["id"]; ?>"/>	
					<textarea cols="80" rows="8" placeholder="Bình luận..." name="txtComment" id="txtComment"></textarea>
				</td>
           	</a>
			</tr>
			<tr>
				<td valign="top">
				<?php
				if (isset($_SESSION["username"]))
				{
				?>	
					<input type="button" id="binhLuan" value="Gửi bình luận" formaction="../quanLyBaiViet/binhLuanProcess.php" onclick="valbinhLuan()" />
					<?php
						$maUser=$_SESSION["idUser"];
						$resultBvl=mysqli_query($con,"select * from tblbaivietduocluu where maBaiViet=$maBaiViet and maUser=$maUser");
						$bvl=mysqli_fetch_array($resultBvl);
						$soBvl=mysqli_num_rows($resultBvl);
					//Kiểm tra xem bài viết này đã đc lưu chưa
					if($soBvl==1)
					//nếu đã lưu rồi
						{
							$mabvl=$bvl["maBaiVietDuocLuu"];
					?>
					<!--Hiện nút bỏ lưu -->
						<input type="button" value="Bỏ Lưu" onclick="location.href='../quanLyBaiViet/xoaBaiVietDaLuuProcess.php?idBvl=<?php echo($mabvl); ?>&id=<?php echo($maBaiViet); ?>'" >
					<?php
						}else
						{
					?>
					<!-- chưa thì hiện nút lưu-->
					 <input type="button" id="luuBv" onclick="luu()" value="Lưu" formaction="../quanLyBaiViet/luuBvProcess.php"/>
					<?php
						}
					?>			
					 <input type="button" value="Xem" onclick="location.href='?bvl'" />
					 <span id="errComment" style="padding-left:290px; color:#F00"></span>
				<?php
				}
				?>
				</td>
			</tr>
        </a>
	</table>
	</form>
    <?php
	if(isset($_SESSION["username"]))
	{
	?>
    	<table>
			<?php
             $resultCmt=mysqli_query($con,"SELECT COUNT(*) as tongCmt FROM tblcomment WHERE maBaiViet='$maBaiViet'");
             $soCmt=mysqli_fetch_array($resultCmt);
            ?>
            <a name="binhLuan">
             <h3>Bình luận: (<?php echo ($soCmt["tongCmt"]);?>)</h3>            
	<?php
	$result=mysqli_query($con,"SELECT username, noiDungComment,ngayComment FROM tblcomment LEFT JOIN tblUser ON tblcomment.maUser= tbluser.maUser WHERE maBaiViet = $id order by ngayComment desc ");
			while ($comment=mysqli_fetch_array($result))
			{
		?>
			<div id="comment">
				<b><?php echo ($comment["username"]); ?>:</b>
				<?php echo ($comment["noiDungComment"]); ?><br />
				<font size="2px"><i><?php echo ($comment["ngayComment"]); ?></i></font>
			</div>     
		<?php
			}
		?>
        	</a>
	</table>
	<?php
	}
	?>
	
	<div id="tinLq">
    	<div style="border-bottom:#000 2px solid;height:30px; padding-left:5px">
			<h2>TIN LIÊN QUAN</h2>
        </div>
		<?php
		$maTheLoaiCon=$bv["maTheLoaiCon"];
		$result=mysqli_query($con,"select * from tblBaiViet where maTheLoaiCon=$maTheLoaiCon and tinhTrangBv=1 order by maBaiViet desc limit 4");
		?>
        <div id="noiDungTinLq">
		<table>
			<tr>
			<?php
				while ($tinLq=mysqli_fetch_array($result))
				{
			?>
			<td valign="top">	
				<table>
					<tr>
						<td valign="top"><a href="?id=<?php echo ($tinLq["maBaiViet"]); ?>"><img src="<?php echo ($tinLq["anh"]); ?>" height="190px" width="190px" /></a></td>
					</tr>
					<tr>
						<td valign="top" width="190px" style=" vertical-align:top;padding-top:2px;text-align: justify;"><b><a href="?id=<?php echo ($tinLq["maBaiViet"]); ?>"><?php echo $tinLq["tenBaiViet"] ;?></a></b></td>
					</tr>
				</table>
			</td>		
			<?php
				}
			?>
			</tr>
		</table>
        </div>
	</div>
	<?php
	include ("../Connectdb/close.php");
}
?>
</body>
</html>
<script type="text/javascript">
	function valbinhLuan()
	{
		var dem=0;
		var comment=document.getElementById("txtComment").value;
		var errComment=document.getElementById("errComment");
		if(comment.length==0)
		{
			alert("Bạn chưa nhập bình luận!");
		}else
		{
			errComment.innerHTML="";
			dem++;
		}
		if (dem==1)
		{
			document.getElementById("binhLuan").type = "submit";
		}
	}
	function luu(){
		alert ("Lưu bài viết thành công!");
		document.getElementById("luuBv").type = "submit";
	}
</script>
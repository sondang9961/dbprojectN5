<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
	include ("../Connectdb/open.php");
	$maUser=$_SESSION["idUser"];
	$resultTongBvl=mysqli_query($con,"select count(*) as tongBvl from tblbaivietduocluu where maUser=$maUser ");
	$rowTongBvl=mysqli_fetch_array($resultTongBvl);
	$tongBvl=$rowTongBvl["tongBvl"];
	$soBvl1trang=4;
	$tongSoTrang=ceil($tongBvl/$soBvl1trang);
	$start=0;
	$page=1;
	$result=mysqli_query($con,"select maBaiVietDuocLuu,anh,tenBaiViet,moTa, ngayLuu, tblbaiviet.maBaiViet from tblbaivietduocluu left join tblbaiviet on tblbaivietduocluu.maBaiViet = tblbaiviet.maBaiViet where tblbaivietduocluu.maUser=$maUser order by ngayLuu desc limit $start,$soBvl1trang");
	if (isset($_GET["page"]))
		{
			$page=$_GET["page"];
			$start=($_GET["page"]-1)*$soBvl1trang;
			$result=mysqli_query($con,"select maBaiVietDuocLuu,anh,tenBaiViet,moTa, ngayLuu, tblbaiviet.maBaiViet from tblbaivietduocluu left join tblbaiviet on tblbaivietduocluu.maBaiViet = tblbaiviet.maBaiViet where tblbaivietduocluu.maUser=$maUser order by ngayLuu desc limit $start,$soBvl1trang ");
		}
	$soBv=mysqli_num_rows($result);
	if ($soBv!=0)
	{
	?>
    <div id="bvl">
	<table>
    	<a name="boLuu">
		<tr>
			<h1><center>Bài viết đã lưu:</center> </h1>
		</tr>
		<?php
		while ($bvl=mysqli_fetch_array($result))
		{
		?>
            <tr>
				<td valign="top" >
					<a href="../giaoDien/?id=<?php echo ($bvl["maBaiViet"]); ?>"><img src="<?php echo ($bvl["anh"]); ?>" height="150px" width="150px" /></a>
				</td>
				<td valign="top">
					<table>
						<tr>
							<td height="30px" style="font-size:30px; font-weight:bold"><a href="../giaoDien/?id=<?php echo ($bvl["maBaiViet"]); ?>" style="text-decoration:none; color:#000000"><?php echo $bvl["tenBaiViet"] ;?></a></td>
						</tr>
						<tr>
							<td style="padding-top:2px"><a href="../giaoDien/?id=<?php echo ($bvl["maBaiViet"]); ?>" style="text-decoration:none; color:#000000"><?php echo $bvl["moTa"] ;?></a></td>
						</tr>
						<tr>
							<td><button type="button"><a href="../quanLyBaiViet/xoaBaiVietDaLuuProcess.php?idBvl=<?php echo($bvl["maBaiVietDuocLuu"]);?>" onclick="return confirm('Bạn có chắc chắn muốn bỏ lưu!')">Bỏ lưu</a></button></td>
						</tr>
					</table>   
				</td>
			</tr>
		<?php
		}
		?>
	</tr>
    </a>
	</table>
	<?php
	if(isset($tongSoTrang) && $tongSoTrang>1)
    {
	?>
	    <table style="margin-left:100px; margin-top:100px; ">
			<tr>
	        	<td>Trang: </td>
	<?php
			if($page > 1)
			{
				$i = $page - 1;
	?>
				<td><button type="button" onClick="location.href='<?php echo("?bvl&page=$i"); ?>'">Prev</button></td>
	<?php
			}
			if($page <= 2) $startpage = 1;
			else if($page == $tongSoTrang) $startpage = $page - 4;
			else if($page == $tongSoTrang - 1) $startpage = $page - 3;
			else $startpage = $page - 2;
			$endpage = $startpage + 4;
			if($tongSoTrang > 5)
			{
			for ($i=$startpage; $i <= $endpage; $i++)
				{
	?>
					<td>
	                    <button type="button" onClick="location.href='<?php echo("?bvl&page=$i"); ?>'">
	                        <?php echo ($i); ?>
	                    </button>
					</td>
	<?php
				}
			}
			else
			{
			for ($i=1; $i <= $tongSoTrang; $i++)
				{
	?>
					<td>
	                    <button type="button" onClick="location.href='<?php echo("?bvl&page=$i"); ?>'">
	                        <?php echo ($i); ?>
	                    </button>
					</td>
	<?php
				}
			}
				if($page < $tongSoTrang)
				{
				$i = $page + 1;
	?>
				<td><button type="button" onClick="location.href='<?php echo("?bvl&page=$i"); ?>'">Next</button></td>

	<?php
				}
	?>
			</tr>
		</table>
		<table style="margin-left:100px; margin-top:1px; ">
			<tr>
				<form>
					<td>
						<input type="hidden" name="bvl" />
						<select name="page">
	<?php
							for($i=1; $i <= $tongSoTrang; $i++)
							{
	?>
								<option value="<?php echo($i); ?>"<?php if($page==$i) { ?>selected="selected"<?php } ?>><?php echo($i); ?></option>
	<?php
							}
	?>
						</select>
					</td>
					<td><input type="submit" value="Sang trang"</td>
				</form>
			</tr>
		</table>
		</div>
	<?php
		}
	}
	else 
	{
		echo ("<h1> Bạn chưa lưu bài viết nào </h1>");
	}
		include ("../Connectdb/close.php");
	?>
</body>
</html>
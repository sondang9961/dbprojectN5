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
		$resultTongCmt=mysqli_query($con,"select count(*) as tongCmt from tblcomment where maUser=$maUser ");
		$rowTongCmt=mysqli_fetch_array($resultTongCmt);
		$tongCmt=$rowTongCmt["tongCmt"];
		$soCmt1trang=4;
		$tongSoTrang=ceil($tongCmt/$soCmt1trang);
		$start=0;
		$page=1;
		$result=mysqli_query($con,"select * from tblbaiviet left join tblcomment on tblbaiViet.maBaiViet=tblcomment.maBaiViet where tblcomment.maUser=$maUser order by ngayComment desc limit $start,$soCmt1trang");
		//$result=mysqli_query($con,"SELECT tblbaiViet.maBaiViet, `anh`, `tenBaiViet`, `moTa`, tblcomment.`noiDung`, `maTheLoaiCon`, tblbaiViet.`maUser`, `ngayDangBai`, `tinhTrang`, `luotXem`, tblcomment.ngayComment FROM `tblbaiviet` left join tblcomment on tblbaiViet.maBaiViet=tblcomment.maBaiViet where tblcomment.maUser=$maUser order by ngayComment desc");
		if (isset($_GET["page"]))
		{
			$page=$_GET["page"];
			$start=($_GET["page"]-1)*$soCmt1trang;
			$result=mysqli_query($con,"select * from tblbaiviet left join tblcomment on tblbaiViet.maBaiViet=tblcomment.maBaiViet where tblcomment.maUser=$maUser order by ngayComment desc limit $start,$soCmt1trang ");
		}
		$demCmt=mysqli_num_rows($result);
		if ($demCmt > 0)
		{
		?>
        <div id="hdbl" >
            <h2><center>Hoạt động bình luận</center></h2>
            <?php
            while ($hdbl=mysqli_fetch_array($result))
			{
			?>
				<div style="border-bottom:1px #999999 solid">
					Bài viết:<b><a href="?id=<?php echo($hdbl["maBaiViet"]); ?>">
						<?php echo $hdbl["tenBaiViet"] ;?>
					</a></b><br />
					Bạn đã bình luận: <b><?php echo ($hdbl["noiDungComment"]); ?></b><br />
					<font size="2px"><i><?php echo ($hdbl["ngayComment"]); ?> </i></font>  <a href="../quanLyBaiViet/xoaBinhLuanProcess.php?maComment=<?php echo($hdbl["maComment"]); ?>">Xóa</a>
				</div>
			<?php
			}
			?>
    <table style="margin-left:100px; margin-top:100px; ">
    <tr>
        <td>Trang: </td>
	<?php
		if($page > 1)
		{
			$i = $page - 1;
	?>
			<td><button type="button" onClick="location.href='<?php echo("?hdbl&page=$i"); ?>'">Prev</button></td>
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
                    <button type="button" onClick="location.href='<?php echo("?hdbl&page=$i"); ?>'">
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
                    <button type="button" onClick="location.href='<?php echo("?hdbl&page=$i"); ?>'">
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
			<td><button type="button" onClick="location.href='<?php echo("?hdbl&page=$i"); ?>'">Next</button></td>

	<?php
			}
	?>
		</tr>
	</table>
	<table style="margin-left:100px; margin-top:1px; ">
		<tr>
			<form>
				<td>
					<input type="hidden" name="hdbl" />
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
	<?php
		}
		else echo ("<h2>Bạn chưa bình luận bài viết nào!</h2>");
		include ("../Connectdb/close.php");
	?>
   	 </div>
</body>
</html>
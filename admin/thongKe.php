<?php
	if($_SESSION["phanQuyen"]==0)
	{
	header ("location:../giaoDien/index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<center>
	<h1>Thống kê</h1>
</center>
<form>
    <input type="hidden" name="thongKe">
	Từ: <input type="datetime-local" name="ngayBatDau" value="<?php if(isset($_GET["ngayBatDau"])) echo($ngayBatDau); ?>" /> 
    Đến: <input type="datetime-local" name="ngayKetThuc" value="<?php if(isset($_GET["ngayKetThuc"])) echo($ngayKetThuc); ?>" /> 
    <input type="submit" value="Tìm" /><br /><br />
</form>
    <?php
    if(isset($_GET["ngayBatDau"]) && isset($_GET["ngayKetThuc"]))
    {
        include ("../Connectdb/open.php");
        $ngayBatDau=$_GET["ngayBatDau"];
        $ngayKetThuc=$_GET["ngayKetThuc"];
        $result=mysqli_query($con,"select * from tbluser inner join (select a.maTheLoai, maTheLoaiCon, tenTheLoai,tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv, luotXem, luotLuu from tbltheloai inner join (select maTheLoai, tblBaiViet.maTheloaiCon, tenTheLoaiCon, maBaiViet, tenBaiViet, anh, moTa, maUser, ngayDangBai, tinhTrangBv, luotXem, luotLuu from tblBaiViet inner join tblTheLoaiCon on tblBaiViet.maTheLoaiCon = tblTheLoaiCon.maTheLoaiCon)a on tblTheLoai.maTheLoai = a.maTheLoai)b on tbluser.maUser = b.maUser where ngayDangBai BETWEEN '$ngayBatDau' AND '$ngayKetThuc' ORDER BY luotXem DESC");
        include ("../Connectdb/close.php");
    ?>
       	<table border="1" cellspacing="0">
        	<tr>
            	<th>Mã</th>
                <th>Tên bài viết</th>
                <th>Ảnh</th>
                <th>Thể loại</th>
                <th>Ngày đăng bài</th>
                <th>Người viết bài</th>
                <th>Số lượt xem</th>  
                <th>Số lượt lưu</th>         
            </tr>
    <?php
        while ($thongKe=mysqli_fetch_array($result))
        {
    ?>
            <tr>
                <td><?php echo($thongKe["maBaiViet"]); ?></td>
                <td><?php echo($thongKe["tenBaiViet"]); ?></td>
                <td><img src="<?php echo($thongKe["anh"]); ?>" width="70px"></td>
                <td><?php echo($thongKe["tenTheLoai"]); ?></td>
                <td><?php echo($thongKe["ngayDangBai"]); ?></td>
                <td><?php echo($thongKe["tenUser"]); ?></td>
                <td><?php echo($thongKe["luotXem"]); ?></td>
                <td><?php echo($thongKe["luotLuu"]); ?></td>
            </tr>
    <?php
        }
    }
    ?>
        </table>
</body>
</html>
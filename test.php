<?php
	include("Connectdb/open.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript">
	function dynamicdropdown(listindex)
	{
		document.getElementById("subcategory").length = 0;
		switch (listindex)
		{
				case "-1":
					document.getElementById("subcategory").options[0]=new Option("-Thể loại con-","-1");
					break;
	<?php
			$resultTl=mysqli_query($con,"select * from tbltheloai");
			while($tl=mysqli_fetch_array($resultTl))
			{
	?>
				case "<?php echo($tl["maTheLoai"]); ?>" :
					document.getElementById("subcategory").options[0]=new Option("-Thể loại con-","-1");
	<?php
					$i = 0;
					$maTheLoai = $tl["maTheLoai"];
					$resultTlc=mysqli_query($con,"select * from tbltheloaicon where maTheLoai=$maTheLoai");
					while($tlc=mysqli_fetch_array($resultTlc))
					{
						$i += 1;
						$maTheLoaiCon = $tlc["maTheLoaiCon"];
						$tenTheLoaiCon = $tlc["tenTheLoaiCon"];
	?>
					document.getElementById("subcategory").options[<?php echo($i); ?>]=new Option("<?php echo($tenTheLoaiCon); ?>","<?php echo($maTheLoaiCon); ?>");
	<?php
					}
	?>
					break;
	<?php
			}
	?>
		}
		return true;
	}
</script>
</head>
<title>Dynamic Drop Down List</title>
<body>
	<form>
	<div class="category_div" id="category_div">Thể loại:
		<select name="ddlPcat" class="required-entry" id="category" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
			<option value="-1">-Thể loại-</option>
	<?php
			$resultTl=mysqli_query($con,"select * from tbltheloai");
			while($tl=mysqli_fetch_array($resultTl))
			{
	?>
				<option value="<?php echo($tl["maTheLoai"]); ?>"><?php echo($tl["tenTheLoai"]); ?></option>
	<?php		
			}
	?>
		</select>
	</div>
	<div class="sub_category_div" id="sub_category_div">Thể loại con:
		<script type="text/javascript" language="JavaScript">
			document.write('<select name="ddlCat" id="subcategory"><option value="-1">-Thể loại con-</option></select>')
		</script>
	</div>
	<input type="submit">
	</form>
	<?php
		include("Connectdb/close.php");
	?>
</body>
</html>
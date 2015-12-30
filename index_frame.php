<html>
<head>

	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">

		function change_frame_src(src) {
			parent.content_frame.location.href = src;
		}
		$(document).ready(function() {
			$('a').css('color', 'green');
			$('a').click(function() {
				$('a').css('color', 'green');
				$(this).css('color', 'red');
			});
		});
	</script>
</head>
<body bgcolor="black" style="color: green;">
<a href="javascript: void(1);" onclick="change_frame_src('create.php')" class="frame_link" style='color:green'>Create New File(+)</a>
<br/>
<br/>
<?php
if ($handle = opendir('files/')) {
	while (false !== ($file = readdir($handle))) {
		if (strpos($file, '.') == 0) continue;
		?>
		<a href="javascript: void(1);" onclick="change_frame_src('files/<?php echo $file; ?>')" class="frame_link" style='color:green'><?php echo $file; ?></a> (<a
			href="javascript: void(1);" onclick="change_frame_src('files/<?php echo $file; ?>')" class="frame_link" style='color:green'>Execute</a>)(<a href='javascript: void(1);'
																																						class="frame_link"
																																						style='color:green'
																																						onclick="change_frame_src('edit.php?file=<?php echo $file; ?>')">edit</a>) (
		<a href='javascript: void(1);' class="frame_link" style='color:green'
		   onclick="if(!confirm('are you sure')){return false; } change_frame_src('delete.php?file=<?php echo $file; ?>')">delete</a>)<br/>
		<?php
	}
}
?>
</body>
</html>
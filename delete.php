<script type="text/javascript">
	function reloadFrame() {
		parent.index_frame.location.reload()
	}
</script>
<?php
$file = $_GET['file'];
$file = 'files/' . $file;
unlink($file);
echo 'File deleted successfully';
echo '<script type="text/javascript">reloadFrame();</script>';
?>
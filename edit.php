<html>
<head>
	<style type="text/css">
		::selection {
			color: #ff0000;
		}

		::-moz-selection {
			color: #ff0000;
		}
	</style>

	<script type="text/javascript">
		function reloadFrame() {
			parent.index_frame.location.reload();
		}
	</script>
	<?php
	$file = $_GET["file"];
	$file = 'files/' . $file;

	if (isset($_POST['save'])) {
		if (file_exists($file)) {
			$a = fopen($file, 'w+');
			fwrite($a, $_POST['content']);
			fclose($a);
			echo '<font color="red">Saved successfully</font><br />';
		}
	}


	if (file_exists($file)) {
		$a        = fopen($file, 'r');
		$filedata = fread($a, filesize($file));
		fclose($a);
	} else {
		echo 'does not exist';
		die;
	}
	?>
	<style type="text/css">
		#codeTextarea {
			width: 500px;
			height: 510px;
		}

		.textAreaWithLines {
			font-family: courier;
			border: 1px solid #F00;

		}

		.textAreaWithLines textarea, .textAreaWithLines div {
			border: 0px;
			line-height: 120%;
			font-size: 12px;
		}

		.lineObj {
			color: red;
		}
	</style>

	<script type="text/javascript">

		var lineObjOffsetTop = 2;

		function createTextAreaWithLines(id) {
			var el = document.createElement('DIV');
			var ta = document.getElementById(id);
			ta.parentNode.insertBefore(el, ta);
			el.appendChild(ta);

			el.className = 'textAreaWithLines';
			el.style.width = (ta.offsetWidth + 30) + 'px';
			ta.style.position = 'absolute';
			ta.style.left = '30px';
			el.style.height = '80%';
			el.style.overflow = 'hidden';
			el.style.position = 'relative';
			el.style.width = (ta.offsetWidth + 30) + 'px';
			var lineObj = document.createElement('DIV');
			lineObj.style.position = 'absolute';
			lineObj.style.top = lineObjOffsetTop + 'px';
			lineObj.style.left = '0px';
			lineObj.style.width = '27px';
			el.insertBefore(lineObj, ta);
			lineObj.style.textAlign = 'right';
			lineObj.className = 'lineObj';
			var string = '';
			for (var no = 1; no < 200; no++) {
				if (string.length > 0)string = string + '<br>';
				string = string + no;
			}

			ta.onkeydown = function() {
				positionLineObj(lineObj, ta);
			};
			ta.onmousedown = function() {
				positionLineObj(lineObj, ta);
			};
			ta.onscroll = function() {
				positionLineObj(lineObj, ta);
			};
			ta.onblur = function() {
				positionLineObj(lineObj, ta);
			};
			ta.onfocus = function() {
				positionLineObj(lineObj, ta);
			};
			ta.onmouseover = function() {
				positionLineObj(lineObj, ta);
			};
			lineObj.innerHTML = string;

		}

		function positionLineObj(obj, ta) {
			obj.style.top = (ta.scrollTop * -1 + lineObjOffsetTop) + 'px';


		}

	</script>
</head>
<body style="background-color:black; color:green;">
File: <?php echo $file; ?><br/>

<form method='post'>
	<textarea id="codeTextarea" name='content' style="width:96%; height:100%; color:green; background-color:black;"><?php echo htmlspecialchars($filedata); ?></textarea>
	<script type="text/javascript">
		createTextAreaWithLines('codeTextarea');
	</script>
	<br/>
	<hr style="width:99%; float: left;"/>
	<input type='submit' name='save' id='save' value='Save' style="background-color: green; color: white;"/>
</form>
<script type="text/javascript"> reloadFrame();</script>
</body>
</html>

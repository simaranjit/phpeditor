<?php ob_start(); ?>
<html>
<head>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript">
		function reloadFrame() {
			parent.index_frame.location.reload()
		}
	</script>
	<style type="text/css">
		::selection {
			color: #ff0000;
		}

		::-moz-selection {
			color: #ff0000;
		}
	</style>
	<?php
	$name    = '';
	$content = '';
	if (isset($_POST['create'])) {
		$name    = $_POST['name'];
		$content = $_POST['content'];
		$file    = 'files/' . $name;
		if (!file_exists($file)) {
			$a = fopen($file, 'w+');
			fwrite($a, $_POST['content']);
			fclose($a);
			echo '<script type="text/javascript"> reloadFrame();</script>';
			header("location:edit.php?file=" . $name);
			exit;
		} else {
			echo 'file already exists';
		}
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

		$ = jQuery;

		$(document).delegate('#textbox', 'keydown', function(e) {
			var keyCode = e.keyCode || e.which;

			if (keyCode == 9) {
				e.preventDefault();
				var start = $(this).get(0).selectionStart;
				var end = $(this).get(0).selectionEnd;

				// set textarea value to: text before caret + tab + text after caret
				$(this).val($(this).val().substring(0, start)
							+ "\t"
							+ $(this).val().substring(end));

				// put caret at right position again
				$(this).get(0).selectionStart =
					$(this).get(0).selectionEnd = start + 1;
			}
		});


		$("textarea").keydown(function(e) {
			if (e.keyCode === 9) { // tab was pressed
				// get caret position/selection
				var start = this.selectionStart;
				var end = this.selectionEnd;

				var $this = $(this);
				var value = $this.val();

				// set textarea value to: text before caret + tab + text after caret
				$this.val(value.substring(0, start)
						  + "\t"
						  + value.substring(end));

				// put caret at right position again (add one for the tab)
				this.selectionStart = this.selectionEnd = start + 1;

				// prevent the focus lose
				e.preventDefault();
			}
		});

	</script>
</head>
<body bgcolor="black">
<?php
$name    = '';
$content = '';
if (isset($_POST['create'])) {
	$name    = $_POST['name'];
	$content = $_POST['content'];
	$file    = 'files/' . $name;
	if (!file_exists($file)) {
		$a = fopen($file, 'w+');
		fwrite($a, $_POST['content']);
		fclose($a);
		echo '<script type="text/javascript"> reloadFrame();</script>';
		header("location:edit.php?file=" . $name);
		exit;
	} else {
		echo 'file already exists';
	}
}
?>
<form method='post'>
	<input type='text' name='name' value='<?php echo $name; ?>' style="background-color: black; color:green; border: green solid 1px;"><br/>
	<textarea id="codeTextarea" name='content' style="background-color: black; color:green; height:100%; width:95%;"><?php echo $content; ?></textarea>
	<br/>
	<script type="text/javascript">
		createTextAreaWithLines('codeTextarea');
	</script>
	<hr style="width:99%; float:left;"/>
	<input type='submit' name='create' id='create' value='Create' style="background-color: green; color:white;"/>


</form>
</body>
</html>
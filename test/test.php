<!DOCTYPE html>
<html>
<head>
	<title>jQuery Example</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$("button").click(function(){
				$("body").css("background-color", "red");
			});
		});
	</script>
</head>
<body>
	<button>Change Background Color</button>
</body>
</html> 
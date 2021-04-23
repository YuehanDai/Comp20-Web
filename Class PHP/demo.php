<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Demo PHP</title>
</head>


<body>
<h1>Demo PHP</h1>

	<?php
		$messages = array("hi", "nice", "to", "meet", "you");
//		foreach($messages as $msg)
//			echo "$msg <br/>";
	
		function getMsg(){
			global $messages;
			$n = rand (0, count($messages)-1);
			return $messages[$n];
		}
	
//		echo "<h2>" .getMsg(). "</h2>"
	?>
<h2><?php getMsg(); ?></h2>
</body>
</html>
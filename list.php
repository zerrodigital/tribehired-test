<?php

$keyword = @$_GET['keyword'];

// Get the Comments from the JSON file 
$getJsonComments = file_get_contents("comments.json");

// Convert to array 
$arrComments = json_decode($getJsonComments, true);


// use preg_grep to  find array by string for every relevent attributes
$sByName = preg_grep("/$keyword/i", array_column($arrComments, 'name'));
$sByEmail = preg_grep("/$keyword/i", array_column($arrComments, 'email'));
$sByBody = preg_grep("/$keyword/i", array_column($arrComments, 'body'));

// echo "<pre>"; print_r($sByName);echo "<pre>";
// echo "<pre>"; print_r($sByEmail);echo "<pre>";
// echo "<pre>"; print_r($sByBody);echo "<pre>";

// use arrary_merge to get all ids in one array
$arrFound = array_merge($sByName, $sByEmail, $sByBody);

// echo "<pre>"; print_r($result);echo "<pre>";
?>

<html>
<head>
<body>

	<h1>Search Comments</h1>

	<div class="search-wrap">
		<form action="list.php" method="GET">
			<input type="text" name="keyword" style="padding:1em;" placeholder="Type keywords here ">
		</form>
	</div>

	<hr>

	<div class="comment-list">

		<?php 
		$ccc=1;
		foreach ( $arrFound as $a => $arrId):
			
            $name = $arrComments[$a]['name'];
            $email = $arrComments[$a]['email'];
            $body = $arrComments[$a]['body'];

			// print_r($arrComments[$a]);
		?>
		<div class="list-item">
			<div><?php echo $ccc; ?></div>
			<div>name : <?php echo @$name; ?></div>
			<div>email : <?php echo @$email; ?></div>
			<div>body : <?php echo @$body; ?></div>
		</div>
		<br><br>
		<?php 
			$ccc++;
		endforeach;
		?>

	</div>

		
</body>	
</head>	
</html>
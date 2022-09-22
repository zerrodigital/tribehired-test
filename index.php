<?php

// Get the posts from the JSON file 
$getJsonPosts = file_get_contents("posts.json");

// Convert to array 
$arrPosts = json_decode($getJsonPosts, true);

// Get the Comments from the JSON file 
$getJsonComments = file_get_contents("comments.json");

// Convert to array 
$arrComments = json_decode($getJsonComments, true);


$newArrPosts = array();

//loop post from array of post
for( $i=0; $i<count($arrPosts); $i++){
	$findId = $arrPosts[$i]['id'];
	// echo $findId;

	// use array_column to count array value separately from Array of Comments, fetch post id
	// ref https://www.php.net/manual/en/function.array-count-values.php
	$numComments = array_count_values(array_column($arrComments, 'postId'))[$findId];
	
	$newArrPosts[$i]['postId'] = $findId;
	$newArrPosts[$i]['title'] = $arrPosts[$i]['title'];
	$newArrPosts[$i]['comments'] = $numComments;
}

// rearrange to sort by comments DESC order (php7.4 above)
usort($newArrPosts, fn($a, $b) => $b['comments'] <=> $a['comments']);

// echo "<pre>"; print_r($newArrPosts);echo "<pre>"; 

?>

<html>
<head>
<body>

	<div class="posts-list">
		<?php 
		$ccc=1;
		foreach ( $newArrPosts as $post):

			//just display up to 8 post with most comments
			if($ccc>8) break;	

            $postTitle = $post['title'];
            $numComments = $post['comments'];
		?>
		<div class="list-item">
			<div><?php echo $ccc; ?></div>
			<div style="text-transform: capitalize;"><?php echo $postTitle; ?></div>
			<div>Comments : <?php echo $numComments; ?></div>
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
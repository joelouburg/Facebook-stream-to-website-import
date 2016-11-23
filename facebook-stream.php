<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
body{
	background: #fefefe;
}

img{
	max-width:150px;
}

@media (max-width:768px){
	img{
	width:100%;
	max-width:450px;
}
}
.feed_container{
	
	background-color: #cecece;
    border: 1px solid #000000;
    border-radius: 10px;
    padding: 20px !important;
    clear: none !important;
    margin-bottom: 10px;
	
	
}
</style>
 
</head>
<body>
<div class="container">
 <?php
    $page_ID = ''; // Id of your facebook account
    $access_token = ''; // app security token 
    $number_of_posts = '100';
    
    $fbpage = file_get_contents('https://graph.facebook.com/v2.7/'.$page_ID.'?fields=posts.limit('.$number_of_posts.'){full_picture,message,created_time,picture,permalink_url}&access_token='.$access_token);
    
    $fbdata = json_decode($fbpage);

    foreach ($fbdata->posts->data as $fbpost)
    {
        $post_created = date('j M Y', strtotime($fbpost->created_time));
        $post_text = $fbpost->message;
        $post_url = $fbpost->permalink_url;
        $post_picture = $fbpost->full_picture;
        
		$post_text = str_replace('\n','<br>',$post_text);
		
		?>
		
		
		<div class="feed_container"">
        <div class="row">
		<div class="col-xs-12" style="padding:10px; text-align:right;"><?= $post_created ?></div>
		</div>
		<div class="row">
		<div class="col-sm-3 col-md-2" style="text-align:center;"><img src="<?= $post_picture ?>"></div>
		<div class="col-sm-9 col-md-10"><?= $post_text ?></div>
		
		
		</div>
		</div>
		
		
		<?php
    }
	
?>
</div>
</body>
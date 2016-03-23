<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/access/css/style.css">
	<meta charset = "utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
		$(document).ready(function()
		{
			$(document).on('click', '.add_form', function()
			{
	
				$(".form").toggle('fast');
				$(".add_form").toggle();
				$(".hide_form").toggle();
			});
		
			
		$(document).on('click','.hide_form',function(){
			// var appended = $('.appended').detach();
			$('.hide_form').toggle();
			$('.add_form').toggle();
			$(".form").toggle('fast');
		});

		});
	</script>
	<title>Graffiti Grades</title>
</head>
<body>
	<div id = "wrapper">
		<a href = "/photos">Home</a>

		<form class = "logout" action ="/sessions/destroy" method = "post">
			<input class = "submit" type = "submit" value = "Log out" />
		</form>

		<img class = "all_images" src = '/images/<?= $photo_details["full_path"]?>' alt = "Dud" />

		<p class = "added_by">Added by: <?=$photo_details['alias']?></p>
		<h3 class = 'caption'><?=$photo_details['caption']?></h3>
		<?php
		if($photo_details['grade']<= 1.4)
		{
			$photo_details['grade'] = "F";
		}
		if($photo_details['grade'] >= 1.5 && $photo_details['grade']<= 2.4)
		{
			$photo_details['grade'] = "D";
		}
		if($photo_details['grade'] >= 2.5 && $photo_details['grade']<= 3.4)
		{
			$photo_details['grade'] = "C";
		}
		if($photo_details['grade'] >= 3.5 && $photo_details['grade']<= 4.4)
		{
			$photo_details['grade'] = "B";
		}
		if($photo_details['grade'] >= 4.5)
		{
			$photo_details['grade'] = "A";
		}
		?>
		<h3 class = 'grade'>Grade: </h3><h1 class ="actual_grade"><?=$photo_details['grade']?></h1>

		<?php
		
		if($photo_details['user_id']===$this->session->userdata('id'))
		{
			?>

			<form method = "post" action = "/photos/delete_all_comments">
			<input type = "hidden" name = "id" value = "<?=$photo_details['photo_id']?>" />
			<input class = "submit" type = "submit" value = "Delete Photo" />
			</form>

			<?php
		}
		?>

		<div class = "buttons">
				<button class = "add_form">Add a Comment</button>
				<button class = "hide_form"> Hide Comment Form</button>
		</div>
		<form class = "form" action = "/photos/add" method = "post">
			<input type = "hidden" name = "id" value = "<?=$photo_details['photo_id']?>">
			<label>Grade:</label>
			<select name = "grade">
				<option value = "1">F</option>
				<option value = "2">D</option>
				<option value = "3">C</option>
				<option value = "4">B</option>
				<option value = "5">A</option>
			</select>
			<label>Add a comment:</label>
			<textarea rows = "10" cols = "100" name = "comment"></textarea>
			<input class = "submit" type = "submit" value = "Tag" />
		</form>
		<h3 class = 'comment'>Comments:</h3>
		<div class = "comments">
			<ul>
				<?php 
				
				foreach($comments as $comment)
				{
					if($comment['comments'] !== null)
					{
					echo "<li>" . $comment['comments'] . " -" . $comment['alias'] . "</li>";
					if($comment['user_id']===$this->session->userdata('id'))
					{
						?>
						<form method = "post" action = "/photos/delete_comment">
							<input type = 'hidden' name = 'id' value = '<?= $comment[
							"id"]?>' />
							<input type = "hidden" name = "photo_id" value = "<?=$photo_details['photo_id']?>" />
							<input class = "submit" type = "submit" value = "Delete Comment" />
						</form>
						<?php
					}
					}
				}
			
				?>
			</ul>
		</div>




	</div>

	

</body>
</html>
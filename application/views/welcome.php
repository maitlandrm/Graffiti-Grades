<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Sniglet:800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="access/css/style.css">
	<meta charset = "utf-8">
	<title>Welcome</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
		$(document).ready(function()
		{
			$(document).on('click', '.add_form', function()
			{
			
			
			// var form = '<?= form_open_multipart("/upload/do_upload");
			// ?>';

			// if(typeof appended === 'undefined'){
			// 	$(".form").append(form + '<input type = "file" name = "userfile" /><label>Caption: </label><textarea name = "caption" rows="3" cols = "70"></textarea><label>Grade: </label><select name = "grade"><option value = "1">F</option><option value = "2">D</option><option value = "3">C</option><option value = "4">B</option><option value = "5">A</option></select><input type = "submit" name = "upload" class = "submit" value = "Tag" /></form>');
			// 	$(".form").addClass("appended");
				// $(".add_form").toggle();
				// $(".hide_form").toggle();
			// }
			// else{
			// 	$(appended).append();
			// 	$(".form").addClass("appended");
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
</head>
<body>
	<div id = "wrapper">
		<div id = "header">
			<h1 class = "welcome">Graffiti Grades</h1>
			<div class = "buttons">
				<button class = "add_form">Add a Photo</button>
				<button class = "hide_form"> Hide Photo Form</button>
			</div>
			<form class = "logout" action ="/sessions/destroy" method = "post">
				<input class = "submit" type = "submit" value = "Log out" />
			</form>
			<h2 class = "welcome">Welcome <?= $this->session->userdata('alias') . "!" ?></h1>
		</div>
		<div class = "form">
				<?= form_open_multipart("/upload/do_upload");
			?>

				<input type = "file" name = "userfile" />
				<label>Caption: </label>
				<textarea name = "caption" rows="3" cols = "70"></textarea>
				<label>Grade: </label>
				<select name = "grade">
					<option value = "1">F</option>
					<option value = "2">D</option>
					<option value = "3">C</option>
					<option value = "4">B</option>
					<option value = "5">A</option>
				</select>
				<input type = "submit" name = "upload" class = "submit" value = "Tag" />
			</form>

		</div>
		<?php
		if(isset($photos))
		{
			foreach($photos as $photo)
			{
				
				?>
				<a href = "/photos/show/<?=$photo['photo_id']?>">
					<img class = "all_images" src = '/images/<?= $photo["full_path"]?>' alt = "Dud" />
				</a>
				<?php
			}
		}
		
		?>


		<?="<div class = 'red'>" . $this->session->flashdata('error') . "</div>";?>


		<a href = "#wrapper" class = "back">Back to top</a>
	</div>

</body>

</html>
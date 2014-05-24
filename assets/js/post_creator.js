camera = $("#camera");
spotify = $("#spotify");
text = $("#text");
friends = $("#freinds-button");

$(document).ready(function() {
	spotify.hide();
	text.hide();
	camera.show();

	$('#text-button').click(function() {
		spotify.hide();
		text.fadeIn(200);
		camera.hide();
		friends.hide();
		$(this).removeClass('gray-button');
		$('#spotify-button').addClass('gray-button');
		$('#camera-button').addClass('gray-button');
		$('#friends-button').addClass('gray-button');
	});
	$('#camera-button').click(function() {
		spotify.hide();
		text.hide();
		camera.fadeIn(200);
		friends.hide();
		$(this).removeClass('gray-button');
		$('#spotify-button').addClass('gray-button');
		$('#text-button').addClass('gray-button');
		$('#friends-button').addClass('gray-button');
	});
	$('#spotify-button').click(function() {
		spotify.fadeIn(200);
		text.hide();
		camera.hide();
		friends.hide();
		$(this).removeClass('gray-button');
		$('#camera-button').addClass('gray-button');
		$('#text-button').addClass('gray-button');
		$('#friends-button').addClass('gray-button');
	});	
	$('#friends-button').click(function() {
		spotify.hide();
		text.hide();
		camera.hide();
		friends.fadeIn(200);
		$(this).removeClass('gray-button');
		$('#spotify-button').addClass('gray-button');
		$('#camera-button').addClass('gray-button');
		$('#text-button').addClass('gray-button');
	});
});
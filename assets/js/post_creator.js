camera = $("#camera");
spotify = $("#spotify");
text = $("#text");

$(document).ready(function() {
	spotify.hide();
	text.hide();
	camera.show();

	$('#text-button').click(function() {
		spotify.hide();
		text.fadeIn(200);
		camera.hide();
	});
	$('#camera-button').click(function() {
		spotify.hide();
		text.hide();
		camera.fadeIn(200);
	});
	$('#spotify-button').click(function() {
		spotify.fadeIn(200);
		text.hide();
		camera.hide();
	});	
});
function parsespotify(query, theobject)
{
	// make sure our query is long enough
	if(query.length < 3)
	{
		return false;
	}
	query = query.replace(" ", "+");
	var spotifyAPI = 'http://ws.spotify.com/search/1/track.json?&q=' + query;

	$.getJSON(spotifyAPI)
		.done(function(data)
		{
			var searchresults = theobject.parent('.spotifysearch').children('.searchresults');
			searchresults.empty();
			if(data.info.num_results > 0)
			{
				var limit = Math.min(data.tracks.length,10);
				var counter = 0;

				// loop through the results
				for(var i = 0; counter < limit; i++)
				{
					//FIXME - hardcoded territory!
					if(data.tracks[i].album.availability.territories.indexOf("SE") == -1)
					{
						continue;
					}

					// save what we want in variables!
					// save string with artists
					var artists = '',
						name = data.tracks[i].name,
						uri = data.tracks[i].href,
						album = data.tracks[i].album.name;

					var track = data.tracks[i];

					// loop through the artists and add name to string
					for(var k = 0; k < track.artists.length; k++)
						artists += (k !== 0 ? ', ' : '' ) + track.artists[k].name;

					// create object and append to search results
					$('<a></a>').attr('href', '#').attr('data-uri', uri).html(name + " <span>" + artists +"</span>")
						.attr('data-artist', encodeURI(artists))
						.attr('data-name', encodeURI(name))
						.attr('data-album', encodeURI(album))
						.prependTo(searchresults);

					// take a step in the loop
					counter++;
				}

				console.log("Nr of results: " + data.info.num_results);
			}
			else
			{
				console.log("Nothing found for " + query);
			}

		}).done(function(){
			// get album art -- not working -- it is now :)
			/*theobject.parent('.spotifysearch').children('.searchresults').children('a').each(function() {
				var child = $(this);
				var uri = $(this).attr('data-uri');
				$.ajax({
					url: BASE_URL + "api/party/get_spotify_img_url",
					type: "POST",
					data: {uri: uri}}).done(function(json){
						child.prepend('<img src="' + json.result + '" alt="" width="20">');
					});
			});*/

		});

	// theobject.parent('.spotifysearch').children('.searchresults').show();
}

function addsong(theobject)
{
	var uri = theobject.attr('data-uri'),
		artist = decodeURI(theobject.attr('data-artist')),
		songname = decodeURI(theobject.attr('data-name')),
		album = decodeURI(theobject.attr('data-album')),
		searchresults = theobject.closest('.spotifysearch');

	// prepare post data
	var postdata = {
		'spotifyuri': uri,
		'partyid': searchresults.children('input.partyid').val(),
		'artist': artist,
		'songname': songname,
		'album': album
	};

	// send post request
	$.ajax({
		type: "POST",
		url: BASE_URL + 'api/party/add_song',
		data: postdata,
		dataType: 'json'
	})
	.fail(function(errordata){
		console.log(errordata.responseText);
	})
	.done(function(answer){
		if(answer.status === 'success')
		{
			console.log(answer);

			// fade out the object, and the remove it. uncluttered DOM <3.
			theobject.fadeOut(300, function(){
				theobject.addClass('success').text('Song added!').fadeIn().delay(1500).slideUp(300, function(){theobject.remove()});
			});
			if($('#partyqueue > div').length == 0)
			{
				$('#partyqueue').html(answer.html);
			}
			else
			{
				$('#partyqueue').append(answer.html);
			}

		}
		else
			console.log("Failed. Message: " + answer.response);
	});
}


$(document).ready(function(){
	$('.spotifysearch input').on('input', function(){
		parsespotify($(this).val(), $(this));
	});

	// listen to clicks on searchresults
	$(document).on('click', '.spotifysearch .searchresults a', function(event){
		event.preventDefault();
		addsong($(this));
	});

	// $(document).on('click', '.vote', function(event){
	// 	event.preventDefault();
	// 	var songid = $(this).attr('data-songid');
	// 	var postdata = {
	// 		songid: songid,
	// 	};

	// 	var link = $(this);

	// 	link.text('...');

	// 	$.ajax({
	// 		type: "POST",
	// 		url: BASE_URL + "api/party/add_vote",
	// 		data: postdata,
	// 		dataType: "JSON"
	// 	})
	// 	.fail(function(errordata){
	// 		console.log(errordata.responseText);
	// 	})
	// 	.done(function(answer){
	// 		console.log(answer);
	// 		link.text('OK!').fadeOut(1000);
	// 	});
	// });

});

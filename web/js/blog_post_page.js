$(document).ready(function () {
	$('#logged_stars_vote_button').on('click', function () {
		$('#current_stars_rating').addClass('hidden');
		$('#vote_stars_rating').removeClass('hidden');
		$(this).addClass('hidden');
		$('#cancel_logged_stars_vote_button').removeClass('hidden');
	});
	$('#cancel_logged_stars_vote_button').on('click', function () {
		$('#current_stars_rating').removeClass('hidden');
		$('#vote_stars_rating').addClass('hidden');
		$(this).addClass('hidden');
		$('#logged_stars_vote_button').removeClass('hidden');
	});
	$('i[id^=vote_back_star], i[id^=vote_front_star]').on('mouseover', function () {
		var voteRating = parseInt($(this).attr('id').slice(-1) || 0);
		if (voteRating > 0 && voteRating < 6) {
			var voteRatingPercentage = voteRating * 20;
			$('#vote_stars_rating div.front-stars').css('width', voteRatingPercentage+'%');
		}
	});
});
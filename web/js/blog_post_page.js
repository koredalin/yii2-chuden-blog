var voteRating = 1;
$(document).ready(function () {
	$('#logged_stars_vote').on('click', function () {
		$(this).hide();
		$('#vote_stars_rating').removeClass('hidden');
		$('#vote_stars_rating').addClass('inline-block');
	});
	$('i[id^=vote_back_star], i[id^=vote_front_star]').on('mouseover', function () {
		voteRating = parseInt($(this).attr('id').slice(-1) || 0);
		console.log(voteRating);
		if (voteRating > 0 && voteRating < 6) {
			var voteRatingPercentage = voteRating * 20;
			console.log(voteRatingPercentage);
			$('#vote_stars_rating div.front-stars').css('width', voteRatingPercentage+'%');
		}
	});
	$('i[id^=vote_front_star]').on('click', function () {
		voteRating = parseInt($(this).attr('id').slice(-1) || 0);
		console.log(voteRating);
		if (voteRating > 0 && voteRating < 6) {
			var voteRatingPercentage = voteRating * 20;
			console.log(voteRatingPercentage);
			$('#vote_stars_rating div.front-stars').css('width', voteRatingPercentage+'%');
		}
	});
});
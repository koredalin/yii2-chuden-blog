$(document).ready(function () {
	$('#blogpost-type').on('change', function () {
		var typeVal = ($(this).val() || '').trim();
		if (typeVal === '' || typeVal === 'content') {
			$('div#content_block').removeClass('hidden');
			$('div#podcast_url_block').addClass('hidden');
			$('div#podcast_url_block textarea').val(null);
		} else if (typeVal === 'audio' || typeVal === 'video') {
			$('div#podcast_url_block').removeClass('hidden');
			$('div#content_block').addClass('hidden');
			$('div#content_block textarea').val(null);
		}
	});
});
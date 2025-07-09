$(function() {

	// Change the behaviour of the notify button,
	// using id because we are using bootstrap classes and stuff
	$('.normal_button_strip_notify').next().find('a').click(function (e) {
		var $obj = $(this);
		// All of the sub buttons are now without the active class if they had it.
		$('.notify_dropdown_buttonlist .viewport .overview a').removeClass('active');
		// Toggle this new selection as active
		$obj.toggleClass('active');
		e.preventDefault();
		ajax_indicator(true);
		// New Text
		var new_text = $obj.find('em').text();
		var new_text_lCase = new_text.toLowerCase();
		$.get($obj.attr('href') + ';xml', function () {
			ajax_indicator(false);
			$('.normal_button_strip_notify > span').text(new_text);
			$('.normal_button_strip_notify i.fa').removeClass();
			$('.normal_button_strip_notify i').addClass('fa fa-' + new_text_lCase);
		});

		return false;
	});

	// Likes on quickbuttons
	$(document).on('click', 'ul.custom_quickbuttons li.post_like_button > a', function(event){
		var obj = $(this);
		event.preventDefault();
		ajax_indicator(true);
		$.ajax({
			type: 'GET',
			url: obj.attr('href') + ';js=1',
			headers: {
				"X-SMF-AJAX": 1
			},
			xhrFields: {
				withCredentials: typeof allow_xhjr_credentials !== "undefined" ? allow_xhjr_credentials : false
			},
			cache: false,
			dataType: 'html',
			success: function(html){
				obj.parent().replaceWith($(html).first('li'));
			},
			error: function (html){
			},
			complete: function (){
				ajax_indicator(false);
			}
		});

		return false;
	});
});
$(document).on('submit', '#fk-form', function(e) {
	e.preventDefault();

	var values = $(this).serializeArray();
	console.log(values.length);
	var foretagskalender1 = new Foretagskalender(values);
	foretagskalender1.ajaxsender('/foretagskalendern/public/php/makepdf.php');
	foretagskalender1.ajaxsender('/foretagskalendern/public/php/makeical.php');
});

$(document).on('blur', 'input, select', function() {
	var validate = new Validator();
	validate.checkIfEmpty(this);
});
$(document).on('change', '#momsperiod', function() {
	if (this.value == 3) {
		$('.hideToggle').fadeIn('fast');
	}else{
		$('.hideToggle').fadeOut('fast');
	}
});
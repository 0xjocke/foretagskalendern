$(document).on('submit', '#fk-form', function(e) {
	e.preventDefault();
	var validate1 = new Validator();
	if(validate1.checkIfEmptyForm(this)){
		$('#fk-emptyfield').fadeOut('fast');
		var values = $(this).serializeArray();
		console.log(values.length);
		var foretagskalender1 = new Foretagskalender(values);
		foretagskalender1.ajaxsender('/foretagskalendern/public/php/makepdf.php');
		foretagskalender1.ajaxsender('/foretagskalendern/public/php/makeical.php');
	}else{
		$('#fk-emptyfield').fadeIn('fast');
	}
});

$(document).on('blur', '.fk-required', function() {
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

$(document).on('change', '#fiscalYear', function() {
	var validate = new Validator();
	validate.checkIfLastDate(this);
});
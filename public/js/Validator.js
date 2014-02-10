function Validator(){
}

Validator.prototype.checkIfEmpty = function(input){
	if(!$(input).val().length) {
		$(input).css('border', '1px solid red');
	}else{
		$(input).css('border', '1px solid green');

	}
};

Validator.prototype.checkIfEmptyForm = function(form){
	var checker = false;
	$(form).find('.fk-required').each(function(){
		if (this.value === '') {
			checker = false;
			return false;
		}else{
			checker = true;
		}
	});
	return checker;
};
Validator.prototype.checkIfLastDate = function(input){
	var day = input.value.substring(8);
	var month = input.value.substring(5, 7);
	var checker = true;
	switch(month){
		case '01':
			if (day !== '31') {checker = false;}
		break;
		case '02':
			if (day !== '28') {checker = false;}
		break;
		case '03':
			if (day !== '31') {checker = false;}
		break;
		case '04':
			if (day !== '30') {checker = false;}
		break;
		case '05':
			if (day !== '31') {checker = false;}
		break;
		case '06':
			if (day !== '30') {checker = false;}
		break;
		case '07':
			if (day !== '31') {checker = false;}
		break;
		case '08':
			if (day !== '31') {checker = false;}
		break;
		case '09':
			if (day !== '30') {checker = false;}
		break;
		case '10':
			if (day !== '31') {checker = false;}
		break;
		case '11':
			if (day !== '30') {checker = false;}
		break;
		case '12':
			if (day !== '31') {checker = false;}
		break;
	}
	if (checker === false){
		$('#fk-wrongDate').fadeIn('fast');
		$(input).css('border', '1px solid red');
	}else{
		$('#fk-wrongDate').fadeOut('fast');
		$(input).css('border', '1px solid green');
	}
};

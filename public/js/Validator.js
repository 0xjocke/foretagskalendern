function Validator(){
}

Validator.prototype.checkIfEmpty = function(input){
	if (input.value === '') {
		var label = $("label[for='"+$(input).attr('id')+"']");
		console.log(label);
		// $('#' + value).after('Tomt');
	}
};
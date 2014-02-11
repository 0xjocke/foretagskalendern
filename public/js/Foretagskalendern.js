function Foretagskalender(values){
	this.name = values[0].value;
	this.pdfMonth = values[1].value;
	this.pdfSpecificMonth = values[2].value;
	this.pdfSpecificYear = values[3].value;
	this.momsperiod = values[4].value;
	this.paperMoms = values[5].value;
	this.eu = values[6].value;
	this.timeReport = values[7].value;
	this.fiscalYearEnd = values[8].value;
	this.paperDec = values[9].value;
	this.extra = values[10].value;
	this.extraDate = values[11].value;
}

Foretagskalender.prototype.ajaxsender = function(path){
	var pluginPath = fk_plugin_url.directory;
	$.ajax({
		url: pluginPath + path,
		type: 'POST',
		data: {'name': this.name, 'pdfMonth': this.pdfMonth, 'pdfSpecificMonth': this.pdfSpecificMonth, 'pdfSpecificYear': this.pdfSpecificYear,
		'momsperiod':this.momsperiod,'paperMoms' : this.paperMoms,
		'eu' : this.eu, 'fiscalYearEnd' : this.fiscalYearEnd, 'paperDec' : this.paperDec, 'timeReport': this.timeReport,
		'extra' : this.extra,'extraDate': this.extraDate}
	})
	.done(function(guid) {
		console.log("success");
		if (path === '/foretagskalendern/public/php/makepdf.php' ) {
			$('#fk-pdflink').fadeIn('fast').attr('href', pluginPath + '/foretagskalendern/public/php/makepdf.php?guid=' + guid);
		}else{
			$('#fk-icallink').fadeIn('fast').attr('href', pluginPath + '/foretagskalendern/public/views/ical.ics');
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
};
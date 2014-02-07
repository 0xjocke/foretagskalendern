(function ( $ ) {
	"use strict";

	$(function () {
		function Foretagskalender(values){
			this.name = values[0].value;
			this.momsperiod = values[1].value;
			this.paperMoms = values[2].value;
			this.eu = values[3].value;
			this.timeReport = values[4].value;
			this.fiscalYearEnd = values[5].value;
			this.paperDec = values[6].value;
			this.extra = values[7].value;
			this.extraDate = values[8].value;
		}
	
		Foretagskalender.prototype.ajaxsender = function(path){
			var pluginPath = fk_plugin_url.directory;
			$.ajax({
				url: pluginPath + path,
				type: 'POST',
				data: {'name': this.name, 'momsperiod':this.momsperiod,'paperMoms' : this.paperMoms,
				'eu' : this.eu, 'fiscalYearStart' : this.fiscalYearStart, 'paperDec' : this.paperDec, 'timeReport': this.timeReport,
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

		$(document).on('submit', '#fk-form', function(e) {
			e.preventDefault();
			var values = $(this).serializeArray();
			console.log(values.length);
			var foretagskalender1 = new Foretagskalender(values);
			foretagskalender1.ajaxsender('/foretagskalendern/public/php/makepdf.php');
			foretagskalender1.ajaxsender('/foretagskalendern/public/php/makeical.php');
		});
		$(document).on('blur', '#momsperiod', function() {
			if (this.value == 3) {
				$('.hideToggle').fadeIn('fast');
			}
		});
	});

}(jQuery));
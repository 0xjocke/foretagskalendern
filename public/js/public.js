(function ( $ ) {
	"use strict";

	$(function () {
		 function Foretagskalender(values){
			this.name = values[0].value;
			this.momsperiod = values[1].value;
			this.timeReport = values[2].value;
			this.financialStatement = values[3].value;
			this.extra = values[4].value;
			this.extraDate = values[5].value;
		
		}
	
		Foretagskalender.prototype.ajaxsender = function(){
			var pluginPath = fk_plugin_url.directory;
			$.ajax({
				url: pluginPath + '/foretagskalendern/public/php/makepdf.php',
				type: 'POST',
				data: {'name': this.name, 'momsperiod':this.momsperiod, 'financialStatement' : this.financialStatement, 'timeReport': this.timeReport, 'extra' : this.extra, 'extraDate': this.extraDate},
			})
			.done(function(guid) {
				console.log("success");
				$('#fk-downloadlink').css('display', 'block').attr('href', pluginPath + '/foretagskalendern/public/php/makepdf.php?guid=' + guid);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});	
		}

		$(document).on('submit', '#fk-form', function(e) {
			e.preventDefault();
			var values = $(this).serializeArray();
 			var foretagskalender1 = new Foretagskalender(values);
			foretagskalender1.ajaxsender();

		});
	});

}(jQuery));
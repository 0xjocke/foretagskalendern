(function ( $ ) {
	"use strict";

	$(function () {
		 function Foretagskalender(values){
			this.name = values[0].value;
			this.momsperiod = values[1].value;
			this.timeReport = values[2].value;
		
		}
	
		Foretagskalender.prototype.ajaxsender = function(){
			var pluginPath = fk_plugin_url.directory;
			$.ajax({
				url: pluginPath + '/foretagskalendern/public/php/makepdf.php',
				type: 'POST',
				data: {'name': this.name, 'momsperiod':this.momsperiod, 'timeReport': this.timeReport},
			})
			.done(function() {
				console.log("success");
				$('#fk-downloadlink').css('display', 'block');
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
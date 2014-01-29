(function ( $ ) {
	"use strict";

	$(function () {
		var Foretagskalender = function(values){
			var name = "";
			var momsperiod = "";
			var timeReport = "";
			this.construct = function(values){
				if (values == null) {
					return;
				}else{
					this.name = values[0];
					this.momsperiod = values[1];
					this.timeReport = values[2];
				}
			}
			this.ajaxsender = function(){
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

			this.construct(values);
		}

		$('#fk-form').submit(function(e){ e.preventDefault(); });
	
		$(document).on('click', '#fk-btn', function() {
			var values = $('#fk-form').serializeArray();
			var foretagskalender1 = new Foretagskalender(values);
			foretagskalender1.ajaxsender();

        
		});
	});

}(jQuery));
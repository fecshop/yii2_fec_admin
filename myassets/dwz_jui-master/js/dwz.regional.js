/**
 * @author ZhangHuihua@msn.com
 */
(function($){
	// jQuery validate
	if ($.validator) {
		$.extend($.validator.messages, {
			required: "Required field",
			remote: "Please fix this field",
			email: "Please enter the correct format email",
			url: "Please enter the correct URL",
			date: "Please enter the correct date",
			dateISO: "Please enter the correct date (ISO).",
			number: "Please enter the correct number",
			digits: "Can only enter integers",
			creditcard: "Please enter the correct credit card number",
			equalTo: "Please enter the same value again",
			accept: "Please enter a string with the correct suffix",
			maxlength: $.validator.format("a string of up to {0} in length"),
			minlength: $.validator.format("a string with a minimum length of {0}"),
			rangelength: $.validator.format("a string between {0} and {1}"),
			range: $.validator.format("Please enter a value between {0} and {1}"),
			max: $.validator.format("Please enter a value of up to {0}"),
			min: $.validator.format("Please enter a value with a minimum of {0}"),

			alphanumeric: "Letters, numbers, underscores",
			lettersonly: "Must be a letter",
			phone: "Numbers, spaces, parentheses"
		});
	}
	
	// DWZ regional
	$.setRegional("datepicker", {
		dayNames: ['seven', 'one', 'two', 'three', 'four', 'five', 'six'],
		monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
	});
	$.setRegional("alertMsg", {
		title:{error:"Error", info:"Prompt", warn:"Warning", correct:"Success", confirm:"Confirm Prompt"},
		butMsg:{ok:"Ok", yes:"Yes", no:"No", cancel:"Cancel"}
	});
})(jQuery);
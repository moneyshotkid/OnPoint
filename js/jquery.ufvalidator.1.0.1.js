/*
 * 
 * Utopic Farm 2009
 * @author Tolga Arican
 * @website www.utopicfarm.com
 * @version 1.0.1
 
CSS Class Attributes
class="input req-both"
    * .req-string: Field requires string (Use to force other css classes to be required on submit)
    * .req-email: Field requires email
    * .req-min: Field requires minimum X characters (Add minlength parameter to input field)
    * .req-numeric: Field validates numeric
    * .req-date: Field validates date (dd.mm.yyyy)
    * .req-both: Checks all group fields has some value if one of them filled (group by "rel" attribute)
    * .req-same: Checks all group fields has same value if one of them filled (group by "rel" attribute)


 
 * 
 */


// FORM VALIDATOR JQUERY PLUGIN - START

(function($) {
	
	$.fn.formValidator = function(options) {
		$(this).click(function() { 
		
			var result = $.formValidator(options);
		
			if (result && jQuery.isFunction(options.onSuccess)) {
				options.onSuccess();
				return false;
			} else {
				return result; 
			}
		});
	};
	
	$.formValidator = function (options) {
		
		// merge options with defaults
		var merged_options = $.extend({}, $.formValidator.defaults, options);
		var drawer = $("#drawer");
		// result boolean
		var boolValid = true;
		
		// result error message
		var errorMsg = '';
		
		// clean errors
		$(merged_options.scope + ' .error-both, ' + merged_options.scope + ' .error-same, ' + merged_options.scope + ' .error-input').removeClass('error-both').removeClass('error-same').removeClass('error-input');
		
		// gather inputs & check is valid
		$(merged_options.scope+' .req-email, '+merged_options.scope+' .req-string, '+merged_options.scope+' .req-same, '+merged_options.scope+' .req-both, '+merged_options.scope+' .req-numeric, '+merged_options.scope+' .req-date, '+merged_options.scope+' .req-min').each(function() {
			thisValid = $.formValidator.validate($(this),merged_options);
			boolValid = boolValid && thisValid.error;
			if (!thisValid.error) errorMsg  = thisValid.message;
		});
		
		// submit form if there is and valid
		if ((merged_options.scope != '') && boolValid) {
			$(merged_options.errorDiv).fadeOut();
		}
		
		// if there is errorMsg print it if it is not valid
		if (!boolValid && errorMsg != '') {
			
			var tempErr = (merged_options.customErrMsg != '') ? merged_options.customErrMsg : errorMsg;
			$(merged_options.errorDiv).hide().html(tempErr).fadeIn();
			drawer.slideDown(function()  {
				drawer.html(tempErr);
				drawer.css('backgroundColor','#229');
				setTimeout(function() { drawer.css('backgroundColor', '#fff'); }, 1000);
			});
		}
		
		return boolValid;
	};
	
	$.formValidator.validate = function(obj,opts) {

		var valAttr = obj.val();
		var css = opts.errorClass;
		var mail_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var numeric_filter = /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)|(^-?\d*$)/;
		var tmpresult = true;
		var result = true;
		var errorTxt = '';
		
		// REQUIRED FIELD VALIDATION
		if (obj.hasClass('req-string')) {
			tmpresult = (valAttr != '');
			if (!tmpresult) errorTxt = opts.errorMsg.reqString;
			result = result && tmpresult;
		}
		// SAME FIELD VALIDATION
		if (obj.hasClass('req-same')) {
			
			tmpresult = true;
			
			group = obj.attr('rel');
			tmpresult = true;
			$(opts.scope+' .req-same[rel="'+group+'"]').each(function() { 
				if($(this).val() != valAttr || valAttr == '') {
					tmpresult = false;
				}
			});
			if (!tmpresult) {
				$(opts.scope+' .req-same[rel="'+group+'"]').parent().parent().addClass('error-same');
				errorTxt = opts.errorMsg.reqSame;
			} else {
				$(opts.scope+' .req-same[rel="'+group+'"]').parent().parent().removeClass('error-same');
			}
			
			result = result && tmpresult;
		}
		// BOTH INPUT CHECKING
		// if one field entered, the others should too.
		if (obj.hasClass('req-both')) {
			
			tmpresult = true;
			
			if (valAttr != '') {
				
				group = obj.attr('rel');

				$(opts.scope+' .req-both[rel="'+group+'"]').each(function() { 
					if($(this).val() == '') {
						tmpresult = false;
					}
				});
				
				if (!tmpresult) {
					$(opts.scope+' .req-both[rel="'+group+'"]').parent().parent().addClass('error-both');
					errorTxt = opts.errorMsg.reqBoth;
				} else {
					$(opts.scope+' .req-both[rel="'+group+'"]').parent().parent().removeClass('error-both');
				}
			}
			
			result = result && tmpresult;
		}
		// E-MAIL VALIDATION
		if (obj.hasClass('req-email')) {
			tmpresult = mail_filter.test(valAttr);
			if (!tmpresult) errorTxt = (valAttr == '') ? opts.errorMsg.reqMailEmpty : opts.errorMsg.reqMailNotValid;
			result = result && tmpresult;
		}
		// DATE VALIDATION
		if (obj.hasClass('req-date')) {
			
			tmpresult = true;
			
			var arr = valAttr.split(opts.dateSeperator);
			var curDate = new Date();
			
			if (valAttr == '') {
				
				tmpresult = true;
			} else {
				
				if (arr.length < 3) {
					tmpresult = false;
				} else {
					tmpresult = (arr[0] <= 12) && (arr[1] <= 31) && (arr[2] <= curDate.getFullYear());
				}
			}
			
			if (!tmpresult) errorTxt = opts.errorMsg.reqDate;
			result = result && tmpresult;
		}
		// MINIMUM REQUIRED FIELD VALIDATION
		if (obj.hasClass('req-min')) {
			tmpresult = (valAttr.length >= obj.attr('minlength'));
			if (!tmpresult) errorTxt = opts.errorMsg.reqMin.replace('%1',obj.attr('minlength'));
			result = result && tmpresult;
		}
		// NUMERIC FIELD VALIDATION
		if (obj.hasClass('req-numeric')) {
			tmpresult = numeric_filter.test(valAttr);
			if (!tmpresult) errorTxt = opts.errorMsg.reqNum;
			result = result && tmpresult;
		}
				
		if (result) {
			obj.removeClass(css);
		} else {
			obj.addClass(css);
		}
		
		return {
			error: result,
			message: errorTxt
		};
	};
	
	// CUSTOMIZE HERE or overwrite by sending option parameter
	$.formValidator.defaults = {
		onSuccess		: null,
		scope		:	'',
		errorClass		:	'error-input',
		errorDiv		:	'',
		errorMsg		: 	{
								reqString		:	'Please fill the required fields',
								reqDate			:	'Sorry Date is <b>not</b> valid',
								reqNum			:	'Only numbers allowed',
								reqMailNotValid	:	'Opps your E-Mail is <b>not</b> valid',
								reqMailEmpty	:	'Please fill e-mail',
								reqSame			:	'Repeating inputs are not same',
								reqBoth			:	'Related field(s) required',
								reqMin			:	'Minimum %1 characters required'
							},
		customErrMsg	:	'',
		dateSeperator	:	'.'
	};
})(jQuery);

// FORM VALIDATOR JQUERY PLUGIN - END

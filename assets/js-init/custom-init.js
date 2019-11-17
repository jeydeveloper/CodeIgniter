var MYAPP = MYAPP || {};

MYAPP.nameSpace = function (ns_string) {
	var parts = ns_string.split('.'),
		parent = MYAPP,
		i;
	if (parts[0] === "MYAPP") {
		parts = parts.slice(1);
	}
	for (i = 0; i < parts.length; i += 1) {
		if (typeof parent[parts[i]] === "undefined") {
			parent[parts[i]] = {};
		}
		parent = parent[parts[i]];
	}
	return parent;
};

MYAPP.timeOut = (function(){
	var timeOuts = new Array();
	var getTimo = function() {
		return timeOuts;
	};
	var setTimo = function(val) {
		timeOuts.push(val);
	};
	var clearTimo = function() {
		for( key in getTimo() ){  
			clearInterval(timeOuts[key]);
		}
	};
	return {
		setTimo: setTimo,
		clearTimo: clearTimo
	};
}());

MYAPP.doAjax = (function() {
    var process = function(){};
	process = function(url, param, callback, dataType, el, method = 'POST') {
        dataType = dataType || 'json';
        callback = callback || function(){};
		var me = el || '';
		jQuery.ajax({
			url         : url,
			data        : param,
			type        : method,
			dataType    : dataType,
			success     : callback,
			error       : function(xhr, status) {
				alert('Sorry, there was a problem!');
			}
		});
    }
	return {
		process: process
	};
}());

MYAPP.doAjaxUpload = (function() {
    var process = function(){};
	process = function(url, param, callback, dataType, el) {
        dataType = dataType || 'json';
        callback = callback || function(){};
		var me = el || '';
		jQuery.ajax({
			url         : url,
			data        : param,
			type        : 'POST',
			dataType    : dataType,
			success     : callback,
			processData	: false,
        	contentType	: false,
			error       : function(xhr, status) {
				alert('Sorry, there was a problem!');
			}
		});
    }
	return {
		process: process
	};
}());

MYAPP.doFormSubmit = (function() {
    var process = function(){};
	process = function(listparam) {
        var btn_submit 	= $(listparam.btn_submit);
		var div_errmsg 	= $(listparam.div_errmsg);
		btn_submit.attr('disabled', true);
		div_errmsg.hide();
  		var url         = listparam.url_ajax_action,
			dataType    = listparam.data_type,
			method    	= listparam.method || 'POST',
			param       = $(listparam.formid).serialize(),
			callback    = listparam.callback;
		if(enbl_btn_process == true) {
			MYAPP.doAjax.process(url, param, callback, dataType, '', method);
			enbl_btn_process = false;
		}
    }
	return {
		process: process
	};
}());

MYAPP.doFormSubmitUploadTmp = (function() {
    var process = function(){};
	process = function(listparam, files) {
        var btn_submit 	= $(listparam.btn_submit);
		var div_errmsg 	= $(listparam.div_errmsg);
		btn_submit.attr('disabled', true);
		div_errmsg.hide();
		var data = new FormData();
		if(typeof files != 'undefined') {
			$.each(files, function(key, value)
			{
				data.append(key, value);
			});	
		}
  		var url         = listparam.url_ajax_action,
			dataType    = listparam.data_type,
			param       = data,
			callback    = listparam.callback;
		
		if(enbl_btn_process == true) {
			MYAPP.doAjaxUpload.process(url, param, callback, dataType);
		}
    }
	return {
		process: process
	};
}());

MYAPP.doFormSubmitUpload = (function() {
    var process = function(){};
	process = function(listparam, data) {
        var btn_submit 	= $(listparam.btn_submit);
		var div_errmsg 	= $(listparam.div_errmsg);
		btn_submit.attr('disabled', true);
		div_errmsg.hide();
  		var url         = listparam.url_ajax_action,
			dataType    = listparam.data_type,
			method    	= listparam.method || 'POST',
			param       = $(listparam.formid).serialize(),
			callback    = listparam.callback;

		$.each(data.files, function(key, value)
		{
			param = param + '&filenames[]=' + value;
		});
		if(enbl_btn_process == true) {
			MYAPP.doAjax.process(url, param, callback, dataType, '', method);
			enbl_btn_process = false;
		}
    }
	return {
		process: process
	};
}());

$(function() { "use strict";
	$('#logout_link').click(function() {
		var cfm = confirm('Logout?');
		if(!cfm) return false;
	});
});
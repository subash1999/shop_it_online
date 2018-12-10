if(dpUI===undefined)var dpUI={data:{},helper:{},options:{},versions:{}};
dpUI.helper.data2obj=function(e){if(e===undefined)return false;var t={};for(var n=0;n<e.attributes.length;n++){if((e.attributes[n].nodeName+"").indexOf("data-")>-1){var r=(e.attributes[n].nodeName+"").substring(5);var i=e.attributes[n].value;if(i.toLowerCase()=="true")i=true;else if(i.toLowerCase()=="false")i=false;else if(parseFloat(i)+""==i)i=parseFloat(i);t[r]=i}}return t};
dpUI.helper.formatter=function(n, format){
	if(!format||format.length==0)return n+"";
	var w = Math.floor(n);
	var d = n-w;
	var b = format.indexOf(".");
	var a = ((format.length-b)-1);
	w=w+"";
	while(w.length<b)w="0"+w;
	d=Math.round( d*Math.pow(10,a) )+"";
	while(d.length<a)d+="0";
	return w+"."+d;
};
dpUI.helper.betterParseFloat = function(s){
	if(isNaN(parseFloat(s))){
		if(s.length<2)return parseFloat(s);
		return dpUI.helper.betterParseFloat(s.substring(1));
	} else return parseFloat(s);
};
dpUI.versions.numberPicker = "2.0.0";
dpUI.numberPicker = function(selector, options){
	var defaults = {
		start: 0,
		min: false,
		max: false,
		step: 1,
		format: false,
		formatter: function(x){return x;},
		increaseText: "+",
		decreaseText: "-",
		
		onReady: function(){},
		onMin: function(){},
		onMax: function(){},
		beforeIncrease: function(){},
		beforeDecrease: function(){},
		beforeChange: function(){},
		afterIncrease: function(){},
		afterDecrease: function(){},
		afterChange: function(){}
	};
	$(selector).each(function(){
		var el = this;
		var np = $(el);
		el.options = $.extend(defaults, options);
		el.options = $.extend(el.options, dpUI.helper.data2obj(el));
		el.number = dpUI.helper.betterParseFloat(el.options.start);
		np.addClass("dpui-numberPicker").html("<button type='button' class='dpui-numberPicker-decrease'>"+el.options.decreaseText+"</button><input type='text' class='dpui-numberPicker-input' /><button type='button' class='dpui-numberPicker-increase'>"+el.options.increaseText+"</button>");
		var input = np.find(".dpui-numberPicker-input");
		input.val(el.options.formatter(dpUI.helper.formatter(el.number, el.options.format)));
		if(el.options.min!==false&&el.options.start==el.options.min)np.addClass("dpui-numberPicker-min");
		if(el.options.max!==false&&el.options.start==el.options.max)np.addClass("dpui-numberPicker-max");
		
		function set(num){
			num = dpUI.helper.betterParseFloat(num);
			if(isNaN(num)) num = el.number;
			np.removeClass("dpui-numberPicker-min").removeClass("dpui-numberPicker-max");
			el.options.beforeChange.call(el,el,el.number);
			if(el.options.min!==false&&num<=el.options.min){
				np.addClass("dpui-numberPicker-min");
				el.number = el.options.min;
			} else if(el.options.max!==false&&num>=el.options.max){
				np.addClass("dpui-numberPicker-max");
				el.number = el.options.max;
			} else {
				el.number = num;
			}
			input.val(el.options.formatter(dpUI.helper.formatter(el.number, el.options.format)));
			el.options.afterChange.call(el,el,el.number);
		};
		el.set = function(number){
			set(number);
		};
		el.increase = function(){
			el.options.beforeIncrease.call(el,el,el.number);
			set(el.number+el.options.step);
			el.options.afterIncrease.call(el,el,el.number);
		};
		el.decrease = function(){
			el.options.beforeDecrease.call(el,el,el.number);
			set(el.number-el.options.step);
			el.options.afterDecrease.call(el,el,el.number);
		};
		np.find(".dpui-numberPicker-decrease").on("click", el.decrease);
		np.find(".dpui-numberPicker-increase").on("click", el.increase);
		input.on("change", function(){
			el.set(input.val());
		});
	});
};
(function($){
	$.fn.dpNumberPicker = function(options){
		if(typeof(options)=="string"){
			if(options.toLowerCase()=="increase")this.each(function(){this.increase();});
			else if(options.toLowerCase()=="decrease")this.each(function(){this.decrease();});
			else if(options.toLowerCase()=="set"&&arguments.length>1){
				var n = arguments[1];
				this.each(function(){this.set(n)});
			}
		} else dpUI.numberPicker(this.selector, options);
	};
}(jQuery));
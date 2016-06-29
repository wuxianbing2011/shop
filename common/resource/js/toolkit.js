var isPlainObject = function(obj){
	if(!obj.hasOwnProperty('constructor') && typeof obj == 'object' && obj.constructor == Object){
		return true;
	}
	
	return false;
}
var mix = function(base, child, deep){
    var o = new Object();
    for(var key in base){
        o[key] = base[key];
    }
    for(var key in child){
		if(deep && isPlainObject(o[key])){
			o[key] = mix(o[key], child[key]);
		}else{
			o[key] = child[key];
		}
    }
    return o;
};

var extend = function(subClass, baseClass){
	var parent = subClass.parent = {
		/**
		 * parent construct
		 * @param obj currentObject
		 * @param args
		 */
		'__construct': function(obj, args){
			baseClass.apply(obj, args);
		}
	};

	for(var method in baseClass.prototype){
		parent[method] = baseClass.prototype[method];
		if(! (method in subClass.prototype)){
			subClass.prototype[method] = baseClass.prototype[method];
		}

	}
};

var trim = function(str, spliter){
	var regexp;
	if(!spliter){
		regexp = /^(\s|\u00A0)+|(\s|\u00A0)+$/g;
	}else{
		regexp = new RegExp("^(" + spliter + ")+|(" + spliter + ")+$", "g");
	}
	
	return str.replace(regexp, '');
};


var dashToUnderScore = function(str){
	return str.replace(/-/g, '_');
};

var dashToCamel = function(str){
	return str.replace(/-([a-z])/, function(matches){
		return matches[1].toUpperCase();
	});
}

var camel2Dash = function(str){
	return str.replace(/.+([A-Z])/, function(matches){
		return "-" + matches[1].toLowerCase();
	});
};
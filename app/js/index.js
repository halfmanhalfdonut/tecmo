/* Global wambo namespace */
if (typeof wambo == "undefined" || !wambo) {
	var wambo = {};
}
wambo.dev = (window.location.hostname.indexOf("localhost") >= 0 || window.location.hostname.indexOf("local.geared.us") > 0);
wambo.live = !wambo.dev;
wambo.debug = wambo.dev && window && typeof window.console !== "undefined";
wambo.namespace = function (nodes,root) {
	root = root == null ? wambo : root;
	var a = nodes, o = null, i, j, d;
	d = nodes.split(".");
	o = root;
	for(j = (d[0] == root) ? 1 : 0; j < d.length; j++){
		o[d[j]] = o[d[j]] || {};
		o = o[d[j]];
	}
	return o;
};
wambo.namespace("utils",wambo);
wambo.utils.trim = function(str){
	return str == null ? "" : str.replace(/^\s+|\s+$/g,"");
};

wambo.utils.log = function() {
	if(!wambo.debug) { return; }
	if(window.console && typeof window.console.debug !== "undefined") {
		window.console.debug.apply(window.console,arguments);
	} else {
		if(window.console && typeof window.console.log !== "undefined") {
			if(window.console.log.apply === "function") {
				window.console.log.apply(window.console,arguments);
			} else {
				window.console.log(arguments[0]);
			}
		}
	}
};

//validate email function
wambo.utils.isValidEmail = function(email) {
	return /^[^@]+@[^.]+(\.[^.]+)+$/.test(email);
};
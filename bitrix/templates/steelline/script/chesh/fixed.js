(function(global) {
	function Fixed(el, start, finish, options) {
		"use strict";

		var self = Object.create(Fixed.prototype);

		var scroll = 0;

		var loop = window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.msRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      function(callback){ setTimeout(callback, 1000 / 60); };

		var el = document.querySelector(el);
		var start = document.querySelector(start);
		var finish = document.querySelector(finish);

		self.options = {
			offsetTop: 0,
			offsetBot: 0
		};

		if (options) {
			Object.keys(options).forEach(function(key){
        self.options[key] = options[key];
      });
		};

		function getCoords(elem) { // кроме IE8-
		  var box = elem.getBoundingClientRect();

		  return {
		    top: box.top + window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop,
		    left: box.left + window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft
		  };

		};

		var coordStart  = getCoords(start).top;
		var coordFinish = getCoords(finish).top + finish.offsetHeight;

		function update() {
			if (scroll !== (window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop)) {
				scroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

				if (scroll + self.options.offsetTop >= coordStart && scroll + self.options.offsetTop + self.options.offsetBot + el.offsetHeight <= coordFinish) {
					el.style.position = 'fixed';
					el.style.top = self.options.offsetTop + 'px';
				}
				else if (scroll + self.options.offsetTop + self.options.offsetBot + el.offsetHeight >= coordFinish) {
					el.style.top = coordFinish - coordStart - el.offsetHeight + 'px';
					el.style.position = 'relative';
				} else start.style.position = 'static';

				// console.log(coordStart, scroll);
			}

			loop(update);
		};

		function init() {
			update();
		};

		init();
	}

	global.Fixed = Fixed;

})(window.app || (window.app = {}))
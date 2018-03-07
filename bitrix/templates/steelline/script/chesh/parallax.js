(function(global) {
	function Parallax(wind, options) {
		var self = Object.create(Parallax.prototype);

		self.options = {
			procentScreenStart: 60
		};

		if (options) {
			Object.keys(options).forEach(function(key){
        self.options[key] = options[key];
      });
		};

		var windowParallax = document.querySelector(wind);
		var itemsParallax = windowParallax.querySelectorAll('.parallax-item');

		var windowHeight = windowParallax.offsetHeight;
		var itemsHeight = [];
		var itemsFinish = [];
		var itemsSpeed = [];

		for (var i = 0; i < itemsParallax.length; i++) {
			itemsHeight.push(itemsParallax[i].offsetHeight);
			itemsFinish.push(itemsHeight[i] - windowHeight);
			itemsSpeed.push(+itemsParallax[i].getAttribute('data-speed'));
		}

		function getCoords(elem) {
		  var box = elem.getBoundingClientRect();

		  return {
		    top: box.top,
		    left: box.left
		  };

		};

		function parallax(offset) {
			Array.prototype.forEach.call(itemsParallax, function(item, i) {
				// item.style.transition = 'all .1s';
			
				if (offset <= 0)	item.style.transform = 'translate3d(0, 0, 0)';
				else if (offset * itemsSpeed[i] < itemsFinish[i] - 80)item.style.transform = 'translate3d(0, -' + Math.round(offset * itemsSpeed[i]) + 'px, 0)';
				else if (offset * itemsSpeed[i] >= itemsFinish[i] - 80) item.style.transform = 'translate3d(0, -' + Math.round(itemsFinish[i] - 80) + 'px, 0)';
			})
		};

		function init() {
			window.addEventListener('scroll', function(e) {
				var offset = (window.innerHeight / 100) * self.options.procentScreenStart - getCoords(windowParallax).top;

				parallax(offset);
			})

			window.addEventListener('load', function() {
				var offset = (window.innerHeight / 100) * self.options.procentScreenStart - getCoords(windowParallax).top;

				parallax(offset);
			})

			// console.log('dsadsa');
		};

		init();
	}

	global.Parallax = Parallax;

})(window.app || (window.app = {}))
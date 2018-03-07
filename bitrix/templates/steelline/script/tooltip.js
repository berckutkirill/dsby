(function() {
	var tooltipWraps  = document.querySelectorAll('[data-tooltip]'),
						parent  = document.querySelector('table'),
						tooltip;

	function createTooltip(massage) {
		var tooltip = document.createElement('div');

		tooltip.classList.add('tooltip');
		tooltip.innerHTML = massage;

		return tooltip;
	}

	function getOffsetSum(elem) {
	  var top  = 0,
	    	left = 0;
	   
	  while (elem.tagName !== 'TABLE') {
	    top  = top + parseInt(elem.offsetTop);
	    left = left + parseInt(elem.offsetLeft);
	    elem = elem.offsetParent;
	  }

	  return {
	    top:  top,
	    left: left
	  };
	}

	function init() {
		Array.prototype.forEach.call(tooltipWraps, function(item, i ,arr) {
			item.addEventListener('mouseenter', function() {
				tooltip = createTooltip(this.getAttribute('data-tooltip'));

				tooltip.style.top = getOffsetSum(this).top - 9 + 'px';
				parent.appendChild(tooltip);
			});

			item.addEventListener('mouseleave', function() {
				parent.removeChild(tooltip);
			})
		})
	};

	init();
})()
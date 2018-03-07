(function(global) {

	function Accordion(options) {
		this.options = options;

		this.items = this.options.accord.querySelectorAll(options.itemsSel)
		this.index = null;

		this.init()
	}

	Accordion.prototype.init = function() {
		Array.prototype.forEach.call(this.items, function(item) {
			var trigger = item.querySelector(this.options.triggerSel);
			
			trigger.addEventListener('click', function(e) {
				this.action($(e.target).closest(this.options.itemsSel)[0]);
			}.bind(this))

		}.bind(this));
	}

	Accordion.prototype.action = function(item) {
		if (item.classList.contains('active')) {
			item.classList.remove('active');
			this.index = null;
			return;
		}

		if (this.index === null) {
			item.classList.add('active');
			this.index = Array.prototype.indexOf.call(this.items, item);
			return;
		}

		

		this.items[this.index].classList.remove('active');
		this.index = Array.prototype.indexOf.call(this.items, item);
		this.items[this.index].classList.add('active');

	}

	global.Accordion = Accordion;

})(window.app || (window.app = {}))
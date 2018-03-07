(function(global) {

	var Flip = function(options) {
		this.options = options;

		this.init();
	}

	Flip.prototype.init = function() {
		this.options.trigger.addEventListener('click', this.click.bind(this));
	}

	Flip.prototype.click = function() {
		this.options.flip.classList.toggle(this.options.activeFlipClass);
		this.options.trigger.classList.toggle(this.options.activeTriggerClass);

		for (var i = 0; i < this.options.desc.length; i++) {
			this.options.desc[i].classList.toggle(this.options.activeFlipTitleClass);
		}
	}

	global.Flip = Flip;

})(window)
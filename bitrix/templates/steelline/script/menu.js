(function(global) {

	var Menu = function(options) {
		this.options = options;
		this.body = document.body;

		this.init()
	} 


	Menu.prototype.init = function() {
		this.options.activeBut.addEventListener('click', this.open.bind(this));
	}

	Menu.prototype.listener = function(e) {
		var escBut,
				xBut,
				clickBody;

		escBut = function(e) {
			if (e.keyCode === 27) {
				this.close();
				this.body.removeEventListener('keydown', escBut);

				xBut();
			}
		}.bind(this);

		xBut = function() {
			this.close();
			this.options.closeBut.removeEventListener('click', xBut);

			this.body.removeEventListener('keydown', escBut);
			this.body.removeEventListener('click', clickBody);
		}.bind(this);

		clickBody = function(e) {
			if (e.target.tagName === 'BODY') {
				this.close();
				this.body.removeEventListener('click', clickBody);

				xBut();
			}
		}.bind(this);

		this.body.addEventListener('click', clickBody);
		this.body.addEventListener('keydown', escBut);
		this.options.closeBut.addEventListener('click', xBut);
	}

	Menu.prototype.open = function() {
		this.options.menu.classList.add('open');
		this.body.classList.add('open');

		this.listener();
	}

	Menu.prototype.close = function() {
		this.options.menu.classList.remove('open');
		this.body.classList.remove('open');
	}

	global.Menu = Menu;

})(window);
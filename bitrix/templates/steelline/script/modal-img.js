(function(global) {

	var ModalImg = function(options) {
		this.options = options;
		this.body = document.body;

		this.init();
	}

	ModalImg.prototype = Object.create(Menu.prototype);
	ModalImg.prototype.constructor = ModalImg;

	ModalImg.prototype.init = function() {
		Array.prototype.forEach.call(this.options.activeBut, function(item) {
			item.addEventListener('click', this.open.bind(this));
		}.bind(this))
	}

	ModalImg.prototype.cloneImg = function(item) {
		var clone;

		if (item.tagName === img)	clone = item.cloneNode(false);
		else clone = item.querySelector('img').cloneNode(false);

		var img = this.options.imgPopup.querySelector('img');
		if (img) this.options.imgPopup.removeChild(img);

		this.options.imgPopup.appendChild(clone);
	}

	ModalImg.prototype.open = function(e) {
		this.options.imgPopup.classList.add('open');
		this.body.classList.add('open');

		this.listener();
		this.cloneImg(e.currentTarget);
	}

	ModalImg.prototype.close = function() {
		this.options.imgPopup.classList.remove('open');
		this.body.classList.remove('open');
	}

	global.ModalImg = ModalImg;

})(window)
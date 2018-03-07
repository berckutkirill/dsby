(function(global) {

	var Gallery = function(options) {
		this.options = options;

		this.active  = this.options.start;
		this.index   = this.options.start;
		this.trigger = false;

		this.init();
	}

	Gallery.prototype.init = function() {
		if (this.options.previews.length === 1) return;

		this.options.next.style.display = 'none';
		this.options.prev.style.display = 'none';

		for (var i = 0; i < this.options.previews.length; i++) {
			this.options.previews[i].addEventListener('click', this.clickPreview.bind(this), true);
		}

		if (this.options.next && this.options.prev) {
			this.options.next.addEventListener('click', this.clickNext.bind(this));
			this.options.prev.addEventListener('click', this.clickPrev.bind(this));
		}

		document.addEventListener('keydown', this.downKey.bind(this));
		document.addEventListener('keyup', this.upKey.bind(this));
	}

	Gallery.prototype.getPosition = function() {
		var coords        = this.options.wrap.getBoundingClientRect(),
				heightVieport = document.documentElement.clientHeight;

		if (coords.top > heightVieport && coords.bottom > heightVieport || coords.top < 0 && coords.bottom < 0) return false;

		return true;
	}

	Gallery.prototype.downKey = function(e) {
		if (e.keyCode !== this.options.keyCodeNext && e.keyCode !== this.options.keyCodePrev || !this.getPosition() || this.trigger) return;

		if (e.keyCode === this.options.keyCodeNext) {
			this.clickNext();
		}	else if (e.keyCode === this.options.keyCodePrev) {
			this.clickPrev();
		}

		this.trigger = true;
	}

	Gallery.prototype.upKey = function(e) {
		if (e.keyCode === this.options.keyCodeNext || e.keyCode === this.options.keyCodePrev) this.trigger = false;
	}

	Gallery.prototype.clickPreview = function(e) {
		this.index = Array.prototype.indexOf.call(this.options.previews, e.currentTarget);

		if (this.active === this.index) return;

		this.changeActivePreview();
		this.changeView();

		if (this.options.title)	this.changeTitle();
		if (this.options.price) this.changePrice();
		if (this.options.priceOld && this.options.priceNew) this.changePriceAction();

		if (this.options.link) this.changeLink();

	}

	Gallery.prototype.clickNext = function() {
		var index = this.index + 1;

		if (index < this.options.previews.length) this.options.previews[index].click();
		else this.options.previews[0].click();

	}

	Gallery.prototype.clickPrev = function() {
		var index = this.index - 1;

		if (index < 0) this.options.previews[this.options.previews.length - 1].click();
		else this.options.previews[index].click();

	}

	Gallery.prototype.changeActivePreview = function() {
		this.options.previews[this.active].classList.remove(this.options.activePreviewClass);

		this.options.previews[this.index].classList.add(this.options.activePreviewClass);

		this.active = this.index;
	}

	Gallery.prototype.changeView = function() {
		var src = this.options.previews[this.active].getAttribute('data-src').split(',');

		for (var i = 0; i < this.options.views.length; i++) {
			this.options.views[i].setAttribute('src', src[i]);
		}
	}

	Gallery.prototype.changeTitle = function() {
		this.options.title.innerHTML = this.options.previews[this.active].getAttribute('data-title');
	}

	Gallery.prototype.changePrice = function() {
		this.options.price.innerHTML = this.options.previews[this.active].getAttribute('data-discount');
	}

	Gallery.prototype.changePriceAction = function() {
		this.options.priceOld.innerHTML = this.options.previews[this.active].getAttribute('data-price');
		this.options.priceNew.innerHTML = this.options.previews[this.active].getAttribute('data-discount');
	}

	Gallery.prototype.changeLink = function() {
		this.options.link.setAttribute('href', this.options.previews[this.active].getAttribute('data-href'));
	}

	global.Gallery = Gallery;

})(window)
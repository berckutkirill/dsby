(function(global) {

	function Gallery(gallery) {
		this.actions = gallery.querySelectorAll('.gallery__img');
		this.hero    = gallery.querySelector('.gallery__hero');
		this.desc    = gallery.querySelector('.gallery__desc');

		this.index = 0;

		this.init();
	}

	Gallery.prototype.init = function() {
		Array.prototype.forEach.call(this.actions, function(item) {
			item.addEventListener('click', this.action.bind(this));
		}.bind(this))
	}

	Gallery.prototype.action = function(e) {
		var index = Array.prototype.indexOf.call(this.actions, e.target);
		if (index === this.index) return

		e.target.classList.add('active');
		this.actions[this.index].classList.remove('active');

		this.change(e.target);

		this.index = index;
	}

	Gallery.prototype.change = function(item) {
		var img  = item.getAttribute('data-img'),
				desc = item.getAttribute('data-desc');

		this.hero.setAttribute('src', '/bitrix/templates/steelline/img/chesh/2x/' + img);
		this.hero.setAttribute('srcset', '/bitrix/templates/steelline/img/chesh/1x/' + img + ' 1x, /bitrix/templates/steelline/img/chesh/2x/' + img + ' 2x');

		this.desc.innerHTML = desc;
	}

	global.Gallery = Gallery;

})(window.app || (window.app = {}))
function Floating(options) {
	this.config = {};

	var defaults = {
		container: '.floatingContainer',
		item: '.floatingItem',
		line: '.line',
		base: '.base',
		type: 'top'
	}

	for (key in defaults) {
		this.config[key] = options ? options[key] ? options[key] : defaults[key] : defaults[key];
	}

	this.wrap   = document.querySelector(this.config.container);
	this.item   = document.querySelector(this.config.item);

	this.lines = document.querySelectorAll(this.config.line);
	this.bases = document.querySelectorAll(this.config.base);

	this.scroll = 0;    // прошлый показатель скролла(для определения направления скролла)

	this.init();
};

Floating.prototype.fixed = {};
	Floating.prototype.fixed.bot = function(elem) {
		elem.style.position = 'fixed';
		elem.style.bottom   = '50px';
		elem.style.top      = '';
	}
	Floating.prototype.fixed.top = function(elem) {
		elem.style.position = 'fixed';
		elem.style.top      = '50px';
		elem.style.bottom   = '';
	}
	Floating.prototype.fixed.clear = function(elem) {
		elem.style.position = '';
		elem.style.top      = '';
		elem.style.bottom   = '';
	}
	Floating.prototype.fixed.pos = function(elem, coord) {
		elem.style.position = 'absolute';
		elem.style.top      = coord + 'px';
	}

Floating.prototype.getCoordDot = function(item, offsetX, offsetY) {
	var dot = {};

	dot.left = item.left + +offsetX;
	dot.top  = item.top + +offsetY;

	return dot;
}
Floating.prototype.getCath = function(base, dot) {
	var cath = {};

	cath.x = base.left - dot.left;
	cath.y = base.top - dot.top;

	return cath;
}
Floating.prototype.getHypot = function(x, y) {
	return Math.sqrt(x * x + y * y);
}
Floating.prototype.getAng = function(cath, hypot) {
	return Math.asin(cath / hypot) * 180 / Math.PI;
}
Floating.prototype.moveLines = function(lines, bases) {

	Array.prototype.forEach.call(lines, function(elem, i, arr) {
		var base  = this.coordinates.getCoordsOnPage(bases[i]),
				dot   = this.getCoordDot(this.coordItem, elem.getAttribute('data-dotx'), elem.getAttribute('data-doty')),
				cath  = this.getCath(base, dot),
				hypot = this.getHypot(cath.x, cath.y)
				ang   = this.getAng(cath.y, hypot);

		elem.style.width     = hypot + 'px';
		elem.style.transform = 'rotateZ(' + ang + 'deg)';

	}.bind(this));
}
Floating.prototype.coordinates = {};
	Floating.prototype.coordinates.getCoordsOnPage = function(elem) {
		var box = elem.getBoundingClientRect();

		return {
			top:  box.top + pageYOffset,
			left: box.left + pageXOffset
		};
	};
	Floating.prototype.coordinates.getDirectionScroll = function(scroll) {
		var direction;

		scroll > pageYOffset ? direction = 'up' : direction = 'down';

		return direction;
	}
	Floating.prototype.coordinates.getOffset = function(scroll) {
		return scroll - pageYOffset;
	}
	Floating.prototype.coordinates.getPositionItemOnWrap = function(posTopWrap, posTopItem, range) {
		var posTop = posTopItem - posTopWrap;

		if (posTop < 0) posTop = 0;
		else if (posTop > range) posTop = range;

		return posTop;
	}
	Floating.prototype.getCoords = function() {
		var coordWrap = this.coordinates.getCoordsOnPage(this.wrap);				// координаты контейнера в документе
		  	
		this.coordItem = this.coordinates.getCoordsOnPage(this.item);				// координаты перемещаемого элемента в документе

		this.heightWrap = this.wrap.offsetHeight;  							// высота контейнера
		this.heightItem = this.item.offsetHeight;								// высота перемещаемого элемента
		this.range      = this.heightWrap - this.heightItem;		// диапазон возможного перемещения

		this.topCoordWrap = coordWrap.top;													// координата верхней граници контейнера
		this.botCoordWrap = this.topCoordWrap + this.heightWrap;		// координата нижней граници контейнера

		this.topCoordItem = this.coordItem.top;													// координата верхней граници перемещаемого элемента
		this.botCoordItem = this.topCoordItem + this.heightItem;		// координата нижней граници перемещаемого элемента

		this.posTop = this.coordinates.getPositionItemOnWrap(this.topCoordWrap, this.topCoordItem, this.range); 		// позиция перемещаемого элемента относительно контейнера

		if (this.config.type === 'duplex') {
			this.botScroll = pageYOffset + document.documentElement.clientHeight;  	// координата нижней граници окна просмотра
			this.offset = this.coordinates.getOffset(this.scroll);	 								// величина отката при мин скролле
		}
	}
Floating.prototype.checkScroll = function() {
	if (pageYOffset < this.topCoordWrap) this.fixed.clear(this.item);
	else if (pageYOffset >= this.topCoordWrap) {
		if (pageYOffset + this.heightItem <= this.botCoordWrap) this.fixed.top(this.item);
		else this.fixed.pos(this.item, this.posTop);
	}
}
Floating.prototype.checkDownScroll = function() {
	if (this.botScroll === this.botCoordItem) this.fixed.pos(this.item, this.posTop + this.offset);
	else this.fixed.pos(this.item, this.posTop);

	if (pageYOffset + 50 >= this.topCoordWrap) {
		if (pageYOffset + 50 >= this.topCoordItem && pageYOffset + 50 + this.heightItem <= this.botCoordWrap) this.fixed.top(this.item);
		else this.fixed.pos(this.item, this.posTop);
	}
}
Floating.prototype.checkUpScroll = function() {
	if (pageYOffset === this.topCoordItem) this.fixed.pos(this.item, this.posTop + this.offset);
	else this.fixed.pos(this.item, this.posTop);

	if (this.botScroll - 50 <= this.botCoordWrap) {
		if (this.botScroll - 50 <= this.botCoordItem && this.topCoordItem > this.topCoordWrap) this.fixed.bot(this.item);
		else this.fixed.pos(this.item, this.posTop);
	}
}

Floating.prototype.general = function() {
	this.getCoords();

	if (this.config.type === 'duplex') {
		if (this.coordinates.getDirectionScroll(this.scroll) === 'down') {
			this.scroll = pageYOffset;
			this.checkDownScroll();
		} else {
			this.scroll = pageYOffset;
			this.checkUpScroll();
		}
	} else {
		this.checkScroll();
	}
	
	this.moveLines(this.lines, this.bases);
}

Floating.prototype.init = function() {
	window.addEventListener('scroll', this.general.bind(this));
	document.addEventListener("DOMContentLoaded", this.general.bind(this));
}
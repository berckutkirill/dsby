(function(global) {

	var ModalRequis = function(options) {
		this.options = options;
		this.body = document.body;

		this.init();
	}

	ModalRequis.prototype = Object.create(global.Menu.prototype);
	ModalRequis.prototype.constructor = ModalRequis;

	ModalRequis.prototype.init = function() {
		this.options.openBut.addEventListener('click', this.open.bind(this));

		this.text = document.createElement('TEXTAREA');
		this.text.style.position = 'absolute';
		this.text.style.opacity = 0;

		this.options.copyBut.addEventListener('click', this.copy.bind(this));
	}

	ModalRequis.prototype.open = function() {
		this.options.requis.classList.add('open');
		this.body.classList.add('open-requis');

		this.listener();
	}

	ModalRequis.prototype.close = function() {
		this.options.requis.classList.remove('open');
		this.body.classList.remove('open-requis');

		this.options.requis.classList.remove('copy');
	}

	ModalRequis.prototype.copy = function() {
		this.text.value = this.options.copyItem.innerText;

		document.body.appendChild(this.text);
		this.text.select();

		if (!document.queryCommandEnabled('copy')) {
			// var rng, sel;
	  //   if (document.createRange) {
	  //     rng = document.createRange();
	  //     rng.selectNode(this.options.copyItem)
	  //     sel = window.getSelection();
	  //     sel.removeAllRanges();
	  //     sel.addRange(rng);
	  //   } else {
	  //     rng = document.body.createTextRange();
	  //     rng.moveToElementText(this.options.copyItem);
	  //     rng.select();
	  //   }

			this.options.requis.classList.add('copy');
			this.options.status.innerHTML = '<p>' +
					'Упс. Ваш браузер устарел. <br>' +
					'Рекомендуем обновить <br>' +
					'используемый вами ' +
					'<a class="c-link" target="_blank" href="http://www.opera.com/ru">браузер</a>' +
				'</p>';
			return;
		}
	
		document.execCommand('copy');
		this.options.requis.classList.add('copy');
		document.body.removeChild(this.text);
	}

	global.ModalRequis = ModalRequis;

})(window)
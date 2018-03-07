(function(global) {

	function PopupRequis(options) {
		this.options = options;
		this.body = document.body;

		this.init();
	}

	PopupRequis.prototype = Object.create(global.Popup.prototype);
	PopupRequis.prototype.contructor = PopupRequis;

	PopupRequis.prototype.copy = function() {
		var textArea = document.createElement('TEXTAREA');

		textArea.style.position = 'absolute';
		textArea.style.opacity = 0;
		textArea.style.zIndex = -100;

		textArea.value = this.options.copyText.innerText;

		this.body.appendChild(textArea);

		textArea.select();

		if (!document.queryCommandEnabled('copy')) {
			this.body.removeChild(textArea);
			this.options.copyStatus.innerText = 'Реквизиты не скопированы — ваш бразуер устарел. Скопируйте вручную.';
			this.options.copyStatus.style.display = 'inline-block';
			return;
		}

		this.options.copyStatus.style.display = 'inline-block';
		document.execCommand('copy');
		this.body.removeChild(textArea);
	}

	PopupRequis.prototype.closePopup = function() {
		this.options.popup.classList.remove('open')
		this.body.style.overflow = 'auto';

		this.options.copyStatus.style.display = 'none';
	}

	PopupRequis.prototype.init = function() {
		this.options.openPopup.addEventListener('click', this.openPopup.bind(this));

		for(var i = 0; i < this.options.closePopup.length; i++) {
			this.options.closePopup[i].addEventListener('click', this.closePopup.bind(this));
		}

		this.body.addEventListener('keydown', this.escClosePopup.bind(this));

		this.options.copyAction.addEventListener('click', this.copy.bind(this))
	}

	global.PopupRequis = PopupRequis;

})(window.app || (window.app = {}))
(function(global) {

	function Popup(options) {
		this.options = options;
		this.body = document.body;

		this.init();
	}

	Popup.prototype.init = function() {
		this.options.openPopup.addEventListener('click', this.openPopup.bind(this));

		for(var i = 0; i < this.options.closePopup.length; i++) {
			this.options.closePopup[i].addEventListener('click', this.closePopup.bind(this));
		}

		this.body.addEventListener('keydown', this.escClosePopup.bind(this));

		if (this.options.form) {
			

			this.formSub  = this.options.form.querySelector('.form__sub');
			this.formSucc = this.options.form.querySelector('.form__succ');
			this.formMain = this.options.form.querySelector('.form__main');

			this.field = this.options.form.querySelector('.form__field[data-valid]');
			this.in    = this.field.querySelector('input');

			this.formWrap = this.options.popup.querySelector('.request__wrap');


			this.valid();
			this.options.form.addEventListener('submit', this.send.bind(this));
		}
	}

	Popup.prototype.openPopup = function() {
		this.options.popup.classList.add('open')
		this.body.style.overflow = 'hidden';

		if (this.options.form && this.formSucc.classList.contains('active')) {
			this.stateStart();
		}
	}

	Popup.prototype.closePopup = function() {
		this.options.popup.classList.remove('open')
		this.body.style.overflow = 'auto';
	}

	Popup.prototype.escClosePopup = function(e) {
		if (e.keyCode === 27) this.closePopup();
	}

	Popup.prototype.copy = function() {
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

	Popup.prototype.valid = function() {

		function getChar(event) {
		  if (event.which == null) { // IE
		    if (event.keyCode < 32) return null; // спец. символ
		    return String.fromCharCode(event.keyCode)
		  }

		  if (event.which != 0 && event.charCode != 0) { // все кроме IE
		    if (event.which < 32) return null; // спец. символ
		    return String.fromCharCode(event.which); // остальные
		  }

		  return null; // спец. символ
		}

		this.in.addEventListener('keypress', function(e) {
			if (getChar(e) && !getChar(e).search(/[a-zа-яё]/ig)) e.preventDefault();	
		})

		this.in.addEventListener('focus', function() {
			this.field.classList.remove('err');
		}.bind(this))

		this.in.addEventListener('blur', function(e) {
			if (e.target.value.match(/\d/ig) && e.target.value.match(/\d/ig).length >= 7) return;
			this.field.classList.add('err');
		}.bind(this))

		this.in.addEventListener('input', function(e) {
			var value = e.target.value.replace(/[a-zа-яё]/ig, '');
			if (value.match(/\d/ig) && value.match(/\d/ig).length >= 7) {
				this.formSub.setAttribute('type', 'submit');
				this.formSub.classList.remove('but--dis');
			}	else {
				this.formSub.setAttribute('type', 'button');
				this.formSub.classList.add('but--dis');
			}
		}.bind(this))

	}

	Popup.prototype.send = function(e) {
		e.preventDefault();

		var xhr  = new XMLHttpRequest();
		xhr.open('POST', '/request/form.php', true);

		xhr.onreadystatechange = function(e) {
		  // if (e.target.readyState != 4) return;


		  // if (e.target.status != 200) {
		  //   // обработать ошибку
		  //   alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
		  //   return;
		  // }

		  if (e.target.status === 200) {
		    // console.log('Ok');
		    this.stateSend();
		  }
		}.bind(this);

		xhr.send(new FormData(e.target));
	}

	Popup.prototype.stateSend = function() {
		this.formSucc.style.display = 'block';
		this.formSucc.classList.add('active');
		this.formMain.style.display = 'none';

		this.formWrap.style.display = 'none';
	}

	Popup.prototype.stateStart = function() {
		this.formSucc.style.display = 'none';
		this.formSucc.classList.remove('active');
		this.formMain.style.display = 'block';
		this.formWrap.style.display = 'block';
		this.formSub.classList.add('but--dis');
		this.formSub.setAttribute('type', 'button');

		this.options.form.reset();
	}

	global.Popup = Popup;

})(window.app || (window.app = {}))
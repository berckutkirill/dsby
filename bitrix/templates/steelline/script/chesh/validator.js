(function(global) {

	function Validator(form) {
		this.form   = form;
		this.fields = form.querySelectorAll('.form__field[data-valid]');
		this.submit = form.querySelector("button");

		this.download = form.querySelector('.form__download');
		this.downloadDesc = form.querySelector('.form__download-desc');
		this.downloadInput = this.download.querySelector('input[type="file"]');
		this.fileName = this.download.querySelector('.form__download-filename');
		this.clear    = this.download.querySelector('.form__download-reset');

		this.filePath;

		this.patterns = {
			email: /[\w.]+@[a-z_\d]+?\.[a-z\d]{2,6}/gi,
			name: /.{2,}/g,
			phone: /[a-zа-яё]/ig
		}

		this.init();
		
	}

	Validator.prototype.init = function() {
		this.form.addEventListener('input', this.checkFormValid.bind(this));

		Array.prototype.forEach.call(this.fields, function(item) {
			var input = item.querySelector('.form__field-input');

			input.addEventListener('focus', function() {
				item.classList.remove('err')
			})

			input.addEventListener('blur', function(e) {
				if (item.getAttribute('data-press') && e.target.value.match(/\d/ig) && e.target.value.match(/\d/ig).length >= 7 || e.target.value.match(this.patterns[item.getAttribute('data-patt')])) return;			

				item.classList.add('err');
			}.bind(this))

			if (item.getAttribute('data-press')) {
				item.addEventListener('keypress', function(e) {
					if (this.getChar(e) && !this.getChar(e).search(this.patterns[item.getAttribute('data-patt')])) e.preventDefault();
				}.bind(this))
			}

			input.addEventListener('input', function(e) {
				if (item.getAttribute('data-press') && e.target.value.match(/\d/ig) && e.target.value.match(/\d/ig).length >= 7 || e.target.value.match(this.patterns[item.getAttribute('data-patt')])) item.classList.remove('invalid');
				else item.classList.add('invalid');
			}.bind(this))

		}.bind(this))


		this.download.addEventListener('change', this.downloadFile.bind(this));
		this.clear.addEventListener('click', this.resetFile.bind(this));

		this.form.addEventListener('submit', this.submitForm.bind(this));
	}

	Validator.prototype.downloadFile = function(e) {
		var self = e.target;

		if (self.files[0]) {

			if (this.bigFileState(self.files[0])) return;

			this.loadFileState();
			this.invalidFormState();

			var xhr = new XMLHttpRequest();

			xhr.onload = xhr.onerror = function(e) {
				this.uploadFileState();
				this.checkFormValid();

				this.fileName.innerText = this.checkTitleLenght(self.files[0].name);
				this.filePath = e.target.responseText;
			}.bind(this)

			xhr.open("POST", "/request/vacantion.php", true);

			var data = new FormData();
			    data.append('doc', e.target.files[0], e.target.files[0].name);

			xhr.send(data);
			
		}
	}

	Validator.prototype.resetFile = function() {
		this.download.classList.remove('upload');
		this.fileName.innerText = '';
		this.downloadInput.value = null;
	}

	Validator.prototype.submitForm = function(e) {
		e.preventDefault();

		var self = e.target;

		var xhr = new XMLHttpRequest();

		xhr.open('POST', '/request/vacantion.php', true);

		xhr.onreadystatechange = function(e) {

		  if (e.target.status === 200) {
		    self.classList.add('form--submit');
		  }

		}.bind(this);

		var data = new FormData(e.target);
				data.append('doc', this.filePath);

		xhr.send(data);
	}

	Validator.prototype.checkTitleLenght = function(string) {
		if (string.length < 35) return string;
		else {
			var arrStr = string.split('.'),
					title = arrStr[arrStr.length - 2],
					wordF = title.slice(-24),
					wordL = title.slice(title.length - 4);
			
			arrStr[arrStr.length - 2] = wordF + '...' + wordL;

			return arrStr.join('.')
		}
	}

	Validator.prototype.checkFormValid = function() {
		if (this.form.querySelectorAll('.form__field.invalid').length !== 0) {
			this.invalidFormState();
		}	else {
			this.validFormState();
		}
	}

	Validator.prototype.bigFileState = function(file) {
		if (file.size > 20000000) {
			this.downloadDesc.innerText = 'Размер файла более 20Мб';
			this.resetFile();
			return true;
		} else {
			this.downloadDesc.innerText = '.zip не более 20Мб';
			return false;
		}
	}

	Validator.prototype.validFormState = function() {
		this.submit.classList.remove('but--dis');
		this.submit.setAttribute('type', 'submit');
	}

	Validator.prototype.invalidFormState = function() {
		this.submit.classList.add('but--dis');
		this.submit.setAttribute('type', 'button');
	}

	Validator.prototype.loadFileState = function() {
		this.download.classList.add('load')
		this.download.classList.remove('upload')
	}

	Validator.prototype.uploadFileState = function() {
		this.download.classList.add('upload')
		this.download.classList.remove('load')
	}

	Validator.prototype.getChar = function(event) {
		if (event.which == null) { // IE
	    if (event.keyCode < 32) return null; // спец. символ
	    return String.fromCharCode(event.keyCode)
	  }

	  if (event.which != 0 && event.charCode != 0) { // все кроме IE
	    if (event.which < 32) return null; // спец. символ
	    return String.fromCharCode(event.which); // остальные
	  }

	  return null;
	}


	global.Validator = Validator;

})(window.app || (window.app = {}))
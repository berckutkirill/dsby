(function(global) {

	function Tabs(tab) {
      if (!tab) return;

      this.controls = tab.querySelectorAll('.c-tabs__controls-item');
      this.tabs = tab.querySelectorAll('.c-tabs__item');
      this.trig = tab.querySelectorAll('.c-tab--trigger');
      this.index = 0;

      this.init();
  }

  Tabs.prototype.changeTab = function(e) {
    var target = e.currentTarget;

    if (target.classList.contains('c-tabs__controls-item--active')) return;

    var index = Array.prototype.indexOf.call(this.controls, target);

    this.controls[this.index].classList.remove('c-tabs__controls-item--active');
    this.controls[index].classList.add('c-tabs__controls-item--active');

    this.tabs[this.index].classList.remove('c-tabs__item--active');
    this.tabs[index].classList.add('c-tabs__item--active');

    this.index = index;
  }

  Tabs.prototype.init = function () {
    for (var i = 0; i < this.controls.length; i++) {
      this.controls[i].addEventListener('click', this.changeTab.bind(this));
    }

    Array.prototype.forEach.call(this.trig, function(item) {
      var trigg = item.querySelectorAll('.c-tab__trigger'),
          price = item.querySelectorAll('.c-tab__price'),
          desc = item.querySelector('.c-tab__toggle');

      for (var i = 0; i < trigg.length; i++) {
        trigg[i].addEventListener('click', function() {
          if (!this.classList.contains('active')) return;

          for (var i = 0; i < trigg.length; i++) {
            trigg[i].classList.toggle('active');
            price[i].classList.toggle('active');
          }

          desc.classList.toggle('active');
        })
      }
    })
  }

  window.Tabs = Tabs;

})(window);
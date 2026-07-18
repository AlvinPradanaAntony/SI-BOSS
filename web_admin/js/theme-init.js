(function() {
  document.documentElement.classList.add('js-enabled');
  var t = localStorage.getItem('theme') || 'system';
  if (t === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
  } else if (t === 'light') {
    document.documentElement.setAttribute('data-theme', 'light');
  } else {
    document.documentElement.removeAttribute('data-theme');
  }
})();

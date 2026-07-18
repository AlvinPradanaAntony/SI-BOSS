document.addEventListener('DOMContentLoaded', function() {
  const switchers = document.querySelectorAll('.theme-switcher');
  
  function applyTheme(theme) {
    if (theme === 'dark') {
      document.documentElement.setAttribute('data-theme', 'dark');
    } else if (theme === 'light') {
      document.documentElement.setAttribute('data-theme', 'light');
    } else {
      document.documentElement.removeAttribute('data-theme');
    }
    
    // Update all switchers on the page
    switchers.forEach(switcher => {
      switcher.setAttribute('data-active', theme);
      const buttons = switcher.querySelectorAll('.theme-btn');
      buttons.forEach(btn => {
        const val = btn.getAttribute('data-theme-value');
        const icon = btn.querySelector('i');
        if (val === theme) {
          btn.classList.add('active');
          if (icon) {
            if (val === 'light') icon.className = 'bx bxs-sun';
            else if (val === 'system') icon.className = 'bx bx-desktop';
            else if (val === 'dark') icon.className = 'bx bxs-moon';
          }
        } else {
          btn.classList.remove('active');
          if (icon) {
            if (val === 'light') icon.className = 'bx bx-sun';
            else if (val === 'system') icon.className = 'bx bx-desktop';
            else if (val === 'dark') icon.className = 'bx bx-moon';
          }
        }
      });
    });
  }
  
  // Initialize switchers based on saved theme or system
  const savedTheme = localStorage.getItem('theme') || 'system';
  applyTheme(savedTheme);
  
  // Attach event listeners
  switchers.forEach(switcher => {
    const buttons = switcher.querySelectorAll('.theme-btn');
    buttons.forEach(btn => {
      btn.addEventListener('click', function() {
        const selectedTheme = this.getAttribute('data-theme-value');
        localStorage.setItem('theme', selectedTheme);
        applyTheme(selectedTheme);
      });
    });
  });

  // Listen to system preference changes
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if (localStorage.getItem('theme') === 'system' || !localStorage.getItem('theme')) {
      applyTheme('system');
    }
  });
});

let sidebar = document.querySelector(".sidebar");
let menuContainer = document.querySelector(".menu");

// Close sidebar by default on mobile/tablet screens
if (sidebar && window.innerWidth < 768) {
  sidebar.classList.add("close");
}

if (sidebar && menuContainer) {
  menuContainer.addEventListener("click", (e)=>{
    e.stopPropagation(); // Prevent triggering the document click handler
    sidebar.classList.toggle("close");
    // Adjust stat values layout on sidebar state toggle
    if (typeof adjustStatValues === 'function') {
      adjustStatValues();
      setTimeout(adjustStatValues, 300);
    }
  });
}

// Close sidebar when clicking outside it on mobile
document.addEventListener("click", (e) => {
  if (window.innerWidth < 768 && sidebar && !sidebar.classList.contains("close")) {
    // If the click target is not the sidebar and not the toggle menu button
    if (!sidebar.contains(e.target) && !menuContainer.contains(e.target)) {
      sidebar.classList.add("close");
      if (typeof adjustStatValues === 'function') {
        adjustStatValues();
        setTimeout(adjustStatValues, 300);
      }
    }
  }
});

// Function to dynamically scale stat values to prevent wrapping
function adjustStatValues() {
  const statValues = document.querySelectorAll('.stat-card .stat-value');
  statValues.forEach(el => {
    // Reset properties to calculate natural bounds
    el.style.transform = '';
    el.style.width = '';
    
    const parent = el.parentElement;
    if (!parent) {
      el.classList.add('scaled'); // fallback to show if no parent
      return;
    }
    
    // Calculate parent's available width (accounting for padding)
    const parentStyle = window.getComputedStyle(parent);
    const paddingLeft = parseFloat(parentStyle.paddingLeft) || 0;
    const paddingRight = parseFloat(parentStyle.paddingRight) || 0;
    const availableWidth = parent.clientWidth - paddingLeft - paddingRight;
    
    // Get natural scroll width of content
    const scrollWidth = el.scrollWidth;
    
    if (scrollWidth > availableWidth && availableWidth > 0) {
      const scaleFactor = availableWidth / scrollWidth;
      el.style.transform = `scale(${scaleFactor})`;
      // Prevent browser from constraining size to parent bounds when transforming
      el.style.width = (100 / scaleFactor) + '%';
    }
    
    // Mark as scaled/ready (makes it visible)
    el.classList.add('scaled');
  });
}

// Run immediately if DOM is already parsed
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', adjustStatValues);
} else {
  adjustStatValues();
}

// Recalculate on window resize
window.addEventListener('resize', adjustStatValues);

// Toggle notification icon between outline and filled when dropdown opens/closes
document.addEventListener("DOMContentLoaded", function() {
  const notifDropdown = document.getElementById('dropdownNotification');
  if (notifDropdown) {
    notifDropdown.addEventListener('show.bs.dropdown', function () {
      const icon = this.querySelector('.notification-icon-wrap i');
      if (icon) {
        icon.classList.remove('bx-bell');
        icon.classList.add('bxs-bell');
      }
    });
    notifDropdown.addEventListener('hide.bs.dropdown', function () {
      const icon = this.querySelector('.notification-icon-wrap i');
      if (icon) {
        icon.classList.remove('bxs-bell');
        icon.classList.add('bx-bell');
      }
    });
  }
});

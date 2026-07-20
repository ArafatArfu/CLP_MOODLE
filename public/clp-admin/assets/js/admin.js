// CLP Admin Panel - JavaScript

$(document).ready(function() {
    const $sidebar = $('#sidebar');
    const $overlay = $('#sidebarOverlay');
    const $toggle = $('#sidebarToggle');
    const $close = $('#sidebarClose');
    
    function openSidebar() {
        $sidebar.addClass('open');
        $overlay.addClass('active');
        $('body').css('overflow', 'hidden');
    }
    
    function closeSidebar() {
        $sidebar.removeClass('open');
        $overlay.removeClass('active');
        $('body').css('overflow', '');
    }
    
    // Sidebar toggle for mobile
    $toggle.on('click', function() {
        if ($sidebar.hasClass('open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });
    
    // Close button inside sidebar
    $close.on('click', function() {
        closeSidebar();
    });
    
    // Close sidebar when clicking overlay
    $overlay.on('click', function() {
        closeSidebar();
    });
    
    // Close sidebar on escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $sidebar.hasClass('open')) {
            closeSidebar();
        }
    });
    
    // Dropdown toggle
    $('.dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        $(this).parent('.has-dropdown').toggleClass('active');
    });
    
    // Submenu toggle for nested dropdowns
    $('.submenu-toggle').on('click', function(e) {
        e.preventDefault();
        $(this).parent('.has-dropdown').toggleClass('active');
    });
    
    // Auto-hide flash messages
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Confirm delete actions
    $('.confirm-delete').on('click', function(e) {
        if (!confirm('Are you sure you want to delete this? This action cannot be undone.')) {
            e.preventDefault();
        }
    });
    
    // Toggle switch for status
    $('.status-toggle').on('change', function() {
        var form = $(this).closest('form');
        form.submit();
    });
});

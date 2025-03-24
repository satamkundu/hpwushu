$(document).ready(function () {
    // Initialize AOS
    AOS.init({
        disable: 'mobile', // Disable AOS on mobile for better performance
        once: true         // Animation only happens once
    });

    // Mobile menu toggle
    $('#mobile-menu-button').click(function () {
        $('.mobile-menu').toggleClass('open');
    });

    // Dropdown menu functionality
    $('.dropdown-button').click(function (e) {
        e.stopPropagation();

        // For mobile view, we want to rotate the dropdown arrow
        $(this).find('.dropdown-icon').toggleClass('rotate-180');

        // Toggle current dropdown
        const dropdownContent = $(this).siblings('.dropdown-content');

        // On mobile, we close other dropdowns and only toggle the clicked one
        if (window.innerWidth < 1024) {
            $('.dropdown-content').not(dropdownContent).slideUp(300);
            $('.dropdown-icon').not($(this).find('.dropdown-icon')).removeClass('rotate-180');
            dropdownContent.slideToggle(300);
        } else {
            // On desktop, we use the show/hide class
            $('.dropdown-content').not(dropdownContent).removeClass('show');
            dropdownContent.toggleClass('show');
        }
    });

    // Close all dropdowns when clicking outside on desktop
    $(document).click(function () {
        if (window.innerWidth >= 1024) {
            $('.dropdown-content').removeClass('show');
        }
    });

    // Prevent dropdown from closing when clicking inside it
    $('.dropdown-content').click(function (e) {
        e.stopPropagation();
    });

    // Hover effect for desktop using jQuery
    if (window.innerWidth >= 1024) {
        $('.dropdown').hover(
            function () {
                $(this).find('.dropdown-content').addClass('show');
            },
            function () {
                $(this).find('.dropdown-content').removeClass('show');
            }
        );
    }

    // Handle window resize events to reset mobile menu state
    $(window).resize(function () {
        if (window.innerWidth >= 1024) {
            // Reset mobile specific states
            $('.mobile-menu').removeClass('open');
            $('.dropdown-content').removeAttr('style');
        }
    });
});
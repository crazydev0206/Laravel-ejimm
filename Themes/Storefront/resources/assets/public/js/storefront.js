require('./vendors/vendors');

$(() => {

    /*      variables
    /*----------------------------------------*/

    let _window = $(window),
        body = $('body');

    /*      button loading
    /*----------------------------------------*/

    $('[data-loading]').on('click', (e) => {
        e.currentTarget.classList.add('btn-loading');
    });

    /*      select option
    /*----------------------------------------*/

    let select = $('.custom-select-option');

    select.niceSelect();

    select.on('change', (e) => {
        e.target.dispatchEvent(new Event('nice-select-updated', { bubbles: true }));
    });

    /*      overlay
    /*----------------------------------------*/

    let overlay = $('.overlay');

    /*      sidebar cart
    /*----------------------------------------*/

    let headerCart = $('.header-column-right .header-cart'),
        sidebarCart = $('.sidebar-cart-wrap'),
        sidebarCartClose = $('.sidebar-cart-close');

    headerCart.on('click', (e) => {
        e.stopPropagation();

        overlay.addClass('active');
        sidebarCart.addClass('active');
    });

    sidebarCartClose.on('click', () => {
        overlay.removeClass('active');
        sidebarCart.removeClass('active');
    });

    sidebarCart.on('click', (e) => {
        e.stopPropagation();
    });

    /*      header
    /*----------------------------------------*/

    let headerWrap = $('.header-wrap'),
        headerWrapInner = $('.header-wrap-inner'),
        headerWrapInnerHeight = headerWrapInner.outerHeight(),
        headerSearchSm = $('.header-search-sm'),
        searchInputSm = $('.search-input-sm'),
        headerSearchSmClose = $('.header-search-sm-form .btn-close');

    headerSearchSm.on('click', (e) => {
        let target = $(e.currentTarget);

        target.parents('.header-search').next().toggleClass('active');
        searchInputSm.focus();
    });

    headerSearchSmClose.on('click', (e) => {
        let target = $(e.currentTarget);

        target.parents('.header-search-sm-form').removeClass('active');
    });

    _window.on('resize', () => {
        headerWrapInnerHeight = headerWrapInner.outerHeight();
    });

    _window.on('load scroll resize', () => {
        let headerWrapHeight = headerWrap.outerHeight(),
            headerWrapOffsetTop = headerWrap.offset().top + headerWrapHeight;

        function stickyHeader() {
            let scrollTop = _window.scrollTop();

            if (scrollTop > headerWrapOffsetTop) {
                headerWrap.css('padding-top', `${headerWrapInnerHeight}px`);
                headerWrapInner.addClass('sticky');

                setTimeout(() => {
                    headerWrapInner.addClass('show');
                });

                return;
            }

            headerWrap.css('padding-top', 0);
            headerWrapInner.removeClass('sticky show');
        }

        stickyHeader();
    });

    /*      menu dropdown arrow
    /*----------------------------------------*/

    let megaMenuItem = $('.mega-menu > li'),
        subMenuDropdown = $('.sub-menu > .dropdown'),
        sidebarMenuSubMenu = $('.sidebar-menu .sub-menu');

    function menuDropdownArrow(parentSelector, childSelector) {
        parentSelector.each(function () {
            let self = $(this);

            if (self.children().length > 1) {
                if (window.FleetCart.rtl) {
                    self.children(`${childSelector}`).append('<i class="las la-angle-left"></i>');

                    return;
                }

                self.children(`${childSelector}`).append('<i class="las la-angle-right"></i>');
            }
        });
    }

    menuDropdownArrow(subMenuDropdown, 'a');
    menuDropdownArrow(megaMenuItem, '.menu-item');

    /*      navigation
    /*----------------------------------------*/

    let moreCategories = $('.more-categories'),
        categoryDropdown = $('.category-dropdown'),
        categoryNavInner = $('.category-nav-inner'),
        categoryDropdownWrap = $('.category-dropdown-wrap'),
        verticalMegaMenuList = $('.vertical-megamenu > li');

    categoryNavInner.on('click', () => {
        categoryDropdownWrap.toggleClass('show');
    });

    _window.on('load resize', () => {
        let verticalMegaMenuListHeight = 0,
            homeSliderHeight = homeSlider.height(),
            categoryDropdownHeight = homeSliderHeight;

        categoryDropdown.css('height', `${categoryDropdownHeight}px`);

        verticalMegaMenuList.each(function () {
            let self = $(this);

            verticalMegaMenuListHeight += self.height();

            if (verticalMegaMenuListHeight + 78 > categoryDropdownHeight) {
                self.addClass('hide');
                moreCategories.removeClass('hide');

                return;
            }

            self.removeClass('hide');
            moreCategories.addClass('hide');
        });
    });

    /*      sidebar menu
    /*----------------------------------------*/

    let sidebarMenuIcon = $('.sidebar-menu-icon'),
        sidebarMenuWrap = $('.sidebar-menu-wrap'),
        sidebarMenuClose = $('.sidebar-menu-close'),
        sidebarMenuTab = $('.sidebar-menu-tab a'),
        sidebarMenuList = $('.sidebar-menu li'),
        sidebarMenuLink = $('.sidebar-menu > li > a'),
        sidebarMenuListUl = $('.sidebar-menu > li > ul'),
        sidebarMenuDropdown = $('.sidebar-menu > .dropdown'),
        sidebarMenuSubMenuUl = $('.sidebar-menu .sub-menu ul'),
        sidebarMenuSubMenuLink = $('.sidebar-menu .sub-menu > a');

    sidebarMenuIcon.on('click', (e) => {
        e.stopPropagation();

        overlay.addClass('active');
        sidebarMenuWrap.addClass('active');
    });

    sidebarMenuClose.on('click', (e) => {
        overlay.removeClass('active');
        sidebarMenuWrap.removeClass('active');
    });

    sidebarMenuWrap.on('click', (e) => {
        e.stopPropagation();
    });

    sidebarMenuTab.on('click', (e) => {
        let target = $(e.currentTarget);

        e.preventDefault();
        target.tab('show');
    });

    sidebarMenuList.each(function () {
        let self = $(this);

        if (self.children().length > 1) {
            if (window.FleetCart.rtl) {
                self.children('a').after('<i class="las la-angle-left"></i>');

                return;
            }

            self.children('a').after('<i class="las la-angle-right"></i>');
        }
    });

    sidebarMenuDropdown.on('click', (e) => {
        let target = $(e.currentTarget);

        if (! target.hasClass('active')) {
            $('.sidebar-menu > li').removeClass('active');
            target.addClass('active');
        } else {
            $('.sidebar-menu > li').removeClass('active');
        }

        if (! target.children('ul').hasClass('open')) {
            $('.sidebar-menu .open').removeClass('open').slideUp(300);
            target.children('ul').addClass('open').slideDown(300);

            return;
        }

        $('.sidebar-menu .open').removeClass('open').slideUp(300);
    });

    sidebarMenuLink.on('click', (e) => {
        e.stopPropagation();
    });

    sidebarMenuListUl.on('click', (e) => {
        e.stopPropagation();
    });

    sidebarMenuSubMenu.on('click', (e) => {
        let target = $(e.currentTarget);

        if (! target.hasClass('active')) {
            target.addClass('active');
        } else {
            target.removeClass('active');
        }

        target.children('ul').slideToggle(300);
    });

    sidebarMenuSubMenuUl.on('click', function (e) {
        e.stopPropagation();
    });

    sidebarMenuSubMenuLink.on('click', (e) => {
        e.stopPropagation();
    });

    /*      slider
    /*----------------------------------------*/

    let homeSlider = $('.home-slider');

    if (homeSlider.length !== 0) {
        homeSlider.slick({
            rows: 0,
            rtl: window.FleetCart.rtl,
            cssEase: 'ease',
            speed: Number(homeSlider.data('speed')),
            fade: !! JSON.parse(homeSlider.data('fade')),
            dots: !! JSON.parse(homeSlider.data('dots')),
            arrows: !! JSON.parse(homeSlider.data('arrows')),
            autoplay: !! JSON.parse(homeSlider.data('autoplay')),
            autoplaySpeed: Number(homeSlider.data('autoplay-speed')),
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        dots: false,
                    },
                },
            ],
        }).slickAnimation();
    }

    /*      tooltip
    /*----------------------------------------*/

    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        selector: '[data-toggle="tooltip"]',
    });

    /*      top brands
    /*----------------------------------------*/

    let topBrands = $('.top-brands');

    topBrands.slick({
        rows: 0,
        dots: false,
        arrows: true,
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 7,
        rtl: window.FleetCart.rtl,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 6,
                },
            },
            {
                breakpoint: 1050,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                },
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                },
            },
            {
                breakpoint: 750,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
        ],
    });

    /*      sidebar filter
    /*----------------------------------------*/

    let mobileViewFilter = $('.mobile-view-filter');
    let filterSectionWrap = $('.filter-section-wrap');
    let sidebarFilterClose = $('.sidebar-filter-close');

    mobileViewFilter.on('click', (e) => {
        e.stopPropagation();

        filterSectionWrap.addClass('active');
        overlay.addClass('active');
    });

    sidebarFilterClose.on('click', () => {
        filterSectionWrap.removeClass('active');
        overlay.removeClass('active');
    });

    filterSectionWrap.on('click', (e) => {
        e.stopPropagation();
    });

    body.on('click', () => {
        overlay.removeClass('active');
        sidebarCart.removeClass('active');
        sidebarMenuWrap.removeClass('active');
        filterSectionWrap.removeClass('active');
    });

    /*      browse categories
    /*----------------------------------------*/

    $('.browse-categories li').each((i, li) => {
        if ($(li).children('ul').length > 0) {
            $(li).addClass('parent');
        }
    });

    let filterCategoriesLink = $('.browse-categories li.parent > a');
    let parentUls = $('.browse-categories li.active').parentsUntil('.browse-categories', 'ul');

    if (window.FleetCart.rtl) {
        filterCategoriesLink.before('<i class="las la-angle-left"></i>');
    } else {
        filterCategoriesLink.before('<i class="las la-angle-right"></i>');
    }

    parentUls.show().siblings('i').addClass('open');

    $('.browse-categories li i').on('click', (e) => {
        $(e.currentTarget).toggleClass('open').siblings('ul').slideToggle(300);
    });

    /*      image gallery
    /*----------------------------------------*/

    let baseImage = $('.base-image');

    $('.additional-image-wrap').slick({
        rows: 0,
        dots: false,
        arrows: true,
        vertical: true,
        infinite: false,
        slidesToShow: 4,
        slideToScroll: 1,
        asNavFor: baseImage,
        focusOnSelect: true,
        adaptiveHeight: true,
        verticalSwiping: true,
        responsive: [
            {
                breakpoint: 577,
                settings: {
                    vertical: false,
                    variableWidth: true,
                    verticalSwiping: false,
                    rtl: window.FleetCart.rtl,
                },
            },
        ],
    });

    baseImage.slick({
        rows: 0,
        fade: true,
        dots: false,
        swipe: false,
        arrows: false,
        infinite: false,
        draggable: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: window.FleetCart.rtl,
    });

    baseImage.slickLightbox({
        src: 'data-image',
        itemSelector: '.base-image-slide',
        slick: {
            fade: true,
            infinite: false,
            rtl: window.FleetCart.rtl,
        },
    });

    $('.base-image-slide').zoom({
        magnify: 1.2,
        touch: false,
    });

    /*      number picker
    /*----------------------------------------*/

    $('.btn-number').on('click', function (e) {
        e.preventDefault();

        let type = $(this).attr('data-type');
        let input = $(this).closest('.input-group-quantity').find('input.input-quantity');
        let minValue = input.attr('min');
        let maxValue = input.attr('max');
        let currentValue = parseInt(input.val());

        if (! $.isNumeric(currentValue)) {
            input.val(minValue);
            input[0].dispatchEvent(new Event('input'), { bubbles: true });
        }

        if (type === 'minus') {
            if (currentValue > minValue) {
                input.val(currentValue - 1);
                input[0].dispatchEvent(new Event('input'), { bubbles: true });
                $('.btn-number.btn-plus').removeAttr('disabled');
            }

            if (input.val() === minValue) {
                $(this).attr('disabled', true);
            }
        } else if (type === 'plus') {
            if (! maxValue || currentValue < maxValue) {
                input.val(currentValue + 1);
                input[0].dispatchEvent(new Event('input'), { bubbles: true });
                $('.btn-number.btn-minus').removeAttr('disabled');
            }

            if (input.val() === maxValue) {
                $(this).attr('disabled', true);
            }
        }
    });

    $('.input-number').on('input', function () {
        let self = $(this);
        let minValue = parseInt(self.attr('min'));
        let maxValue = parseInt(self.attr('max'));
        let currentValue = parseInt(self.val());

        if (! $.isNumeric(self.val())) {
            self.val(minValue);
            $('.btn-number.btn-minus').attr('disabled', true);
        }

        if (currentValue < minValue) {
            self.val(minValue);
            $('.btn-number.btn-minus').attr('disabled', true);
        }

        if (maxValue && currentValue > maxValue) {
            self.val(maxValue);
            $('.btn-number.btn-plus').attr('disabled', true);
        }
    });
});

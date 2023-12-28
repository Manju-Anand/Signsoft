"use strict";
let mainContent;
(function () {
    let html = document.querySelector('html');
    mainContent = document.querySelector('.main-content');

   

    localStorageBackup();
    // ______________Owl-carousel-icons2
    var owl = $('.owl-carousel-icons2');
    owl.owlCarousel({
        loop: true,
        rewind: false,
        margin: 25,
        animateIn: 'fadeInDowm',
        animateOut: 'fadeOutDown',
        autoplay: false,
        autoplayTimeout: 2000, // set value to change speed
        autoplayHoverPause: true,
        dots: false,
        nav: true,
        autoplay: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            800: {
                items: 1,
                nav: true
            },
            1300: {
                items: 2,
                nav: true
            }
        }
    })
    
      $(".feature-logos").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 4,
            },
          },
          {
            breakpoint: 520,
            settings: {
              slidesToShow: 2,
            },
          },
        ],
      });

    /*RTL Start*/
    if (html.getAttribute('dir') === "rtl") {
        rtlFn();
    }
    /*RTL End*/

    if (document.querySelector(".sidebar-right1")) {
        switcherClick();
    }

    checkOptions();

})();

function switcherClick() {
    let ltrBtn, rtlBtn, lightBtn, darkBtn, resetBtn;
    let html = document.querySelector('html');
    lightBtn = document.querySelector('#switchbtn-light');
    darkBtn = document.querySelector('#switchbtn-dark');
    ltrBtn = document.querySelector('#switchbtn-ltr');
    rtlBtn = document.querySelector('#switchbtn-rtl');
    resetBtn = document.querySelector('#resetbtn');

    /*Light Layout Start*/
    let lightThemeVar = lightBtn.addEventListener('click', () => {
        html.setAttribute('data-theme-color', 'light');

        localStorage.setItem("dashleadlandinglighttheme", true);
        localStorage.removeItem("dashleadlandingdarktheme");

        checkOptions();
        const root = document.querySelector(':root');
        root.style = "";

        if (!document.body.classList.contains('login-img')) {
            let mainHeader = document.querySelector('.main-header');
            mainHeader.style = "";
            let appSidebar = document.querySelector('.app-sidebar');
            appSidebar.style = "";
        }

    })
    /*Light Layout End*/

    /*Dark Layout Start*/
    let darkThemeVar = darkBtn.addEventListener('click', () => {
        html.setAttribute('data-theme-color', 'dark');

        localStorage.setItem("dashleadlandingdarktheme", true);
        localStorage.removeItem("dashleadlandinglighttheme");

        checkOptions();

        const root = document.querySelector(':root');
        root.style = "";

        if (!document.body.classList.contains('login-img')) {
            let mainHeader = document.querySelector('.main-header');
            mainHeader.style = "";
            let appSidebar = document.querySelector('.app-sidebar');
            appSidebar.style = "";
        }

    });
    /*Dark Layout End*/

    
    /* rtl start*/
    let rtlVar = rtlBtn?.addEventListener('click', () => {
        localStorage.setItem("dashleadlandingrtl", true);
        localStorage.removeItem(".");
        rtlFn();
    });
    /* rtl end*/

    /* ltr start*/
    let ltrVar = ltrBtn?.addEventListener('click', () => {
        //    local storage 
        localStorage.setItem("dashleadlandingltr", true);
        localStorage.removeItem("dashleadlandingrtl");

        ltrFn();
    });
    /* ltr end*/
}

function ltrFn() {
    let html = document.querySelector('html');
    html.setAttribute("dir", "ltr");
    let select2Cont = document.querySelectorAll(".select2-container")
    select2Cont.forEach(e => e.setAttribute("dir", "ltr"))
    document.querySelector("#style")?.setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.min.css");
    var carousel = $('.owl-carousel');
    $.each(carousel, function (index, element) {
        // element == this
        var carouselData = $(element).data('owl.carousel');
        carouselData.settings.rtl = false; //don't know if both are necessary
        carouselData.options.rtl = false;
        $(element).trigger('refresh.owl.carousel');
    });
    if (html.getAttribute('data-layout') === "horizontal") {
        // checkHoriMenu();
    }
    //
    checkOptions();
}

function rtlFn() {
    let html = document.querySelector('html');
    html.setAttribute("dir", "rtl");
    let select2Cont = document.querySelectorAll(".select2-container")
    select2Cont.forEach(e => e.setAttribute("dir", "rtl"))
    document.querySelector("#style")?.setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.rtl.min.css");
    var carousel = $('.owl-carousel');
    $.each(carousel, function (index, element) {
        // element == this
        var carouselData = $(element).data('owl.carousel');
        carouselData.settings.rtl = true; //don't know if both are necessary
        carouselData.options.rtl = true;
        $(element).trigger('refresh.owl.carousel');
    });
    if (html.getAttribute('data-layout') === "horizontal"  && document.querySelector("login-img")) {
        // checkHoriMenu();
    }
    //
    checkOptions();
}

function resetData() {
    let html = document.querySelector('html');
    $('#switchbtn-ltr').prop('checked', true);
    $('#switchbtn-light').prop('checked', true);
    html.setAttribute('data-theme-color', 'light');
    ltrFn();
    localStorage.clear();
    if (!document.body.classList.contains('login-img')) {
        let mainHeader = document.querySelector('.main-header');
        mainHeader.style = "";
        let appSidebar = document.querySelector('.app-sidebar');
        appSidebar.style = "";
        //
        checkOptions();
        menuClick();
    }
}

function checkOptions() {

    let html = document.querySelector('html')

    // dark
    if (html.getAttribute('data-theme-color') === "dark") {
        $('#switchbtn-dark').prop('checked', true);
    }

    //RTL 
    if (html.getAttribute('dir') === "rtl") {
        $('#switchbtn-rtl').prop('checked', true);
    }
   
}

function localStorageBackup() {
    // if there is a value stored, update color picker and background color
    // Used to retrive the data from local storage
    
    if (localStorage.dashleadlandingdarktheme) {
        let html = document.querySelector('html');
        html.setAttribute('data-theme-color', 'dark');
    }
    if (localStorage.dashleadlandingrtl) {
        let html = document.querySelector('html');
        html.setAttribute('dir', 'rtl');
    }
}

"use strict";

let currentWidth;
(function () {

    currentWidth = [];

    var slideMenu = $('.side-menu');

    // Toggle Sidebar
    $(document).on('click', '[data-bs-toggle="sidebar"]', function (event) {
        event.preventDefault();
        if ($('.app').hasClass('sidenav-toggled')) {
            $('.app').removeClass('sidenav-toggled');
            if ((document.querySelector('html').getAttribute('data-vertical-style') === "doublemenu" || 
                document.querySelector('html').getAttribute('data-vertical-style') === "doublemenu-tabs") && 
                !document.querySelector('html').getAttribute('data-layout') === "horizontal") {
                if (document.querySelector('.slide-menu') && innerWidth >= 992) {
                    let slidemenu = document.querySelectorAll('.slide-menu');
                    slidemenu.forEach(e => {
                        if (e.classList.contains('double-menu-active')) {
                            e.classList.remove('double-menu-active')
                        }
                    })
                    let sidemenuActive = document.querySelector('.side-menu__item.active');
                    if (sidemenuActive?.nextElementSibling) {
                        let submenu = sidemenuActive.nextElementSibling;
                        submenu.classList.add('double-menu-active');
                        document.body.classList.remove('sidenav-toggled');
                    }
                    else {
                        document.body.classList.add('sidenav-toggled');
                    }
                }

            }
        } 
        else {
            $('.app').addClass('sidenav-toggled');
            if (innerWidth >= 992) {
                if ((document.querySelector('html').getAttribute('data-vertical-style') === "doublemenu" || 
                    document.querySelector('html').getAttribute('data-vertical-style') === "doublemenu-tabs") && 
                    !document.querySelector('html').getAttribute('data-layout') === "horizontal") {
                    if (document.querySelector('.slide-menu')) {
                        let slidemenu = document.querySelectorAll('.slide-menu');
                        slidemenu.forEach(e => {
                            if (e.classList.contains('double-menu-active')) {
                                e.classList.remove('double-menu-active')
                            }
                        })
                    }
                }
            }
        }
    });
    responsive();


    var toggleSidebar = function () {
        var w = $(window);
        if (w.outerWidth() <= 991) {
            $("body").addClass("sidebar-gone");
            $(document).off("click", "body").on("click", "body", function (e) {
                if ($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
                    $("body").removeClass("sidebar-show");
                    $("body").addClass("sidebar-gone");
                    $("body").removeClass("search-show");
                }
            });
        } else {
            $("body").removeClass("sidebar-gone");
        }
    }
    toggleSidebar();
    $(window).resize(toggleSidebar);

    //p-scroll
    const ps1 = new PerfectScrollbar('.app-sidebar', {
        useBothWheelAxes: true,
        suppressScrollX: true,
    });

    //sticky-header
    $(window).on("scroll", function (e) {
        if ($(window).scrollTop() >= 70) {
            $('.app-header').addClass('fixed-header');
            $('.app-header').addClass('visible-title');
        } else {
            $('.app-header').removeClass('fixed-header');
            $('.app-header').removeClass('visible-title');
        }
    });
    

})();

// page load active menu 
setTimeout(() => {
    if ($('.slide-item').hasClass('active')) {
        $('.app-sidebar').animate({
            scrollTop: $('a.slide-item.active').offset().top - 600
        }, 600);
    
    }
    if ($('.sub-side-menu__item').hasClass('active')) {
        $('.app-sidebar').animate({
            scrollTop: $('a.sub-side-menu__item.active').offset().top - 600
        }, 600);
    }
    
}, 200);

function responsive() {
    if (window.innerWidth >= 992) {
        if (document.querySelector("body").classList.contains("sidenav-toggled") && document.querySelector('html').getAttribute('data-layout') === "horizontal") {
            document.querySelector("body").classList.remove("sidenav-toggled")
        }
    }
    const mediaQuery = window.innerWidth;
    currentWidth.push(mediaQuery);
    if (currentWidth.length > 2) { currentWidth.shift() }
    if (currentWidth.length > 1) {
        if ((currentWidth[currentWidth.length - 1] < 992) && (currentWidth[currentWidth.length - 2] >= 992)) {
            // less than 992
        
        }
        
        if ((currentWidth[currentWidth.length - 1] >= 992) && (currentWidth[currentWidth.length - 2] < 992)) {
            // greater than 992
            
            if (document.querySelector('html').getAttribute('data-vertical-style') === "doublemenu" || document.querySelector('html').getAttribute('data-vertical-style') === "doublemenu-tabs") {
                document.body.classList.remove("sidenav-toggled");
            }
            if (document.querySelector('html').getAttribute('data-layout') === "horizontal") {
                let li = document.querySelectorAll('.side-menu li')
                li.forEach((e, i) => {
                    e.classList.remove('is-expanded')
                })
                var animationSpeed = 300;
                // first level
                var parent = $("[data-bs-toggle='sub-slide']").parents('ul');
                var ul = parent.find('ul.slide-menu:visible').slideUp(animationSpeed);
                ul.removeClass('open');
                var parent1 = $("[data-bs-toggle='sub-slide2']").parents('ul');
                var ul1 = parent1.find('ul.sub-slide-menu:visible').slideUp(animationSpeed);
                ul1.removeClass('open');
            }
        }
    }

}


//________________Horizontal js
jQuery(function () {
    'use strict';
    document.addEventListener("touchstart", function () { }, false);
    jQuery(function () {
        jQuery('body').wrapInner('<div class="horizontalMenucontainer" />');
    });

    
}());


// horizontal arrows
var sideMenu = $(".side-menu");
var slide = "100px";

let menuWidth = document.querySelector('.horizontal-main')
let menuItems = document.querySelector('.side-menu')

$(window).resize(
    () => {
        let menuWidth = document.querySelector('.horizontal-main');
        let menuItems = document.querySelector('.side-menu');
        let mainSidemenuWidth = document.querySelector('.main-sidemenu');
        let menuContainerWidth = menuWidth?.offsetWidth - mainSidemenuWidth?.offsetWidth;
        let marginLeftValue = Math.ceil(window.getComputedStyle(menuItems).marginLeft.split('px')[0]);
        let marginRightValue = Math.ceil(window.getComputedStyle(menuItems).marginRight.split('px')[0]);
        let check = menuItems.scrollWidth + (0 - menuWidth?.offsetWidth) + menuContainerWidth;
        // to check and adjst the menu on screen size change
        if ($('body').hasClass('ltr')) {
            if (marginLeftValue > -check == false && (menuWidth?.offsetWidth - menuContainerWidth) < menuItems.scrollWidth) {
                sideMenu.stop(false, true).animate({
                    marginLeft: -check
                }, {
                    duration: 400
                })
            }
            else {
                sideMenu.stop(false, true).animate({
                    marginLeft: 0
                }, {
                    duration: 400
                })
            }
        }
        else {
            if (marginRightValue > -check == false && menuWidth?.offsetWidth < menuItems.scrollWidth) {
                sideMenu.stop(false, true).animate({
                    marginRight: -check
                }, {
                    duration: 400
                })
            }
            else {
                sideMenu.stop(false, true).animate({
                    marginRight: 0
                }, {
                    duration: 400
                })
            }
        }
        responsive();
    }
)

// section menu active
function onScroll(event) {
    const sections = document.querySelectorAll(".side-menu__item");
    const scrollPos =
      window.pageYOffset ||
      document.documentElement.scrollTop ||
      document.body.scrollTop;
  
    sections.forEach((elem) => {
      const val = elem.getAttribute("href");
      let refElement;
      if (val != 'javascript:void(0)' && val !== "#") {
        refElement = document.querySelector(val);
      }
      const scrollTopMinus = scrollPos + 73;
      if (
        refElement?.offsetTop <= scrollTopMinus &&
        refElement?.offsetTop + refElement.offsetHeight > scrollTopMinus
      ) {
        elem.classList.add("active");
      } else {
        elem.classList.remove("active");
      }
    });
  }
  
  window.document.addEventListener("scroll", onScroll);
  
  jQuery(".demo-icon").click(function () {
    if ($(".demo_changer").hasClass("active")) {
      $(".demo_changer").animate({ "inset-inline-end": "-270px" }, function () {
        $(".demo_changer").toggleClass("active");
      });
    } else {
      $(".demo_changer").animate({ "inset-inline-end": "0px" }, function () {
        $(".demo_changer").toggleClass("active");
      });
    }
  });
function menuClick() {
    $("[data-bs-toggle='slide']").off('click');
    $("[data-bs-toggle='sub-slide']").off('click')
    $("[data-bs-toggle='sub-slide2']").off('click')
    $("[data-bs-toggle='slide']").on('click', function (e) {
  
      var $this = $(this);
      var checkElement = $this.next();
      var animationSpeed = 300,
        slideMenuSelector = '.slide-menu';
      if (checkElement.is(slideMenuSelector) && checkElement.is(':visible')) {
        checkElement.slideUp(animationSpeed, function () {
          checkElement.removeClass('open');
        });
        checkElement.parent("li").removeClass("is-expanded");
      }
      else if ((checkElement.is(slideMenuSelector)) && (!checkElement.is(':visible'))) {
        var parent = $this.parents('ul').first();
        var ul = parent.find('ul[class^="slide-menu"]:visible').slideUp(animationSpeed);
        ul.removeClass('open');
        var parent_li = $this.parent("li");
        checkElement.slideDown(animationSpeed, function () {
          checkElement.addClass('open');
          parent.find('li.is-expanded').removeClass('is-expanded');
          parent_li.addClass('is-expanded');
        });
      }
      if (checkElement.is(slideMenuSelector)) {
        e.preventDefault();
      }
  
  
      if (window.innerWidth >= 992) {
        if (!checkElement.hasClass('double-menu-active') && !document.body.classList.contains('horizontal') && (document.body.classList.contains('double-menu') || document.body.classList.contains('double-menu-tabs'))) {
  
          if (document.querySelector('.slide-menu')) {
            let slidemenu = document.querySelectorAll('.slide-menu');
            slidemenu.forEach(e => {
              if (e.classList.contains('double-menu-active')) {
                e.classList.remove('double-menu-active')
              }
            })
          }
  
          checkElement.addClass('double-menu-active');
          document.body.classList.remove("sidenav-toggled")
        }
      }
    });
    // Activate sidebar slide toggle	
    $("[data-bs-toggle='sub-slide']").on('click', function (e) {
      var $this = $(this);
      var checkElement = $this.next();
      var animationSpeed = 300,
        slideMenuSelector = '.sub-slide-menu';
      if (checkElement.is(slideMenuSelector) && checkElement.is(':visible')) {
        checkElement.slideUp(animationSpeed, function () {
          checkElement.removeClass('open');
        });
        checkElement.parent("li").removeClass("is-expanded");
      }
      else if ((checkElement.is(slideMenuSelector)) && (!checkElement.is(':visible'))) {
        var parent = $this.parents('ul').first();
        var ul = parent.find('ul[class^="sub-slide-menu"]:visible').slideUp(animationSpeed);
        ul.removeClass('open');
        var parent_li = $this.parent("li");
        checkElement.slideDown(animationSpeed, function () {
          checkElement.addClass('open');
          parent.find('li.is-expanded').removeClass('is-expanded');
          parent_li.addClass('is-expanded');
        });
      }
      if (checkElement.is(slideMenuSelector)) {
        e.preventDefault();
      }
    });
    // Activate sidebar slide toggle	
    $("[data-bs-toggle='sub-slide2']").on('click', function (e) {
      var $this = $(this);
      var checkElement = $this.next();
      var animationSpeed = 300,
        slideMenuSelector = '.sub-slide-menu2';
      if (checkElement.is(slideMenuSelector) && checkElement.is(':visible')) {
        checkElement.slideUp(animationSpeed, function () {
          checkElement.removeClass('open');
        });
        checkElement.parent("li").removeClass("is-expanded");
      }
      else if ((checkElement.is(slideMenuSelector)) && (!checkElement.is(':visible'))) {
        var parent = $this.parents('ul').first();
        var ul = parent.find('ul[class^="sub-slide-menu"]:visible').slideUp(animationSpeed);
        ul.removeClass('open');
        var parent_li = $this.parent("li");
        checkElement.slideDown(animationSpeed, function () {
          checkElement.addClass('open');
          parent.find('li.is-expanded').removeClass('is-expanded');
          parent_li.addClass('is-expanded');
        });
      }
      if (checkElement.is(slideMenuSelector)) {
        e.preventDefault();
      }
    });
  }
  menuClick();

    


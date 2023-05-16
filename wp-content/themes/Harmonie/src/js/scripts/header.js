jQuery.event.special.touchstart = {
    setup: function (_, ns, handle) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function (_, ns, handle) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
$(document).ready(function () {
    "use strict";
    /*----------------------------- Site Loader & Popup --------------------*/
    $(window).load(function () {
        $("#ec-overlay").fadeOut("slow");
    });

    /*--------------------- Search Bar On Focus -------------------------------- */
    $(".ec-search-bar").focus(function () {
        $(".ec-search-tab").addClass("active");
    });

    $(".ec-search-bar").focusout(function () {
        setTimeout(function () {
            $(".ec-search-tab").removeClass("active");
        }, 100);
    });

    /*----------------------------- Animate On Scroll --------------------*/
    var Animation = function ({ offset } = { offset: 10 }) {
        var _elements;

        // Define a dobra superior, inferior e laterais da tela
        var windowTop = offset * window.innerHeight / 100;
        var windowBottom = window.innerHeight - windowTop;
        var windowLeft = 0;
        var windowRight = window.innerWidth;

        function start(element) {
            // Seta os atributos customizados
            element.style.animationDelay = element.dataset.animationDelay;
            element.style.animationDuration = element.dataset.animationDuration;
            // Inicia a animacao setando a classe da animacao
            element.classList.add(element.dataset.animation);
            // Seta o elemento como animado
            element.dataset.animated = "true";
        }

        function isElementOnScreen(element) {
            // Obtem o boundingbox do elemento
            var elementRect = element.getBoundingClientRect();
            var elementTop =
                elementRect.top + parseInt(element.dataset.animationOffset) ||
                elementRect.top;
            var elementBottom =
                elementRect.bottom - parseInt(element.dataset.animationOffset) ||
                elementRect.bottom;
            var elementLeft = elementRect.left;
            var elementRight = elementRect.right;

            // Verifica se o elemento esta na tela
            return (
                elementTop <= windowBottom &&
                elementBottom >= windowTop &&
                elementLeft <= windowRight &&
                elementRight >= windowLeft
            );
        }
        var els = _elements = document.querySelectorAll(
            "[data-animation]:not([data-animated])"
        );
        // Percorre o array de elementos, verifica se o elemento está na tela e inicia animação
        function checkElementsOnScreen(_elements) {
            var els = _elements;
            for (var i = 0, len = els.length; i < len; i++) {
                // Passa para o proximo laço se o elemento ja estiver animado
                if (els[i].dataset.animated) continue;

                isElementOnScreen(els[i]) && start(els[i]);
            }
        }

        // Atualiza a lista de elementos a serem animados
        function update() {
            _elements = document.querySelectorAll(
                "[data-animation]:not([data-animated])"
            );
            checkElementsOnScreen(_elements);
        }

        // Inicia os eventos
        window.addEventListener("load", update, false);
        window.addEventListener("scroll", () => checkElementsOnScreen(_elements), { passive: true });
        window.addEventListener("resize", () => checkElementsOnScreen(_elements), false);

        // Retorna funcoes publicas
        return {
            start,
            isElementOnScreen,
            update
        };
    };

    // Initialize
    var options = {
        offset: 20 //percentage of window
    };

    var animation = new Animation(options);

    /*----------------------------- Stickey headre on scroll &&  Menu Fixed On Scroll Active  --------------------*/
    var doc = document.documentElement;
    var w = window;

    var ecprevScroll = w.scrollY || doc.scrollTop;
    var eccurScroll;
    var ecdirection = 0;
    var ecprevDirection = 0;
    var ecscroll_top = $(window).scrollTop() + 1;
    var echeader = document.getElementById('ec-main-menu-desk');

    var checkScroll = function () {

        eccurScroll = w.scrollY || doc.scrollTop;
        if (eccurScroll > ecprevScroll) {
            //scrolled up
            ecdirection = 2;
        }
        else if (eccurScroll < ecprevScroll) {
            //scrolled down
            ecdirection = 1;
        }

        if (ecdirection !== ecprevDirection) {
            toggleHeader(ecdirection, eccurScroll);
        }

        ecprevScroll = eccurScroll;
    };

    var toggleHeader = function (ecdirection, eccurScroll) {

        if (ecdirection === 2 && eccurScroll > 52) {
            // echeader.classList.add('hide');
            ecprevDirection = ecdirection;
            $("#ec-main-menu-desk").addClass("menu_fixed_up");
            // $("#ec-main-menu-desk").removeClass("menu_fixed");
        }
        else if (ecdirection === 1) {
            // echeader.classList.remove('hide');
            ecprevDirection = ecdirection;
            $("#ec-main-menu-desk").addClass("menu_fixed");
            $("#ec-main-menu-desk").removeClass("menu_fixed_up");
        }
    };

    $(window).on("scroll", function () {
        var distance = $('.sticky-header-next-sec').offset().top,
            $window = $(window);

        if ($window.scrollTop() <= distance + 50) {
            // alert("1");
            $("#ec-main-menu-desk").removeClass("menu_fixed");
        }
        else {
            // alert("2");
            checkScroll();
        }
    });


    /*----------------------------- Bootstrap dropdown   --------------------*/
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    });

    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    });


    /*----------------------------- Toggle Search Bar --------------------- */
    $(".search-btn").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_search').slideToggle('medium');
    });

    /*----------------------------- Sidebar js | Toggle Icon OnClick Open sidebar  -----------------------------------*/

    $(".ec-sidebar-toggle").on("click", function () {
        $(".ec-side-cat-overlay").fadeIn();
        $(".category-sidebar").addClass("ec-open");
    });

    $(".ec-close").on("click", function () {
        $(".category-sidebar").removeClass("ec-open");
        $(".ec-side-cat-overlay").fadeOut();
    });

    $(".ec-side-cat-overlay").on("click", function () {
        $(".category-sidebar").removeClass("ec-open");
        $(".ec-side-cat-overlay").fadeOut();
    });

    /*----------------------------- Side Bar Cart Toggle  -----------------------------------*/
    (function () {
        var $ekkaToggle = $(".ec-side-toggle"),
            $ekka = $(".ec-side-cart"),
            $ecMenuToggle = $(".mobile-menu-toggle");

        $ekkaToggle.on("click", function (e) {
            e.preventDefault();
            var $this = $(this),
                $target = $this.attr("href");
            // $("body").addClass("ec-open");
            $(".ec-side-cart-overlay").fadeIn();
            $($target).addClass("ec-open");
            if ($this.parent().hasClass("mobile-menu-toggle")) {
                $this.addClass("close");
                $(".ec-side-cart-overlay").fadeOut();
            }
        });

        $(".ec-side-cart-overlay").on("click", function (e) {
            $(".ec-side-cart-overlay").fadeOut();
            $ekka.removeClass("ec-open");
            $ecMenuToggle.find("a").removeClass("close");
        });

        $(".ec-close").on("click", function (e) {
            e.preventDefault();
            $(".ec-side-cart-overlay").fadeOut();
            $ekka.removeClass("ec-open");
            $ecMenuToggle.find("a").removeClass("close");
        });

        $("body").on("click", ".ec-pro-content .remove", function () {

            // $(".ec-pro-content .remove").on("click", function () {
            var $this = $(this);
            var cart_product_count = $(".eccart-pro-items li").length;
            var $theKey = $this.data('key');

            var cartPrice = $this.closest('.ec-pro-content').find('.cart-price span').text();
            var priceValue = parseFloat(cartPrice.split(' ')[0]);
            var qntyText = $this.closest('.ec-pro-content').find('.cart-price .qty').text();

            var qntyVal = parseFloat(qntyText);
            var totalText = $('.cart-sub-total .primary-color').text();
            var existingTotal = parseFloat(totalText.split(' ')[0]);

            var newTotal = existingTotal - (priceValue * qntyVal);
            console.log(qntyText);

            $.ajax({
                url: harmoniedata.root_url + "/wp-json/cocart/v2/cart/item/" + $theKey,
                type: 'DELETE',
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: (response) => {
                    console.log(response);
                    $(this).closest("li").remove();
                    $('.cart-sub-total .primary-color').text(newTotal.toFixed(2) + ' MAD');
                },
                error: (response) => {
                    console.log(response);
                }
            });


            if (cart_product_count == 1) {
                $('.eccart-pro-items').html('<li><p class="emp-cart-msg">Your cart is empty!</p></li>');
            }

            var count = $(".cart-count-lable").html();
            count--;
            $(".cart-count-lable").html(count);

            cart_product_count--;
        });

    })();

    /*----------------------------- ekka Responsive Menu -----------------------------------*/
    function ResponsiveMobileekkaMenu() {
        var $ekkaNav = $(".ec-menu-content, .overlay-menu"),
            $ekkaNavSubMenu = $ekkaNav.find(".sub-menu");
        $ekkaNavSubMenu.parent().prepend('<span class="menu-toggle"></span>');

        $ekkaNav.on("click", "li a, .menu-toggle", function (e) {
            var $this = $(this);
            if ($this.attr("href") === "#" || $this.hasClass("menu-toggle")) {
                e.preventDefault();
                if ($this.siblings("ul:visible").length) {
                    $this.parent("li").removeClass("active");
                    $this.siblings("ul").slideUp();
                    $this.parent("li").find("li").removeClass("active");
                    $this.parent("li").find("ul:visible").slideUp();
                } else {
                    $this.parent("li").addClass("active");
                    $this.closest("li").siblings("li").removeClass("active").find("li").removeClass("active");
                    $this.closest("li").siblings("li").find("ul:visible").slideUp();
                    $this.siblings("ul").slideDown();
                }
            }
        });
    }

    ResponsiveMobileekkaMenu();

    /*----------------------------- Qty Plus Minus Button  ------------------------------ */
    var QtyPlusMinus = $(".qty-plus-minus");
    QtyPlusMinus.prepend('<div class="dec ec_qtybtn">-</div>');
    QtyPlusMinus.append('<div class="inc ec_qtybtn">+</div>');

    $("body").on("click", ".ec_qtybtn", function () {
        var $qtybutton = $(this);
        var keyTag = $qtybutton.closest('.ec-pro-content').find('.remove');
        var itemKey = keyTag.data('key');
        var QtyoldValue = $qtybutton.parent().find("input").val();

        if ($qtybutton.text() === "+") {
            var QtynewVal = parseFloat(QtyoldValue) + 1;
        } else {

            if (QtyoldValue > 1) {
                var QtynewVal = parseFloat(QtyoldValue) - 1;
            } else {
                QtynewVal = 1;
            }
        }

        $qtybutton.parent().find("input").val(QtynewVal);

        if ($qtybutton.closest('#ec-side-cart').length) {
            $.ajax({
                url: harmoniedata.root_url + "/wp-json/cocart/v2/cart/item/" + itemKey,
                data: {
                    "quantity": QtynewVal.toString()
                },
                type: 'POST',
                success: (response) => {
                    console.log(response)
                },
                error: (response) => {
                    console.log(response)
                }
            });

        }
    });

    /*----------------------------- Scroll Up Button --------------------- */
    $.scrollUp({
        scrollText: '<i class="ecicon eci-arrow-up" aria-hidden="true"></i>',
        easingType: "linear",
        scrollSpeed: 900,
        animation: "fade",
    });
    /*----------------------------- Menu Active -------------------------------- */
    var current_page_URL = location.href;
    $(".ec-main-menu ul li a").each(function () {
        if ($(this).attr("href") !== "#") {
            var target_URL = $(this).prop("href");
            if (target_URL == current_page_URL) {
                $('.ec-main-menu a').parents('li, ul').removeClass('active');
                $(this).parent('li').addClass('active');
                return false;
            }
        }
    });

    /*----------------------------- Footer Toggle -------------------------------- */
    $(document).ready(function () {
        $("footer .footer-top .ec-footer-widget .ec-footer-links").addClass("ec-footer-dropdown");

        $('.ec-footer-heading').append("<div class='ec-heading-res'><i class='ecicon eci-angle-down'></i></div>");

        $(".ec-footer-heading .ec-heading-res").click(function () {
            var $this = $(this).closest('.footer-top .col-sm-12').find('.ec-footer-dropdown');
            $this.slideToggle('slow');
            $('.ec-footer-dropdown').not($this).slideUp('slow');
        });
    });
    /*----------------------------- List Grid View -------------------------------- */
    $('.ec-gl-btn').on('click', 'button', function () {
        var $this = $(this);
        $this.addClass('active').siblings().removeClass('active');
    });

    // for 100% width list view
    function showList(e) {
        var $gridCont = $('.shop-pro-inner');
        var $listView = $('.pro-gl-content');
        e.preventDefault();
        $gridCont.addClass('list-view');
        $listView.addClass('width-100');
    }

    function gridList(e) {
        var $gridCont = $('.shop-pro-inner');
        var $gridView = $('.pro-gl-content');
        e.preventDefault();
        $gridCont.removeClass('list-view');
        $gridView.removeClass('width-100');
    }

    $(document).on('click', '.btn-grid', gridList);
    $(document).on('click', '.btn-list', showList);

    // for 50% width list view
    function showList50(e) {
        var $gridCont = $('.shop-pro-inner');
        var $listView = $('.pro-gl-content');
        e.preventDefault();
        $gridCont.addClass('list-view-50');
        $listView.addClass('width-50');
    }

    function gridList50(e) {
        var $gridCont = $('.shop-pro-inner');
        var $gridView = $('.pro-gl-content');
        e.preventDefault();
        $gridCont.removeClass('list-view-50');
        $gridView.removeClass('width-50');
    }

    $(document).on('click', '.btn-grid-50', gridList50);
    $(document).on('click', '.btn-list-50', showList50);

    /*----------------------------- Whatsapp chat --------------------------------*/
    $(document).ready(function () {

        //click event on a tag
        $('.ec-list').on("click", function () {

            var number = $(this).attr("data-number");
            var message = $(this).attr("data-message");

            //checking for device type
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                // redirect link for mobile WhatsApp chat awc
                window.open('https://wa.me/' + number + '/?text=' + message, '-blank');
            }
            else {
                // redirect link for WhatsApp chat in website
                window.open('https://web.WhatsApp.com/send?phone=' + number + '&text=' + message, '-blank');
            }
        })

        // chat widget open/close duration
        $('ec-style1').launchBtn({ openDuration: 400, closeDuration: 300 });
    });

    // chat panel open/close function
    $.fn.launchBtn = function (options) {
        var mainBtn, panel, clicks, settings, launchPanelAnim, closePanelAnim, openPanel, boxClick;

        mainBtn = $(".ec-button");
        panel = $(".ec-panel");
        clicks = 0;

        //default settings
        settings = $.extend({
            openDuration: 600,
            closeDuration: 200,
            rotate: true
        }, options);

        //Open panel animation
        launchPanelAnim = function () {
            panel.animate({
                opacity: "toggle",
                height: "toggle"
            }, settings.openDuration);
        };

        //Close panel animation
        closePanelAnim = function () {
            panel.animate({
                opacity: "hide",
                height: "hide"
            }, settings.closeDuration);
        };

        //Open panel and rotate icon
        openPanel = function (e) {
            if (clicks === 0) {
                if (settings.rotate) {
                    $(this).removeClass('rotateBackward').toggleClass('rotateForward');
                }

                launchPanelAnim();
                clicks++;
            } else {
                if (settings.rotate) {
                    $(this).removeClass('rotateForward').toggleClass('rotateBackward');
                }

                closePanelAnim();
                clicks--;
            }
            e.preventDefault();
            return false;
        };

        //Allow clicking in panel
        boxClick = function (e) {
            e.stopPropagation();
        };

        //Main button click
        mainBtn.on('click', openPanel);

        //Prevent closing panel when clicking inside
        panel.click(boxClick);

        //Click away closes panel when clicked in document
        $(document).click(function () {
            closePanelAnim();
            if (clicks === 1) {
                mainBtn.removeClass('rotateForward').toggleClass('rotateBackward');
            }
            clicks = 0;
        });
    };


    /*----------------------------- Tools sidebar ---------------------- */
    $(".ec-tools-sidebar-toggle").on("click", function (e) {
        e.preventDefault();
        if ($(this).hasClass("in-out")) {
            $(".ec-tools-sidebar").stop().animate({ right: "0px" }, 100);
            $(".ec-tools-sidebar-overlay").fadeIn();
            if ($(".ec-tools-sidebar-toggle").not("in-out")) {
                $(".ec-tools-sidebar").stop().animate({ right: "-200px" }, 100);
                $(".ec-tools-sidebar-toggle").addClass("in-out");
                // $(".ec-tools-sidebar-overlay").fadeOut();
            }
            if ($(".ec-tools-sidebar-toggle").not("in-out")) {
                $(".ec-tools-sidebar").stop().animate({ right: "0" }, 100);
                $(".ec-tools-sidebar-toggle").addClass("in-out");
                $(".ec-tools-sidebar-overlay").fadeIn();
            }
        } else {
            $(".ec-tools-sidebar").stop().animate({ right: "-200px" }, 100);
            $(".ec-tools-sidebar-overlay").fadeOut();
        }

        $(this).toggleClass("in-out");
        return false;

    });
    $(".ec-tools-sidebar-overlay").on("click", function (e) {
        $(".ec-tools-sidebar-toggle").addClass("in-out");
        $(".ec-tools-sidebar").stop().animate({ right: "-200px" }, 100);
        $(".ec-tools-sidebar-overlay").fadeOut();
    });
});


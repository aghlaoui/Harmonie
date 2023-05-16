$(document).ready(function () {
    "use strict";
    /*----------------------------- Remove product on compare and wishlish page -----------------------------------*/
    $(document).ready(function () {
        $(".ec-remove-wish").on("click", function () {
            var wish_id = $(this).closest('.ec-pro-image').find('.ec-btn-group.wishlist').attr('data-wishid');
            var wishlistCount = parseInt($('.ec-header-wishlist .ec-header-count').first().text());
            $.ajax({
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('X-WP-nonce', harmoniedata.nonce)
                },
                url: harmoniedata.root_url + '/wp-json/ecommerce/v1/wishlist/',
                data: {
                    'wish_id': wish_id
                },
                type: 'DELETE',
                success: (response) => {
                    $(this).parents(".pro-gl-content").remove();
                    var wish_product_count = $(".pro-gl-content").length;
                    if (wish_product_count == 0) {
                        $('.ec-wish-rightside, .wish-empt').html('<p class="emp-wishlist-msg">Your wishlist is empty!</p>');
                    }
                    wishlistCount -= 1;
                    $('.ec-header-wishlist .ec-header-count').text(wishlistCount);
                    $('.ec-nav-panel-icons .wishlist-res').text(wishlistCount);
                    console.log(response);
                },
                error: (response) => {
                    console.log(response)
                }
            });
        });
    })


    $(".ec-remove-compare").on("click", function () {
        $(this).parents(".pro-gl-content").remove();
        var comp_product_count = $(".pro-gl-content").length;
        if (comp_product_count == 0) {
            $('.ec-compare-rightside').html('<p class="emp-wishlist-msg">Your Compare list is empty!</p>');
        }
    });
    /*----------------------------- Quick view Slider ------------------------------ */

    function quickViewSlider() {
        $('.qty-product-cover').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.qty-nav-thumb',
        });

        $('.qty-nav-thumb').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.qty-product-cover',
            dots: false,
            arrows: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 479,
                    settings: {
                        slidesToScroll: 1,
                        slidesToShow: 2,
                    }
                }
            ]
        });
    }
    quickViewSlider();
    /*----------------------------- Color Hover To Image Change -------------------------------- */
    var $ecproduct = $('.ec-pro-color, .ec-product-tab, .shop-pro-inner, .ec-new-product, .ec-releted-product, .ec-checkout-pro').find('.ec-opt-swatch');

    function initChangeImg($opt) {
        $opt.each(function () {
            var $this = $(this),
                ecChangeImg = $this.hasClass('ec-change-img');

            $this.on('mouseenter', 'li', function () {
                changeProductImg($(this));
            });

            $this.on('click', 'li', function () {
                changeProductImg($(this));
            });

            function changeProductImg(thisObj) {

                var $this = thisObj;
                var $load = $this.find('a');

                var $proimg = $this.closest('.ec-product-inner').find('.ec-pro-image');

                if (!$load.hasClass('loaded')) {
                    $proimg.addClass('pro-loading');
                }

                var $loaded = $this.find('a').addClass('loaded');

                $this.addClass('active').siblings().removeClass('active');
                if (ecChangeImg) {
                    hoverAddImg($this);
                }
                setTimeout(function () {
                    $proimg.removeClass("pro-loading");
                }, 1000);
                return false;
            }

        });
    }

    function hoverAddImg($this) {
        var $optData = $this.find('.ec-opt-clr-img'),
            $opImg = $optData.attr('data-src'),
            $opImgHover = $optData.attr('data-src-hover') || false,
            $optImgWrapper = $this.closest('.ec-product-inner').find('.ec-pro-image'),
            $optImgMain = $optImgWrapper.find('.image img.main-image'),
            $optImgMainHover = $optImgWrapper.find('.image img.hover-image');

        console.log($opImg.length);
        if ($opImg.length) {
            $optImgMain.attr('src', $opImg);
        }
        if ($opImg.length) {
            var checkDisable = $optImgMainHover.closest('img.hover-image');
            $optImgMainHover.attr('src', $opImgHover);
            if (checkDisable.hasClass('disable')) {
                checkDisable.removeClass('disable');
            }
        }
        if ($opImgHover === false) {
            $optImgMainHover.closest('img.hover-image').addClass('disable');
        }
    }

    $(window).on('load', function () {
        initChangeImg($ecproduct);
    });

    $(document).ready(function () {
        initChangeImg($ecproduct);
    });

    /*----------------------------- Size Hover To Active -------------------------------- */
    $('.ec-opt-size').each(function () {
        $(document).on('mouseenter', 'li', function () {
            // alert("1");
            onSizeChange($(this));
        });

        $(document).on('click', 'li', function () {
            // alert("2");
            onSizeChange($(this));
        });

        function onSizeChange(thisObj) {
            // alert("3");
            var $this = thisObj;
            var $old_data = $this.find('a').attr('data-old');
            var $new_data = $this.find('a').attr('data-new');
            var $old_price = $this.closest('.ec-pro-content').find('.old-price');
            var $new_price = $this.closest('.ec-pro-content').find('.new-price');

            $old_price.text($old_data);
            $new_price.text($new_data);

            $this.addClass('active').siblings().removeClass('active');
        }
    });
    /*----------------------------- Cart  Shipping Toggle -------------------------------- */
    $(document).ready(function () {
        $(document).on("click", ".ec-sb-block-content .ec-ship-title", function () {
            $('.ec-sb-block-content .ec-cart-form').slideToggle('slow');
        });
    });

    $(document).ready(function () {
        // $("button.add-to-cart").click(function () {
        //     $("#addtocart_toast").addClass("show");
        //     setTimeout(function () { $("#addtocart_toast").removeClass("show") }, 3000);
        // });
        $(document).on("click", ".ec-btn-group.wishlist", function () {
            var isWishlist = $(this).hasClass("active");
            var parentTag = $(this).closest('.ec-pro-actions');
            var wishlistCount = parseInt($('.ec-header-wishlist .ec-header-count').first().text());

            if (isWishlist) { // Remove Item From The Wishlist 
                $.ajax({
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader('X-WP-nonce', harmoniedata.nonce)
                    },
                    url: harmoniedata.root_url + '/wp-json/ecommerce/v1/wishlist/',
                    data: {
                        'wish_id': $(this).attr('data-wishid')
                    },
                    type: 'DELETE',
                    success: (response) => {
                        $(this).removeClass("active");
                        wishlistCount -= 1;
                        $('.ec-header-wishlist .ec-header-count').text(wishlistCount);
                        $('.ec-nav-panel-icons .wishlist-res').text(wishlistCount);
                        console.log(response);
                    },
                    error: (response) => {
                        console.log(response)
                    }
                });
            } else { // Add Item To Wishlist
                $.ajax({
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader('X-WP-nonce', harmoniedata.nonce)
                    },
                    url: harmoniedata.root_url + '/wp-json/ecommerce/v1/wishlist/',
                    data: {
                        'product_id': parentTag.attr('data-id')
                    },
                    type: 'POST',
                    success: (response) => {
                        $(this).addClass("active");
                        $(this).attr('data-wishid', response);
                        wishlistCount += 1;
                        $('.ec-header-wishlist .ec-header-count').text(wishlistCount);
                        $('.ec-nav-panel-icons .wishlist-res').text(wishlistCount);
                        console.log(response)
                    },
                    error: (response) => {
                        if (response.responseText == 'limits reached') {
                            $(".myAlert-top").html('Vous avez atteint la limite de produits.');
                            $(".myAlert-top").show();
                            setTimeout(function () {
                                $(".myAlert-top").hide();
                            }, 2000);
                        } else if (response.responseText == 'user not loged in') {
                            $(".myAlert-top").html('Vous n êtes pas connecté. <a href=" ' + harmoniedata.root_url + '/login" class="alert-link">Se connecter</a>');
                            $(".myAlert-top").show();
                            setTimeout(function () {
                                $(".myAlert-top").hide();
                            }, 7000);
                        }
                        console.log(response)
                    }
                });
            }


            $("#wishlist_toast").addClass("show");
            setTimeout(function () { $("#wishlist_toast").removeClass("show") }, 3000);
        });
    });

    $(document).ready(function () {
        $('.ec-pro-image').append("<div class='ec-pro-loader'></div>");
    });

    // Quick View Modal Function 
    function quickViewSlider() {
        $('.qty-product-cover').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.qty-nav-thumb',
        });

        $('.qty-nav-thumb').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.qty-product-cover',
            dots: false,
            arrows: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 479,
                    settings: {
                        slidesToScroll: 1,
                        slidesToShow: 2,
                    }
                }
            ]
        });
    }

    function VariationColorHover() {
        var $ecproduct = $('.ec-pro-color, .ec-product-tab, .shop-pro-inner, .ec-new-product, .ec-releted-product, .ec-checkout-pro').find('.ec-opt-swatch');

        function initChangeImg($opt) {
            $opt.each(function () {
                var $this = $(this),
                    ecChangeImg = $this.hasClass('ec-change-img');

                $this.on('mouseenter', 'li', function () {
                    changeProductImg($(this));
                });

                $this.on('click', 'li', function () {
                    changeProductImg($(this));
                });

                function changeProductImg(thisObj) {

                    var $this = thisObj;
                    var $load = $this.find('a');

                    var $proimg = $this.closest('.ec-product-inner').find('.ec-pro-image');

                    if (!$load.hasClass('loaded')) {
                        $proimg.addClass('pro-loading');
                    }

                    var $loaded = $this.find('a').addClass('loaded');

                    $this.addClass('active').siblings().removeClass('active');
                    if (ecChangeImg) {
                        hoverAddImg($this);
                    }
                    setTimeout(function () {
                        $proimg.removeClass("pro-loading");
                    }, 1000);
                    return false;
                }

            });
        }

        function hoverAddImg($this) {
            var $optData = $this.find('.ec-opt-clr-img'),
                $opImg = $optData.attr('data-src'),
                $opImgHover = $optData.attr('data-src-hover') || false,
                $optImgWrapper = $this.closest('.ec-product-inner').find('.ec-pro-image'),
                $optImgMain = $optImgWrapper.find('.image img.main-image'),
                $optImgMainHover = $optImgWrapper.find('.image img.hover-image');

            console.log($opImg.length);
            if ($opImg.length) {
                $optImgMain.attr('src', $opImg);
            }
            if ($opImg.length) {
                var checkDisable = $optImgMainHover.closest('img.hover-image');
                $optImgMainHover.attr('src', $opImgHover);
                if (checkDisable.hasClass('disable')) {
                    checkDisable.removeClass('disable');
                }
            }
            if ($opImgHover === false) {
                $optImgMainHover.closest('img.hover-image').addClass('disable');
            }
        }

        $(window).on('load', function () {
            initChangeImg($ecproduct);
        });

        $(document).ready(function () {
            initChangeImg($ecproduct);
        });

    }

    /***************************** Modal Add To Cart Button **************************/
    $("body").on("click", ".modal-add-to-cart", function () {
        // values declaration
        var img_url = '';
        var $this = $(this);
        var init_img_url = $this.closest('.row').find(".qty-product-cover").find(".img-responsive").eq(0).attr("src");
        if (init_img_url) {
            img_url = init_img_url;
        } else {
            img_url = $this.closest('.row').find(".qty-product-cover").find(".img-responsive").attr("src");
        }
        var p_name = $this.closest('.quickview-pro-content').find(".ec-quick-title").children("a").html();
        var p_price = $this.closest('.quickview-pro-content').find(".ec-quickview-price").children(".new-price").html();
        var p_qty = $this.closest('.ec-quickview-qty').find('.qty-plus-minus input').val();

        function OurClickDispatcher(key) {
            $(".ec-cart-float").fadeIn();

            var count = $(".cart-count-lable").html();
            count++;

            $(".cart-count-lable").html(count);

            // Remove Empty message    
            $(".emp-cart-msg").parent().remove();

            setTimeout(function () {
                $(".ec-cart-float").fadeOut();
            }, 5000);

            // get an image url

            var p_html = '<li>' +
                '<a href="product-left-sidebar.html" class="sidekka_pro_img"><img src="' + img_url + '" alt="product"></a>' +
                '<div class="ec-pro-content">' +
                '<a href="product-left-sidebar.html" class="cart_pro_title">' + p_name + '</a>' +
                '<span class="cart-price"><span>' + p_price + '</span> x <p class="qty" style="display: inline-flex;">' + p_qty + '</p></span>' +
                '<div class="qty-plus-minus"><div class="dec ec_qtybtn">-</div>' +
                '<input class="qty-input" type="text" name="ec_qtybtn" value="' + p_qty + '">' +
                '<div class="inc ec_qtybtn">+</div></div>' +
                '<a href="javascript:void(0)" class="remove" data-key="' + key + '">×</a>' +
                '</div>' +
                '</li>';

            $('.eccart-pro-items').append(p_html);

            var totalText = $('.cart-sub-total .primary-color').text();
            var existingTotal = parseFloat(totalText.split(' ')[0]);
            var newTotal = (existingTotal + parseFloat(p_price)) * parseFloat(p_qty);
            $('.cart-sub-total .primary-color').text(newTotal.toFixed(2) + ' MAD');
        }
        if ($this.data('type') == 'simple') {
            $.ajax({
                url: harmoniedata.root_url + "/wp-json/cocart/v2/cart/add-item",
                data: {
                    "id": $this.data('id'),
                    "quantity": p_qty
                },
                type: 'POST',
                success: (response) => {
                    var itemKey = response.items[response.items.length - 1].item_key;
                    OurClickDispatcher(itemKey);
                    console.log(response);
                },
                error: (response) => {
                    console.log(response)
                }
            })
        }

    });

    $("body").on("click", ".add-to-cart", function () {
        // values declaration
        var $this = $(this);
        var img_url = $this.parents().parents().children(".image").find(".main-image").attr("src");
        var p_name = $this.parents().parents().parents().children(".ec-pro-content").children("h5").children("a").html();
        var p_price = $this.parents().parents().parents().children(".ec-pro-content").children(".ec-price").children(".new-price").html();


        function OurClickDispatcher(key) {
            $(".ec-cart-float").fadeIn();

            var count = $(".cart-count-lable").html();
            count++;

            $(".cart-count-lable").html(count);

            // Remove Empty message    
            $(".emp-cart-msg").parent().remove();

            setTimeout(function () {
                $(".ec-cart-float").fadeOut();
            }, 5000);

            // get an image url

            var p_html = '<li>' +
                '<a href="product-left-sidebar.html" class="sidekka_pro_img"><img src="' + img_url + '" alt="product"></a>' +
                '<div class="ec-pro-content">' +
                '<a href="product-left-sidebar.html" class="cart_pro_title">' + p_name + '</a>' +
                '<span class="cart-price"><span>' + p_price + '</span> x <p class="qty" style="display: inline-flex;">1</p></span>' +
                '<div class="qty-plus-minus"><div class="dec ec_qtybtn">-</div>' +
                '<input class="qty-input" type="text" name="ec_qtybtn" value="1">' +
                '<div class="inc ec_qtybtn">+</div></div>' +
                '<a href="javascript:void(0)" class="remove" data-key="' + key + '">×</a>' +
                '</div>' +
                '</li>';

            $('.eccart-pro-items').append(p_html);

            var totalText = $('.cart-sub-total .primary-color').text();
            var existingTotal = parseFloat(totalText.split(' ')[0]);
            var newTotal = existingTotal + parseFloat(p_price);
            $('.cart-sub-total .primary-color').text(newTotal.toFixed(2) + ' MAD');
        }
        if ($this.data('type') == 'simple') {
            $.ajax({
                url: harmoniedata.root_url + "/wp-json/cocart/v2/cart/add-item",
                data: {
                    "id": $this.data('id'),
                    "quantity": "1"
                },
                type: 'POST',
                success: (response) => {
                    var itemKey = response.items[response.items.length - 1].item_key;
                    OurClickDispatcher(itemKey);
                    console.log(response);
                },
                error: (response) => {
                    console.log(response)
                }
            })
        }

    });
});
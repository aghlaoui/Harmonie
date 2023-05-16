
$(document).ready(function () {
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

    //Variation Buttons 
    function VariationSizeHover() {
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
    }
    // Color Change When Hover 

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



    var id = '';
    var sizeID = '';
    $('.ec-sidebar-block-item.item-category input').on('click', function () {
        $('.item-category input').prop('checked', false);
        $(this).prop('checked', true);

        id = $(this).siblings('a').data('id');

    });

    $('.ec-sidebar-block-item.item-size input').on('click', function () {
        $('.item-size input').not(this).prop('checked', false);

        if ($(this).prop('checked')) {
            sizeID = $(this).siblings('a').data('sid');
        } else {
            sizeID = '';
        }
    });
    var colorID = '';
    $('.ec-sidebar-block-item.item-color span').on('click', function () {
        colorID = $(this).data('colorid');
    });

    // Select the element
    const slider = $('#ec-sliderPrice')[0];
    let priceMin = 0;
    let priceMax = 250;
    // Create a new MutationObserver
    const observer = new MutationObserver((mutationsList) => {
        for (const mutation of mutationsList) {
            if (mutation.type === 'attributes') {
                if (mutation.attributeName === 'data-min') {
                    // Handle data-min change
                    const newMinValue = mutation.target.dataset.min;
                    priceMin = newMinValue;
                }
                else if (mutation.attributeName === 'data-max') {
                    // Handle data-max change
                    const newMaxValue = mutation.target.dataset.max;
                    priceMax = newMaxValue;
                }

            }
        }
    });

    // Start observing the element for attribute changes
    if (slider) {
        observer.observe(slider, { attributes: true });
    }

    // Get The Valur Of S 
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
    var searchTerm = getUrlParameter('s');

    $('.ec-sidebar-block-item input, .ec-sidebar-block-item span, .ec-price-input .filter-btn').on('click', function () {
        $('.ec-pro-pagination').hide();
        var spinner = $('.filter-product-spinner');

        if (id == '' && sizeID == '' && colorID == '' && priceMin == '' && priceMax == '') {
            $('.ec-pro-pagination').show();
        }

        $('.products-rows-items').empty();

        spinner.show();
        $.ajax({
            type: 'POST',
            url: harmoniedata.root_url + '/wp-admin/admin-ajax.php',
            dataType: 'html',
            data: {
                action: 'filter_projects',
                id: id,
                sizeid: sizeID,
                colorid: colorID,
                pricemax: priceMax,
                pricemin: priceMin,
                search: searchTerm
            },
            success: function (res) {
                $('.products-rows-items').html(res);
                spinner.hide();
                quickViewSlider();
                VariationSizeHover();
                VariationColorHover();
            }
        })
    });


    /***************************** Modal Add To Cart Button **************************/
    $("body").on("click", ".modal-add-to-cart", function () {
        // values declaration
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
});



!function(){var s={311:function(e){"use strict";e.exports=jQuery}},a={};function o(e){var t=a[e];return void 0!==t||(t=a[e]={exports:{}},s[e](t,t.exports,o)),t.exports}var r;(r=o(311))(document).ready(function(){"use strict";r(document).ready(function(){r(".ec-remove-wish").on("click",function(){var e=r(this).closest(".ec-pro-image").find(".ec-btn-group.wishlist").attr("data-wishid"),t=parseInt(r(".ec-header-wishlist .ec-header-count").first().text());r.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-nonce",harmoniedata.nonce)},url:harmoniedata.root_url+"/wp-json/ecommerce/v1/wishlist/",data:{wish_id:e},type:"DELETE",success:e=>{r(this).parents(".pro-gl-content").remove(),0==r(".pro-gl-content").length&&r(".ec-wish-rightside, .wish-empt").html('<p class="emp-wishlist-msg">Your wishlist is empty!</p>'),--t,r(".ec-header-wishlist .ec-header-count").text(t),r(".ec-nav-panel-icons .wishlist-res").text(t),console.log(e)},error:e=>{console.log(e)}})})}),r(".ec-remove-compare").on("click",function(){r(this).parents(".pro-gl-content").remove(),0==r(".pro-gl-content").length&&r(".ec-compare-rightside").html('<p class="emp-wishlist-msg">Your Compare list is empty!</p>')}),r(".qty-product-cover").slick({slidesToShow:1,slidesToScroll:1,arrows:!1,fade:!1,asNavFor:".qty-nav-thumb"}),r(".qty-nav-thumb").slick({slidesToShow:4,slidesToScroll:1,asNavFor:".qty-product-cover",dots:!1,arrows:!0,focusOnSelect:!0,responsive:[{breakpoint:479,settings:{slidesToScroll:1,slidesToShow:2}}]});var e=r(".ec-pro-color, .ec-product-tab, .shop-pro-inner, .ec-new-product, .ec-releted-product, .ec-checkout-pro").find(".ec-opt-swatch");function t(e){e.each(function(){var e=r(this),c=e.hasClass("ec-change-img");function t(e){var t,s,a=e.find("a"),o=e.closest(".ec-product-inner").find(".ec-pro-image");a.hasClass("loaded")||o.addClass("pro-loading"),e.find("a").addClass("loaded");e.addClass("active").siblings().removeClass("active"),c&&(t=(e=(a=e).find(".ec-opt-clr-img")).attr("data-src"),e=e.attr("data-src-hover")||!1,s=(a=a.closest(".ec-product-inner").find(".ec-pro-image")).find(".image img.main-image"),a=a.find(".image img.hover-image"),console.log(t.length),t.length&&s.attr("src",t),t.length&&(s=a.closest("img.hover-image"),a.attr("src",e),s.hasClass("disable"))&&s.removeClass("disable"),!1===e)&&a.closest("img.hover-image").addClass("disable"),setTimeout(function(){o.removeClass("pro-loading")},1e3)}e.on("mouseenter","li",function(){t(r(this))}),e.on("click","li",function(){t(r(this))})})}r(window).on("load",function(){t(e)}),r(document).ready(function(){t(e)}),r(".ec-opt-size").each(function(){function e(e){var t=e.find("a").attr("data-old"),s=e.find("a").attr("data-new"),a=e.closest(".ec-pro-content").find(".old-price"),o=e.closest(".ec-pro-content").find(".new-price");a.text(t),o.text(s),e.addClass("active").siblings().removeClass("active")}r(document).on("mouseenter","li",function(){e(r(this))}),r(document).on("click","li",function(){e(r(this))})}),r(document).ready(function(){r(document).on("click",".ec-sb-block-content .ec-ship-title",function(){r(".ec-sb-block-content .ec-cart-form").slideToggle("slow")})}),r(document).ready(function(){r(document).on("click",".ec-btn-group.wishlist",function(){var e=r(this).hasClass("active"),t=r(this).closest(".ec-pro-actions"),s=parseInt(r(".ec-header-wishlist .ec-header-count").first().text());e?r.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-nonce",harmoniedata.nonce)},url:harmoniedata.root_url+"/wp-json/ecommerce/v1/wishlist/",data:{wish_id:r(this).attr("data-wishid")},type:"DELETE",success:e=>{r(this).removeClass("active"),--s,r(".ec-header-wishlist .ec-header-count").text(s),r(".ec-nav-panel-icons .wishlist-res").text(s),console.log(e)},error:e=>{console.log(e)}}):r.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-nonce",harmoniedata.nonce)},url:harmoniedata.root_url+"/wp-json/ecommerce/v1/wishlist/",data:{product_id:t.attr("data-id")},type:"POST",success:e=>{r(this).addClass("active"),r(this).attr("data-wishid",e),s+=1,r(".ec-header-wishlist .ec-header-count").text(s),r(".ec-nav-panel-icons .wishlist-res").text(s),console.log(e)},error:e=>{"limits reached"==e.responseText?(r(".myAlert-top").html("Vous avez atteint la limite de produits."),r(".myAlert-top").show(),setTimeout(function(){r(".myAlert-top").hide()},2e3)):"user not loged in"==e.responseText&&(r(".myAlert-top").html('Vous n êtes pas connecté. <a href=" '+harmoniedata.root_url+'/login" class="alert-link">Se connecter</a>'),r(".myAlert-top").show(),setTimeout(function(){r(".myAlert-top").hide()},7e3)),console.log(e)}}),r("#wishlist_toast").addClass("show"),setTimeout(function(){r("#wishlist_toast").removeClass("show")},3e3)})}),r(document).ready(function(){r(".ec-pro-image").append("<div class='ec-pro-loader'></div>")}),r("body").on("click",".modal-add-to-cart",function(){var a="",e=r(this),t=e.closest(".row").find(".qty-product-cover").find(".img-responsive").eq(0).attr("src"),a=t||e.closest(".row").find(".qty-product-cover").find(".img-responsive").attr("src"),o=e.closest(".quickview-pro-content").find(".ec-quick-title").children("a").html(),c=e.closest(".quickview-pro-content").find(".ec-quickview-price").children(".new-price").html(),i=e.closest(".ec-quickview-qty").find(".qty-plus-minus input").val();"simple"==e.data("type")&&r.ajax({url:harmoniedata.root_url+"/wp-json/cocart/v2/cart/add-item",data:{id:e.data("id"),quantity:i},type:"POST",success:e=>{var t,s=e.items[e.items.length-1].item_key;s=s,r(".ec-cart-float").fadeIn(),t=r(".cart-count-lable").html(),t++,r(".cart-count-lable").html(t),r(".emp-cart-msg").parent().remove(),setTimeout(function(){r(".ec-cart-float").fadeOut()},5e3),t='<li><a href="product-left-sidebar.html" class="sidekka_pro_img"><img src="'+a+'" alt="product"></a><div class="ec-pro-content"><a href="product-left-sidebar.html" class="cart_pro_title">'+o+'</a><span class="cart-price"><span>'+c+'</span> x <p class="qty" style="display: inline-flex;">'+i+'</p></span><div class="qty-plus-minus"><div class="dec ec_qtybtn">-</div><input class="qty-input" type="text" name="ec_qtybtn" value="'+i+'"><div class="inc ec_qtybtn">+</div></div><a href="javascript:void(0)" class="remove" data-key="'+s+'">×</a></div></li>',r(".eccart-pro-items").append(t),s=r(".cart-sub-total .primary-color").text(),t=(parseFloat(s.split(" ")[0])+parseFloat(c))*parseFloat(i),r(".cart-sub-total .primary-color").text(t.toFixed(2)+" MAD"),console.log(e)},error:e=>{console.log(e)}})}),r("body").on("click",".add-to-cart",function(){var e=r(this),a=e.parents().parents().children(".image").find(".main-image").attr("src"),o=e.parents().parents().parents().children(".ec-pro-content").children("h5").children("a").html(),c=e.parents().parents().parents().children(".ec-pro-content").children(".ec-price").children(".new-price").html();"simple"==e.data("type")&&r.ajax({url:harmoniedata.root_url+"/wp-json/cocart/v2/cart/add-item",data:{id:e.data("id"),quantity:"1"},type:"POST",success:e=>{var t,s=e.items[e.items.length-1].item_key;s=s,r(".ec-cart-float").fadeIn(),t=r(".cart-count-lable").html(),t++,r(".cart-count-lable").html(t),r(".emp-cart-msg").parent().remove(),setTimeout(function(){r(".ec-cart-float").fadeOut()},5e3),t='<li><a href="product-left-sidebar.html" class="sidekka_pro_img"><img src="'+a+'" alt="product"></a><div class="ec-pro-content"><a href="product-left-sidebar.html" class="cart_pro_title">'+o+'</a><span class="cart-price"><span>'+c+'</span> x <p class="qty" style="display: inline-flex;">1</p></span><div class="qty-plus-minus"><div class="dec ec_qtybtn">-</div><input class="qty-input" type="text" name="ec_qtybtn" value="1"><div class="inc ec_qtybtn">+</div></div><a href="javascript:void(0)" class="remove" data-key="'+s+'">×</a></div></li>',r(".eccart-pro-items").append(t),s=r(".cart-sub-total .primary-color").text(),t=parseFloat(s.split(" ")[0])+parseFloat(c),r(".cart-sub-total .primary-color").text(t.toFixed(2)+" MAD"),console.log(e)},error:e=>{console.log(e)}})})})}();
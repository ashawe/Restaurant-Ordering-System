/*! js-cookie v3.0.1 | MIT */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self,function(){var n=e.Cookies,o=e.Cookies=t();o.noConflict=function(){return e.Cookies=n,o}}())}(this,(function(){"use strict";function e(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)e[o]=n[o]}return e}return function t(n,o){function r(t,r,i){if("undefined"!=typeof document){"number"==typeof(i=e({},o,i)).expires&&(i.expires=new Date(Date.now()+864e5*i.expires)),i.expires&&(i.expires=i.expires.toUTCString()),t=encodeURIComponent(t).replace(/%(2[346B]|5E|60|7C)/g,decodeURIComponent).replace(/[()]/g,escape);var c="";for(var u in i)i[u]&&(c+="; "+u,!0!==i[u]&&(c+="="+i[u].split(";")[0]));return document.cookie=t+"="+n.write(r,t)+c}}return Object.create({set:r,get:function(e){if("undefined"!=typeof document&&(!arguments.length||e)){for(var t=document.cookie?document.cookie.split("; "):[],o={},r=0;r<t.length;r++){var i=t[r].split("="),c=i.slice(1).join("=");try{var u=decodeURIComponent(i[0]);if(o[u]=n.read(c,u),e===u)break}catch(e){}}return e?o[e]:o}},remove:function(t,n){r(t,"",e({},n,{expires:-1}))},withAttributes:function(n){return t(this.converter,e({},this.attributes,n))},withConverter:function(n){return t(e({},this.converter,n),this.attributes)}},{attributes:{value:Object.freeze(o)},converter:{value:Object.freeze(n)}})}({read:function(e){return'"'===e[0]&&(e=e.slice(1,-1)),e.replace(/(%[\dA-F]{2})+/gi,decodeURIComponent)},write:function(e){return encodeURIComponent(e).replace(/%(2[346BF]|3[AC-F]|40|5[BDE]|60|7[BCD])/g,decodeURIComponent)}},{path:"/"})}));

// disable mousewheel on a input number field when in focus
// (to prevent Cromium browsers change the value when scrolling)
$('form').on('focus', 'input[type=number]', function (e) {
    $(this).on('wheel.disableScroll', function (e) {
        e.preventDefault()
    })
})
$('form').on('blur', 'input[type=number]', function (e) {
    $(this).off('wheel.disableScroll')
})

$('.btn-minuse').on('click', function () {
    var MIN = 1;
    old_val = parseInt($(this).parent().siblings('input').val());

    var food_id = $(this).attr('id');
    var cart_cookie = Cookies.get('cart');
    if(cart_cookie == undefined)
    // food_id : count
        var obj = {};
    else
        var obj = JSON.parse(cart_cookie);
    obj[food_id] = old_val > MIN ? old_val - 1 : old_val;

    // if the val is 1 and they want to convert it to 0, remove the item from cart
    if (old_val == MIN) {
        $(this).parent().parent().siblings('.cart-add')[0].dataset['toggle'] = "on";
        $(this).parent().parent().siblings('.cart-add').removeClass('d-none');
        $(this).parent().parent().addClass('d-none');
        // @ToDo: Remove Item from Cart
        generateToast("rem-cart" + ran(), "Item removed from cart!", "danger"); // adding random id to generate more than 1 toasts 
        delete obj[food_id];
    }
    $(this).parent().siblings('input').val(old_val > MIN ? old_val - 1 : old_val)
    cart_cookie = JSON.stringify(obj);

    // if no entries in object, remove the cookie
    if(Object.keys(obj).length === 0)
    {
        console.log('here');
        Cookies.remove('cart');
    }
    else
        // else set the cookie like normal
        Cookies.set('cart',cart_cookie);
})

$('.btn-pluss').on('click', function () {
    var MAX = 10;
    old_val = parseInt($(this).parent().siblings('input').val());
    $(this).parent().siblings('input').val(old_val < MAX ? old_val + 1 : old_val);

    var food_id = $(this).attr('id');
    var cart_cookie = Cookies.get('cart');
    if(cart_cookie == undefined)
    // food_id : count
        var obj = {};
    else
        var obj = JSON.parse(cart_cookie);
    obj[food_id] = old_val < MAX ? old_val + 1 : old_val;
    cart_cookie = JSON.stringify(obj);
    Cookies.set('cart',cart_cookie);
});

$('.cart-add').on('click', function () {
    // default -> show add to cart button
    // if clicked -> remove add to cart and disp qty
    if ($(this)[0].dataset['toggle'] == "on") {
        $(this)[0].dataset['toggle'] = "off";
        $(this).siblings('.cart-qty').removeClass('d-none');
        $(this).addClass('d-none');
        
        // @ToDo: Add item to cart
        var food_id = $(this).attr('id');
        var cart_cookie = Cookies.get('cart');
        // food_id : count
        if(cart_cookie == undefined)
            var obj = {};
        else
            var obj = JSON.parse(cart_cookie);

        obj[food_id] = 1;
        cart_cookie = JSON.stringify(obj);
        Cookies.set('cart',cart_cookie);
        
        generateToast("added-cart" + ran(), "Item added to cart!", "success");    // adding random id to generate more than 1 toasts 
    }
})

// gives random number for id
function ran() {
    return Math.floor(Math.random() * 1000);
}

// generates a toast message and removes its html after the toast is hidden. id is used as toast's element id, message is what's shown, status = {primary,danger,success,warning,...}
function generateToast(id, message, state) {
    var toastHTML = '<div id ="' + id + '" class="toast align-items-center text-white bg-' + state + ' border-0" data-bs-delay="2000" role="alert" aria-live="assertive" aria-atomic="true"><div class="d-flex"><div class="toast-body">' + message + '</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>';
    $('.toast-container').append(toastHTML);
    $('#' + id).toast('show');
    $("#" + id).on("hidden.bs.toast", function () {
        $('#' + id).remove();
    });
}

$('.btn-order-next').on('click', function () {

    var current = ($(this).html()).split(" ")[2];

    switch (current) {
        case "Accepted":
            // change button text
            $(this).html("Mark as Preparing");

            // change button color
            $(this).removeClass('btn-warning text-dark');
            $(this).addClass('btn-primary');

            // move to accepted
            var card = $(this).parent().parent().parent().parent();
            $('#accepted-order-container').append(card);
            generateToast("accepted" + ran(), "Order Marked as Accepted", "warning");
            break;

        case "Preparing":
            // change button text
            $(this).html("Mark as Completed");

            // change button color and accept->prepare
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-success');

            // move to accepted
            var card = $(this).parent().parent().parent().parent();
            $('#preparing-order-container').append(card);
            generateToast("accepted" + ran(), "Order Marked as Preparing", "primary");
            break;

        default:
            if (confirm("Are you sure?")) {
                $(this).parent().parent().parent().parent().remove();
                generateToast("accepted" + ran(), $(this).html() === "Remove" ? "Order Removed" : "Order Marked as Completed", "success");
            }
    }
});
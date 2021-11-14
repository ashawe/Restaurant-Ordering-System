// var startSessionModal = document.getElementById('startSessionModal');
// var ssModalInput = document.getElementById('ssModalInput');

// startSessionModal.addEventListener('shown.bs.modal', function () {
//     ssModalInput.focus()
// });

// $('.collapse').collapse()

$('.btn-minuse').on('click', function () {
    var MIN = 1;
    old_val = parseInt($(this).parent().siblings('input').val());
    // if the val is 1 and they want to convert it to 0, remove the item from cart
    if (old_val == MIN) {
        $(this).parent().parent().siblings('.cart-add')[0].dataset['toggle'] = "on";
        $(this).parent().parent().siblings('.cart-add').removeClass('d-none');
        $(this).parent().parent().addClass('d-none');
        // @ToDo: Remove Item from Cart
        generateToast("rem-cart"+ Math.floor(Math.random()*1000),"Item removed from cart!","danger"); // adding random id to generate more than 1 toasts 
    }
    $(this).parent().siblings('input').val(old_val > MIN ? old_val - 1 : old_val)
})

$('.btn-pluss').on('click', function () {
    var MAX = 10;
    old_val = parseInt($(this).parent().siblings('input').val());
    $(this).parent().siblings('input').val(old_val < MAX ? old_val + 1 : old_val)
})

$('.cart-add').on('click', function () {
    // default -> show add to cart button
    // if clicked -> remove add to cart and disp qty
    if ($(this)[0].dataset['toggle'] == "on") {
        $(this)[0].dataset['toggle'] = "off";
        $(this).siblings('.cart-qty').removeClass('d-none');
        $(this).addClass('d-none');
        // @ToDo: Add item to cart
        generateToast("added-cart"+ Math.floor(Math.random()*1000),"Item added to cart!","success");    // adding random id to generate more than 1 toasts 
    }
})

// generates a toast message and removes its html after the toast is hidden. id is used as toast's element id, message is what's shown, status = {primary,danger,success,warning,...}
function generateToast(id, message, state) {
    var toastHTML = '<div id ="' + id + '" class="toast align-items-center text-white bg-' + state + ' border-0" data-bs-delay="2000" role="alert" aria-live="assertive" aria-atomic="true"><div class="d-flex"><div class="toast-body">' + message + '</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>';
    $('.toast-container').append(toastHTML);
    $('#'+id).toast('show');
    $("#"+id).on("hidden.bs.toast", function(){
        $('#' + id).remove();
    });
}
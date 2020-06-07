var shoppingCart = (function() {
    // =============================
    // Private methods and propeties
    // =============================
    cart = [];

    // Constructor
    function Item(name, price, urlImg, count) {
        this.name = name;
        this.price = price;
        this.urlImg = urlImg;
        this.count = count;
    }

    // Save cart
    function saveCart() {
        localStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(localStorage.getItem('shoppingCart'));
    }
    if (localStorage.getItem("shoppingCart") != null) {
        loadCart();
    }


    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(name, price, urlImg, count) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count += count;
                    saveCart();
                    return;
                }
            }
            var item = new Item(name, price, urlImg, count);
            cart.push(item);
            saveCart();
        }
        // Set count from item
    obj.setCountForItem = function(name, count) {
        for (var i in cart) {
            if (cart[i].name === name) {
                cart[i].count = count;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(name) {
        for (var item in cart) {
            if (cart[item].name === name) {
                cart[item].count--;
                if (cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(name) {
        for (var item in cart) {
            if (cart[item].name === name) {
                cart.splice(item, 1);
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }

    // Count cart 
    obj.totalCount = function() {
        var totalCount = 0;
        for (var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for (var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }

    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for (i in cart) {
            item = cart[i];
            itemCopy = {};
            for (p in item) {
                itemCopy[p] = item[p];

            }
            itemCopy.total = Number(item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy)
        }
        return cartCopy;
    }

    // cart : Array
    // Item : Object/Class
    // addItemToCart : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCart : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
})();


// *****************************************
// Triggers / Events
// ***************************************** 
// Add item
$('.add-to-cart').click(function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    var urlImg = $(this).data('urlimg');
    shoppingCart.addItemToCart(name, price, urlImg, 1);
    displayCart();
});

$('.add-to-carts').click(function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    var urlImg = $(this).data('urlimg');
    var count = $('#quantity').val();
    shoppingCart.addItemToCart(name, price, urlImg, parseInt(count));
    displayCart();
});

$('.quantity-right-plus').click(function() {
    var count = $('#quantity').val();
    var quantity = parseInt(count);
    $('#quantity').val(quantity + 1);
    checkQuantity();
});

$('.quantity-left-minus').click(function() {
    var count = $('#quantity').val();
    var quantity = parseInt(count);
    $('#quantity').val(quantity - 1);
    checkQuantity();
});

function checkQuantity() {
    if ($('.quantity-left-minus').length > 0) {
        if (parseInt($('#quantity').val()) <= 1) {
            $('#quantity').val(1);
            $(".quantity-left-minus").attr("disabled", true);
        } else {
            $('.quantity-left-minus').removeAttr("disabled");
        }
    }
}

checkQuantity();

// Clear items
$('.clear-cart').click(function() {
    shoppingCart.clearCart();
    displayCart();
});


function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for (var i in cartArray) {
        output += '<tr class="text-center">' +
            '<td class="product-remove"><a class="delete-item text-decoration-none" style="cursor:pointer" data-name="' + cartArray[i].name + '"><span class="icon-close"></span></a></td>' +
            '<td class="image-prod"><div class="img" style="background-image:url(/storage/' + cartArray[i].urlImg + ');"></div></td>' +
            "<td><h5 style='color:white'>" + cartArray[i].name + "</h5></td>" +
            "<td style='color:white'>$" + cartArray[i].price.toFixed(2) + "</td>" +
            "<td><button class='minus-item input-group-addon btn btn-primary' data-name='" + cartArray[i].name + "'>-</button>" +
            '<span class="mr-3 ml-3 item-count" style="color:white" data-name="' + cartArray[i].name + '">' + cartArray[i].count + '</span>' +
            "<button class='plus-item btn btn-primary input-group-addon' data-name='" + cartArray[i].name + "'>+</button></td>" +
            " = " +
            "<td style='color:white'>" + cartArray[i].total + "</td>" +
            "</tr>";
    }
    $('.show-cart').html(output);
    $('.total-cart').html('$' + shoppingCart.totalCart().toFixed(2));
    $('.total-count').html(shoppingCart.totalCount());
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.removeItemFromCart(name);
        displayCart();
    })
    // +1
$('.show-cart').on("click", ".plus-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.addItemToCart(name, '', '', 1);
    displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
    var name = $(this).data('name');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
});

$('#form_check_out').on('submit', function(e) {
    e.preventDefault();
    $('#check_out').html('Waiting...');
    var cartArray = shoppingCart.listCart();
    var totalCart = shoppingCart.totalCart().toFixed(2);
    if (totalCart == 0) {
        $('#error_cart').html('You cart is empty');
        $('#check_out').html('Place an order');
    } else {
        var formData = new FormData($('#form_check_out')[0]);
        formData.append('cartArray', JSON.stringify(cartArray));
        formData.append('totalCart', totalCart);
        $.ajax({
            method: 'post',
            url: 'checkout',
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                $('#check_out').html('Place an order');
                if (data.error_cart) {
                    $('#error_cart').html('You cart is empty');
                }
                if ($.isEmptyObject(data.error)) {
                    shoppingCart.clearCart();
                    displayCart();
                    $('input').val('');
                    alert('Order sussess ! Please check email .')
                        // $('.toast').show();
                        // setTimeout(() => {
                        //     $(".toast").hide();
                        // }, 2000);
                } else {
                    for (var error in data.error) {
                        if (`${data.error[error]}`.includes('The firstname')) {
                            $('#errorfirstname').append('<p style="color: red" class="help is-danger error">' + `${data.error[error]}` + '</p>');
                        } else if (`${data.error[error]}`.includes('The lastname')) {
                            $('#errorlastname').append('<p style="color: red" class="help is-danger error">' + `${data.error[error]}` + '</p>');
                        } else if (`${data.error[error]}`.includes('The address')) {
                            $('#erroraddress').append('<p style="color: red" class="help is-danger error">' + `${data.error[error]}` + '</p>');
                        } else if (`${data.error[error]}`.includes('The phone')) {
                            $('#errorphone').append('<p style="color: red" class="help is-danger error">' + `${data.error[error]}` + '</p>');
                        } else if (`${data.error[error]}`.includes('The email')) {
                            $('#erroremail').append('<p style="color: red" class="help is-danger error">' + `${data.error[error]}` + '</p>');
                        }
                    }
                    $("input").change(function() {
                        $('.error').remove();
                    });
                }
            }
        });
    }
});


displayCart();

//// Tiep tuc voi luu db checkout
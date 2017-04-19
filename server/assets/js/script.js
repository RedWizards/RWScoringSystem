var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope) {

    $scope.isCartEmpty = true;
    $scope.isReturning = true;

    $('#productsScrn').hide();
    $('#cartScrn').hide();
    $('#checkOutScrn').hide();
    $('#thankYouScrn').hide();

    $scope.showProductsScrn = function() {
    	$('#landingScrn').hide();
    	$('#productsScrn').fadeIn();
	    $('#cartScrn').hide();
	    $('#checkOutScrn').hide();
        $('#thankYouScrn').hide();

	    $scope.clickedProduct = $scope.products[0];
	    
    }
    $scope.showCartScrn = function() {
    	$('#landingScrn').hide();
    	$('#productsScrn').hide();
	    $('#cartScrn').fadeIn();
	    $('#checkOutScrn').hide();
        $('#thankYouScrn').hide();
    }
    $scope.showCheckOutScrn = function() {
    	$('#landingScrn').hide();
    	$('#productsScrn').hide();
	    $('#cartScrn').hide();
	    $('#checkOutScrn').fadeIn();
        $('#thankYouScrn').hide();
    }

    $scope.productClicked = function(name, price, image, description, obj) {
    	$('#clickedProduct').hide();
    	$scope.clickedProduct = obj;
    	$('#clickedProduct').fadeIn();
        $('#thankYouScrn').hide();
    }

    $scope.searchChanged = function() {
        console.log($scope.searchText);

        // search box is empty just get the top products
        if ($scope.searchText.length == 0) {
            $scope.products = $scope.topproducts;
        } else { 
            // search for products here
            url = 'api/getSearchedProducts.php?query=' + $scope.searchText;  
            $.ajax({
                url: url,
            }).done(function(data) {
                $scope.products = []; // clear the products
                $.each(data, function(i, obj) {
                    $scope.products.push(obj);
                    console.log(obj);
                });
            });
        }

    }

    $scope.addToCart = function(name, price, image, id, quantity) {
        $scope.isCartEmpty = false;
    	$scope.cartItems += quantity;
        // check if the product is already on the cart
        var isOnCart = false;
        for (var i = 0; i < $scope.cart.length; i++) {
            if ($scope.cart[i].name == name) {
                isOnCart = true; // set to true so a new item wont be pushed on the cart
                $scope.cart[i].qty += quantity;
                break;
            }
        }
        // if still not on cart
        if (isOnCart == false) {
            $scope.cart.push({
                name: name,
                price: price,
                image: image,
                qty: quantity,
                id: id
            });
        }

    	$scope.total = 0;
    	$.each($scope.cart, function(i, obj) {
    		$scope.total += (obj.price * obj.qty);
    	});

        quantity = 0;
    }

    $scope.cartUpdated = function(item) {
        $scope.total = 0;
        for (var i = 0; i < $scope.cart.length; i++) {
            if ($scope.cart[i].qty > 0) {
                $scope.total += $scope.cart[i].price * $scope.cart[i].qty;
            }
        }
    }


    $scope.placeOrder = function(isReturning) {

        var isSuccess = true;

        if (isReturning == false) {
            $.ajax({
                type: 'POST',
                url: 'api/placeOrders.php',
                data: {
                    cart: JSON.stringify($scope.cart),
                    firstname: $scope.firstName,
                    lastname: $scope.lastName,
                    email: $scope.email,
                    password: $scope.password,
                    phone: $scope.phone,
                    address: $scope.address,
                    shipaddress: $scope.shipaddress,
                    zip: $scope.zip,
                    zipship: $scope.zipship,
                    isReturning: isReturning
                    },
                success: function(data) {
                    $scope.cart = [];
                    $scope.isCartEmpty = true;
                    $scope.total = 0;
                    console.log(JSON.stringify(data));
                },
                error: function(e) {
                    $scope.cart = [];
                    $scope.isCartEmpty = true;
                    $scope.total = 0;
                }
            }).done(function(data) {
                alert('ordered');
                console.log(JSON.stringify(data));
                $scope.cart = [];
                $scope.isCartEmpty = true;
                $scope.total = 0;
            });
        } else if (isReturning == true) {
            console.log('Returning is true');
            $.ajax({
                type: 'POST',
                url: 'api/placeOrders.php',
                data: {
                    cart: JSON.stringify($scope.cart),
                    email: $scope.email,
                    password: $scope.password,
                    isReturning: isReturning
                },
                success: function(data) {
                    console.log('success');
                    console.log('RESPONSE: ' + data['response']);
                    $scope.cart = [];
                    $scope.isCartEmpty = true;
                    $scope.total = 0;
                    console.log(JSON.stringify(data));
                },
                error: function(e) {
                    if (e.responseText.indexOf('success') != 1) {
                        // login success
                        $scope.cart = [];
                        $scope.isCartEmpty = true;
                        $scope.total = 0;
                        console.log(e);
                    } else {
                        isSuccess = false;
                    }
                }
            }).done(function(data) {
                console.log('Emptying cart');
                $scope.cart = [];
                $scope.isCartEmpty = true;
                $scope.total = 0;
                console.log(JSON.stringify(data));
            });
        }

        if (isSuccess = true) {
            $('#landingScrn').hide();
            $('#productsScrn').hide();
            $('#cartScrn').hide();
            $('#checkOutScrn').hide();
            $('#thankYouScrn').show();
        } else {
            alert('Please check the data you provided.');
        }

    }

    $.ajax({
	   url: 'api/getProducts.php',
	}).done(function(data) {
		$.each(data, function(i, obj) {
			$scope.products.push(obj);
            $scope.topproducts.push(obj);
		});
	});



});


//Make this function to arrange the items in cart
function arrangeCart(cart) {

}


/*
$(document).click(function(e){
    if ($('.product').on('clicked')) {
        alert("It works");
    }  
})
*/
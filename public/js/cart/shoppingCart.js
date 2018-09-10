// ***************************************************
// Shopping Cart functions

var shoppingCart = (function () {
    // Private methods and properties

    var cart = [];
    var cabecera = [];

    var cabecera = [{'tipo_descuento': '', 'monto_descuento': '', 'porcentaje_descuento': ''}];

    // Put the object into storage
    localStorage.setItem('cabecera', JSON.stringify(cabecera));
        

    function Item(id, name, price, count, comentario) {
        this.id = id
        this.name = name
        this.price = price
        this.count = count
        this.comentario = comentario
    }

    function saveCart() {
        localStorage.setItem("shoppingCart", JSON.stringify(cart));
    }

    function loadCart() {
        cart = JSON.parse(localStorage.getItem("shoppingCart"));
        if (cart === null) {
            cart = []
        }
    }

    loadCart();



    // Public methods and properties
    var obj = {};

    obj.addItemToCart = function (id, name, price, count, comentario) {
        for (var i in cart) {
            if (cart[i].id === id) {
                cart[i].count += count;
                saveCart();
                return;
            }
        }

        console.log("addItemToCart:", id, name, price, count, comentario);

        var item = new Item(id, name, price, count, comentario);
        cart.push(item);
        saveCart();
    };

    obj.setPrice = function (id, price) {
        for (var i in cart) {
            if (cart[i].id === id) {
                cart[i].price = price;
                break;
            }
        }
        saveCart();
    };

    obj.setComentario = function (id, comentario) {
        for (var i in cart) {
            if (cart[i].id === id) {
                cart[i].comentario = comentario;
                break;
            }
        }
        saveCart();
    };

    obj.setCountForItem = function (id, count) {
        for (var i in cart) {
            if (cart[i].id === id) {
                cart[i].count = count;
                break;
            }
        }
        saveCart();
    };


    obj.removeItemFromCart = function (id) { // Removes one item
        for (var i in cart) {
            if (cart[i].id === id) { // "3" === 3 false
                cart[i].count--; // cart[i].count --
                if (cart[i].count === 0) {
                    cart.splice(i, 1);
                }
                break;
            }
        }
        saveCart();
    };


    obj.removeItemFromCartAll = function (id) { // removes all item name
        for (var i in cart) {
            if (cart[i].id === id) {
                cart.splice(i, 1);
                break;
            }
        }
        saveCart();
    };


    obj.clearCart = function () {
        cart = [];
        saveCart();
    }


    obj.countCart = function () { // -> return total count
        var totalCount = 0;
        for (var i in cart) {
            totalCount += cart[i].count;
        }

        return totalCount;
    };

    obj.totalCart = function () { // -> return total cost
        var totalCost = 0;
        for (var i in cart) {
            totalCost += cart[i].price * cart[i].count;
        }
        return totalCost.toFixed(0);
    };

    obj.listCart = function () { // -> array of Items
        var cartCopy = [];
        console.log("Listing cart");
        console.log(cart);
        for (var i in cart) {
            console.log(i);
            var item = cart[i];
            var itemCopy = {};
            for (var p in item) {
                itemCopy[p] = item[p];
            }
            itemCopy.total = (item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy);
        }
        return cartCopy;
    };

    // ----------------------------
    return obj;
})();





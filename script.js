document.addEventListener("DOMContentLoaded", function () {

    /* =========================================
       QUANTITY BUTTONS
    ========================================= */

    document.querySelectorAll(".pizza-order-card .quantity-control").forEach(function (control) {

        const buttons = control.querySelectorAll("button");
        const quantityDisplay = control.querySelector("span");

        buttons[0].addEventListener("click", function () {

            let quantity = parseInt(quantityDisplay.textContent) || 0;

            if (quantity > 0) {
                quantity--;
            }

            quantityDisplay.textContent = quantity;
        });


        buttons[1].addEventListener("click", function () {

            let quantity = parseInt(quantityDisplay.textContent) || 0;

            quantity++;

            quantityDisplay.textContent = quantity;

            const card = control.closest(".pizza-order-card");
            const cartMessage = card.querySelector(".cart-message");

            cartMessage.textContent = "";
        });

    });


    /* =========================================
        CHANGE PRICE BASED ON PIZZA SIZE
    ========================================= */

    document.querySelectorAll(".pizza-order-card").forEach(function (card) {

        const sizeSelect =
            card.querySelector(".pizza-size select");

        const priceDisplay =
            card.querySelector(".pizza-price");

        if (!sizeSelect || !priceDisplay) {
            return;
        }

        function updatePizzaPrice() {

            const selectedOption =
                sizeSelect.options[sizeSelect.selectedIndex];

            const newPrice =
                parseFloat(selectedOption.dataset.price);

            priceDisplay.textContent =
                "₱" + newPrice;

            }

            sizeSelect.addEventListener("change", function () {

                updatePizzaPrice();

            });

            /* Set correct price when page first loads */

            updatePizzaPrice();

        });



        /* =========================================
        ADD TO CART
        ========================================= */

        document.querySelectorAll(".add-cart-btn").forEach(function (button) {

            button.addEventListener("click", function () {

                const card = button.closest(".pizza-order-card");

                const pizzaName =
                    card.querySelector("h2").textContent.trim();


                /* Get size */

                const sizeSelect =
                    card.querySelector(".pizza-size select");

                const size =
                    sizeSelect.value;


                /* Get price based on selected size */

                const selectedOption =
                    sizeSelect.options[sizeSelect.selectedIndex];

                const price =
                    parseFloat(selectedOption.dataset.price);


                /* Get quantity */

                const quantityDisplay =
                    card.querySelector(".quantity-control span");

                const quantity =
                    parseInt(quantityDisplay.textContent) || 0;


                /* Check quantity */

                if (quantity === 0) {

                    const cartMessage =
                        card.querySelector(".cart-message");

                    cartMessage.textContent =
                        "Please select at least 1 pizza.";

                    return;
                }


                /* Create cart item */

                const cartItem = {
                    name: pizzaName,
                    price: price,
                    size: size,
                    quantity: quantity
                };


                /* Get existing cart */

                let cart =
                    JSON.parse(localStorage.getItem("pizzaCart")) || [];


                /* Check if same pizza and size already exists */

                const existingItem =
                    cart.find(function (item) {

                        return (
                            item.name === cartItem.name &&
                            item.size === cartItem.size
                        );

                    });


                if (existingItem) {

                    existingItem.quantity += cartItem.quantity;

                } else {

                    cart.push(cartItem);

                }


                /* Save cart */

                localStorage.setItem(
                    "pizzaCart",
                    JSON.stringify(cart)
                );


                /* Remove validation message */

                const cartMessage =
                    card.querySelector(".cart-message");

                cartMessage.textContent = "";


                /* Button feedback */

                const originalText =
                    button.textContent;

                button.textContent =
                    "ADDED TO CART ✓";

                button.disabled = true;


                setTimeout(function () {

                    button.textContent =
                        originalText;

                    button.disabled = false;

                }, 1200);


                console.log("Cart:", cart);

            });

        });


        /* =========================================
            DISPLAY CART
        ========================================= */

        const cartItemsContainer =
            document.getElementById("cart-items");

        const cartTotal =
            document.getElementById("cart-total");

        /* Only run this part on cart.php */

        if (cartItemsContainer && cartTotal) {

            function displayCart() {

                let cart =
                    JSON.parse(localStorage.getItem("pizzaCart")) || [];

                if (cart.length === 0) {

                    cartItemsContainer.innerHTML =
                        "<p>Your cart is currently empty.</p>";

                    cartTotal.textContent = "₱0";

                    return;
                }

                let total = 0;

                cartItemsContainer.innerHTML = "";

                cart.forEach(function (item, index) {

                    const itemTotal =
                        item.price * item.quantity;

                    total += itemTotal;

                    const cartItem =
                        document.createElement("div");

                    cartItem.className = "cart-item";

                    cartItem.innerHTML = `
                        <div class="cart-item-info">

                            <h3>${item.name}</h3>

                            <p>Size: ${item.size}</p>

                            <p>Price: ₱${item.price.toFixed(2)}</p>

                            <div class="cart-quantity">

                                <button type="button"
                                        class="cart-minus"
                                        data-index="${index}">
                                    −
                                </button>

                                <span>${item.quantity}</span>

                                <button type="button"
                                        class="cart-plus"
                                        data-index="${index}">
                                    +
                                </button>

                            </div>

                            <button type="button"
                                    class="cart-remove"
                                    data-index="${index}">
                                REMOVE
                            </button>

                        </div>

                        <div class="cart-item-total">

                            ₱${itemTotal.toFixed(2)}

                        </div>
                    `;

                    cartItemsContainer.appendChild(cartItem);

                });

                cartTotal.textContent =
                    "₱" + total.toFixed(2);


            /* =========================================
            CART PLUS BUTTON
            ========================================= */

            document.querySelectorAll(".cart-plus").forEach(function (button) {

                button.addEventListener("click", function () {

                    const index =
                        parseInt(button.dataset.index);

                    cart[index].quantity++;

                    localStorage.setItem(
                        "pizzaCart",
                        JSON.stringify(cart)
                    );

                    displayCart();

                });

            });


            /* =========================================
            CART MINUS BUTTON
            ========================================= */

            document.querySelectorAll(".cart-minus").forEach(function (button) {

                button.addEventListener("click", function () {

                    const index =
                        parseInt(button.dataset.index);

                    if (cart[index].quantity > 1) {

                        cart[index].quantity--;

                    }

                    localStorage.setItem(
                        "pizzaCart",
                        JSON.stringify(cart)
                    );

                    displayCart();

                });

            });


            /* =========================================
            REMOVE BUTTON
            ========================================= */

            document.querySelectorAll(".cart-remove").forEach(function (button) {

                button.addEventListener("click", function () {

                    const index =
                        parseInt(button.dataset.index);

                    cart.splice(index, 1);

                    localStorage.setItem(
                        "pizzaCart",
                        JSON.stringify(cart)
                    );

                    displayCart();

                });

            });

        }

        displayCart();

    }


    /* =========================================
    CHECKOUT PAGE
    ========================================= */

    const checkoutItems =
        document.getElementById("checkout-items");

    const checkoutTotal =
        document.getElementById("checkout-total");

    if (checkoutItems && checkoutTotal) {

        const cart =
            JSON.parse(localStorage.getItem("pizzaCart")) || [];

        if (cart.length === 0) {

            checkoutItems.innerHTML =
                "<p>Your cart is empty.</p>";

            checkoutTotal.textContent =
                "₱0.00";

        } else {

            let total = 0;

            checkoutItems.innerHTML = "";

            cart.forEach(function (item) {

                const itemTotal =
                    item.price * item.quantity;

                total += itemTotal;

                const itemElement =
                    document.createElement("div");

                itemElement.className =
                    "checkout-item";

                itemElement.innerHTML = `
                    <div>
                        <h3>${item.name}</h3>

                        <p>
                            Size: ${item.size}
                        </p>

                        <p>
                            Quantity: ${item.quantity}
                        </p>

                        <p>
                            Price: ₱${item.price.toFixed(2)}
                        </p>
                    </div>

                    <strong>
                        ₱${itemTotal.toFixed(2)}
                    </strong>
                `;

                checkoutItems.appendChild(itemElement);

            });

            checkoutTotal.textContent =
                "₱" + total.toFixed(2);

        }

    }



    /* =========================================
    CUSTOM PIZZA CUSTOMIZATION
    ========================================= */

    const customPizzaPage =
        document.querySelector(".custom-pizza-page");

    if (customPizzaPage) {

        const sizeOptions =
            document.querySelectorAll(
                'input[name="custom-size"]'
            );

        const sauceOptions =
            document.querySelectorAll(
                'input[name="custom-sauce"]'
            );

        const toppingOptions =
            document.querySelectorAll(
                'input[name="custom-topping"]'
            );

        const summarySize =
            document.getElementById(
                "custom-summary-size"
            );

        const summarySauce =
            document.getElementById(
                "custom-summary-sauce"
            );

        const summaryToppings =
            document.getElementById(
                "custom-summary-toppings"
            );

        const totalDisplay =
            document.getElementById(
                "custom-total"
            );

        const quantityDisplay =
            document.getElementById(
                "custom-quantity"
            );

        const minusButton =
            document.getElementById(
                "custom-minus"
            );

        const plusButton =
            document.getElementById(
                "custom-plus"
            );

        const addCartButton =
            document.getElementById(
                "custom-add-cart"
            );

        const cartMessage =
            document.getElementById(
                "custom-cart-message"
            );


        /* =========================================
        UPDATE CUSTOM PIZZA
        ========================================= */

        function updateCustomPizza() {

            /* -------------------------
            SIZE
            ------------------------- */

            const selectedSize =
                document.querySelector(
                    'input[name="custom-size"]:checked'
                );

            const size =
                selectedSize.value;

            const sizePrice =
                parseFloat(
                    selectedSize.dataset.price
                );


            /* -------------------------
            SAUCE
            ------------------------- */

            const selectedSauce =
                document.querySelector(
                    'input[name="custom-sauce"]:checked'
                );

            const sauce =
                selectedSauce.value;

            const saucePrice =
                parseFloat(
                    selectedSauce.dataset.price
                );


            /* -------------------------
            TOPPINGS
            ------------------------- */

            const selectedToppings = [];

            let toppingsPrice = 0;


            toppingOptions.forEach(function (topping) {

                if (topping.checked) {

                    selectedToppings.push(
                        topping.value
                    );

                    toppingsPrice +=
                        parseFloat(
                            topping.dataset.price
                        );

                }

            });


            /* -------------------------
            TOTAL
            ------------------------- */

            const total =
                sizePrice +
                saucePrice +
                toppingsPrice;


            /* -------------------------
            UPDATE SUMMARY
            ------------------------- */

            summarySize.textContent =
                size.charAt(0).toUpperCase() +
                size.slice(1);

            summarySauce.textContent =
                sauce;


            if (selectedToppings.length === 0) {

                summaryToppings.textContent =
                    "None";

            } else {

                summaryToppings.textContent =
                    selectedToppings.join(", ");

            }


            totalDisplay.textContent =
                "₱" + total.toFixed(2);

        }


        /* =========================================
        SIZE CHANGE
        ========================================= */

        sizeOptions.forEach(function (option) {

            option.addEventListener(
                "change",
                updateCustomPizza
            );

        });


        /* =========================================
        SAUCE CHANGE
        ========================================= */

        sauceOptions.forEach(function (option) {

            option.addEventListener(
                "change",
                updateCustomPizza
            );

        });


        /* =========================================
        TOPPING CHANGE
        ========================================= */

        toppingOptions.forEach(function (option) {

            option.addEventListener(
                "change",
                updateCustomPizza
            );

        });


        /* =========================================
        QUANTITY PLUS
        ========================================= */

        plusButton.addEventListener(
            "click",
            function () {

                let quantity =
                    parseInt(
                        quantityDisplay.textContent
                    ) || 1;

                quantity++;

                quantityDisplay.textContent =
                    quantity;

                cartMessage.textContent = "";

            }
        );


        /* =========================================
        QUANTITY MINUS
        ========================================= */

        minusButton.addEventListener(
            "click",
            function () {

                let quantity =
                    parseInt(
                        quantityDisplay.textContent
                    ) || 1;

                if (quantity > 1) {

                    quantity--;

                }

                quantityDisplay.textContent =
                    quantity;

                cartMessage.textContent = "";

            }
        );


        /* =========================================
        ADD CUSTOM PIZZA TO CART
        ========================================= */

        addCartButton.addEventListener(
            "click",
            function () {

                const selectedSize =
                    document.querySelector(
                        'input[name="custom-size"]:checked'
                    );

                const selectedSauce =
                    document.querySelector(
                        'input[name="custom-sauce"]:checked'
                    );


                const size =
                    selectedSize.value;

                const sauce =
                    selectedSauce.value;


                const sizePrice =
                    parseFloat(
                        selectedSize.dataset.price
                    );

                const saucePrice =
                    parseFloat(
                        selectedSauce.dataset.price
                    );


                const selectedToppings = [];

                let toppingsPrice = 0;


                toppingOptions.forEach(
                    function (topping) {

                        if (topping.checked) {

                            selectedToppings.push(
                                topping.value
                            );

                            toppingsPrice +=
                                parseFloat(
                                    topping.dataset.price
                                );

                        }

                    }
                );


                const quantity =
                    parseInt(
                        quantityDisplay.textContent
                    ) || 1;


                const price =
                    sizePrice +
                    saucePrice +
                    toppingsPrice;


                /* -------------------------
                CUSTOMIZATION DETAILS
                ------------------------- */

                const customization = {

                    sauce: sauce,

                    toppings: selectedToppings

                };


                /* -------------------------
                CREATE CART ITEM
                ------------------------- */

                const cartItem = {

                    name: "Custom Pizza",

                    price: price,

                    size: size,

                    quantity: quantity,

                    customization: customization

                };


                /* -------------------------
                GET EXISTING CART
                ------------------------- */

                let cart =
                    JSON.parse(
                        localStorage.getItem(
                            "pizzaCart"
                        )
                    ) || [];


                /* -------------------------
                ADD TO CART
                ------------------------- */

                cart.push(cartItem);


                /* -------------------------
                SAVE CART
                ------------------------- */

                localStorage.setItem(
                    "pizzaCart",
                    JSON.stringify(cart)
                );


                /* -------------------------
                SUCCESS MESSAGE
                ------------------------- */

                cartMessage.textContent =
                    "Custom pizza added to cart!";


                /* -------------------------
                BUTTON FEEDBACK
                ------------------------- */

                const originalText =
                    addCartButton.textContent;


                addCartButton.textContent =
                    "ADDED TO CART ✓";

                addCartButton.disabled =
                    true;


                setTimeout(
                    function () {

                        addCartButton.textContent =
                            originalText;

                        addCartButton.disabled =
                            false;

                    },
                    1200
                );


                console.log(
                    "Custom Pizza Cart:",
                    cart
                );

            }
        );


        /* =========================================
        INITIAL PRICE
        ========================================= */

        updateCustomPizza();

    }




    /* =========================================
    DELIVERY / PICKUP
    ========================================= */

    const deliveryAddressSection =
        document.getElementById("delivery-address-section");

    const orderTypeOptions =
        document.querySelectorAll('input[name="order_type"]');

    if (deliveryAddressSection && orderTypeOptions.length > 0) {

        orderTypeOptions.forEach(function (option) {

            option.addEventListener("change", function () {

                if (this.value === "pickup") {

                    deliveryAddressSection.style.display = "none";

                } else {

                    deliveryAddressSection.style.display = "block";

                }

            });

        });

    }


    /* =========================================
    CHECKOUT CART SUBMISSION
    ========================================= */

    const checkoutForm =
        document.getElementById("checkout-form");

    const cartDataInput =
        document.getElementById("cart-data");

    if (checkoutForm && cartDataInput) {

        checkoutForm.addEventListener("submit", function () {

            const cart =
                JSON.parse(localStorage.getItem("pizzaCart")) || [];

            cartDataInput.value =
                JSON.stringify(cart);

        });

    }


});
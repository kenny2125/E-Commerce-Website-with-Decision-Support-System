document.addEventListener("DOMContentLoaded", function() {
    const quantityInput = document.getElementById("quantity");
    const decreaseBtn = document.getElementById("decrease-btn");
    const increaseBtn = document.getElementById("increase-btn");

    decreaseBtn.addEventListener("click", () => {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
        }
    });

    increaseBtn.addEventListener("click", () => {
        let quantity = parseInt(quantityInput.value);
        quantityInput.value = quantity + 1;
    });
});
// Simulated API data (replace this with actual API calls)
const data = {
    customer: {
        name: "John Doe",
        contact: "09123456789",
        address: "123 Main Street, Quezon City",
    },
    product: {
        name: "GEFORCE RTX 4090 MSI GAMING TRIO 24GB",
        description: "GDDR6X TRIPLE FAN RGB",
        image: "https://via.placeholder.com/200x150", // Replace with product image URL
        price: 114995.00,
    },
    shippingFee: 0.00,
};

// Function to populate placeholders with actual data
function populatePage(data) {
    // Update product information
    document.getElementById("product-name").textContent = data.product.name;
    document.getElementById("product-description").textContent = data.product.description;
    document.getElementById("product-image").src = data.product.image;
    document.getElementById("product-price").textContent = `₱${data.product.price.toLocaleString()}`;
    document.getElementById("product-subtotal").textContent = `₱${data.product.price.toLocaleString()}`;

    // Update customer information
    document.getElementById("customer-name").textContent = data.customer.name;
    document.getElementById("customer-contact").textContent = data.customer.contact;
    document.getElementById("customer-address").textContent = data.customer.address;

    // Update order review
    const totalPayment = data.product.price + data.shippingFee;
    document.getElementById("shipping-fee").textContent = `₱${data.shippingFee.toLocaleString()}`;
    document.getElementById("total-payment").textContent = `₱${totalPayment.toLocaleString()}`;
}

// Call the function to populate data
populatePage(data);
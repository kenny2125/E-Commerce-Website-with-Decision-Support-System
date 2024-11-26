// JavaScript function to filter products based on category selection
function filterProducts(category) {
    const productSection = document.getElementById("productSection");
    
    // Clear the current products displayed
    productSection.innerHTML = "";
  
    // Simulate showing products based on selected category
    const productList = {
      "CPU": [
        { name: "Intel Core i9", price: "₱25,000.00" },
        { name: "AMD Ryzen 9", price: "₱22,000.00" },
      ],
      "RAM": [
        { name: "Corsair Vengeance 16GB", price: "₱4,500.00" },
        { name: "G.SKILL Ripjaws 16GB", price: "₱4,200.00" },
      ],
      "Motherboard": [
        { name: "ASUS ROG Strix B550", price: "₱12,000.00" },
        { name: "MSI MPG B550", price: "₱11,500.00" },
      ],
      // Add more categories here as needed...
    };
  
    // Check if the category has products
    if (productList[category]) {
      productList[category].forEach(product => {
        const productCard = document.createElement("div");
        productCard.classList.add("product-card");
        productCard.innerHTML = `
          <h3>${product.name}</h3>
          <p class="price">${product.price}</p>
          <button class="add-to-cart">Add to Cart</button>
        `;
        productSection.appendChild(productCard);
      });
    } else {
      productSection.innerHTML = "<p>No products available in this category.</p>";
    }
  }
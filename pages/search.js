const products = [
    { name: "Laptop", price: 1500, category: "Electronics" },
    { name: "Smartphone", price: 800, category: "Electronics" },
    { name: "Watch", price: 250, category: "Accessories" },
    { name: "Shoes", price: 100, category: "Fashion" },
    { name: "Backpack", price: 60, category: "Fashion" },
    { name: "Tablet", price: 400, category: "Electronics" },
    { name: "Headphones", price: 120, category: "Accessories" },
    { name: "Sunglasses", price: 80, category: "Fashion" },
  ];
  
  const searchBar = document.getElementById("search-bar");
  const sortOptions = document.getElementById("sort-options");
  const resultList = document.getElementById("result-list");
  
  // Render Products
  function renderProducts(items) {
    resultList.innerHTML = ""; // Clear previous results
    if (items.length === 0) {
      resultList.innerHTML = `<p>No products found.</p>`;
      return;
    }
    items.forEach((product) => {
      const productDiv = document.createElement("div");
      productDiv.className = "product-item";
      productDiv.innerHTML = `
        <h2>${product.name}</h2>
        <p>Category: ${product.category}</p>
        <p class="price">$${product.price.toFixed(2)}</p>
      `;
      resultList.appendChild(productDiv);
    });
  }
  
  // Filter Products
  function filterProducts(query) {
    return products.filter((product) =>
      product.name.toLowerCase().includes(query.toLowerCase())
    );
  }
  
  // Sorting Function
  function sortProducts(items, sortType) {
    switch (sortType) {
      case "name-asc":
        return items.sort((a, b) => a.name.localeCompare(b.name));
      case "name-desc":
        return items.sort((a, b) => b.name.localeCompare(a.name));
      case "price-low":
        return items.sort((a, b) => a.price - b.price);
      case "price-high":
        return items.sort((a, b) => b.price - a.price);
      default:
        return items;
    }
  }
  
  // Show Suggestions as User Types
  searchBar.addEventListener("input", () => {
    const query = searchBar.value.trim();
    if (query) {
      const filteredProducts = filterProducts(query);
      const sortedProducts = sortProducts(filteredProducts, sortOptions.value);
      resultList.classList.remove("hidden");
      renderProducts(sortedProducts);
    } else {
      resultList.classList.add("hidden");
    }
  });
  
  // Handle Sort Option Change
  sortOptions.addEventListener("change", () => {
    const query = searchBar.value.trim();
    if (query) {
      const filteredProducts = filterProducts(query);
      const sortedProducts = sortProducts(filteredProducts, sortOptions.value);
      renderProducts(sortedProducts);
    }
  });
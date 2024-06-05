const ajaxGet = (endpoint, method) => {
  const baseUrl = "https://fakestoreapi.com/";
  return $.ajax({
    url: baseUrl + endpoint,
    method: method,
    dataType: "json",
    success: function (data) {
      return data;
    },
    error: function (error) {
      return error;
    },
  });
};

const createCard = (product) => {
  // Create the card container
  const $card = $("<div>", {
    class:
      "w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700",
  });

  // Create the image link and image element
  const $imageLink = $("<a>", { href: "#" });
  const $image = $("<img>", {
    class: "p-8 rounded-t-lg h-80 w-80 m-auto object-cover",
    src: product.image,
    alt: "product image",
  });
  $imageLink.append($image);

  // Create the card content container
  const $content = $("<div>", { class: "px-5 pb-5" });

  // Create the title link and title element
  const $titleLink = $("<a>", { href: "#" });
  const $title = $("<h5>", {
    class: "text-xl font-semibold tracking-tight text-gray-900 dark:text-white",
    text: product.title,
  });
  $titleLink.append($title);

  // Create the rating container and rating element
  const $ratingContainer = $("<div>", {
    class: "flex items-center mt-2.5 mb-5",
  });
  const $rating = $("<span>", {
    class:
      "bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-800",
    text: "5.0",
  });
  $ratingContainer.append($rating);

  // Create the price and button container
  const $priceContainer = $("<div>", {
    class: "flex items-center justify-between",
  });
  const $price = $("<span>", {
    class: "text-3xl font-bold text-gray-900 dark:text-white",
    text: `$ ${product.price}`,
  });
  const $button = $("<a>", {
    href: "#",
    class:
      "text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800",
    text: "Add to cart",
  });
  $priceContainer.append($price, $button);

  // Append elements to the content container
  $content.append($titleLink, $ratingContainer, $priceContainer);

  // Append the image link and content to the card container
  $card.append($imageLink, $content);

  // Return the card HTML as a string
  return $card.prop("outerHTML");
};

const getProducts = () => {
  ajaxGet("products", "GET")
    .then((data) => {
      const cards = $(data)
        .map((index, product) => {
          return createCard(product);
        })
        .get();

      $("#dataShop").append(cards);
    })
    .catch((error) => {
      console.error("Error fetching products:", error);
    });
};

getProducts();

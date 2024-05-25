

<!-- buraya post kontrol komutunu koymalısın php ile -->

<?php
  session_start();

  include_once("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php");

  //post'dan ürünü aldıktan sonra append et session'a product idsiyle

  if (isset($_POST['product_id'], $_POST['product_buy_quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['product_buy_quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['product_buy_quantity'];

    $query = <<<QUERY_TEXT
    SELECT * FROM products WHERE id = 
    QUERY_TEXT;

    $query .= $_POST["product_id"];

    $product = query_parser($query);

    // echo "<pre>"; print_r($product); //querymiz calisior.


    if ($product && $quantity > 0) {
      // Product exists in database, now we can create/update the session variable for the cart
      if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
          if (array_key_exists($product_id, $_SESSION['cart'])) {
              // Product exists in cart so just update the quanity
              $_SESSION['cart'][$product_id] += $quantity;
          } else {
              // Product is not in cart so add it
              $_SESSION['cart'][$product_id] = $quantity;
          }
      } else {
          // There are no products in cart, this will add the first product to cart
          $_SESSION['cart'] = array($product_id => $quantity);
      }
    }
        // Prevent form resubmission...
        header('location: cart.php');
        exit;
  }

  //to remove the unwanted product

  if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
  }

  if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    header('Location: cart.php');
    exit;
  }

  //for placeorder button

  if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: place_order.php');
    exit;
  }




$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if (!empty($products_in_cart)) {
  // Extracting product IDs from the keys of the session array
  $product_ids = array_keys($products_in_cart);


  $q = "SELECT * FROM products WHERE id IN (";
  foreach ($product_ids as $id) {
      $q .= $id . ",";
  }
  // Remove the trailing comma
  $q = rtrim($q, ",");
  $q .= ")";


  // Constructing the SQL query with the correct number of placeholders


  // Now you can execute this query to fetch products from the database
  // Assuming you have a function named query_parser to execute the query and fetch results
  $products = query_parser($q);
  // echo "<pre>"; print_r($products);


  // Calculate the subtotal
  foreach ($products as $product) {
    $subtotal += (float)$product['price'] * (int)$products_in_cart[(int)$product['id']];
    $_SESSION["total_price"] = $subtotal+20;
  }
}
//echo $subtotal; //works perfect till here !!!
?>


<html>

    
    <div class="flex flex-col h-screen">

        <?php include_once '../components/header.php'; ?>

        <!-- aşağıdaki div'in içine content gelecek!!! -->
        <!-- flex grow kullan ekleyeceğin contentin classında !!! -->
        <form action="cart.php" method="post">

        <div class="bg-gray-50 flex-grow">

          <div class="container mx-auto mt-10">
            <div class="flex shadow-md my-10">   <!--burda flex growa bak -->
    
              <div class="w-3/4 bg-white px-10 py-10">
    
                <div class="flex justify-between border-b pb-8"> <!-- titles of the cart -->
    
                  <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                  <h2 class="font-semibold text-2xl"><?php echo sizeof($products_in_cart)?> Items</h2>
    
                </div> <!-- end of cart titles -->
    
                <div class="flex mt-10 mb-5"> <!-- start of cart detail -->
    
                  <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center ">Quantity</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price Per Product</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center mr-10">Total</h3>
    
                </div> <!-- end of cart detail -->
                  
                <?php foreach ($products as $product){
                  
                  
                ?>
                
    
                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5"> <!-- product card block -->
    
                  <div class="flex w-2/5"> <!-- product pic and texts -->
    
                    <div class="w-20">
                      <img class="h-24 w-24 object-contain object-center rounded" src=<?=$product['img']?> >
                    </div>
    
                    <div class="flex flex-col justify-between ml-4 flex-grow ">
                      <span class="font-bold text-sm"><?=$product['title']?></span>
                      <span class="text-gray-500 text-xs font-semibold mb-3"><?=$product['brand']?></span>
                    </div>
                  </div>
    
    
                  <div class="flex justify-center w-1/5">  <!-- start of the quantity button tag -->
    
                    <div class="flex items-center border-gray-100">
    
                        <span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-stone-500 " id="decrement_button<?php echo$product["id"] ?>"> - </span>
                        <input name="quantity-<?=$product['id']?>" class="h-8 w-8 border bg-white text-center text-xs outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" value=<?php echo (int)$products_in_cart[(int)$product['id']]?> min="1"  id="adjustable_quantity_number<?php echo$product["id"] ?>" onkeydown="preventKeyboardInput(event)"/>
                        <span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-stone-500 " id = "increment_button<?php echo$product["id"] ?>"> + </span>
    
                    </div>
    
                    <script>
                            function preventKeyboardInput(event) {
                                event.preventDefault();
                                }
    
                            document.addEventListener("DOMContentLoaded", function() {
    
                                document.getElementById('increment_button<?php echo$product["id"] ?>').addEventListener('click', function() {
                                  if(document.getElementById('adjustable_quantity_number<?php echo$product["id"] ?>').valueAsNumber < <?php echo $product["quantity"]?>)
                                    document.getElementById('adjustable_quantity_number<?php echo$product["id"] ?>').valueAsNumber++;
                                });
    
                                document.getElementById('decrement_button<?php echo$product["id"] ?>').addEventListener('click', function() {
                                    if(document.getElementById('adjustable_quantity_number<?php echo$product["id"] ?>').valueAsNumber > 1){
                                        document.getElementById('adjustable_quantity_number<?php echo$product["id"] ?>').valueAsNumber--;
    
                                    }
                                });
                            });
                    </script>
    
                  </div>  <!-- end of the quantity button tag -->
    
                  <span class="text-center w-1/5 font-semibold text-sm">₺<?php echo number_format($product["price"],2,".",",") ?></span>
                  <span id="final_price_of_product" class="text-center w-1/5 font-semibold text-sm">₺<?php echo number_format(($products_in_cart[$product["id"]] * $product["price"]),2,".",",") ?></span> 

                  <a href="cart.php?remove=<?php echo $product["id"]?>" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
    
                </div>   <!-- end of the product card block -->

                <?php } 
                
                ?>
    
                <a href="home.php" class="flex font-semibold text-stone-500 hover:text-stone-900 text-sm mt-10">
    
                  <svg class="fill-current mr-2 text-stone-500 hover:text-stone-900  w-4" viewBox="0 0 448 512">
                    <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                  </svg>
                  Continue Shopping
    
                </a>

                <button name="update" type ="submit" id="update_button" class="flex ml-auto text-white bg-stone-500 border-0 py-2 px-6 focus:outline-none hover:bg-stone-900 rounded">Update Cart</button>

                <!-- burda bu butonla sayfaya geri formu gönder ve update et sayfayı  -->
    
              </div> <!-- end of the left cart page block -->
    
              <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                  <span class="font-semibold text-sm uppercase">Total Items: <?php echo array_sum($products_in_cart)?> </span>
                  <span class="font-semibold text-sm">₺<?php echo number_format(($subtotal),2,".",",")?></span>
                </div>
                <div>
                  <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                  <select class="block p-2 text-gray-600 w-full text-sm">
                    <option>Standard shipping - ₺20.00</option>
                  </select>
                </div>
    
                <div class="border-t mt-8">
                  <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Total cost</span>
                    <span>₺<?php echo number_format(($subtotal+20),2,".",",")?></span>
                  </div>
                  <button type = "submit" name="placeorder" class="flex ml-auto text-white bg-stone-500 border-0 py-2 px-6 focus:outline-none hover:bg-stone-900 rounded">Checkout</button>
                </div>
              </div>
    
            </div>
          </div>

        </div>
        <?php include_once '../components/footer.php'; ?>
    </div>

</html>


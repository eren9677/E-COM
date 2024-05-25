
<!-- BU SAYFADA KALDINNN -->

<!-- bu sayfaya get_id checker ekle eger kullanıcı olmayan bir id girerse 404.php'e götür -->





<?php 
    //this page will mainlywork on dynamically automating the product card components 
    session_start();

    include_once("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php"); //include config.php file and functions

    $query = <<<QUERY_TEXT
    SELECT * FROM products LEFT JOIN categories ON products.id = categories.category_id WHERE products.id = 
    QUERY_TEXT;

    $query .= $_GET["id"];

    $results = query_parser($query);
  
    // print_r($results); //yes it works
 
?>

<?php include_once '../components/header.php'; ?>

<section class="text-gray-600 body-font overflow-hidden">
  <form action="cart.php" method="post"> 
      <div class="container px-5 py-24 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class=" object-contain object-center rounded  p-6 h-96 w-96" src=<?php echo $results[0]["img"]?>>
      
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
      
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?php echo $results[0]["brand"] ?></h2>
      
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?php echo $results[0]["title"] ?></h1>
      
                <div class="flex mb-4">
      
                  <span class="flex items-center">
                    <span class="text-gray-600 ml-3"><?php echo $results[0]["quantity"]." In Stock"?></span>
                  </span>
      
                  <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200 space-x-2s">
      
                    <a href="contact.php">
                      <!-- show this message if the quantitiy is 0 otherwise write other text  -->
                      <div class = "text-gray-600">
                        Contacts us for restocking
                      </div>
                    </a>
      
                  </span>
                </div>
                <p class="leading-relaxed"><?php echo $results[0]["description"] ?></p>
                <br>
      
                <!-- <div class="mb-6 flex items-center gap-2 text-gray-500">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                  </svg>
      
                  <span class="text-sm">2-4 day shipping</span>
                </div> -->
      
      
      
                <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
      
                  <div class="mb-6 flex items-center gap-2 text-gray-500 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
      
                    <span class="text-sm">2-4 day shipping</span>
                  </div>
      
      
      
                  <div class="flex ml-auto mb-6 items-center text-gray-500 ">
                    <span class="mr-3">Select Quantity : </span>
                  </div>
      
      
                  <div class="flex mb-6 items-center border-gray-100">
                        <span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-stone-500 " id="decrement_button"> - </span>
                        <input name="product_buy_quantity" class="h-8 w-8 border bg-white text-center text-xs outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" value="1" min="1" id="adjustable_quantity_number" onkeydown="preventKeyboardInput(event)"/>
                        <span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-stone-500 " id = "increment_button"> + </span>
                  </div>
      
                  <script>
                            function preventKeyboardInput(event) {
                                event.preventDefault();
                                }
      
                            document.addEventListener("DOMContentLoaded", function() {
      
                                document.getElementById('increment_button').addEventListener('click', function() {
                                  if(document.getElementById('adjustable_quantity_number').valueAsNumber < <?=$results[0]['quantity']?>)
                                    document.getElementById('adjustable_quantity_number').valueAsNumber++;
                                });
      
                                document.getElementById('decrement_button').addEventListener('click', function() {
                                    if(document.getElementById('adjustable_quantity_number').valueAsNumber > 1){
                                        document.getElementById('adjustable_quantity_number').valueAsNumber--;
      
                                    }
                                });
                            });
                  </script>
      
      
                </div>
      
                <div class="flex">
      
                  <span class="title-font font-medium text-2xl text-gray-900">₺<?php echo number_format($results[0]["price"], 2,",", "."); ?></span>

                  <input type="hidden" name="product_id" value = <?php echo $results[0]['id']?> >
                  <input type="hidden" name="product_img" value = <?php echo $results[0]["img"]?> >
                  <input type="hidden" name="product_title" value = <?php echo $results[0]['title']?> >
                  <input type="hidden" name="product_brand" value = <?php echo $results[0]['brand']?> >
                  <input type="hidden" name="product_stock" value = <?php echo $results[0]['quantity']?> >
                  <input type="hidden" name="product_price" value = <?php echo $results[0]['price']?> >
      
                  <button type = "submit" id = "button_send" class="flex ml-auto text-white bg-stone-500 border-0 py-2 px-6 focus:outline-none hover:bg-stone-900 rounded">Add to Cart</button>
      
                  <script>document.getElementById('button_send').value = document.getElementById('adjustable_quantity_number').valueAsNumber</script>
      
                </div>
      
              </div>
      
            </div>
      </div>
      <?php include_once "../components/footer.php"?>

  </form>
</section>
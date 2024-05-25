<?php
    session_start();
    include("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php");


    //burda öncelikle aldığın productları destroy etmeden bir göstermen lazım sayfanın en sonunda da destroy edersin session bilgilerini bu çok oneml, 1

    //sonra da burda productları gösterdiğin bir sayfaya dönüştürebilirsin ya d asenin istediğin gibi kalıor bilmiyorum tam olarak


    //eğer götermek istermiyorsan da modal kullanıp teşekkür edersin ve yine sayfanın sonunda sessionları hemen destroy etmeden yani burda
    //en üsste burda database'den düşmen lazım product quantitiyleri !

    //sonra da burda istersne ordered productları gösterebilirsin şimdi sana veriler postla gelmediği sürece sorun yok burda o yüzden sessiondan tüm verileri check et ve kullan benceeğğğğhh


    //echo "<pre>" ; print_r($_SESSION);//çalımadı çünkü bu sayfaya gelmeden session variableLarı sıfırladın ztane !
    //tamam dookunma calısıo


    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
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
    
    
    
      $products = query_parser($q);
      // echo "<pre>"; print_r($products);
    
    //   foreach ($products as $product) {


    //     echo "<pre>" ;echo $product["title"];
    //   }
    }
    $subtotal = isset($_SESSION["total_price"]) ? $_SESSION["total_price"]: array();






    $queryy = <<<QUERY

    INSERT INTO orders (name, surname ,email ,Address, city, country, phone_num, zipcode, total, products)
    VALUES (

    QUERY;


    $queryy.= "'".$_SESSION["address_info"]["name"]."',";
    $queryy.= "'".$_SESSION["address_info"]["surname"]."',";
    $queryy.= "'".$_SESSION["address_info"]["email"]."',";
    $queryy.= "'".$_SESSION["address_info"]["address"]."',";
    $queryy.= "'".$_SESSION["address_info"]["city"]."',";
    $queryy.= "'".$_SESSION["address_info"]["country"]."',";
    $queryy.= "".$_SESSION["address_info"]["phone"].",";
    $queryy.= "".$_SESSION["address_info"]["zipcode"].",";


    $queryy .= "'".$subtotal."',";

    //$queryy .= "'deneme',"; //bu kısım için uğraş 

    $prods = json_encode($_SESSION["cart"]);

    $queryy .= "'".$prods."'";

    //echo $prods;
    $queryy = rtrim($queryy, ",");
    $queryy .= ");";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";

   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $conn->query($queryy);

    // $conn->close();

    foreach($_SESSION["cart"] as $k => $v ):
        $decreeese = <<<DEC
        UPDATE products 
        SET quantity = quantity - 
        DEC;
        $decreeese .= $v." WHERE id = ".$k;
        $conn->query($decreeese);

    endforeach;
    $conn->close();
    




    

//buraya dokunmadan önce database designini düzelt!! 




?>




<html>

    
    <div class="flex flex-col h-screen">

        <?php include_once '../components/header.php'; ?>

        <!-- aşağıdaki div'in içine content gelecek!!! -->
        <!-- flex grow kullan ekleyeceğin contentin classında !!! -->


        <div class="bg-gray-50 flex-grow">

          <div class="container mx-auto mt-10">
            <div class="flex shadow-md my-10">   <!--burda flex growa bak -->
    
              <div class="w-3/4 bg-white px-10 py-10">
    
                <div class="flex justify-between border-b pb-8"> <!-- titles of the cart -->
    
                  <h1 class="font-semibold text-2xl">Thanks For Your Order!!</h1>
                  <h2 class="font-semibold text-2xl"><?php echo sizeof($products_in_cart)?> Items</h2>
    
                </div> <!-- end of cart titles -->
    
                <div class="flex mt-10 mb-5"> <!-- start of cart detail -->
    
                  <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center ">Quantity</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price Per Product</h3>
                  <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center ">Total</h3>
    
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

                        <input name="quantity-<?=$product['id']?>" class="h-8 w-8 border bg-white text-center text-xs outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" type="number" value=<?php echo (int)$products_in_cart[(int)$product['id']]?> min="1"  id="adjustable_quantity_number<?php echo$product["id"] ?>" onkeydown="preventKeyboardInput(event)"/>
    
                    </div>
    
                    <script>
                            function preventKeyboardInput(event) {
                                event.preventDefault();
                                };
                    </script>
    
                  </div>  <!-- end of the quantity button tag -->
    
                  <span class="text-center w-1/5 font-semibold text-sm">₺<?php echo number_format($product["price"],2,".",",") ?></span>
                  <span id="final_price_of_product" class="text-center w-1/5 font-semibold text-sm">₺<?php echo number_format(($products_in_cart[$product["id"]] * $product["price"]),2,".",",") ?></span> 
    
                </div>   <!-- end of the product card block -->

                <?php } 
                
                ?>

                
              </div> <!-- end of the left cart page block -->
    
              <div id="summary" class="w-1/2 px-8 py-10 ml-10">

                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>

                <div class="flex justify-between mt-6 mb-2">
                  <span class="font-semibold text-sm uppercase">Total Items: <?php echo array_sum($products_in_cart)?> </span>

                  <span class="font-semibold text-sm">₺<?php echo number_format(($subtotal-20),2,".",",")?></span>
                </div>

                <div class="flex justify-between">
                  <label class="font-medium inline-block mb-2 text-sm uppercase">Shipping: </label>
                  <span class="font-semibold text-sm"> ₺20.00</span>
                </div>
    
                <div class="border-t mt-4">
                  <div class="flex font-semibold justify-between py-2 text-sm uppercase mx-2">
                    <span>Total cost</span>
                    <span>₺<?php echo number_format(($subtotal),2,".",",")?></span>
                  </div>
                </div>




                <div>
                    <h1 class="font-semibold text-2xl border-b pb-2 py-2 pt-4">Customer Information</h1>

                    <div>
                        <label class="font-semibold text-sm uppercase">Name:</label>
                        <span class="font-semibold text-sm text-gray-800"><?php echo $_SESSION["address_info"]["name"]?></span>
                    </div>
                    <div>
                        <label class="font-semibold text-sm uppercase">Surname:</label>
                        <span class="font-semibold text-sm text-gray-800"><?php echo $_SESSION["address_info"]["surname"]?></span>
                    </div>
                    <div>
                        <label class="font-semibold text-sm uppercase">E-mail:</label>
                        <span class="font-semibold text-sm text-gray-800"><?php echo $_SESSION["address_info"]["email"]?></span>
                    </div>
                    <div>
                        <label class="font-semibold text-sm uppercase">Phone Number:</label>
                        <span class="font-semibold text-sm text-gray-800"><?php echo $_SESSION["address_info"]["phone"]?></span>
                    </div>


                    <div class="border-t mt-4"></div>
                </div>


                
              </div>





              <div id="addresssummary" class="w-1/2 px-8 py-10 ml-10">
                
                <h1 class="font-semibold text-2xl border-b pb-8">Address Summary</h1>


                <?php


                    $address = $_SESSION["address_info"];

                    $result["address_info"] = []; 

                    $wanted_keys = ["address", "city", "country", "zipcode"];

                    foreach ($wanted_keys as $key) {
                    if (isset($address[$key])) {
                        $result["address_info"][$key] = $address[$key];
                    }
                    }

                    foreach($result["address_info"] as $k => $v):
                
                ?>


                <div>
                  <label class="font-semibold text-sm uppercase"><?php echo $k?>:</label>
                  <span class="font-semibold text-sm text-gray-800"><?php echo $v?></span>
                </div>


                <?php

                    endforeach;
                
                ?>


    
                <div class="border-t mt-8">
                    <br>
                </div>

                <a href="home.php" class="flex w-2/4 ml-auto text-white bg-stone-500 border-0 py-2 px-4 focus:outline-none hover:bg-stone-900 rounded">Back To Home</a>

              </div>
            

            
            
            </div>
          </div>

        </div>
        <?php include_once '../components/footer.php'; ?>
    </div>

<?php 

                //echo $queryy; //query istenilen gibi

                //query_parser($queryy);

                //echo("Success!"); //sonunda bu da calisti

                session_unset();
                session_destroy();



                //simdi de burda düşmen lazım databa

                //print_r($final);
              


                
                    //burda sessionu destroy etmeden önce database stocktan alınan ürün kadar düşmelisin
                    //ve order informationu da database'e order numarasıyla girmelisin 

                    //bunları kapanmaya yakın değil de bi block öncesi yapıp order id'i frontend kullanıcısına gösterebilriim 

?>
</html>
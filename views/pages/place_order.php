<?php
    session_start();
    include("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php");
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    //postla kendine gönder formu ve bunu da sessionda sakla!!!


    $form_variables = array("name","surname","email","address","city","country","phone","zipcode");
    $_SESSION["address_info"] = array();
    foreach($form_variables as $k =>$v){
      if(isset($_POST[$v]) && !empty($_POST[$v])){
      $_SESSION['address_info'] += array($v => $_POST[$v]);
      }
      else{
        continue;
      }
    }

//burda kaldın!!!!!!!!!!!!!!

  //this is for redirecting the page to payment page
  if (isset($_POST['finishaddress']) && isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_SESSION['address_info']) && !empty($_SESSION['address_info']) ) {

    //tamam bu çalışıyor şimdi session'a bu verileri ekle

    // //sakın bu kısma da dokunma lsdjhfgljk
    // $form_variables = array("full_name","email","address","city","country","phone_num","zipcode");
    // $_SESSION["address_info"] = array();
    // foreach($form_variables as $k =>$v){
    //   $_SESSION['address_info'] += array($v => $_POST[$v]);
    // }
    


//dokunma bu kısma
    header('Location: payment.php');
    exit;
  }

?>




<html>
    <form action="place_order.php" method="post">
        <div class="flex flex-col h-screen">
            <?php include("../components/header.php");?>
            <div class=" p-6 bg-gray-50 flex flex-grow items-center justify-center pt-6 mb-6">
        
              <div class="container max-w-screen-lg mx-auto">
                  <h2 class="font-semibold text-xl text-gray-600">Please Enter Your Shipping Address</h2>
                  <p class="text-gray-500 mb-6"> Let us bring it to your door :)</p>
        
                  <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6"> <!-- start of the white form part -->
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                      <div class="text-gray-600">
                        <p class="font-medium text-lg">Address</p>
                        <p>Please fill out all the fields to purchase <?php echo array_sum($products_in_cart)?> Items.</p>
                      
                        <div class=" mx-10 ">
                          <svg width="200px" height="200px" viewBox="0 0 1024 1024" fill="#000000" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 1012.8c-253.6 0-511.2-54.4-511.2-158.4 0-92.8 198.4-131.2 283.2-143.2h3.2c12 0 22.4 8.8 24 20.8 0.8 6.4-0.8 12.8-4.8 17.6-4 4.8-9.6 8.8-16 9.6-176.8 25.6-242.4 72-242.4 96 0 44.8 180.8 110.4 463.2 110.4s463.2-65.6 463.2-110.4c0-24-66.4-70.4-244.8-96-6.4-0.8-12-4-16-9.6-4-4.8-5.6-11.2-4.8-17.6 1.6-12 12-20.8 24-20.8h3.2c85.6 12 285.6 50.4 285.6 143.2 0.8 103.2-256 158.4-509.6 158.4z m-16.8-169.6c-12-11.2-288.8-272.8-288.8-529.6 0-168 136.8-304.8 304.8-304.8S816 145.6 816 313.6c0 249.6-276.8 517.6-288.8 528.8l-16 16-16-15.2zM512 56.8c-141.6 0-256.8 115.2-256.8 256.8 0 200.8 196 416 256.8 477.6 61.6-63.2 257.6-282.4 257.6-477.6C768.8 172.8 653.6 56.8 512 56.8z m0 392.8c-80 0-144.8-64.8-144.8-144.8S432 160 512 160c80 0 144.8 64.8 144.8 144.8 0 80-64.8 144.8-144.8 144.8zM512 208c-53.6 0-96.8 43.2-96.8 96.8S458.4 401.6 512 401.6c53.6 0 96.8-43.2 96.8-96.8S564.8 208 512 208z" fill="" /></svg>
                        </div>

                      </div>
        
                      <div class="lg:col-span-2"> <!-- start of the form inputs column -->
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                          <div class="md:col-span-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                          </div>

                          <div class="md:col-span-2">
                            <label for="surname">Surname</label>
                            <input type="text" name="surname" id="surname" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                          </div>
        
                          <div class="md:col-span-5">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="email@domain.com" />
                          </div>
        
                          <div class="md:col-span-3">
                            <label for="address">Address / Street</label>
                            <input type="text" name="address" id="address" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                          </div>
        
                          <div class="md:col-span-2">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                          </div>
        
                          <div class="md:col-span-2">
                            <label for="country">Country</label>
                            <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                              <input name="country" id="country" placeholder="Country" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                            </div>
                          </div>

                          <div class="md:col-span-2">
                            <label for="phone">Phone Number</label>
                            <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                              <input name="phone" id="phone" placeholder="Phone Number" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                            </div>
                          </div>
        
                          <div class="md:col-span-1">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" name="zipcode" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="" />
                          </div>
        
                          <!-- this is the continue button  -->
                          <div class="md:col-span-5 text-right">
                            <div class="inline-flex items-end">
                                <button name="finishaddress" type = "submit" id = "button_send" class="flex ml-auto text-white bg-stone-500 border-0 py-2 px-6 focus:outline-none hover:bg-stone-900 rounded">Proceed to Payment</button>
                            </div>
                          </div>
                          <!-- end of the button  -->
        
                        </div>
                      </div>
                      <!-- end of the columns -->
                    </div>
                  </div>
                  <!-- end of the white form part -->
        
              </div>
              <!-- end of the middle page part container -->
            </div>
            <!-- end of the middle page content -->
        
            <?php include("../components/footer.php");?>
        </div>
        <!-- this div is the end of the whole page -->
    </form>

</html>

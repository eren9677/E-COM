<?php
    session_start();
    include("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php");
    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    //postla kendine gönder formu ve bunu da sessionda sakla!!!

    //buna veriler post'la gelmeyecek direkt session'a gidecek

    // echo "<pre>"; print_r($_SESSION);

//burda kaldın!!!!!!!!!!!!!!
  $form_variables = array("card_num","exp","cvv2");
  $_SESSION["card_info"] = array();
  foreach($form_variables as $k =>$v){
    if(isset($_POST[$v]) && !empty($_POST[$v])){
    $_SESSION['card_info'] += array($v => $_POST[$v]);
    }
    else{
      continue;
    }
  }

    //echo "<pre>"; print_r($_SESSION);



//tüm sessiondaki verileri database'e aktar 

  //this is for redirecting the page to payment page
  if (isset($_POST['finishpayment']) && isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_SESSION['card_info']) && !empty($_SESSION['card_info']) ) {


    //buraya session destroy ekle!!

    //session_destroy(); simdilik böle kalsın

    header('Location: thanks_for_order.php');
    exit;
  }

?>
<!-- there will be a card info page in here and when i press button it will post the request itself and update dtaabse then destroy all the sessions. -->
<html>
    <form action="payment.php" method="post">
        <div class="flex flex-col h-screen">
            <?php include("../components/header.php");?>
            <div class=" p-6 bg-gray-50 flex flex-grow items-center justify-center pt-6 mb-6">
        
              <div class="container max-w-screen-lg mx-auto">
                  <h2 class="font-semibold text-xl text-gray-600">Please Enter Your Card Information</h2>
                  <p class="text-gray-500 mb-6"> Don't actually enter it :)</p>
        
                  <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6 mx-36"> <!-- start of the white form part -->
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                      <div class="text-gray-600">
                        <p class="font-medium text-lg">Credit Card Information</p>
                        <p> Fill to buy <?php echo array_sum($products_in_cart)?> items for ₺<?php echo number_format($_SESSION["total_price"],2,".",",")?></p>
                        

                        <div class="mr-5 ml-5 mt-5 mb-5">
                            <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="170px" height="170px" viewBox="0 0 44.557 44.557"
                                        xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M42.313,20.889L22.592,1.166C21.815,0.389,20.797,0,19.779,0s-2.037,0.389-2.813,1.166l-10.8,10.798
                                                c-1.554,1.554-1.554,4.122,0,5.676l1.79,1.839h4.129l-3.854-3.904c-0.27-0.271-0.31-0.61-0.31-0.774s0.04-0.491,0.31-0.761
                                                l1.426-1.382l6.777,6.821h6.501L12.907,9.401l6.123-6.147c0.27-0.27,0.585-0.321,0.749-0.321s0.479,0.034,0.749,0.303
                                                l19.722,19.72c0.271,0.271,0.312,0.583,0.312,0.748c0,0.164-0.07,0.478-0.341,0.749l-1.118,1.091v4.129l3.184-3.155
                                                C43.84,24.961,43.868,22.443,42.313,20.889z"/>
                                            <path d="M33.06,21.328H5.167c-2.197,0-4.076,1.77-4.076,3.967v10.55h35.898v-10.55C36.989,23.098,35.257,21.328,33.06,21.328z
                                                M10.839,32.253c-0.779,0-1.484-0.31-2.004-0.81c-0.52,0.5-1.226,0.81-2.003,0.81c-1.598,0-2.895-1.295-2.895-2.896
                                                c0-1.599,1.296-2.895,2.895-2.895c0.778,0,1.484,0.309,2.003,0.809c0.52-0.5,1.225-0.809,2.004-0.809
                                                c1.599,0,2.895,1.296,2.895,2.895C13.734,30.958,12.438,32.253,10.839,32.253z"/>
                                            <path d="M1.091,40.566c0,2.197,1.878,3.99,4.076,3.99H33.06c2.197,0,3.93-1.793,3.93-3.99v-0.234H1.091V40.566z"/>
                                        </g>
                                    </g>
                            </svg>
                        </div>


                      </div>
        
                      <div class="lg:col-span-2"> <!-- start of the form inputs column -->
                        <div class="grid gap-5 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 my-10">

                          <div class="md:col-span-5 ">
                            <label for="card_num">Card Number</label>
                            <input type="text" name="card_num" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="xxxx-xxxx-xxxx-xxxx" />
                          </div>
        

                          <div class="md:col-span-1">
                            <label for="exp">Exp. Date </label>
                            <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                              <input tye="text" name="exp" id="exp" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" placeholder="01/27"/>
                            </div>
                          </div>
        
                          <div class="md:col-span-1">
                            <label for="cvv2">CVV2</label>
                            <input placeholder="xxx" type="text" name="cvv2" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="" />
                          </div>
        
                          <!-- this is the continue button  -->
                          <div class="md:col-span-5 text-right mt-10">
                            <div class="inline-flex items-end">
                                <button name="finishpayment" type = "submit" id = "button_send" class="flex ml-auto text-white bg-stone-500 border-0 py-2 px-6 focus:outline-none hover:bg-stone-900 rounded">Finish Payment</button>
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

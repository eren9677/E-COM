<?php 
    //this page will mainlywork on dynamically automating the product card components 
    session_start();


    include_once("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php"); //include config.php file and functions


    $query = <<<QUERY_TEXT
      SELECT * FROM products 
      LEFT JOIN categories ON products.category_id = categories.category_id
      ORDER BY products.date_added DESC LIMIT 12;
    QUERY_TEXT;

    $results = query_parser($query);
   //print_r($results[0]["title"]); //works finallyyy


    $query_2 = <<<QUERY_TEXT
    SELECT * FROM categories LIMIT 3;
    QUERY_TEXT;

    $results_2 = query_parser($query_2);
?>

<html>
    <div class="flex flex-col h-screen">
        <?php include_once '../components/header.php'; ?>


        <section class="flex-grow text-gray-600 body-font container px-5 py-17 mx-auto">
            </br>


            <section class="text-gray-600 body-font">
              <div class="container px-5 py-12 mx-auto">
    
                    <div class="flex flex-wrap w-full mb-10">
    
                        <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
    
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Featured Categories</h1>
                            <div class="h-1 w-20 bg-stone-500 rounded"></div>
                            <!-- title and the line under the title tag -->
    
                        </div>
    
                        <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                        Your one-stop shop for everything you need and more! Check our featured categories!
                        </p>
    
                    </div>
    
                <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
    
                <?php
                    foreach($results_2 as $k => $v):
    
                ?>
    
                  <a href="category_detail.php?id=<?php echo $v["category_id"]?>">
                      <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
                        <div class="rounded-lg h-64 overflow-hidden">
                          <img alt="content" class="object-cover object-center h-full w-full" src="<?php echo $v["category_img"] ?>">
                        </div>
                        <h2 class="text-xl font-medium title-font text-gray-900 mt-5"><?php echo $v["category_name"]?></h2>
                        <p class="text-base leading-relaxed mt-2"><?php echo $v["category_description"]?></p>
                        <a href="category_detail.php?id=<?php echo $v["category_id"]?>" class="text-gray-500 inline-flex items-center mt-3 hover:text-gray-900" >Learn More
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                          </svg>
                        </a>
                      </div>
                  </a>
    
                <?php
                    endforeach;
    
                ?>
    
                </div>
              </div>
            </section>







            <div class="flex flex-wrap w-full mb-20 my-6">

                <div class="lg:w-1/2 w-full  lg:mb-0">

                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Recently Added Products</h1>
                    <div class="h-1 w-20 bg-stone-500 rounded"></div>
                    <!-- title and the line under the title tag -->

                </div>

                <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                    Stay updated with our latest arrivals, freshly added to our collection. From fashion to tech, explore what's trending now. If you're unsure what to buy, our recent additions offer inspiration and options.
                </p>

            </div>
            <!-- end of the recent added part tag -->

            <div class="flex flex-wrap -m-4">
                
                <?php
                    foreach($results as $key => $value){
                
                ?>

                <div class="lg:w-1/4 md:w-1/2 p-4 w-full">

                    <a href="product_detail.php?id=<?php echo $results[$key]["id"]?>" class="block relative h-48 rounded overflow-hidden">
                        <img alt="ecommerce" class="object-contain object-center w-full h-full block" src="<?php  echo $results[$key]["img"]?>">
                    </a>
                    <!-- end of the image part -->
                    
                    <a href="product_detail.php?id=<?php echo $results[$key]["id"]?>">
                        <div class="mt-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?php echo $results[$key]["category_name"]?></h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium"><?php echo $results[$key]["title"]?></h2>
                            <p class="mt-1">₺<?php echo number_format($results[$key]["price"], 2,",", "."); ?></p>
                        </div>
                    </a>
                    <!-- end of the text part -->

                </div>
                <!-- end of the product block card  -->

                <?php

                }

                
                ?>
                <!-- end of the lopp -->




            </div>
            <!-- end of the product  card skeleton  -->

        </section>
        <!-- end of the page content section tag  -->


        <?php include_once '../components/footer.php'; ?>
    </div>
</html>

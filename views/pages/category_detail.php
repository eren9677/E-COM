<?php 
    //this page will mainlywork on dynamically automating the product card components 
    session_start();

    include_once("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php"); //include config.php file and functions

    $query = <<<QUERY_TEXT
    SELECT * FROM products LEFT JOIN categories ON categories.category_id = products.category_id WHERE categories.category_id = 
    QUERY_TEXT;

    $query .= $_GET["id"];

    $results = query_parser($query);


  
    // echo "<pre>" ;print_r($results); //yes it works
 
?>

<html>
    <div class="flex flex-col h-screen">
        <?php include_once '../components/header.php'; ?>


        <section class="flex-grow text-gray-600 body-font container px-5 py-17 mx-auto">
        </br>

            <div class="flex flex-wrap w-full mb-20 my-6">

                <div class="lg:w-1/2 w-full  lg:mb-0">

                
                    <?php if(!empty($results)){?>
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">All <?php echo $results[0]["category_name"]?> Products:</h1>
                    <?php } else{?>
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">There are no products in this category yet.</h1>
                    <?php }?>
                    <div class="h-1 w-20 bg-stone-500 rounded"></div>
                    <!-- title and the line under the title tag -->


                </div>

            </div>
            <!-- end of the recent added part tag -->

            <div class="flex flex-wrap -m-4">
                
                <?php
                if(!empty($results)){
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

                }}

                
                ?>
                <!-- end of the lopp -->




            </div>
            <!-- end of the product  card skeleton  -->

        </section>
        <!-- end of the page content section tag  -->


        <?php include_once '../components/footer.php'; ?>
    </div>
</html>










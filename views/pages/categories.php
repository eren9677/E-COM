
<?php 
    //this page will mainlywork on dynamically automating the product card components 
    session_start();


    include_once("/Applications/XAMPP/xamppfiles/htdocs/views/components/config.php"); //include config.php file and functions


    $query = <<<QUERY_TEXT
      SELECT * FROM categories;
    QUERY_TEXT;

    $results = query_parser($query);
   //print_r($results[0]["title"]); //works finallyyy
?>



<html>
    <div class="flex flex-col h-screen">
        <?php include_once '../components/header.php'; ?>
        <div class="flex-grow">
            <section class="text-gray-600 body-font">
              <div class="container px-5 py-12 mx-auto">
    
                    <div class="flex flex-wrap w-full mb-20">
    
                        <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
    
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">All Categories</h1>
                            <div class="h-1 w-20 bg-stone-500 rounded"></div>
                            <!-- title and the line under the title tag -->
    
                        </div>
    
                        <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                        Your one-stop shop for everything you need and more! From the perfect outfit to the gear for your next adventure, explore our comprehensive Categories section to see all we offer. Discover hidden gems, explore trending products, and find exactly what you've been searching for, all within the convenience of one website.
                        </p>
    
                    </div>
    
                <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
    
                <?php
                    foreach($results as $k => $v):
    
                ?>
    
                  <a href="category_detail.php?id=<?php echo $v["category_id"]?>">
                    <div class="p-4 md:w-1/3 sm:mb-0 mb-6">
                      <div class="rounded-lg h-64 overflow-hidden">
                        <img alt="content" class="object-cover object-center h-full w-full" src= "<?php echo $v["category_img"] ?>">
                      </div>
                      <h2 class="text-xl font-medium title-font text-gray-900 mt-5"><?php echo $v["category_name"]?></h2>
                      <p class="text-base leading-relaxed mt-2"><?php echo $v["category_description"]?></p>
                      <a href = "category_detail.php?id=<?php echo $v["category_id"]?>" class="text-gray-500 inline-flex items-center mt-3 hover:text-gray-900">Learn More
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
        </div>
    
        <?php include_once '../components/footer.php'; ?>
    </div>
</html>
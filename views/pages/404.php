<script src="https://cdn.tailwindcss.com"></script> 
<!-- <div class="min-h-screen flex flex-grow items-center justify-center bg-gray-50">
  <div class="rounded-lg bg-white p-8 text-center shadow-xl">
    <h1 class="mb-4 text-4xl font-bold">404</h1>
    <p class="text-gray-600">Oops! The page you are looking for could not be found.</p>
    <a href="home.php" class="mt-4 inline-block rounded bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"> Go back to Home </a>
  </div>
</div> -->

<!-- şimdi bu iki ayrı 404 error sayfasıdır en dinamik vw güzel olan şimdi çalışan koddur. -->

<!-- <div class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
            <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
                <div class="relative">
                    <div class="absolute">
                        <div class="">
                            <h1 class="my-2 text-gray-800 font-bold text-2xl">
                            Oops! The page you are looking for could not be found.
                            </h1>
                            <p class="my-2 text-gray-800">Sorry.</p>
                            <a href="home.php" class="mt-4 inline-block rounded bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600"> Go back to Home </a>
                        </div>
                    </div>
                    <div>
                        <img src="https://i.ibb.co/G9DC8S0/404-2.png" />
                    </div>
                </div>
            </div>
            <div>
                <img src="https://i.ibb.co/ck1SGFJ/Group.png" />
            </div>
        </div> -->
<?php #include_once '../components/footer.php'; ?>

<html>
    <div class="flex flex-col h-screen">
        <div class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse flex-grow lg:flex-row md:gap-28 gap-16">
            <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
                <div class="relative">
                    <div class="absolute">
                        <div class="">
                            <h1 class="my-2 text-gray-800 font-bold text-2xl">
                            Oops! The page you are looking for could not be found.
                            </h1>
                            <p class="my-2 text-gray-800">Sorry.</p>
                            <a href="home.php" class=" ml-auto text-white bg-stone-500 border-0 py-2 px-6 focus:outline-none hover:bg-stone-900 rounded"> Go back to Home </a>
                        </div>
                    </div>
                    <div>
                        <img src="/images/logos/404.png" />
                    </div>
                </div>
            </div>
            <div>
                <img src="/images/logos/plug_out.png" />
            </div>
        </div> 
        <?php include_once '../components/footer.php'; ?>
    </div>
</html>
<?php
//including connect file

include('./includes/connect.php');


//if in future any problem arise and the ou need to get the old code back
// just go in the backup.php file and get everything from line 118 and beyond and paste from
//line 11 to 91
// Function to get random products if neither category nor brand is specified
function getproducts(){
    global $con;

    // Check if neither category nor brand is specified
    if(!isset($_GET['category']) && !isset($_GET['brand'])){
        $select_query="SELECT * FROM `products` ORDER BY RAND() LIMIT 0,9";
        $result_query=mysqli_query($con,$select_query);

        // Check if there are products
        if(mysqli_num_rows($result_query) > 0){
            // Loop through the products and display them
            while($row=mysqli_fetch_assoc($result_query)){
                // Output product HTML
                output_product_html($row);
            }
        } else {
            echo "<h2 class='text-center text-danger'>No products available</h2>";
        }
    }
}

//getting all products
function get_all_products(){
    global $con;

    // Check if neither category nor brand is specified
    if(!isset($_GET['category']) && !isset($_GET['brand'])){
        $select_query="SELECT * FROM `products` ORDER BY RAND()";
        $result_query=mysqli_query($con,$select_query);

        // Check if there are products
        if(mysqli_num_rows($result_query) > 0){
            // Loop through the products and display them
            while($row=mysqli_fetch_assoc($result_query)){
                // Output product HTML
                output_product_html($row);
            }
        } else {
            echo "<h2 class='text-center text-danger'>No products available</h2>";
        }
    }
}

// Function to get products by category
function get_unique_categories(){
    global $con;

    // Check if category is specified
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
        $select_query="SELECT * FROM `products` WHERE category_id=$category_id";
        $result_query=mysqli_query($con,$select_query);

        // Check if there are products
        if(mysqli_num_rows($result_query) > 0){
            // Loop through the products and display them
            while($row=mysqli_fetch_assoc($result_query)){
                // Output product HTML
                output_product_html($row);
            }
        } else {
            echo "<h2 class='text-center text-danger'>No products available in this category</h2>";
        }
    }
}

// Function to get products by brand
function get_unique_brands(){
    global $con;

    // Check if brand is specified
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
        $select_query="SELECT * FROM `products` WHERE brand_id=$brand_id";
        $result_query=mysqli_query($con,$select_query);

        // Check if there are products
        if(mysqli_num_rows($result_query) > 0){
            // Loop through the products and display them
            while($row=mysqli_fetch_assoc($result_query)){
                // Output product HTML
                output_product_html($row);
            }
        } else {
            echo "<h2 class='text-center text-danger'>No products available for this brand</h2>";
        }
    }
}

// Function to output product HTML
function output_product_html($row) {
    $product_id=$row['product_id'];
    echo "<div class='col-md-4 mb-2'>
            <div class='card' style='width: 18rem;'>
              <img src='./admin_area/product_images/{$row['product_image1']}' class='card-img-top' alt='{$row['product_title']}'>
              <div class='card-body'>
                <h5 class='card-title'>{$row['product_title']}</h5>
                <p class='card-text'>{$row['product_description']}</p>
                <a href='#' class='btn btn-primary'>Add to cart</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>View more</a>
              </div>
            </div>
          </div>";
}

//displaying brands in side nav
function getbrands(){
    global $con;
    $selec_brands="select * from `brands`";
$result_brands=mysqli_query($con,$selec_brands);
// $row_data=mysqli_fetch_assoc($result_brands);
// echo $row_data['brand_title'];
while($row_data=mysqli_fetch_assoc($result_brands)){
  $brand_title=$row_data['brand_title'];
  $brand_id=$row_data['brand_id'];
  echo " <li class='nav-item'>
  <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
</li>";
};
};

//displaying categories in side nav
function getcategories(){
    global $con;
    $selec_categories="select * from `categories`";
$result_categories=mysqli_query($con,$selec_categories);
// $row_data=mysqli_fetch_assoc($result_brands);
// echo $row_data['brand_title'];
while($row_data=mysqli_fetch_assoc($result_categories)){
  $category_title=$row_data['category_title'];
  $category_id=$row_data['category_id'];
  echo " <li class='nav-item'>
  <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
</li>";
};
};

//searching products data

function search_product(){
    global $con;
        if(isset($_GET['search_data_product'])){
        $search_data_value=$_GET['search_data'];
        $search_query="SELECT * FROM `products` WHERE product_keywords like 
        '%$search_data_value%'";
        $result_query=mysqli_query($con,$search_query);
        // $num_of_rows=mysqli_num_rows($result_query);
        // if($num_of_rows == 0){
        //     echo "<h2 class='text-center text-danger'>No results match. No products
        //     found in this category!</h2>";
        // }

        // Check if there are products
        if(mysqli_num_rows($result_query) > 0){
            // Loop through the products and display them
            while($row=mysqli_fetch_assoc($result_query)){
                // Output product HTML
                output_product_html($row);
            }
        } else {
            echo "<h2 class='text-center text-danger'>No results match. No products
            found in this category!</h2>";
        }
    }
}


//view details function
function view_details(){
    global $con;

    // Check if neither category nor brand is specified
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category']) && !isset($_GET['brand'])){
        $product_id=$_GET['product_id'];
        $select_query="SELECT * FROM `products` WHERE product_id=$product_id";
        $result_query=mysqli_query($con,$select_query);
        

        // Check if there are products
        if(mysqli_num_rows($result_query) > 0){
            // Loop through the products and display them
            while($row=mysqli_fetch_assoc($result_query)){
                // Output product HTML
                output_product_html($row);
            }
        } else {
            echo "<h2 class='text-center text-danger'>No products available</h2>";
        }
    }
}
}


?>
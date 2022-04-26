<?php

$upload           =  "uploads";
$user_pic_upload  =  "user_uploads";
$upload_slider  =  "uploads/slider";


// helper functions

function last_id(){
  global $con;

  return mysqli_insert_id($con);
}



function set_message($msg){
  if (!empty($msg)) {
     $_SESSION['message'] = $msg;
  }else{
    $msg = "";

  }
}

function display_message(){

  if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }



}


function redirect($location){

  header("Location: $location ");

}


function query($sql){

  global $con;
  return mysqli_query($con, $sql);
}

function confirm($result){
  global $con;

  if (!$result) {
    die("QUERY FAILED".mysqli_error($con));
  }
}

function escape_string($string){
  global $con;

  return mysqli_real_escape_string($con, $string);
}

function fetch_array($result){
  return mysqli_fetch_array($result);
}

/****************************FRONT END Functions Ends**************************************/

 //get products

function get_products(){

    $query = query("select * from products");

    confirm($query);

    // $rows = mysqli_num_rows($query);
    //
    // if (isset($_GET['page'])) {
    //
    //   $page = preg_replace('#[^0-9]#', '', $_GET['page']);
    //
    //   echo $page;
    // }else{
    //   $page = 1;
    //
    // }
    //
    // $perPage = 6;
    //
    // $lastPage = ceil($rows/$perPage);
    // if ($page < 1) {
    //
    //   $page = 1;
    // }elseif ($page > $lastPage) {
    //
    //   $page = $lastPage;
    // }
    //
    //
    // $middleNumbers = '';
    //
    // $sub1 = $page -1;
    // $sub2 = $page -2;
    // $add1 = $page +1;
    // $add2 = $page +2;
    //
    // if ($page == 1) {
    //
    // //   <li class="page-item active">
    // //   <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
    // // </li>
    // //
    //   $middleNumbers .= '<li class="page-item active"><a>'. $page . '</a></li>';
    //
    //   $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //   '?page= '.$add1.' ">' .$add1. '</a></li>' ;
    //
    //   echo "<ul class='pagination'>$middleNumbers</ul>";
    // }elseif ($page == $lastPage) {
    //
    //   $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //   '?page= '.$sub1.' ">' .$sub1 . '</a></li>' ;
    //   $middleNumbers .= '<li class="page-item active"><a>'. $page . '</a></li>';
    //
    //
    // }elseif ($page > 2 && $page < ($lastPage -1)) {
    //
    //     $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //     '?page= '.$sub2.' ">' .$sub2. '</a></li>' ;
    //     $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //     '?page= '.$sub1.' ">' .$sub1. '</a></li>' ;
    //
    //     $middleNumbers .= '<li class="page-item active"><a>'. $page . '</a></li>';
    //
    //     $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //     '?page= '.$add1.' ">' .$add1. '</a></li>' ;
    //     $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //     '?page= '.$add2.' ">' .$add2. '</a></li>' ;
    //
    //     // echo "<ul class='pagination'>{$middleNumbers}</ul>";
    //
    // }elseif ($page > 1 && $page < $lastPage) {
    //
    //     $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //       '?page= '.$sub1.' ">' .$sub1. '</a></li>' ;
    //
    //     $middleNumbers .= '<li class="page-item active"><a>'. $page . '</a></li>';
    //
    //     $middleNumbers .= '<li class="page-item active"><a class="page-link" href="'.$_SERVER['PHP_SELF'].
    //       '?page= '.$add1.' ">' .$add1. '</a></li>' ;

      // echo "<ul class='pagination'>{$middleNumbers}</ul>";



    // $limit = 'LIMIT ' . ($page-1) * $perPage . ',' .$perPage;
    //
    // $query2 = query("SELECT * FROM products $limit");
    // confirm($query2);
    //
    //
    // $outputPagination = "";
    //
    // if ($lastPage != "1") {
    //
    //
    //
    //
    // }

    while ($row = fetch_array($query)) {

      $product_image = display_image($row['product_image']);

      $product = <<<DELIMETER
      <div class="col-sm-4 col-lg-4 col-md-4">
          <div class="thumbnail">
            <a class="product_card" target="_blank" href="item.php?id={$row['product_id']}">
            <img style="height:250px;" class="product_card" src="../resources/{$product_image}" alt="Image"></a>
              <div class="caption">
                  <h4 class="pull-right">৳{$row['product_price']}</h4>
                  <h4><a href="item.php?id={$row['product_id']}">{$row['product_description']}</a>
                  </h4>
                  <p>{$row['short_desc']}</p></br>
                    <a class="btn btn-primary" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>

              </div>


    </div>
</div>

DELIMETER;

echo $product;

    }
}

function get_categories(){

          $query = query("SELECT * from categories");
          // $send_query = mysqli_query($con, $query);

          confirm($query);
          while ($row = mysqli_fetch_array($query)) {
$product = <<<DELIMETER
<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;

      echo $product;
          }

}



function get_products_in_cat_page(){

    $query = query("select * from products where product_category_id = " .escape_string($_GET['id'])." ");

    confirm($query);

    while ($row = fetch_array($query)) {
      $display_image = display_image($row['product_image']);
      $product = <<<DELIMETER
      <div class="col-sm-4 col-lg-4 col-md-4">
          <div class="thumbnail">
            <a  target="_blank" href="item.php?id={$row['product_id']}">
            <img style="height:250px" class="product_card" src="../resources/{$display_image}" alt="image"></a>
              <div class="caption">
                  <h4 class="pull-right">৳{$row['product_price']}</h4>
                  <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                  </h4>
                  <p>See more snippets like this online store item at</p>
                    <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>

              </div>


    </div>
</div>

DELIMETER;

echo $product;

    }
}






function get_products_in_shop_page(){

    $query = query("select * from products");

    confirm($query);


    while ($row = fetch_array($query)) {

      $display_image = display_image($row['product_image']);

      $product = <<<DELIMETER
      <div class="col-sm-4 col-lg-4 col-md-4">
          <div class="thumbnail">
            <a  target="_blank" href="item.php?id={$row['product_id']}">
            <img style="height:250px;" class="product_card" src="../resources/{$display_image}" alt=""></a>
              <div class="caption">
                  <h4 class="pull-right">৳{$row['product_price']}</h4>
                  <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                  </h4>
                  <p>See more snippets like this online store item at
                    <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to Chart</a>
                  </p>
              </div>


    </div>
</div>

DELIMETER;

echo $product;

    }
}



function login_user(){

  if (isset($_POST['submit'])) {
    $username = escape_string($_POST['username']);
    $password = escape_string($_POST['password']);

    $query = query("SELECT * from users where user_name = '{$username}' and password = '{$password}'");
      confirm($query);

    if(mysqli_num_rows($query) == 0){
      set_message("Your Password {$username} , {$password} or Username is Wrong!");
      redirect("login.php");
    }else{
      $_SESSION['username'] = $username;
      set_message("Welcome {$username} !");
      redirect("admin");
    }


  }



}


function send_message(){
    if (isset($_POST['submit'])) {

      $to = "rawhamikdadchowdhury@gmail.com";
      $form_name  = $_POST['name'];
      $subject  = $_POST['subject'];
      $email  = $_POST['email'];
      $message  = $_POST['message'];

      $headers = "From: {$form_name} {$email} ";

      $result = mail($to, $subject, $message, $headers);

      if (!$result) {

        echo "Error";
        redirect("contact.php");
      }else{
        echo "Sent Successfully";
        redirect("contact.php");
      }
    }
}


function get_orders_admin(){
  $sum = 0;
  $item_quantity = 0;
  foreach ($_SESSION as $name => $value) {


  if(($value > 0) and strlen($name) > 8) {

  $serial = 1;
  if (substr($name, 0, 8) == "product_") {

  $length = strlen($name)-8;

  $id = substr($name, 8 , $length);

  $query = query(" SELECT * FROM products WHERE product_id = " .escape_string($id));
  confirm($query);

  while($row = fetch_array($query)){
  $item_quantity += $value;
  $total = $row['product_price']*$value;

$product = <<<DELIMETER
<tr>
      <td>{$row['product_id']}</td>
      <td>{$row['product_title']}</td>
      <td><img src="http://placehold.it/62x62" alt=""></td>
      <td class="text-center">{$value}</td>
      <td>{$total}</td>
      <td>Jun 2039</td>
     <td>Completed</td>
</tr>

DELIMETER;
$serial = $serial + 1;
  echo $product;


  }

  // $_SESSION['item_total'] = $sum += $total;
  // $_SESSION['item_quantity'] = $item_quantity;


        }

    }

         }



}

/****************************BACk END Functions Ends**************************************/


function display_orders(){
  $query = query("select * from orders");
  confirm($query);

  while($row = fetch_array($query)){
    $orders = <<<DELIMETER
    <tr>

    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a> </td>

    </tr>

DELIMETER;
echo $orders;
  }
}



/****************************** ADmin Products pages *************************************/



function get_products_in_admin(){


  $query = query("select * from products");

  confirm($query);

  while ($row = fetch_array($query)) {
///////////////////////////////////////////
  $category = show_product_category_title($row['product_category_id']);
  $product_image = display_image($row['product_image']);

    $product = <<<DELIMETER
    <tr>
          <td><a href="index.php?edit_product&id={$row['product_id']}">{$row['product_id']}</td></a>
          <td>{$row['product_title']}<br>
            <a href="index.php?edit_product&id={$row['product_id']}"><img style="width:120px;height:120px;" src="../../resources/{$product_image}" alt=""></a>
          </td>
          <td>{$category}</td>
          <td>৳{$row['product_price']}</td>
          <td>{$row['product_quantity']}</td>
          <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>

      </tr>
DELIMETER;

echo $product;

  }

}



/***************************** Add Products in Admin**************************************/

function display_image($picture){

  global $upload;
  return $upload. DS. $picture;
}




function add_product(){

  if (isset($_POST['publish'])) {


    $product_title	       =  escape_string($_POST['product_title']);
    $product_category_id	 =  escape_string($_POST['product_category_id']);
    $product_price	       =  escape_string($_POST['product_price']);
    $product_description	 =  escape_string($_POST['product_description']);
    $short_desc	           =  escape_string($_POST['product_short_description']);
    $product_quantity	     =  escape_string($_POST['product_quantity']);

    $product_image         =  escape_string($_FILES['file']['name']);
    $image_temp_location   =  escape_string($_FILES['file']['tmp_name']); //temporary Location



    copy($image_temp_location , UPLOAD_DIRECTORY . DS . $product_image); //copying picture into directory file

    $query = query("insert into products(product_title,	product_category_id,
    product_price,	product_description,	short_desc, product_quantity,	product_image) values('$product_title','$product_category_id',
    '$product_price','$product_description','$short_desc','$product_quantity','$product_image')");

    $last_id = last_id();
    confirm($query);

    set_message("Inserted New Products with id {$last_id} ! ");
    redirect("index.php?products");

  }




}

/********************************** Updating Product *****************************************/
function update_product(){
if (isset($_POST['update'])) {


  $product_title	       =  escape_string($_POST['product_title']);
  $product_category_id	 =  escape_string($_POST['product_category_id']);
  $product_price	       =  escape_string($_POST['product_price']);
  $product_description	 =  escape_string($_POST['product_description']);
  $short_desc	           =  escape_string($_POST['product_short_description']);
  $product_quantity	     =  escape_string($_POST['product_quantity']);

  $product_image         =  escape_string($_FILES['file']['name']);
  $image_temp_location   =  escape_string($_FILES['file']['tmp_name']); //temporary Location


  if (empty($product_image)) {

    $get_pic = query("SELECT product_image FROM products where product_id=".escape_string($_GET['id']));
    confirm($get_pic);

    while ($row = fetch_array($get_pic)) {

      $product_image = $row['product_image'];

    }
  }

  copy($image_temp_location , UPLOAD_DIRECTORY . DS . $product_image); //copying picture into directory file

  $query    = "UPDATE products SET ";
  $query   .= "product_title        ='{$product_title}'       , ";
  $query   .= "product_category_id  ='{$product_category_id}' , ";
  $query   .= "product_price        ='{$product_price}'       , ";
  $query   .= "product_description  ='{$product_description}' , ";
  $query   .= "short_desc           ='{$short_desc}'          , ";
  $query   .= "product_quantity     ='{$product_quantity}'    , ";
  $query   .= "product_image        ='{$product_image}'         ";
  $query   .= "WHERE product_id=" .escape_string($_GET['id']);





  // $last_id = last_id();
  $send_update_query = query($query);
  confirm($query);

  set_message("Requested Product has been updated! ");
  redirect("index.php?products");

}





}


function show_product_category_title($product_category_id){


  $category_query = query("select * from categories where cat_id ='{$product_category_id}'");
  confirm($category_query);

  while($category_row = fetch_array($category_query)){
    return $category_row['cat_title'];
  }


}

/*********************** Categories ********************/


function categories_length(){

  $query = query("SELECT * FROM categories");
  confirm($query);

while ($row = fetch_array($query)) {

$product = <<<DELIMETER
<option value="{$row['cat_id']}">{$row['cat_title']}</option>

DELIMETER;


echo $product;
}

  }






function show_categories_in_admin(){

   $query = query("SELECT * FROM categories");
   confirm($query);

while ($row = fetch_array($query)) {

$product = <<<DELIMETER
<tr>
       <td>{$row['cat_id']}</td>
       <td>{$row['cat_title']}</td>
       <td><a href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>
DELIMETER;


echo $product;
}


}


function add_categories_in_admin(){


    if (isset($_POST['add'])) {

      if (!empty($_POST['cat_title'])) {
        // code...

      // $cat_id = escape_string($_POST['cat_id']);
      $cat_title = escape_string($_POST['cat_title']);

      $insert_cat_query = query("INSERT INTO categories(cat_title) VALUES('$cat_title') ");
      confirm($insert_cat_query);

      set_message("Category Inserted Successfully!");
      // redirect("index.php?categories");

  }else{

    set_message("Nothing Inserted");
    // redirect("index.php?categories");

  }


}


}


/********************* Admin Users *************************/

function display_user_image($picture){
  global $user_pic_upload;
  return $user_pic_upload. DS .$picture; //here $picture is the path
}



function show_admin_users(){

  $query = query("SELECT * FROM users");
  confirm($query);

while ($row = fetch_array($query)) {

$user_image = display_user_image($row['user_image']);


$product = <<<DELIMETER
<tr>
    <td>{$row['user_id']}</td>
    <td><a href="index.php?edit_user&id={$row['user_id']}">
    <img width='65' class="admin-user-thumbnail user_image" src="../../resources/{$user_image}" alt="">
    </a></td>
    <td>{$row['user_name']}</td>
    <td>{$row['email']}</td>
    <td><a href="../../resources/templates/back/delete_user.php?id={$row['user_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>

</tr>
DELIMETER;


echo $product;
}


}



function add_user(){


if (isset($_POST['add_user'])) {

  $username              = escape_string($_POST['username']);
  $email                 = escape_string($_POST['email']);
  $password              = escape_string($_POST['password']);

  $user_image            = escape_string($_FILES['file']['name']);
  $image_temp_location   = escape_string($_FILES['file']['tmp_name']);

  copy($image_temp_location, UPLOAD_USER_DIRECTORY. DS .$user_image);

  $user_insert_query = query("INSERT INTO users(user_name,email,password,user_image) VALUES('$username','$email','$password','$user_image')");
  confirm($user_insert_query);

  set_message("User Created");
  redirect("index.php?users");

}



}

function update_admin_user(){

  if (isset($_POST['update_user'])) {


    $username                  =  escape_string($_POST['username']);
    $email                     =  escape_string($_POST['email']);
    $password                  =  escape_string($_POST['password']);

    $user_image                =  escape_string($_FILES['file']['name']);
    $user_image_temp_location  =  escape_string($_FILES['file']['tmp_name']);

    if (empty($user_image)) {

      $get_pic = query("SELECT user_image FROM users where user_id=".escape_string($_GET['id']));
      confirm($get_pic);

      while ($row = fetch_array($get_pic)) {

        $user_image = $row['user_image'];

      }
    }

    copy($user_image_temp_location, UPLOAD_USER_DIRECTORY. DS . $user_image);

    $update_user = query("UPDATE users SET user_name='{$username}',email='{$email}',password='{$password}',user_image='{$user_image}' WHERE user_id=".escape_string($_GET['id']));
    confirm($update_user);


    set_message("Updated User information");
    redirect("index.php?users");


  }


}


/********************* REPORTS *************************************/


function get_reports_in_admin(){


  $query = query("select * from reports");

  confirm($query);

  while ($row = fetch_array($query)) {


    $product = <<<DELIMETER
    <tr>
          <td>{$row['report_id']}</td>
          <td>{$row['product_id']}</td>
          <td>{$row['order_id']}</td>
          <td>{$row['product_price']}</td>
          <td>{$row['product_title']}</td>
          <td>{$row['product_quantity']}</td>
          <td><a class="btn btn-danger" href="../../resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>

      </tr>
DELIMETER;

echo $product;

  }

}


/*********************** Slider FUNCTIONS *********************************/


function display_slide($picture){

    global $upload_slider;
    return $upload_slider. DS. $picture;
}





function add_slides(){

if (isset($_POST['add_slide'])) {

  $slide_title = escape_string($_POST['slide_title']);
  $slide_image = escape_string($_FILES['file']['name']);
  $slide_image_loc = escape_string($_FILES['file']['tmp_name']);


  if (empty($slide_title) || empty($slide_image)) {
    echo "<p class='bg-danger'>Fields must be completed</p>";

  }else{

    copy($slide_image_loc, UPLOAD_SLIDER_DIRECTORY . DS . $slide_image);

    $query = query("INSERT INTO slides(slide_title, slide_image) VALUES('{$slide_title}','{$slide_image}')");
    confirm($query);

    set_message("slide Added");
    redirect("index.php?slides");

  }


}



}




function get_current_slide_in_admin(){


  $query = query("SELECT * FROM slides ORDER BY slide_id ASC LIMIT 1");
  confirm($query);

  while ($row = fetch_array($query)) {
    $slide_image = display_slide($row['slide_image']);

    $current_slide_admin = <<<DELIMETER
    <img class="img-responsive" src="../../resources/{$slide_image}" alt="">
DELIMETER;

    echo $current_slide_admin;

  }

  }



function get_active_slide(){

  $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
  confirm($query);

  while ($row = fetch_array($query)) {
    $slide_image = display_slide($row['slide_image']);

    $slide_active = <<<DELIMETER
    <div class="item active">
          <img style="height:300px;width:800px;" class="slide-image" src="../resources/{$slide_image}" alt="">
    </div>

    DELIMETER;

    echo $slide_active;

  }

  }







function get_slides(){

  $query = query("SELECT * FROM slides");
  confirm($query);

  while ($row = fetch_array($query)) {
    $slide_image = display_slide($row['slide_image']);

    $slides = <<<DELIMETER
    <div class="item">
          <img style="height:300px;width:800px;" class="slide-image" src="../resources/{$slide_image}" alt="">
    </div>

    DELIMETER;

    echo $slides;

  }

}

function get_slide_thumbnails(){


  $query = query("SELECT * FROM slides ORDER BY slide_id ASC");
  confirm($query);

  while ($row = fetch_array($query)) {
    $slide_image = display_slide($row['slide_image']);
    $slide_title = $row['slide_title'];

    $slides = <<<DELIMETER

<div class="col-xs-6 col-md-3">
    <a href="">
          <br>
          <img style="height:200px;width:200px;" class="image-responsive" src="../../resources/{$slide_image}" alt="">

          <p class="text-center">{$slide_title}</p>
          <a class="btn btn-danger image_container" href="../../resources/templates/back/delete_slider.php?id={$row['slide_id']}"><span class="glyphicon glyphicon-remove"></span></a>
          <br><br>
    </a>
</div>

DELIMETER;

    echo $slides;
  }

}





?>

<?php require_once("config.php"); ?>


<?php

  if (isset($_GET['add'])) {

    $query = query("select * from products where product_id = " .escape_string($_GET['add']));
    //confirm($query);

    while($row = fetch_array($query)){

      if ($row['product_quantity'] != $_SESSION['product_'. $_GET['add']]) {
        $_SESSION['product_'. $_GET['add']]+=1;
        redirect("../public/checkout.php");

      }else{
        set_message("We only have ".$row['product_title']." only "." ". $row['product_quantity'] ." "."Available");
        redirect("../public/checkout.php");
      }
    }
    // $_SESSION['product_' . $_GET['id']] += 1;
    // redirect("index.php");
  }

  if (isset($_GET['remove'])) {

    $_SESSION['product_'. $_GET['remove']] -=1;

    if ($_SESSION['product_'. $_GET['remove']] <1) {
      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);

      redirect("../public/checkout.php");
    }else{
      redirect("../public/checkout.php");
    }
  }


 if (isset($_GET['delete'])) {
$_SESSION['product_'. $_GET['delete']] = '0';
unset($_SESSION['item_total']);
unset($_SESSION['item_quantity']);

redirect("../public/checkout.php");

}


function cart(){

$sum = 0;
$item_quantity = 0;
foreach ($_SESSION as $name => $value) {
// echo $name;
// echo "<br>";
// echo $value;
// echo "<br>";
// echo strlen($name);
// echo "<br>";
if(($value > 0) and strlen($name) > 8) {

if (substr($name, 0, 8) == "product_") {

$length = strlen($name)-8;

$id = substr($name, 8 , $length);

$query = query(" SELECT * FROM products WHERE product_id = " .escape_string($id));
confirm($query);

while($row = fetch_array($query)){
$item_quantity += $value;
$total = $row['product_price']*$value;

$display_image = display_image($row['product_image']);

$product = <<<DELIMETER
<tr>
    <td><img width='100' height='90' src='../resources/{$display_image}'></td>
    <td>{$row['product_title']}</td>
    <td> {$row['product_price']}</td>
    <td>{$value}</td>
    <td>৳{$total}</td>
    <td><a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a> </td>
    <td><a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a></td>
    <td><a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
DELIMETER;

echo $product;


}

$_SESSION['item_total'] = $sum += $total;
$_SESSION['item_quantity'] = $item_quantity;


      }

  }

       }



  }





  function process_transaction(){



    if (isset($_GET['tx'])) {

      global $con;

      $amount = $_GET['amt'];
      // $product_id = $_GET['prod'];
      $currency = $_GET['cc'];
      $transaction = $_GET['tx'];
      $status = $_GET['st'];

      $send_order = query("insert into orders (order_amount, order_transaction,
      order_status, order_currency) values('{$amount}','{$transaction}','{$status}','{$currency}')");
      $last_id = mysqli_insert_id($con);
      // echo $last_id;
      confirm($send_order);




  $sum = 0;
  $item_quantity = 0;
  foreach ($_SESSION as $name => $value) {

  if($value > 0) {

  if (substr($name, 0, 8) == "product_") {

  $length = strlen($name)-8;

  $id = substr($name, 8 , $length);





  $query = query(" SELECT * FROM products WHERE product_id = " .escape_string($id));
  confirm($query);
  while($row = fetch_array($query)){

  $item_quantity += $value;

  $total = $row['product_price']*$value;


  $product_price = $row['product_price'];
  $product_title = $row['product_title'];



  $insert_report = query("insert into reports (product_id,order_id,product_title,product_price, product_quantity)
  values('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
  confirm($insert_report);


  }

$sum += $total;
echo $item_quantity;


        }

    }

         }



  }else{
    redirect(index.php);
  }
// session_destroy();
    }



?>

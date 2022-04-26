<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<?php


  if (isset($_GET['tx'])) {

    $amount = $_GET['amt'];
    // $product_id = $_GET['prod'];
    $currency = $_GET['cc'];
    $transaction = $_GET['tx'];
    $status = $_GET['st'];


    // $query = query("insert into orders (order_amount, order_transaction,
    // order_status, order_currency) values('{$amount}','{$transaction}','{$status}','{$currency}')");
    // confirm($query);

    // echo $amount;
    process_transaction();

}else{
  redirect(index.php);
}
 ?>



<div class="container">
  <h1 class="text-center bg-success">Thank You</h1>
  <h5 class="text-center pt-5 mt-5">
    <p>Your Transaction Id:<?php echo $transaction;  ?></p>
    <p>Your Order Id:<?php echo $transaction ?></p>
  </h5>
</div>


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
<!-- <?php session_destroy(); ?> -->

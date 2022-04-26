<?php require_once("../resources/config.php"); ?>
<?php include( TEMPLATE_FRONT . DS . "header.php") ?>


<!-- <?php
 // if (isset($_SESSION['product_1'])) {
 //   echo $_SESSION['product_1'];
 //   echo "<br>";
 //   echo $_SESSION['item_total'];
 //   echo "<br>";
 //   echo $_SESSION['item_quantity'];
 // }
?> -->


    <!-- Page Content -->
    <div class="container">


<!-- /.row -->

<div class="row col-xs-12">
      <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
      <h1>Checkout</h1>

<div class="col-md-12 col-sm-12">


<form  action="">
    <table class="table table-striped col-md-6">
        <thead>
          <tr>
           <th>Image</th>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
           <th class="text-center" colspan="2">Operations</th>

          </tr>
        </thead>
        <tbody>
          <?php  cart(); ?>

        </tbody>
    </table>
</form>

</div>

<div class="col-xs-4 col-sm-12 col-md-12 ">

  <a href="thank_you.php?tx=3454&amt=<?php echo $_SESSION['item_total'];?>&cc=BD&st=Completed"><button type="button" class="btn btn-primary" name="tx">Send buy Request</button></a>

</div>



<!--  ***********CART TOTALS*************-->


<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php
echo isset($_SESSION['item_total'])? $_SESSION['item_quantity'] : $_SESSION['item_quantity']="0";//if else statement here
?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">৳
<?php
echo isset($_SESSION['item_total'])? $_SESSION['item_total'] : $_SESSION['item_total']="0";
?>

</span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


           <hr>

        <!-- Footer -->

        <?php include( TEMPLATE_FRONT . DS . "footer.php") ?>



    </div>
    <!-- /.container -->

 <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

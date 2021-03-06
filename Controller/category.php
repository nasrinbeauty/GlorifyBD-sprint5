<?php require_once("../resources/config.php"); ?>

<?php include( TEMPLATE_FRONT . DS . "header.php") ?>


    <!-- Page Content -->
    <div class="container">
      <?php
      $query = query("SELECT * from categories where cat_id = " .escape_string($_GET['id']). " ");
      // $send_query = mysqli_query($con, $query);

      confirm($query);
      while ($row = mysqli_fetch_array($query)):
       ?>
        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1> <?php echo $row['cat_title']; ?></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Products of <?php echo $row['cat_title']; ?></h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

          <?php  get_products_in_cat_page(); ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include( TEMPLATE_FRONT . DS . "footer.php") ?>


    </div>
    <!-- /.container -->
  <?php endwhile ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php require_once("../resources/config.php"); ?>

<?php include( TEMPLATE_FRONT . DS . "header.php") ?>


    <!-- Page Content -->
    <div class="container">


        <!-- Title -->
        <div class="row pb-5 mb-5">

            <div class="col-lg-12">
                <h3 class="text-center">Shop Page</h3>
                <br><br><hr>
            </div>

        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

          <?php  get_products_in_shop_page(); ?>


        </div>
        <!-- /.row -->

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

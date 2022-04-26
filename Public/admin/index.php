<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . "/header.php"); ?>

<?php
 if (!isset($_SESSION['username'])) {
  redirect("../../public");
} ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->

                <!-- /.row -->
                <?php
                  // echo $_SERVER['REQUEST_URI'];

                    if ($_SERVER['REQUEST_URI'] == "/EcommerceWebsite/ecomphp/Public/admin/" || $_SERVER['REQUEST_URI'] == "/EcommerceWebsite/ecomphp/Public/admin/index.php")  {
                    include(TEMPLATE_BACK . "/admin_content.php");
                    }

                    if (isset($_GET['orders'])) {

                      include(TEMPLATE_BACK . "/orders.php");

                    }elseif (isset($_GET['products'])) {

                      include(TEMPLATE_BACK . "/products.php");

                    }elseif (isset($_GET['add_product'])) {

                      include(TEMPLATE_BACK . "/add_product.php");

                    }elseif (isset($_GET['edit_product'])) {

                      include(TEMPLATE_BACK . "/edit_product.php");

                    }elseif (isset($_GET['categories'])) {

                      include(TEMPLATE_BACK. "/categories.php");

                    }elseif (isset($_GET['users'])) {

                      include(TEMPLATE_BACK. "/users.php");

                    }elseif (isset($_GET['add_user'])) {

                      include(TEMPLATE_BACK. "/add_user.php");

                    }elseif (isset($_GET['edit_user'])) {

                      include(TEMPLATE_BACK. "/edit_user.php");

                    }elseif (isset($_GET['reports'])) {

                      include(TEMPLATE_BACK. "/reports.php");
                    }elseif (isset($_GET['slides'])) {

                      include(TEMPLATE_BACK. "/slides.php");
                    }

                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>

</body>

</html>

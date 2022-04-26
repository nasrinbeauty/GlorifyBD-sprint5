<?php

require_once("../../config.php");

if (isset($_GET['id'])) {


  $query = query("delete from products where product_id =". escape_string($_GET['id']));
  confirm($query);

  set_message("Product Deleted");
  redirect("../../../Public/admin/index.php?products");
}else{

  redirect("../../../Public/admin/index.php?products");

}

 ?>

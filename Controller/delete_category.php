<?php


require_once("../../config.php");


if (isset($_GET['id'])) {


  set_message("Category Deleted");

  $delete_query= query("DELETE FROM categories where cat_id=". escape_string($_GET['id']));
  confirm($delete_query);

  set_message("Deleted Successfully");
  redirect("../../../Public/admin/index.php?categories");


}




?>

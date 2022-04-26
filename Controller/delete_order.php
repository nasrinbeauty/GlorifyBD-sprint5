<?php

require_once("../../config.php");

if (isset($_GET['id'])) {

  set_message("Order Deleted");
  $query = query("delete from orders where order_id =". escape_string($_GET['id']));
  confirm($query);

  redirect("../../../Public/admin/index.php?orders");
}else{

}

 ?>

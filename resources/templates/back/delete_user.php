<?php

include(require_once("../../config.php"));

if (isset($_GET['id'])) {

  $delete_user_query = query("DELETE FROM users WHERE user_id=". escape_string($_GET['id']));
  confirm($delete_user_query);

  set_message("User Deleted");
  redirect("../../../Public/admin/index.php?users");
}else{
    redirect("../../../Public/admin/index.php?users");
}





?>

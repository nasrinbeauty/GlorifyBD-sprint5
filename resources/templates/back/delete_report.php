<?php

require_once("../../config.php");

if (isset($_GET['id'])) {


  $query = query("delete from reports where report_id =". escape_string($_GET['id']));
  confirm($query);

  set_message("Report Deleted");
  redirect("../../../Public/admin/index.php?reports");
}else{

  redirect("../../../Public/admin/index.php?reports");

}

 ?>

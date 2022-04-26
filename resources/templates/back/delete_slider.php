<?php
require_once("../../config.php");


if (isset($_GET['id'])) {

$slide_image_query = query("SELECT slide_image FROM slides WHERE slide_id=". escape_string($_GET['id']));
confirm($slide_image_query);

$row = fetch_array($slide_image_query);

$target_path = UPLOAD_SLIDER_DIRECTORY . DS . $row['slide_image'];
unlink($target_path);



$query = query("DELETE FROM slides WHERE slide_id=". escape_string($_GET['id']));
confirm($query);


set_message("Successfully Deleted");
redirect("../../../Public/admin/index.php?slides");

}
?>

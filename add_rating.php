<?php
if(!empty($_POST["rating"]) && !empty($_POST["id"])) {
require_once("Rate.php");
$rate = new Rate();
$rate->updateRatingCount($_POST["rating"], $_POST["id"]);
}
?>
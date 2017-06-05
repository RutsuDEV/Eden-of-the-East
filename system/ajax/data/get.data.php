<?php
include("../../class/data.class.php");
$data->getData(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
?>
<?php
include("../class/search.class.php");
$search->getResults(htmlspecialchars($_POST['q'], ENT_QUOTES, 'UTF-8'));
?>
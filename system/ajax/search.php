<?php
$i = 0;
while($i <= 5){
?>
<article>
	<div class="resultItem">
		<div class="itemLink"><a href="#"><?php echo $_POST['q']; ?></a></div>
		<div class="itemUrl">www.<?php echo $_POST['q']; ?>.pl</div>
		<div class="itemDescription">description</div>
	</div>
</article>
<?php
$i++;
}
?>
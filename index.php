<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Eden of the East</title>
<link href="system/css/basic.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
<audio id="eden" src="system/eden.mp3" type="audio/mp3">Your browser does not support the &#60;audio&#62; element.</audio>
	<div class="internetError" title="Ponów próbe">Brak połączenia z Internetem</div>
	<div class="internetLoading" title="Trwa łączenie...">Łączenie...</div>
	<div class="internetConnected" title="Połączono">Połączono</div>
	<section class="eden">
		<div class="edenLogo">
			<img src="system/images/eden.png">
		</div>
		<div class="edenSearch">
				<input type="text" name="q" placeholder="Search in eden" autocomplete="off">
		</div>
	</section>
	<section class="edenResults">
	</section>
	<section class="resultView">
	
	</section>
<a class="startMusic" href="#start">Start music</a>
<a class="pauseMusic" href="#stop">Stop music</a>
<script src="system/js/jquery.js"></script>

<script>
function checkInternet(){
	var checkInternet = setInterval(function(){
				$.ajax({
					type     : "POST",
					url      : "system/ajax/data/get.online.php",
					success: function(res) {
						$(".internetError").css("display", "none");
						var timeoutConnected = setTimeout(function(){
							$(".internetConnected").fadeOut("fast");
							clearTimeout(timeoutConnected);
						}, 2000);	
					},
					complete: function() {

					},
					error: function(jqXHR, errorText, errorThrown) {
						$(".internetConnected").css("display", "none");
						$(".internetError").fadeIn("fast");
					}
				});
}, 10000);
}
$(document).ready(function(){
	console.log("DOCUMENT READY");
	checkInternet();
	console.log("CHECK INTERNET");
});
   $('.edenSearch input').on('keypress', function (e) {
	console.log("input  PRESS");
         if(e.which === 13){
			console.log("enter PRESSED");

            $(this).attr("disabled", "disabled");

            //Do Stuff, submit, etc..

            //Enable the textbox again if needed.
            $(this).removeAttr("disabled");
			var value = $(".edenSearch input").val();
			var data = {q:value};
$.ajax({
    type     : "POST",
    url      : "system/ajax/search.php",
	cache: null,
    data     : data,
    success: function(res) {
		$(".internetError").fadeOut("fast");
		$(".edenResults").html(res);
		$(".resultItem").on('click', function(){
			var id = $(this).attr("data-id");
			var data2 = {id:id};
				$.ajax({
					type     : "POST",
					url      : "system/ajax/data/get.data.php",
					cache: null,
					data     : data2,
					success: function(res) {
						$(".internetError").fadeOut("fast");
						$(".resultView").html(res);
						$(".resultView").fadeIn("fast");
						$(".resultView").on('click', function(){
							$(".resultView").fadeOut("fast");
							$(".resultView").html("");
						});
						$(".resultBlock").on('click', function(){
							return false;
						});
					},
					complete: function() {

					},
					error: function(jqXHR, errorText, errorThrown) {
						$(".internetError").fadeIn("fast");
					}
				});
		});
    },
    complete: function() {

    },
    error: function(jqXHR, errorText, errorThrown) {
		$(".internetError").fadeIn("fast");
    }
});
			
			$(".edenResults").fadeIn("slow");
         }
   });




$(".startMusic").on('click', function(){
var vid = document.getElementById("eden");
vid.play();
})

$(".pauseMusic").on('click', function(){
var vid = document.getElementById("eden");
vid.pause();
});

$(".internetError").on('click', function(){
	console.log("LOADING #1");
	$(".internetError").css("display", "none");
	$(".internetLoading").fadeIn("fast");

	clearInterval(checkInternet);

	var loadingInternet = setInterval(function(){
				$.ajax({
					type     : "POST",
					url      : "system/ajax/data/get.online.php",
					success: function(res) {
						console.log("CONNECTED #1");
						$(".internetError").css("display", "none");
						$(".internetLoading").css("display", "none");
						$(".internetConnected").fadeIn("fast");
						
						var timeoutConnected = setTimeout(function(){
							$(".internetConnected").fadeOut("fast");
							clearTimeout(timeoutConnected);
						}, 2000);	
						
						console.log("Connected");
						clearInterval(checkInternet);
						clearInterval(loadingInternet);
						
						var checkInternet = setInterval(function(){
									$.ajax({
										type     : "POST",
										url      : "system/ajax/data/get.online.php",
										success: function(res) {
											console.log("CONNECTED #2");
											$(".internetError").fadeOut("fast");
											clearInterval(checkInternet);
										},
										complete: function() {

										},
										error: function(jqXHR, errorText, errorThrown) {
											console.log("ERROR #2");
											$(".internetConnected").css("display", "none");
											$(".internetLoading").css("display", "none");
											$(".internetError").fadeIn("fast");
											clearInterval(checkInternet);
										}
									});
						}, 10000);
					},
					complete: function() {

					},
					error: function(jqXHR, errorText, errorThrown) {
						console.log("ERROR #1");
						$(".internetLoading").css("display", "none");
						$(".internetConnected").css("display", "none");
						$(".internetError").fadeIn("fast");
						clearInterval(loadingInternet);
						
							var checkInternet = setInterval(function(){
										$.ajax({
											type     : "POST",
											url      : "system/ajax/data/get.online.php",
											success: function(res) {
												console.log("START TIMEOUT");
												var timeoutInternet = setTimeout(function(){
													$(".internetError").css("display", "none");
													clearInterval(checkInternet);
												}, 1000);
												console.log("CONNECTED #3");
												$(".internetError").fadeOut("fast");
											},
											complete: function() {

											},
											error: function(jqXHR, errorText, errorThrown) {
												console.log("ERROR #3");
												$(".internetLoading").css("display", "none");
												$(".internetConnected").css("display", "none");
												$(".internetError").fadeIn("fast");
											}
										});
							}, 10000);


					}
				});
}, 10000);
});
</script>
</body>
</html>
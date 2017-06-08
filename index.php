<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Eden of the East</title>
<link href="system/css/basic.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
<section class="edenSplash">
			<div class="edenLogo">
				<img src="system/images/eden.png">
			</div>
</section>
<audio id="eden" src="system/eden.mp3" type="audio/mp3">Your browser does not support the &#60;audio&#62; element.</audio>
<div class="musicPlayer">
	<div class="button  startMusic">Start music</div>
</div>
	<div class="internetError" title="Ponów próbe">Brak połączenia z Internetem</div>
	<div class="internetLoading" title="Trwa łączenie...">Łączenie...</div>
	<div class="internetConnected" title="Połączono">Połączono</div>
	<section class="eden">
		<center>
			<div class="edenLogo">
				<img src="system/images/eden.png">
			</div>
		</center>
		<div class="edenSearch">
				<input type="text" name="q" autocomplete="off">
				<div class="searchButtons">
					<center>
						<button class="searchButton">Search  in eden</button>
						<button class="edenAboutButton">About eden</button>
					</center>
				</div>
		</div>
	</section>

	<section class="edenResults">

	</section>

	<section class="resultView">
	
	</section>
	
	<section class="loadingResults">
		  <div class="sk-double-bounce">
			<div class="sk-child sk-double-bounce1"></div>
			<div class="sk-child sk-double-bounce2"></div>
		  </div>
		<div class="loaderText">Loading results</div>
	</section>
	
	<section class="edenAbout">
		<div class="aboutBlock">
			<div class="edenLogo">
				<img src="system/images/eden.png">
			</div>
			<div class="aboutText"><center>Specialized search engine looking for different data in eden. The search engine is based on the anime "Higashi no Eden"</center></div>
			<div class="aboutWallpaper"></div>
		</div>
	</section>
<script src="system/js/jquery.js"></script>

<script>
$(document).ready(function(){
	$(".edenSplash").fadeOut("slow");
})
$(".edenAboutButton").on('click', function(){
	$("section.edenAbout").fadeIn("slow");
});
$("section.edenAbout").on('click', function(){
	$("section.edenAbout").fadeOut("slow");
});
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
   $('.edenSearch .searchButton').on('click', function (e) {
	   $(".loadingResults").css("display", "block");
	console.log("button  PRESS");

            $(".edenSearch input").attr("disabled", "disabled");
            $(".edenSearch input").removeAttr("disabled");


			var value = $(".edenSearch input").val();
			var data = {q:value};
$.ajax({
    type     : "POST",
    url      : "system/ajax/search.php",
	cache: null,
    data     : data,
    success: function(res) {
		$(".loadingResults").fadeOut("slow");
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
						
						$(".blockClose").on('click', function(){
							$(".resultView").fadeOut("fast");
							$(".resultView").html("");
						});
					},
					complete: function() {

					},
					error: function(jqXHR, errorText, errorThrown) {
						$(".loadingResults").fadeOut("slow");
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

   });
   
   $('.edenSearch input').on('keypress', function (e) {
	console.log("input  PRESS");
         if(e.which === 13){
			$(".loadingResults").css("display", "block");
			console.log("enter PRESSED");

            $(this).attr("disabled", "disabled");
            $(this).removeAttr("disabled");
			var value = $(".edenSearch input").val();
			var data = {q:value};
$.ajax({
    type     : "POST",
    url      : "system/ajax/search.php",
	cache: null,
    data     : data,
    success: function(res) {
		$(".loadingResults").fadeOut("slow");
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
						
						$(".blockClose").on('click', function(){
							$(".resultView").fadeOut("fast");
							$(".resultView").html("");
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
		$(".loadingResults").fadeOut("slow");
		$(".internetError").fadeIn("fast");
    }
});
			
			$(".edenResults").fadeIn("slow");
         }
   });






$(".startMusic, .pauseMusic").click(function()
    {
        if ($(this).hasClass('startMusic')) {
			var vid = document.getElementById("eden");
			vid.play();
			$(this).html("Stop music");
            $(this).removeClass('startMusic').addClass('pauseMusic');
        } else {
			var vid = document.getElementById("eden");
			vid.pause();
            $(this).html("Start music");
            $(this).removeClass('pauseMusic').addClass('startMusic');
        }
    }   
);



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
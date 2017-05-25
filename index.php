<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Eden of the East</title>
<link href="system/css/basic.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
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
<script src="system/js/jquery.js"></script>

<script>
   $('.edenSearch input').on('keypress', function (e) {
         if(e.which === 13){


            $(this).attr("disabled", "disabled");

            //Do Stuff, submit, etc..

            //Enable the textbox again if needed.
            $(this).removeAttr("disabled");
			var value = $(".edenSearch input").val();
			var data = {q:value};
$.ajax({
    type     : "POST",
    url      : "system/ajax/search.php",
    data     : data,
    success: function(res) {
	$(".edenResults").html(res);
    },
    complete: function() {

    },
    error: function(jqXHR, errorText, errorThrown) {

    }
});
			
			$(".edenResults").fadeIn("slow");
         }
   });
</script>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- bootstrap -->
<script src="/lib/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/lib/sweetalert/sweetalert.css">
<script src="/lib/sweetalert/sweetalert.min.js"></script>
<script>
	window.onload = function () {
		swal("","<?=$msg?>","success");
		setTimeout(function () {
			window.location.href = "<?=$url?>";
		},1300);		
	}
</script>
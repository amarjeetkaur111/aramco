<script>
	$(document).ready(function() {
		$('[data-bs-toggle="tooltip"]').tooltip();
		window.addEventListener("load", function() {
			setTimeout(function() {
				$("#splash").fadeOut(500);

			}, 1500);
		});
		if ((/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))) {
			$('#mobile_menu').show();
			$('.flex-center').hide();


		} else {
			$('#mobile_menu').hide();
			$('.flex-center').show();


		}

	});

	function openNav() {
		var div = document.getElementById('sideList'); // need real DOM Node, not jQuery wrapper
		var num = $('#sideList > li').length;
		if (num > 6) {
			document.getElementById("mySidenav").style.width = "150px";

		} else {
			document.getElementById("mySidenav").style.width = "auto";

		}
		console.log('hasVerticalScrollbar', hasVerticalScrollbar);
	}

	function closeNav() {
		document.getElementById("mySidenav").style.width = "0";


	}
</script>
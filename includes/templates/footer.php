		<div class="footer"></div>
		<!-- BootStrap  -->

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
		</script>

		<!-- JQury  -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<!-- Data Table  -->
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
		<?php
		// $arr = ['Members', 'Comments', 'Categories', 'Items'];
		if (in_array($pagename, $arr)) { ?>
			<script src="../layout/js/front.js"></script>
		<?php } else {   ?>
			<script src="layout/js/front.js"></script>
		<?php }  ?>
		</body>

		</html>
<div id="SUBSUB_CONTENT">
	<div class="subsub-container">
		<?php
			switch($subsub){
				default:
					require_once 'spaces_details.php';
				break;
				case 'edit':
					require_once 'spaces_edit.php';
				break;
			}
		?>
	</div>
</div>
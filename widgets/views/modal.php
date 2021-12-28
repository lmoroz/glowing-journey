<?php
/**
 * @var string $idElement
 * @var string $title
 * @var WidgetFactory $content
 */

use app\widgets\WidgetFactory;

?>

<div class="modal" id="<?=$idElement?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<h4 class="modal-title"><?=$title?></h4>
			<?= $content->build() ?>
		</div>
	</div>
</div>

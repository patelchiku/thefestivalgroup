<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="qodef-tags-holder">

	<i class="icon_tag" aria-hidden="true"></i>
	<?php the_tags('', ', ', ''); ?>

</div>
<?php } ?>
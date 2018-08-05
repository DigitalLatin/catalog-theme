
<div class="body-wrap">
	<?php if (!$is_front): fionta_render_block('easy_breadcrumb','easy_breadcrumb'); endif; ?>
	<?php if ($tabs): print render($tabs); endif; ?>
	<?php print render($tabs2); ?>
	<?php print $messages; ?>
	<?php print render($page['help']); ?>
	<?php print render($title_prefix); ?>
        
        <h1><?php print $title; ?></h1>
        
        <?php print render($title_suffix); ?>
        <?php if ($action_links): ?>
        <ul class="fionta-action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
		<?php print render($page['content']); ?>
	<?php print $feed_icons ?>
</div>

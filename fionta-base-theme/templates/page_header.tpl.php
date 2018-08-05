<div id="fionta-header1" style="clear:both;">
	<div class="fionta-wrapper">
	<div id="fionta-header1-section1">
		<div class="fionta-logos">
			<a id="logo1" href="/dll-biblio/">
				<img class="fionta-logo1" src="<?php echo $GLOBALS['base_path'].$GLOBALS['theme_path'] ?>/images/DLL-logo.png"/>
				<img class="fionta-logo2" src="<?php echo $GLOBALS['base_path'].$GLOBALS['theme_path'] ?>/images/DLL-mobile-logo.png"/>
				<span id='site-title-full'>Digital <span id='site-title-full-latin' style='font-weight:strong'>Latin</span> Library</span>
				<span id='site-title-mobile'>DLL</span>
			</a>
		</div>
	</div>

	<div id="fionta-header1-section2">
		<div id="fionta-header-menu">
			<?php $menu = menu_navigation_links('menu-header-menu');
print theme('links__menu-header-menu', array('links' => $menu)); ?>
		</div>
		
		<div id="fionta-header1-section4">
			<?php  fionta_render_block('fionta_menus',1)  ?>
		</div>
	</div>
	</div>
</div>
<div class="subheader-wrap" id="subhead">
	<?php print render($page['subheader']); ?>
</div>
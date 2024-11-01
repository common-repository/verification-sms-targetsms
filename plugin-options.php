<?php

$menu = targetvr_get_plugin_menu();
$panel_active = targetvr_get_gatData('panel');

?>
	<h1 style="margin: 35px 0; text-align: center;;"><?php echo esc_html(get_admin_page_title()) ?></h1>

	<?php if ($menu and is_array($menu)) : ?>

		<nav class="nav-tab-wrapper" style="margin: 80px 0 0">
			<?php
				foreach ($menu as $panel_key => $panel_name) : 
					$class_tab_active = (($panel_active == $panel_key) or (!$panel_active and $panel_key == 'targetsms')) ? ' nav-tab-active': '';
			?>

					<a href="<?php echo targetvr_get_url_panel_settings( esc_html($panel_key) ); ?>" class="nav-tab<?php echo $class_tab_active; ?>"><?php echo esc_html($panel_name); ?></a>

			<?php endforeach; ?>
		</nav>

	<?php endif; ?>

    <?php
		$panel_active = (!$panel_active) ? 'targetsms' : $panel_active;

		$options_names = targetvr_get_options_plugin();
		$option_name = targetvr_get_panel_option($panel_active);

		if ($option_name) : ?>

			<form action='options.php' method='post'>
				<?php
					settings_fields($option_name);
					do_settings_sections($option_name);
					submit_button();
				?>
			</form>

	<?php endif; ?>
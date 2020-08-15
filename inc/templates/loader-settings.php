<section>
  <form id="l_loader_settings_form" method="post" action="options.php" class="l-loader-settings-form">
	<?php settings_fields( 'l-loader-group' ); ?>
	<?php do_settings_sections( 'l_loader_admin_page' ); ?>
	<?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ); ?>
  </form>
</section>
<?php

// Security: If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?><div class="wrap"> 
	<h2>Basic headers and footers &gt; Settings</h2>
	<div id="poststuff">
		<div class="postbox">
			<div class="tab-menu">
				<ul class="wpcr_nav_tabs">
					<li><a href="#" class="tab-a active-a" data-id="tab-header">Header</a></li>
					<li><a href="#" class="tab-a" data-id="tab-footer">Footer</a></li>
			  </ul>
			</div>
			<form action="options-general.php?page=basic-headers-and-footers" method="post">
				<?php wp_nonce_field('basic-headers-and-footers', 'bhaf_nonce' ); ?>
				<div class="inside">
					<div class="tab tab-active" data-id="tab-header">
						<p>
							<label for="basic-headers-and-footers-header"><b>Scripts in Header (in the head section)</b></label>
							<textarea name="bhaf_header" class="widefat" rows="10"><?php echo get_option('bhaf_header'); ?></textarea>
						</p>
					</div>
					<div class="tab" data-id="tab-footer">
						<p>
							<label for="basic-headers-and-footers-footer"><b>Scripts in Footer (above the closing </body> tag)</b></label>
							<textarea name="bhaf_footer" class="widefat" rows="10" ><?php echo get_option('bhaf_footer'); ?></textarea>
						</p>
					</div>
					<p>
						<input name="submit" type="submit" value="<?php esc_html_e('Save', 'insert-headers-and-footers-scripts' ); ?>" class="button button-primary" />
					</p>
				</div>
			</form>
		</div>
	</div>
</div>

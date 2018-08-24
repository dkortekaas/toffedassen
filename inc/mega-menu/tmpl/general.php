<?php
global $wp_widget_factory;
?>
<div id="tamm-panel-general" class="tamm-panel-general tamm-panel">
	<div class="mr-tamm-panel-box">
		<p>
			<label>
				<input type="checkbox" name="<%= taMegaMenu.getFieldName( 'hideText', data['menu-item-db-id'] ) %>" value="1" <% if ( megaData.hideText ) { print( 'checked="checked"' ); } %> >
				<?php esc_html_e( 'Hide Text', 'supro' ) ?>
			</label>
		</p>
	</div>
	<div class="mr-tamm-panel-box">
		<p>
			<label>
				<input type="checkbox" name="<%= taMegaMenu.getFieldName( 'hot', data['menu-item-db-id'] ) %>" value="1" <% if ( megaData.hot ) { print( 'checked="checked"' ); } %> >
				<?php esc_html_e( 'Hot', 'supro' ) ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" name="<%= taMegaMenu.getFieldName( 'new', data['menu-item-db-id'] ) %>" value="1" <% if ( megaData.new ) { print( 'checked="checked"' ); } %> >
				<?php esc_html_e( 'New', 'supro' ) ?>
			</label>
		</p>

		<p>
			<label>
				<input type="checkbox" name="<%= taMegaMenu.getFieldName( 'trending', data['menu-item-db-id'] ) %>" value="1" <% if ( megaData.trending ) { print( 'checked="checked"' ); } %> >
				<?php esc_html_e( 'Trending', 'supro' ) ?>
			</label>
		</p>
	</div>
</div>
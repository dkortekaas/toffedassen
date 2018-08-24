<% var itemId = data['menu-item-db-id']; %>
<div id="tamm-panel-background" class="tamm-panel-background tamm-panel">
	<p class="background-image">
		<label><?php esc_html_e( 'Background Image', 'supro' ) ?></label><br>
		<span class="background-image-preview">
			<% if ( megaData.background.image ) { %>
				<img src="<%= megaData.background.image %>">
			<% } %>
		</span>

		<button type="button" class="button remove-button <% if ( ! megaData.background.image ) { print( 'hidden' ) } %>"><?php esc_html_e( 'Remove', 'supro' ) ?></button>
		<button type="button" class="button upload-button" id="background_image-button"><?php esc_html_e( 'Select Image', 'supro' ) ?></button>

		<input type="hidden" name="<%= taMegaMenu.getFieldName( 'background.image', itemId ) %>" value="<%= megaData.background.image %>">
	</p>

	<p class="background-color">
		<label><?php esc_html_e( 'Background Color', 'supro' ) ?></label><br>
		<input type="text" class="background-color-picker" name="<%= taMegaMenu.getFieldName( 'background.color', itemId ) %>" value="<%= megaData.background.color %>">
	</p>

	<p class="background-repeat">
		<label><?php esc_html_e( 'Background Repeat', 'supro' ) ?></label><br>
		<select name="<%= taMegaMenu.getFieldName( 'background.repeat', itemId ) %>">
			<option value="no-repeat" <% if ( 'no-repeat' == megaData.background.repeat ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'No Repeat', 'supro' ) ?></option>
			<option value="repeat" <% if ( 'repeat' == megaData.background.repeat ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Tile', 'supro' ) ?></option>
			<option value="repeat-x" <% if ( 'repeat-x' == megaData.background.repeat ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Tile Horizontally', 'supro' ) ?></option>
			<option value="repeat-y" <% if ( 'repeat-y' == megaData.background.repeat ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Tile Vertically', 'supro' ) ?></option>
		</select>
	</p>

	<p class="background-position background-position-x">
		<label><?php esc_html_e( 'Background Position', 'supro' ) ?></label><br>

		<select name="<%= taMegaMenu.getFieldName( 'background.position.x', itemId ) %>">
			<option value="left" <% if ( 'left' == megaData.background.position.x ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Left', 'supro' ) ?></option>
			<option value="center" <% if ( 'center' == megaData.background.position.x ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Center', 'supro' ) ?></option>
			<option value="right" <% if ( 'right' == megaData.background.position.x ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Right', 'supro' ) ?></option>
			<option value="custom" <% if ( 'custom' == megaData.background.position.x ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Custom', 'supro' ) ?></option>
		</select>

		<input
			type="text"
			name="<%= taMegaMenu.getFieldName( 'background.position.custom.x', itemId ) %>"
			value="<%= megaData.background.position.custom.x %>"
			class="<% if ( 'custom' != megaData.background.position.x ) { print( 'hidden' ) } %>">
	</p>

	<p class="background-position background-position-y">
		<select name="<%= taMegaMenu.getFieldName( 'background.position.y', itemId ) %>">
			<option value="top" <% if ( 'top' == megaData.background.position.y ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Top', 'supro' ) ?></option>
			<option value="center" <% if ( 'center' == megaData.background.position.y ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Middle', 'supro' ) ?></option>
			<option value="bottom" <% if ( 'bottom' == megaData.background.position.y ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Bottom', 'supro' ) ?></option>
			<option value="custom" <% if ( 'custom' == megaData.background.position.y ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Custom', 'supro' ) ?></option>
		</select>
		<input
			type="text"
			name="<%= taMegaMenu.getFieldName( 'background.position.custom.y', itemId ) %>"
			value="<%= megaData.background.position.custom.y %>"
			class="<% if ( 'custom' != megaData.background.position.y ) { print( 'hidden' ) } %>">
	</p>

	<p class="background-attachment">
		<label><?php esc_html_e( 'Background Attachment', 'supro' ) ?></label><br>
		<select name="<%= taMegaMenu.getFieldName( 'background.attachment', itemId ) %>">
			<option value="scroll" <% if ( 'scroll' == megaData.background.attachment ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Scroll', 'supro' ) ?></option>
			<option value="fixed" <% if ( 'fixed' == megaData.background.attachment ) { print( 'selected="selected"' ) } %>><?php esc_html_e( 'Fixed', 'supro' ) ?></option>
		</select>
	</p>
</div>
<% if ( depth == 0 ) { %>
<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Mega Menu Content', 'toffedassen' ) ?>" data-panel="mega"><?php esc_html_e( 'Mega Menu', 'toffedassen' ) ?></a>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Mega Menu Background', 'toffedassen' ) ?>" data-panel="background"><?php esc_html_e( 'Background', 'toffedassen' ) ?></a>
<div class="separator"></div>
<% } else if ( depth == 1 ) { %>
<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Menu Content', 'toffedassen' ) ?>" data-panel="content"><?php esc_html_e( 'Menu Content', 'toffedassen' ) ?></a>
<a href="#" class="media-menu-item" data-title="<?php esc_attr_e( 'Menu General', 'toffedassen' ) ?>" data-panel="general"><?php esc_html_e( 'General', 'toffedassen' ) ?></a>
<% } else { %>
<a href="#" class="media-menu-item active" data-title="<?php esc_attr_e( 'Menu General', 'toffedassen' ) ?>" data-panel="general"><?php esc_html_e( 'General', 'toffedassen' ) ?></a>
<% } %>

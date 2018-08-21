<?php
/**
 * Partial template displays top right navigation
 *
 * @package ToffeDassen
 */

?>

	<div class="menu-extra s-right">
		<ul>
			<li class="extra-menu-item menu-item-search search-modal"><a href="#" class="menu-extra-search"><i class="t-icon icon-magnifier"></i></a><form method="get" class="instance-search" action="http://demo3.drfuri.com/supro/"><input type="text" name="s" placeholder="Start Searching..." class="search-field" autocomplete="off"><i class="t-icon icon-magnifier"></i></form>
				<div class="loading"><span class="supro-loader"></span></div>
				<div class="search-results">
					<div class="woocommerce"></div>
				</div>
			</li>
			<li class="extra-menu-item menu-item-account">
				<a id="menu-extra-login" href="http://demo3.drfuri.com/supro/my-account/">
					<i class="t-icon icon-user"></i>
					<span class="label-item acc-label">My Account</span>
				</a>
			</li>
			<li class="extra-menu-item menu-item-wishlist">
				<a href="http://demo3.drfuri.com/supro/wishlist/">
					<i class="t-icon icon-heart"></i>
					<span class="label-item wishlist-label">My Wishlist</span>
				</a>
			</li>
			<li class="menu-item-cart extra-menu-item">
				<a class="cart-contents" id="icon-cart-contents" href="http://demo3.drfuri.com/supro/cart/">
					<i class="t-icon icon-cart"></i>
					<span class="label-item cart-label">Shopping Cart</span>
					<span class="mini-cart-counter">0</span>
				</a>
			</li>
			<li class="extra-menu-item menu-item-sidebar  hidden-md hidden-sm hidden-xs">
				<a class="menu-sidebar" id="icon-menu-sidebar" href="#">
					<i class="t-icon icon-menu"></i>
				</a>
			</li>
			<li class="extra-menu-item menu-item-sidebar hidden-lg">
				<a class="menu-sidebar" id="icon-menu-mobile" href="#">
					<i class="t-icon icon-menu"></i>
				</a>
			</li>

		</ul>
	</div>

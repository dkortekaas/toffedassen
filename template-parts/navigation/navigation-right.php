<?php
/**
 * Partial template displays top right navigation
 *
 * @package Toffedassen
 */

?>

	<ul>
		<li class="extra-menu-item menu-item-search search-modal">
			<a href="#" class="menu-extra-search">
				<i class="t-icon icon-magnifier"></i>
			</a>
			<form method="get" class="instance-search" action="#">
				<input type="text" name="s" placeholder="Start Searching..." class="search-field" autocomplete="off">
				<i class="t-icon icon-magnifier"></i>
			</form>
			<div class="loading">
				<span class="supro-loader"></span>
			</div>
			<div class="search-results">
				<div class="woocommerce"></div>
			</div>
		</li>
		<li class="extra-menu-item menu-item-account">
			<a href="#">
				<i class="t-icon icon-user"></i>
				<span class="label-item acc-label">My Account</span>
			</a>
		</li>
		<li class="extra-menu-item menu-item-wishlist">
			<a href="#">
				<i class="t-icon icon-heart"></i>
				<span class="label-item wishlist-label">My Wishlist</span>
			</a>
		</li>
		<li class="menu-item-cart extra-menu-item">
			<a class="cart-contents" href="#">
				<i class="t-icon icon-cart"></i>
				<span class="label-item cart-label">Shopping Cart</span>
				<span class="mini-cart-counter">0</span>
			</a>
		</li>
		<li class="extra-menu-item menu-item-sidebar hidden-md hidden-sm hidden-xs">
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

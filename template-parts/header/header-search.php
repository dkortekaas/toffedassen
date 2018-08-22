<?php
/**
 * Partial template displays header search
 *
 * @package Logiq
 */

?>

    <div class="menu-extra menu-extra-au">
        <ul class="no-flex">
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
        </ul>
    </div>

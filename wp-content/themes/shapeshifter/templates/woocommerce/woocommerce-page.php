<?php
# Action Hook "shapeshifter_main_content_woocommerce_page"
# Filter Hook "shapeshifter_filters_wc_page"

if ( is_shop() ) { // The main shop
	shapeshifter_wc_shop();
} elseif ( is_product_category() ) { // A product category
	shapeshifter_woocommerce_product_taxonomy();
} elseif ( is_product_tag() ) { // A product tag
	shapeshifter_woocommerce_product_taxonomy();
} elseif ( is_product() ) { // A single product
	shapeshifter_woocommerce_single_product();
} elseif ( is_cart() ) { // The cart
	shapeshifter_woocommerce_cart();
} elseif ( is_checkout() ) { // The checkout
	shapeshifter_woocommerce_checkout();
} elseif ( is_account_page() ) { // Customer account
	shapeshifter_woocommerce_account_page();
} elseif ( is_wc_endpoint_url() ) { // An endpoint
	shapeshifter_woocommerce_single_product();
} else {
	shapeshifter_woocommerce_single_product();
}

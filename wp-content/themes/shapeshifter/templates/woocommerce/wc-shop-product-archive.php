<?php
# Action Hook "shapeshifter_woocommerce_shop_product_archive"
# Filter Hook "shapeshifter_filters_wc_shop_product_archive"

echo '<div class="layerbread">';
	woocommerce_breadcrumb();
echo '</div>';

woocommerce_content();


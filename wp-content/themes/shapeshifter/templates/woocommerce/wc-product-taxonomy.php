<?php
# Action Hook "shapeshifter_woocommerce_product_taxonomy"
# Filter Hook "shapeshifter_filters_wc_product_taxonomy"

echo '<div class="layerbread">';
	woocommerce_breadcrumb();
echo '</div>';

woocommerce_content();


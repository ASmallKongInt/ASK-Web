<?php
# Action Hook "shapeshifter_woocommerce_single_product"
# Filter Hook "shapeshifter_filters_wc_single_product"

echo '<div class="layerbread">';
	woocommerce_breadcrumb();
echo '</div>';

woocommerce_content();

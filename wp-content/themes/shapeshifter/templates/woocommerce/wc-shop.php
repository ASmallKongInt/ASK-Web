<?php
# Action Hook "shapeshifter_wc_shop"
# Filter Hook "shapeshifter_filters_wc_shop"

echo '<div class="layerbread">';
	woocommerce_breadcrumb();
echo '</div>';

woocommerce_content();


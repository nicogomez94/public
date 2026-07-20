<?php
if (!defined('ABSPATH')) {
    exit;
}

global $product;

if (!$product || !$product->is_visible()) {
    return;
}

pacha_tarjeta_producto($product);


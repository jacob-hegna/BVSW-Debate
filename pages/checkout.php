<?php
function get_checkout() {
    $page = new Tabbed();
    $page->setTabs('Checkout', ['Laptops', 'Stands'], 'checkout_table', 'checkout');
    $page->write();
}
?>
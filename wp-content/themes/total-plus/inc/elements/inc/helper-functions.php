<?php

/**
 * Helper Functions
 */

function tp_get_portfolio_category() {
    $square_plus_portfolio_categories = get_categories(array('taxonomy' => 'portfolio_type', 'hide_empty' => 0));
    $square_plus_portfolio_cat = array();
    foreach ($square_plus_portfolio_categories as $square_plus_portfolio_category) {
        $square_plus_portfolio_cat[$square_plus_portfolio_category->term_id] = $square_plus_portfolio_category->cat_name;
    }

    return $square_plus_portfolio_cat;
}

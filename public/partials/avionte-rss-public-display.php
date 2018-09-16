<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="avionte-wrap">
    <div class="avionte-search-wrap">
        <div class="col-50">
            <input type="text" class="avionte-form-control" id="keywords" placeholder="Keywords">
        </div>
        <div class="col-50">
        <input type="text" class="avionte-form-control" id="location" placeholder="Location">
        </div>
        <div class="avionte-clearfix"></div>
        <div class="col-50">
            <input type="text" class="avionte-form-control" id="category" placeholder="Category">
        </div>
        <div class="col-50">
            <input type="text" class="avionte-form-control" id="salary" placeholder="Salary">
        </div>
    </div>
    <div class="avionte-result">
        <a id="fetch_result" href="#">fetch_result</a>
    </div>
</div>
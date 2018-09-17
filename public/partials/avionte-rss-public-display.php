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

$publicContent = new Avionte_Rss_Public('avionte_rss', '1.0.0');
$select_category_values = $publicContent->get_from_value('category');
$select_location_values = $publicContent->get_from_value('location');
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="avionte-wrap">
    <div class="avionte-search-wrap">
        <div class="col-50">
            <input type="text" class="avionte-form-control" id="keywords" placeholder="Keywords">
        </div>
        <div class="col-50">
            <select class="avionte-form-control" id="location" placeholder="Location">
            <?php
            foreach($select_location_values as $value) {
                echo "<option value='$value'>$value</option>";
            }
            ?>
            </select>
        </div>
        <div class="avionte-clearfix"></div>
        <div class="col-50">
            <select class="avionte-form-control" id="category" placeholder="Category">
            <?php
            foreach($select_category_values as $value) {
                echo "<option value='$value'>$value</option>";
            }
            ?>
            </select>
        </div>
        <div class="col-50">
            <input type="number" class="avionte-form-control" id="salary" placeholder="Salary">
        </div>
        <div class="col-50">
            <a id="fetch_result" href="#">Search</a>
        </div>
    </div>
    <div class="avionte-clearfix"></div>
    <div class="avionte-result">
        <ul class="job-listing">
            <li>
                <a href="#">
                    <div class="position">
                        <p>Label Room Associate | 2nd Shift | $14.50 | Bloomington</p>
                    </div>
                    <div class="location">
                        <p>Bloomington, MN</p>
                    </div>
                </a>
                <div class="application_link">
                    <a href="#" target="_blank" class="avionte-button">Apply Now</a>
                </div>
            </li>
        </ul>
    </div>
</div>
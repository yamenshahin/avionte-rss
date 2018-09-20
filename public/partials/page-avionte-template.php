<?php

/**
 * Provide a public-facing view for the plugin. Display single result page.
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/yamenshahin/
 * @since      1.0.0
 *
 * @package    Avionte_Rss
 * @subpackage Avionte_Rss/public/partials
 */
get_header(); 
/**
 * This will be used for displaying the single page based on item_id
 *
 * @since    1.0.0
 */
$publicSingleContent = new Avionte_Rss_Public('avionte_rss', '1.0.0');
$results = $publicSingleContent->get_single_page($_GET['item_id']);
$applay_URL = parse_url($results[0]->link, PHP_URL_SCHEME).':/'.parse_url($results[0]->link, PHP_URL_HOST).'/talent/apply?postingId='.$results[0]->item_id;
?>
<div class="avionte-job-list-wrap">
    <div class="title-wrap">
        <h2>&nbsp;</h2>
    </div>
    <div class="button-wrap">
        <button class="avionte-button" type="button" onclick="window.open('<?php echo $applay_URL; ?>', '_blank')">Apply Now</button> 
    </div>

    <?php echo $results[0]->content; ?>
</div>
<script>
	(function( $ ) {
		jQuery('.page-id-7870 .titlebar-heading').html('<?php echo $results[0]->title; ?>');
	})( jQuery );
</script>
<?php get_footer();
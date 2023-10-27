<?php
/**
 * Template part for reach-us section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CT_Custom
 */

?>

<div class="reach-us">
    <h2>Reach Us</h2>
    <hr class="wp-block-separator has-alpha-channel-opacity">
    <div class="contact-info">
        <p><?php echo get_option('address_information') ?></p>
        <p>Phone: <?php echo get_option('phone_number') ?><br>Fax: <?php echo get_option('fax_number') ?></p>
    </div>
    <div class="social-links">
        <a href="<?php echo get_option('facebook_url') ?>" title="facebook page">
            <span class="dashicons dashicons-facebook"></span>
        </a>
        <a href="<?php echo get_option('twitter_url') ?>" title="twitter page">
            <span class="dashicons dashicons-twitter"></span>
        </a>
        <a href="<?php echo get_option('instagram_url') ?>" title="instagram page">
            <span class="dashicons dashicons-instagram"></span>
        </a>
        <a href="<?php echo get_option('pinterest_url') ?>" title="pinterest page">
            <span class="dashicons dashicons-pinterest"></span>
        </a>
    </div>
</div>
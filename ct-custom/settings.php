<?php

/**
 * custom option and settings
 */
function coalition_settings_init()
{
    // if($_POST) var_dump($_POST); die;


    // Register a new section in the "coalition" page.
    add_settings_section(
        'coalition_section_developers',
        __('Setup the basic homepage options.', 'coalition'),
        'coalition_section_developers_callback',
        'coalition'
    );
   

    // Register a new setting for "coalition" page.
    register_setting('coalition', 'coalition_logo_img');


    // Register a new field in the "coalition_section_developers" section, inside the "coalition" page.
    add_settings_field(
        'coalition_logo_img',
        __('Logo image', 'coalition'),
        'coalition_logo_img_cb',
        'coalition',
        'coalition_section_developers',
        array(
            'label_for' => 'coalition_logo_img',
            'class' => 'coalition_row',
            'coalition_custom_data' => 'custom',
        )
    );

    $options = [
        'address_information' => ['Address Information', 'The Address information to show on reach us section', 'textarea'],
        'phone_number' => ['Phone Number', 'The phone number to show on reach us section', ''],
        'fax_number' => ['Fax Number', 'The fax number to show on reach us section', ''],
        'facebook_url' => ['Facebook URL', 'The facebook url to link the social button on footer', ''],
        'twitter_url' => ['Twitter URL', 'The twitter url to link the social button on footer', ''],
        'instagram_url' => ['Instagram URL', 'The instagram url to link the social button on footer', ''],
        'pinterest_url' => ['Pinterest URL', 'The Pinterest url to link the social button on footer', ''],
    ];


    foreach ($options as $label => $value) {

        // Register a new setting for "coalition" page.
        register_setting('coalition', $label);

        add_settings_field(
            $label,
            __($value[0], 'coalition'),
            'coalition_create_field',
            'coalition',
            'coalition_section_developers',
            array(
                'label_for' => $label,
                'class' => 'coalition_row',
                'coalition_custom_data' => 'custom',
                'description' => $value[1],
                'type' => $value[2],
            )
        );

    }

}

/**
 * Register our coalition_settings_init to the admin_init action hook.
 */
add_action('admin_init', 'coalition_settings_init');


/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function coalition_section_developers_callback($args)
{
    ?>
    <p><b>Notice: To use the "Reach Us" block, add the following shortcode to content: [coaliation-reach-us]</b></p>
    <p id="<?php echo esc_attr($args['id']); ?>">
        <?php esc_html_e('Fill the options.', 'coalition'); ?>
    </p>
    
    <?php
}


function coalition_logo_img_cb($args)
{
    //dump_die($args);
    $option = get_option($args['label_for']);
    ?>

    <label for="upload_image">
        <input id="upload_image" type="text" size="36" name="<?php echo $args['label_for'] ?>" value="<?php echo $option ?>"  />
        <input id="upload_image_button" class="button" type="button" value="Upload Image" />
        <br />Enter a URL or upload an image
    </label>



    <p class="description">
        <?php esc_html_e('The website logo to show on top of the homepage', 'coalition'); ?>
    </p>
    <?php
}

add_action('admin_enqueue_scripts', 'coalition_admin_scripts');

function coalition_admin_scripts()
{

    if (isset($_GET['page']) && $_GET['page'] == 'coalition') {
        wp_enqueue_media();
        wp_register_script('uploader-js', get_template_directory_uri().'/js/uploader.js?', array('jquery'));
        wp_enqueue_script('uploader-js');
    }
}



function coalition_create_field($args)
{
    //dump_die($args);
    $option = get_option($args['label_for']);
    //dump_die($option);
    ?>
    <?php if ($args['type'] === 'textarea'): ?>
        <textarea name="<?php echo $args['label_for'] ?>" id="<?php echo $args['label_for'] ?>" cols="30"
            rows="4"><?php echo $option ?></textarea>
    <?php else: ?>
        <input name="<?php echo $args['label_for'] ?>" value="<?php echo $option ?>">
    <?php endif ?>
    <p class="description">
        <?php esc_html_e($args['description'], 'coalition'); ?>
    </p>

    <?php
}



/**
 * Add the top level menu page.
 */
function coalition_options_page()
{
    add_menu_page(
        'Homepage Options',
        'Homepage Options',
        'manage_options',
        'coalition',
        'coalition_options_page_html',
        '',
        1
    );
}


/**
 * Register our coalition_options_page to the admin_menu action hook.
 */
add_action('admin_menu', 'coalition_options_page');


/**
 * Top level menu callback function
 */
function coalition_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if (isset($_GET['settings-updated'])) {
        // add settings saved message with the class of "updated"
        add_settings_error('coalition_messages', 'coalition_message', __('Settings Saved', 'coalition'), 'updated');
    }

    // show error/update messages
    settings_errors('coalition_messages');
    ?>
    <div class="wrap">
        <h1>
            <?php echo esc_html(get_admin_page_title()); ?>
        </h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('coalition');
            do_settings_sections('coalition');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}
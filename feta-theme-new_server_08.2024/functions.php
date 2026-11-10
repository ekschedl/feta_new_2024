<?php

add_action('after_setup_theme', function () {

    // Title Tag in <head> : <title>...</title>
    add_theme_support('title-tag');

    /* Pfad zur Sprachdatei
    * load_textdomain() gibt den Namen der Übersetzungsdatei (beliebiger Name) und den Pfad an, wo diese zu finden ist.
    * https://developer.wordpress.org/reference/functions/load_textdomain/
    * get_template_directory() liefert den absoluten Server-Pfad zum Theme-Verzeichnis (ZB: "/var/www/html/wp-content/themes/webdev-theme") https://developer.wordpress.org/reference/functions/get_template_directory/
    *
    * Sämtliche Texte die wir in unserer functions.php oder in Templates schreiben und im Frontend oder Backend angezeigt werden, sollten über die Textdomain übersetzbar sein!
    * die Ausgabe im PHP wird in der Funktion als echo "_e('Zu übersetzender Text','TEXTDOMAIN')" oder return "__('Zu übersetzender Text','TEXTDOMAIN')" eingebunden
    * https://developer.wordpress.org/reference/functions/_e/
    */
    load_textdomain('wifi', get_template_directory() . '/assets/languages');

        // Aktivierung von Beitragsbildern
    //add_theme_support('post-thumbnails');

   // Eigene Bildgrößen im Theme definieren bzw. registrieren (https://developer.wordpress.org/reference/functions/add_image_size/)
    add_image_size('.change-photo', 1600, 1200, array('center', 'center'));  // 


    // WordPress HTML5-Markup
    add_theme_support('html5', array(
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
        'comment-list',
        'comment-form'
    ));

    add_theme_support('post-formats', array(
        'image',
        'gallery',
        'aside'
    ) );



    register_nav_menus(array(
        'primary' => __('Haupt Navigation', 'wifi'),
        'footer' => __('Footer Navigation', 'wifi'),
    ));


    add_theme_support('custom-logo', array(
        'height' => 80,
        'width' => 80,
        'flex-height' => true,
        'flex-width' => true
    ));


    //-- Gutenberg Editor
  
    add_theme_support('wp-block-styles');

    // aktiviere wide & fullwidth Layouts
    add_theme_support('align-wide');

    // Custom CSS für Gutenberg (Backend)
    add_theme_support('editor-styles');
    //add_editor_style('assets/style-editor.css');
    //add_editor_style('assets/icons/style.min.css');
   
    // Responsive Embeds (ZB. YouTube Videos, Iframes) erlauben
    add_theme_support('responsive-embeds');

    //eigene Schriftgröße im Editor deaktivieren
    //add_theme_support('disable-custom-font-sizes');

    // eigene Farbauswahl-Palette deaktivieren
    //add_theme_support('disable-custom-colors');

    // eignen Farbverlauf im Editor deaktivieren
    //add_theme_support('disable-custom-gradients');

 
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Font-Color', 'wifi'),
            'slug' => 'color-1',
            'color' => '#383838'
        ),
        array(
            'name' => __('Background Color', 'wifi'),
            'slug' => 'color-2',
            'color' => '#fff'
        )
    ));
    

    // Adminbar im Frontend deaktivieren (wenn aktiviert, sollten die Syles für Navigation angepasst werden)
    add_filter('show_admin_bar', '__return_false');

});


/*
 * Zusätzlichen Mimes (Dokumenttypen) für den Upload erlauben
 * https://developer.wordpress.org/reference/hooks/upload_mimes/
 */
add_filter('upload_mimes', function ($mimes = array()) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
});


/* ---- CSS & JS in <head> bzw. vor dem </body> einfügen [ wp_head() , wp_footer() ] ----
* https://developer.wordpress.org/reference/functions/wp_enqueue_script/
* der "Handle" muss eindeutig sein
* Liste aller Scripten, die WordPress bereits inkludiert hat: https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-and-js-libraries-included-and-registered-by-wordpress
*/
$theme_version = wp_get_theme()->get( 'Version' );
$version = is_string( $theme_version ) ? $theme_version : false;

add_action('wp_enqueue_scripts', function () use ($version) {
    
    // CSS (style.css) im Head einfügen
    wp_enqueue_style('icons-css', get_template_directory_uri() . '/assets/icons/style.css');
    wp_enqueue_style('feta-webdev-css', get_template_directory_uri() . '/style.css');
    
   
    // JS im Footer einfügen
    wp_enqueue_script('feta-webdev-js', get_template_directory_uri() . '/assets/js/scripts.js', [], $version, true);


    wp_enqueue_script('icons', get_template_directory_uri() . '/assets/icons/style.css', [], $version, true);

});



add_filter('show_admin_bar', '__return_false');



/* 


/* --- Funktonen für das Plugin ACF-Pro --- */

/* Bedingung: Prüfe ob ACF Pro installiert und aktiviert ist
* die PHP Funktion "function_exists()" prüft ob es diese Funktion mit dem Funktionsnamen gibt - "acf_add_options_page()" wird über das Plugin ACF-Pro deklariert
* wenn (if) das Plugin ACF-Pro installiert ist, existiert diese Funktion und wir können ACF-Option-Pages und/oder ACF-Gutenberg-Blöcke erstellen
* sonst (else) geben wir im WordPress Adminbereich eine Fehlermeldung aus, dass diese Plugin benötigt wird
* https://www.php.net/manual/de/function.function-exists.php
*/

if (function_exists('acf_add_options_page')) {

   /* ACF Feldgruppen und Feldeinstellungen als .json-Dateien im Theme speichern (Verzeichnis "acf-fields") und von dort laden
    * ACHTUNG: das Verzeichnis "acf-fields" muss existieren, damit die Dateien dort gespeichert werden können!
    * https://www.advancedcustomfields.com/resources/local-json/
    */
    add_filter('acf/settings/save_json', function ( $path ) {
        $path = get_template_directory() . '/assets/acf-fields';
        return $path;
    });
    add_filter('acf/settings/load_json', function ( $paths ) {
        unset($paths[0]);
        $paths[] = get_stylesheet_directory() . '/assets/acf-fields';
        return $paths;
    });


    /* ACF Option Page erstellen
    * https://www.advancedcustomfields.com/resources/acf_add_options_page/
    */
    acf_add_options_page(array(
        'page_title' => 'Social Links',
        'menu_title' => 'Social Links',
        'menu_slug' => 'webdev-social-links',
        'capability' => 'edit_posts',
        'position' => 50,
        'icon_url' => 'dashicons-admin-links', // https://developer.wordpress.org/resource/dashicons/
        'update_button' => __( 'Сохранить измененеия', 'wifi' ),
        'updated_message' => __( 'Изменения сохранены', 'wifi' )
    ));


    /* Hinzufügen von Gutenberg-Block-Kategorie */ 
add_filter( 'block_categories_all', function($categories){

    return array_merge(
            array(
                array(
                    'slug' => 'feta',
                    'title' => 'Feta'
                )
                ),
                $categories
            );

}, 10, 2 );


/* ACF-Gutenberg-Blöcke erstellen : */ 

add_action ( 'acf/init', function (){


    if ( function_exists('acf_register_block_type')  ) {
        
        /* register block "Header" */ 
        acf_register_block_type(array(
                'name' => 'product',
                'title' =>  __('Product', 'wifi'),
                'description' => __('Product information', 'wifi'),
                'supports' => array('anchor' => false),
                'category' => 'feta',
                'keywords' => array('product', 'feta'), //RU
                'post_types' => array('page'),
                'align' => false,
                'mode' => false,
                'icon' => 'welcome-widget-menus',//develoüer dashicon
                'render_template' => 'template-parts/block-product.php' // Pfad zum Template (HTML & PHP) des Gutenberg-Block

        ) );

}

} );



}else {
    /* Backend-Fehlermeldung, wenn ACF-Pro nicht installiert ist
    * https://developer.wordpress.org/reference/hooks/admin_notices/
    * https://digwp.com/2016/05/wordpress-admin-notices/
    */
    add_action('admin_notices', function () {
        ?>
        <div class="error notice">
            <p><?php _e('Внимание: Необходимо установить плагин "ACF Pro"!', 'wifi'); ?></p>
        </div>
        <?php
    });
}



function feta_customize_register( $feta_customize ) {
   
    $feta_customize->add_section( 'social_section' , array(
        'title'      => esc_html__( 'Social settings', 'wifi' ),
        'priority'   => 30,
        ));
        
        $feta_customize->add_setting( 'instagram_social' , array(
        'default'     => esc_html__('Url Instagram', 'wifi'),
        'transport'   => 'refresh',
        ));
    
        $feta_customize->add_setting( 'whatsapp_social' , array(
            'default'     => esc_html__('Url Whatsapp', 'wifi'),
            'transport'   => 'refresh',
            ));
    
     
    
   
        
          
        $feta_customize->add_control(
            'instagram_social', 
            array(
                'label'    => esc_html__( 'Instagram profile url', 'wifi' ),
                'section'  => 'social_section',
                'settings' => 'instagram_social',
                'type'     => 'text',
            )); 
      
                $feta_customize->add_control(
                    'whatsapp_social', 
                    array(
                        'label'    => esc_html__( 'Whatsapp profile url', 'wifi' ),
                        'section'  => 'social_section',
                        'settings' => 'whatsapp_social',
                        'type'     => 'text',
                    ));
                }
              
add_action( 'customize_register', 'feta_customize_register' );
            
 
function enqueue_swiper() {
    // Подключение стилей Swiper
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');

    // Подключение скриптов Swiper
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);

    // Ваши собственные скрипты для инициализации Swiper
    wp_enqueue_script('swiper-init', get_template_directory_uri() . '/assets/js/swiper-init.js', array('swiper-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_swiper');



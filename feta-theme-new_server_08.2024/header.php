<!DOCTYPE html>

<html lang="ru" class="no-js">

<head>
    <?php /* die WordPress Funktion "bloginfo()" gibt nütliche Informationen zur Website zurück. Über den Parameter 'show' können einzelne Werte ausgegeben werden.
        * bloginfo('charset') gibt den Zeichensatz der eingestellten Sprache zurück (ZB: UTF-8 )
        * https://developer.wordpress.org/reference/functions/bloginfo/
        * Hinweis: wird dieses Theme nur für Sprachen in UTF-8 entwickelt, könnte dieser Hardcoded eingefügt werden (also ohne Funktionsaufruf)
        */
    ?>
    <meta charset="<?php bloginfo('charset'); ?>>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>


<a href="#content" class="screen-reader-text"><?php _e('Skip to Content', 'ize'); ?> Перейти к основному содержанию</a>



<nav id="nav-main-big" class="container"> 
          <div id="brand">
                <?php /* Ausgabe des Logos aus dem Cusomizer
                    * Bedingung (if) überprüft ob die Funktion existiert - nur der Fall, wenn in der functions.php der Theme-Support 'custom-logo' aktiviert wurde
                    * the_custom_logo() gibt den <a> Tag inkl. href zur Startseite und verschachtelt den <img> Tag mit dem Logo und alt-Attribut aus
                    * https://developer.wordpress.org/reference/functions/the_custom_logo/
                    */
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            } ?>
          </div>
       
          <div id="slogan">
               <div class="slogan1"> 
                    <span class="blue_light">   В</span>
                    <span class="yellow">к</span>
                    <span class="tomato">у</span>
                    <span class="blue_light">с</span>
                </div>
                <div class="slogan2">
                    <span class="tomato">д</span>
                    <span class="yellow">е</span>
                    <span class="blue_light">т</span>
                    <span class="tomato">с</span>
                    <span class="yellow">т</span>
                    <span class="blue_light">в</span>
                    <span class="tomato">а</span>
               </div>  
           </div>

        <div class="nav-wrapper">

                <input type="checkbox" id="menu-toggle">
                  <label for="menu-toggle" id="menu-button">
                        <span class="menu-button-icon" aria-hidden="true"></span>
                        <span class="screen-reader-text"><?php _e('Меню открывается/закрывается', 'wifi'); ?></span>
                </label>



                <?php /*
                * Ausgabe des Menüs, dass im WordPress als "Haupt Navigation" festgelegt wurde (Design -> Menüs oder Cusotmizer -> Menüs / Position im Theme: Checkbox "Haupt Navigation")
                * https://developer.wordpress.org/reference/functions/wp_nav_menu/
                */
        wp_nav_menu(array(
            'theme_location' => 'primary',  // wurde in der functions.php festgelegt "register_nav_menus()"
            'container' => false,           // true würde eine <div> um die <ul> des wp_nav_menu() erzeugen
            'menu_class' => 'nav-menu',     // Klassenname der ul: <ul class="nav-menu">
            'menu_id' => 'nav-main',        // IDname der ul: <ul id="nav-main">
            'depth' => 1,                   // Anzahl der Menüebenen die ausgegeben werden
            'fallback_cb' => false          // wenn im WordPress kein Menü als "Footer Navigation" zugewiesen wurde (Checkbox), wird keine Navigation ausgegeben. Default wäre die Ausgebe der WordPress Funktion "wp_page_menu()" (https://developer.wordpress.org/reference/functions/wp_page_menu/)
        )); ?>



      </div>
     
  </nav>





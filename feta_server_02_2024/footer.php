<?php /*
 * die footer.php wird auf jeder Seiten eingebunden (über die Funktion "get_footer()" in den einzelnen Templates).
 * Somit hier sollte das Markup, dass auf jeder Seite im Footer angezeigt wird, zu finden sein.
 * Am Ende sollte immer der schließende </body> und </html> Tag stehen - geöffnet werden die Tags in der Datei "header.php"
*/ ?>
<footer class="footer">
<div class="social-links">

        <?php if(get_theme_mod('instagram_social') != ''):?>
                   <a class="social-icon__link" href="<?php echo get_theme_mod('instagram_social'); ?>" target="_blank">
                    <span class="icon-instagram " aria-hidden="true"> </span>
                    <span class="screen-reader-text"><?php _e('Мы в Инстаграм ', 'wifi') ?></span></a>
                <?php endif; ?>

             <?php if(get_theme_mod('whatsapp_social') != ''):?>
					<a class="social-icon__link" href="<?php echo get_theme_mod('whatsapp_social'); ?>" target="_blank">
                    <span class="icon-whatsapp" aria-hidden="true"></span>
                    <span class="screen-reader-text"><?php _e('Мы в Ватсап ', 'wifi') ?></span></a>
                <?php endif; ?>

                

                
        </div>

       

        <nav id="nav-footer">
      
      <?php /*
                * Ausgabe des Menüs, dass im WordPress als "Footer Navigation" festgelegt wurde (Design -> Menüs oder Cusotmizer -> Menüs / Position im Theme: Checkbox "Footer Navigation")
                * https://developer.wordpress.org/reference/functions/wp_nav_menu/*/
             wp_nav_menu(array(
            'theme_location' => 'footer',   // wurde in der functions.php festgelegt "register_nav_menus()"
            'container' => false,      // true würde eine <div> um die <ul> des wp_nav_menu() erzeugen
            'menu_class' => 'footer-menu', // Klassenname der ul: <ul class="nav-menu">
            'depth' => 1,          // Anzahl der Menüebenen die ausgegeben werden
            'fallback_cb' => false       // wenn im WordPress kein Menü als "Footer Navigation" zugewiesen wurde (Checkbox), wird keine Navigation ausgegeben. Default wäre die Ausgebe der WordPress Funktion "wp_page_menu()" (https://developer.wordpress.org/reference/functions/wp_page_menu/)
        )); ?>
     
    </nav>
      
    

      
        <div class="copyright">
            <?php 
                echo sprintf(__('&copy; %1$s, %2$s'), date('Y'), get_bloginfo('name')); ?>
              <span>
                    <?php _e('Сайт разработала:'); ?>
                    <a href='https://www.schedl.com' target='_blank' title='Екатерина Шедльбергер'>Екатерина Шедльбергер</a>
            </span>
    
    </div>
    
</footer>


 
 <div id="to-top"><?php _e('', 'wifi'); ?>
        </div>



        
        <?php wp_footer(); ?>


</body>

</html>


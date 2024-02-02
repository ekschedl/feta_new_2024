<?php get_header(); // WordPress Funktion zum Einbinden der header.php  ?>
    <main id="content" class="container">
        <?php /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge
        * https://developer.wordpress.org/themes/basics/the-loop/
        */
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content(); // gibt den gesamten Inhalt des Editors aus
            }
        }
        ?>
    </main>
<?php get_footer(); // WordPress Funktion zum Einbinden der footer.php
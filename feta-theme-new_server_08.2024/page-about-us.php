<?php
/*
Template Name: About Us Template
*/
?>

<?php get_header(); // WordPress Funktion zum Einbinden der header.php  ?>
        
<main>
     
<?php /* WordPress Standard Schleife zur Ausgabe des Seiten-Inhalts und der Beiträge*/
if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content(); // gibt den gesamten Inhalt des Editors aus
    }
}
?>
     <?php get_template_part('slider-template'); // Включает слайдер ?>
      
  </main>
  <?php get_footer(); // WordPress Funktion zum Einbinden der footer.php
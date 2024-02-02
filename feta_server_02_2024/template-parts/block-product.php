
    
    <?php

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

$class_name = 'product';
if (!empty($block['className'])) {
    $class_name .= ' ' . esc_attr($block['className']);
}

/*
 * ACF Gruppe-Feld in Variable speichern – Rückgabewert ist ein Array
 * https://www.advancedcustomfields.com/resources/group/
 */


$product= get_field('product');
if (!empty($product)) : ?>

<div <?php echo $anchor; ?>class="<?php echo $class_name; ?>">

<div class="container-image">
  <span class="name-lolli"><?php echo $product['product_name']; ?></span>
  <figure class="change-photos">
        <div class="change-photo" >
            <?php echo wp_get_attachment_image($product['image_first'], 'medium'); ?>
        </div>
        <div class="change-photo">
            <?php echo wp_get_attachment_image($product['image_second'], 'medium'); ?>
      </div> 
    </figure>
</div> 




<div class="container-tab">  
                  
                  <div class="tab">
                  
                  <?php $product_id = wp_unique_id();?>

                      <input type="checkbox" id="<?php echo $product_id; ?>">
                      
                      <label class="tab-label" for="<?php echo $product_id; ?>"><span class="about-product"> O продукте</span> </label>
                      <span class="screen-reader-text">Откроется таблица/закроется</span>
                     
                      <div class="tab-content">

<?php $product_tabel= get_field('product_tabel');

if (!empty($product_tabel)) : ?>
                        <table>

                        <?php foreach ($product_tabel as $row): ?>
                          <tr>
                             <td class="bold"> <?php echo $row ['column_first']?> </td>
                             <td class="notbold"><?php echo $row ['column_second'] ?> </td>
                         </tr>
                             

                         <?php endforeach; ?>

                        </table>

 <?php endif; ?>
 </div>
                        <div class="preis-btn">
                            <a href="/contact" title="Откроется страница контакты"> 
                              Получить прайс-лист</a>  
                      </div>
                  </div> 
          </div>

</div>


<?php 
elseif (is_admin()) : ?>
    <h2 class="empty-block"><?php _e('Обработать блок &raquo;', 'wifi') ?></h2>
<?php endif;?>



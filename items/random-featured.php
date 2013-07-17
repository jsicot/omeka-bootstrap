
<?php if ($items): ?>

        <div class="span7">
            <div id="homeCarousel" class="carousel slide">
                <div class="carousel-inner">

    <?php 
    
   $i = 0;
   $len = count($items);
    foreach ($items as $item): 
    	$title = metadata($item, array('Dublin Core', 'Title'));
        $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 50));
    
    
     if ($i == 0) {echo '<div class="item active">';}
    	else {echo '<div class="item">';}
    ?>

                        <?php if (metadata($item, 'has thumbnail')): ?>
                            <div class="carousel-img" style="text-align: center">
                                <?php
                                echo link_to_item(item_image('fullsize', array('class'=>'img-polaroid'), 0, $item), array(), 'show', $item);
                                ?>
                            </div>
                        <?php endif; ?>
                            <div class="carousel-caption">
                                <h4><?php echo link_to($item, 'show', strip_formatting($title));  ?></h4>
                                <?php if ($abstract = metadata($item, array('Dublin Core', 'Abstract'), array('snippet'=>250))): ?>
	                             <p>
	                                <?php echo $abstract; ?>
	                             </p>
				<?php  elseif ($description = metadata($item, array('Dublin Core', 'Description'))): ?>
                                    <p>
                                        <?php echo $description; ?>
                                    </p>

                                <?php elseif ($text = metadata($item, array('Item Type Metadata', 'Text'))): ?>
                                    <p>
                                        <?php echo $text; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
    <?php 
    $i++;
    endforeach; 
    ?>
     </div>
            <a class="carousel-control left" href="#homeCarousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#homeCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
<?php else: ?>
    <p><?php echo __('There is no featured document at this time.'); ?></p>
<?php endif; ?>



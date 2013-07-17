<?php 

$collections = get_recent_collections() ;

if ($collections): ?>
 <?php     
   $i = 0;
   $len = count($collections);
    foreach ($collections as $collection): 
    	$title = metadata($collection, array('Dublin Core', 'Title'));
    	$img = "collections/". $collection->id .".jpg" ;

    ?>
<div class="span3">
        <div class="triBox text-center">
            <!-- <h4>Watch Our Progress</h4> -->
            <div  style="background: url(<?php echo img($img); ?>) scroll 50% 0 no-repeat; border-radius: 10px !important; height:180px;">
                <br /><br /><br />
                <h4 style="background: rgba(255,255,255,.75); padding: .5em 1em"><a href="/collections/show/<?php echo $collection->id; ?>"><?php echo link_to($collection, 'show', strip_formatting($title));  ?></a></h4>

                <br /><br /><br />
            </div>
        </div>
    </div>
                       
                               
    <?php 
    $i++;
    endforeach; 
    ?>
    
<?php else: ?>
    <p><?php echo __('There is no recents collections at this time.'); ?></p>
<?php endif; ?>



<?php
$pageTitle = __('Search Omeka ') . __('(%s total)', $total_results);
echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
$searchRecordTypes = get_search_record_types();
?>

<!-- <div id="primary"> -->
    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h1><i class="icon-search"></i> Résultats <small><?php echo __('(%s document', $total_results); ?><?php if ($total_results != 1)  echo 's';  ?>)</small></h1>
            </div>
        </div>
    </div>

<?php echo search_filters(); ?>

<?php if ($total_results): ?>
    <div id="pagination-top" class="pagination pagination-centered">
        <?php echo pagination_links(); ?>
    </div>

        <?php foreach (loop('search_texts') as $searchText): ?>
        <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
                    
        <?php if($searchText['record_type'] == 'File') { 
                 $item = $record->getItem();    
        
        } 
        else { $item = get_record_by_id($searchText['record_type'], $searchText['record_id']);}
        
        
        ?>   
        
<div class="item row">
<div class="span12">
    <div class="row">
        <div class="span2">
            <?php if (metadata($item, 'has thumbnail')): ?>
                <div class="item-img">
                 <?php if (metadata($item, 'has thumbnail')) {
            echo link_to_item(
                item_image('fullsize', array(), 0, $item),
                array('class' => 'image'), 'show', $item
            );
        }
        ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="span7">
            <div class="item-title">
                <h3><a href="<?php echo record_url($item, 'show'); ?>"><?php echo metadata($item, array('Dublin Core', 'Title')); ?></a></h3>
            </div>
           <?php if ($author = metadata($item,array('Dublin Core','Creator'))): ?>
                    <p><div><strong>Par 
                        <?php echo ' ' . $author . '</strong></div>'; ?>
		   </p>
            <?php endif; ?>
            <?php if ($text = metadata($item, array('Item Type Metadata', 'Text'))): ?>
                <div class="item-description">
                    <p><?php echo $text; ?></p>
                </div>
			<?php elseif ($abstract = metadata($item,array('Dublin Core', 'Abstract'), array('snippet'=>250))): ?>
                <div class="item-description">
                    <?php echo $abstract ; ?>
                </div>
            <?php elseif ($description = metadata($item,array('Dublin Core', 'Description'))): ?>
                <div class="item-description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
            
            <?php if (get_collection_for_item($item)): 
	            $Collection = $item->Collection;
	            	
            ?>
                <p><div><strong><?php echo __('Collection'); ?></strong></div>
                <div class="element-text"><a href="<?php echo record_url($Collection, 'show'); ?>"><?php echo metadata($Collection, array('Dublin Core', 'Title')); ?></a></div></p>
            <?php endif; ?>

        </div>
        <div class="span3">
            <?php if (metadata($item,'has tags')): ?>
                <div class="browse-items-tags well well-small">
                    <p><i class="icon-tags"></i> <strong>Tags</strong></p>
                    <?php echo tag_string($item); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <hr />
</div>
</div>
        <?php endforeach; ?>
    </tbody>
</table>





    <div id="pagination-bottom" class="pagination pagination-centered">
        <?php echo pagination_links(); ?>
    </div>
<?php else: ?>
<div id="no-results">
    <p><?php echo __('Your query returned no results.');?></p>
</div>
<?php endif; ?>
<?php echo foot(); ?>

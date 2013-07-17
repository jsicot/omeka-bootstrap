<?php 
    echo head(array('title' => metadata($item,array('Dublin Core', 'Title')), 'bodyid'=>'items','bodyclass' => 'show')); 
    $item = $this->item;
    
    function formatBytes($size, $precision = 2)
	{
    		$base = log($size) / log(1024);
    		$suffixes = array('', 'k', 'M', 'G', 'T');   

    		return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
	}
    $db = get_db();
    $fileTable = $db->getTable('File');
 	$pdfTextPlugin = new PdfTextPlugin;
        $select = $db->select()
            ->from($db->File)
            ->where('mime_type IN (?)', $pdfTextPlugin->getPdfMimeTypes())
	    ->where('item_id = ?', $item->id);
        // Iterate all PDF file records.
        $pageNumber = 1;
        while ($files = $fileTable->fetchObjects($select->limitPage($pageNumber, 50))) {
            foreach ($files as $file) {

    		$PDFname = $file->original_filename; 
    		$PDFlink = WEB_FILES . '/original/' . $file->filename;
    		$PDFtype = metadata($file,  'Type OS');
    		$PDFsize =  formatBytes(metadata($file, 'Size'));
            }
            $pageNumber++;
        }
		
    
    
    
    ?>
<div id="primary">
    <div class="row">
        <div class="span12">
            <div class="pagination pagination-centered" style="margin-top:0;margin-bottom:0;">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <?php echo flash(); ?>
        </div>
    </div>
     <div class="row">
        <div class="span12">
            <div class="page-header">
            	<h1 style="display:inline"><?php echo metadata($item,array('Dublin Core', 'Title')); ?> </i></h1> </h3>
       <?php if (metadata($item, 'Item Type Name') == 'Book' ||  metadata($item, 'Item Type Name') == 'BookReader'){ ?> 
            	<h3  style="display:inline"> <a href="/viewer/show/<?php echo $item->id; ?>"><i class="icon-eye-open"></i> Lire en ligne </a>
        <?php } ?>
    	  </div>
    	</div>
    </div>
    <div class="row">
        <div class="span6">
            <!-- Item Description -->
            <div class="row">
                <div class="span6">
		   <?php if ($itemAbstract = metadata($item,array('Dublin Core','Abstract'))): ?>
                        <div class='toolong'><p class="lead"> <?php echo $itemAbstract; ?></p></div>
                    <?php elseif ($itemDescription = metadata($item,array('Dublin Core','Description'))): ?>
                       <div class='toolong'> <p class="lead"><?php echo $itemDescription; ?></p></div>
                    <?php else: ?>
                        <h4>Description</h4>
                        <p class="alert"><strong>Désolé,</strong> aucune description pour ce document.</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Item Collection Information (if available) -->
            <?php if (get_collection_for_item($item)): ?>
            <div class="row"><div class="span6">
                <div id="collection" class="element">
                    <h4 style="display:inline"><?php echo __('Collection'); ?>: </h4>
                    <h4 style="display:inline"><?php echo link_to_collection_for_item(); ?></h4>
                </div>
            </div></div>
            <?php endif; ?>
            
            <div class="row"><div class="span6"><hr /></div></div>
            
            <div class="row">
                <div class="span2">
                <!-- Item Date Information -->    
                    <h4><i class="icon-calendar"></i> Date : </h5>
                    <?php if ($itemDate = metadata($item,array('Dublin Core','Date'))): ?>
                        <div><?php echo $itemDate; ?></div>
                    <?php else: ?>
                        <div>Inconnu.</div>
                    <?php endif; ?>
                </div>
                <div class="span2">
                <!-- Item Creator Information -->
                    <h4><i class="icon-user"></i> Auteur(s): </h4>
                    <div>
                    <?php if ($itemCreator = metadata($item,array('Dublin Core','Creator'),'all')): ?>
                        <?php foreach ($itemCreator as $author) {
                            echo $author . '<br />';
                        } ?>
                    <?php else: ?>
                        Iconnu.
                    <?php endif; ?>
                    </div>
                </div>
               <div class="span2">
                <!-- Item Date Information -->    
                    <h4><i class="icon-book"></i> Éditeur : </h5>
                    <?php if ($itemEditor = metadata($item,array('Dublin Core','Publisher'))): ?>
                        <div><?php echo $itemEditor; ?></div>
                    <?php else: ?>
                        <div>Inconnu.</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="span2">
                <!-- Item Date Information -->    
                    <h4><i class="icon-comments-alt"></i> Langue(s) : </h5>
                    <?php if ($itemLangs = metadata($item,array('Dublin Core','Language'),'all')): ?>
                     <?php foreach ($itemLangs as $lang) {
                            echo $lang . '<br />';
                        } ?>
                    <?php else: ?>
                        Iconnu.
                    <?php endif; ?>
                </div>
                <div class="span4">
                <!-- Item Creator Information -->
                    <h4><i class="icon-bookmark"></i> Sujet(s): </h4>
                    <div>
                    <?php if ($itemCreator = metadata($item,array('Dublin Core','Subject'),'all')): ?>
                        <?php foreach ($itemCreator as $author) {
                            echo $author . '<br />';
                        } ?>
                    <?php else: ?>
                        Iconnu.
                    <?php endif; ?>
                    </div>
                </div>
            </div>                
            <!-- The following prints a list of all tags associated with the item -->
            <div class="row">
                <div class="span6">
                    <hr />
                    <h4><i class="icon-tags"></i> Tags</h4>
                    <div class="tags well well-small">
                        <?php if (tag_string($item) != null) {
                            echo tag_string($item); }
                            else {
                                echo 'Pas de tags. ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php if ($PDFlink): ?>  
            <div class="row"><div class="span6">
                <div id="collection" class="element">
                    <h4 style="display:inline"><i class="icon-download-alt"></i> Télécharger :</h4>
                    <h4 style="display:inline"><a class="btn btn-danger disabled" href="<?php echo $PDFlink; ?>"><?php echo $PDFname; ?></a> <small>(<?php echo $PDFtype .' - '. $PDFsize ; ?>)</small></h4>
                </div>
            </div></div>
          <?php endif; ?>   
	    <div class="row">
                <div class="span6">
                    <hr />
                    <!-- The following prints a citation for this item. -->
                    <h4><i class="icon-share"></i> <?php echo __('Citation'); ?></h4>
                    <div class="element-text"><?php echo metadata($item,'citation',array('no_escape' => true)); ?></div>
                </div>
            </div>

       	    <?php echo get_specific_plugin_hook_output('Geolocation' , 'public_items_show', array('view' => $this, 'item' => $item)); ?>
	   <div class="row">
                <div class="span6">
                    <?php //fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
                </div>
            </div>
        </div>
        <!-- The following returns all of the files associated with an item. -->
        <div id="itemfiles" class="span6">
            <!-- <h3><?php //echo __('Files'); ?></h3> -->
            <?php if ($itemDate = metadata($item,array('Dublin Core','Identifier'))): ?>
            	<p class="lead" style="text-align:center;">Identifiant #: <?php echo metadata($item,array('Dublin Core','Identifier')); ?></p>
           <?php endif; ?>
            <div class="element-text">

            <?php 
 		echo get_specific_plugin_hook_output('BookReader' , 'public_items_show', array('view' => $this,'item' => $item,'page' => '0','embed_functions' => false,)); 

            
            //echo files_for_item(
                //array('imageSize'=>'fullsize','linkToFile'=>true,'linkToMetadata'=>false),//options
                //array('class'=>'file-image'),
                //null); 
        ?></div>
	 <?php echo get_specific_plugin_hook_output('OmekaBootstrapSocial' , 'public_items_show', array('view' => $this, 'item' => $item)); ?>	
	   <div class="row">
                <div class="span6">
                    <hr />
                    <!-- The following prints a citation for this item. -->
                    <h4><i class="icon-unlock"></i> Conditions d'utilisation</h4>
                     <?php if ($itemLicense = metadata($item,array('Dublin Core','License'))): ?>
                       <?php $cc = $itemLicense; ?>
                     <?php elseif ($itemRights = metadata($item,array('Dublin Core','Access Rights'))): ?>
                        <?php $cc = $itemRights; ?>
                     <?php else: ?>
                      <?php $cc = "Inconnu"; ?>
                     <?php endif; ?>
		<?php 	  
		  if(preg_match("/publicdomain/", $cc)) {
	          	echo ' <a rel="license" href="'. $cc .'"><img src="http://i.creativecommons.org/p/mark/1.0/88x31.png" style="border-style: none;" alt="CC0" /></a>';
          	} 
          else if(preg_match("/by-nc-nd/", $cc)){          		
          		echo '<a rel="license" href="'. $cc. '"><img alt="Licence Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/fr/88x31.png" /></a>' ;	          		          	
          	}
          else if(preg_match("/by-nc-sa/", $cc)){          		
          		echo '<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/fr/"><img alt="Licence Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/fr/88x31.png" /></a>' ;	
          	}
	else { echo $cc; }
         ?>
                     
                </div>
            </div>   

    
        </div>

    </div>
    
    <div class="row">
        <div class="span12">
            <div class="pagination pagination-centered">
                <ul>
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                </ul>
                <ul>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
            </div>
        </div>
    </div>
        
</div>
<!-- end primary -->

<?php echo foot(); ?>

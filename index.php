<?php echo head(array('bodyid'=>'home')); ?>
<div class="row">
   <?php echo random_featured_items(6); ?>
    <div class="span5">
        <div id="browseBox" class="homeBox" onclick="location.href='/items/browse'">
            <h2><a href="/items/browse">CONSULTER <small>tous les contenus</small></a></h2>
        </div>
        <div id="collectionBox" class="homeBox" onclick="location.href='/collections/browse'">
            <h2><a href="/collections/browse">PARCOURIR <small>les collections</small></a></h2>
        </div>
        <div id="mapBox" class="homeBox" onclick="location.href='/geolocation/map/browse'">
            <h2><a href="/geolocation/map/browse">NAVIGUER <small>sur la carte</small></a></h2>
        </div>
        <div id="searchBox" class="homeBox" onclick="location.href='/items/search'">
            <h2><a href="/items/search">RECHERCHER <small>par titre, auteur, date, etc.</small></a></h2>
        </div>
    </div>
    <div class="span12">
        <hr />
    </div>
</div>
<div class="row" id="rowBottom">
   <!-- <div class="span3">
        <div class="triBox" id='random_featured'>
            <?php //echo random_featured_items(1); ?>
        </div>
    </div>-->
     <div class="span3">
        <div class="triBox text-center">
            <div class="random-document">
                <h4>À propos</h4>
                <ul id="home-links" class="nav nav-stacked">
                    <li><a href="/about">Le Projet</a></li>
                    <li><a href="/team">L'Équipe</a></li>
                    <li><a href="/conception">Aspects techniques</a></li>
                    <li><a href="/rights">Conditions d'utilisation</a></li>
                </ul>
            </div>
        </div>
    </div>
	<?php echo random_featured_collection() ?> 
   
</div>
<?php echo foot(); ?>

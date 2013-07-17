<ul class="nav pull-right">
	<li>
		<?php echo link_to_item_search($text='<i class="icon-search"></i> Recherche avancée'); ?>
	</li>
</ul>
<form method="get" action="/search" class="navbar-search pull-right" id="search-form">
		<input type="text" class="search-query span2" placeholder="Rechercher" id="query" name="query">
</form>


<script src="<?=PATH?>/media/js/menu.js" type="text/javascript"></script>
<h1>Menu of Gordon&#39;s Crown</h1>
<div id="sidebar">
    <h2>Jump to ...</h2>
    <ul>
        <?php foreach($this->listCat as $cat) :?>
            <li>
                <a href="javascript: goToByScroll('<?=$cat->alias?>')">
                    <?=$cat->title?>
                </a>
            </li>
        <?php endforeach ?>    
    </ul>
</div>

<div id="foods">
    <?php foreach ($this->listCat as $cat) : ?>
        <h2><a class="category" name="<?=$cat->alias?>"><?=$cat->title?></a></h2>
        <h3 class="rating">Rating: <?= $cat->score?> (<?=$cat->rate?> rating<?=$cat->more?>)</h3>
        <div class="category">
			<div class="foodcategory_image">
				<img src="<?=PATH?>/media/img/menu/<?=$cat->image?>" alt="<?= $cat->titleimage?>" />
			</div>
            	<ul>
                    <?php foreach($cat->listMenu as $menu) : ?>
                        <li>
                            <a href="<?=PATH?>/menu/<?=$menu->alias?>" title="Go to detail view of<?=$menu->title?> - &pound;<?=$menu->price?>">  
                                <?=$menu->title?> - &pound;<?=$menu->price?>
                            </a>
                        </li>	
                    <?php endforeach ?>				
				</ul>
        </div>
    <?php endforeach ?>
</div>
<div id="rssfed"><a href="<?=PATH?>/menu/feed"><img src="<?=PATH?>/media/img/rss.gif" alt="RSS-Feed with Menus" title="RSS-Feed with Menus"/></a></div>


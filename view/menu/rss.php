
<rss version="2.0"
	xmlns:atom="http://www.w3.org/2005/Atom"
	>
    <channel>
        <title>Gordon's Crown Menus</title>
        <link>http://www.gordonscrown.local/</link>
		<atom:link href="<?=PATH?>/menu/feed/" rel="self" type="application/rss+xml" />
        <description>This is RSS Feed of Gordon's Crown Menus</description>
        <language>en</language>
        <?php foreach ($this->listMenu as $menu) : ?>
        <item>
            <title><?= $menu->title?></title>
			<link><?=PATH?>/menu/<?= $menu->alias?></link>
			<guid isPermaLink="false"><?=PATH?>/menu/<?= $menu->alias?></guid>
			<category><![CDATA[<?=$menu->category_title?>]]></category>		
            <description><![CDATA[
				<p><?=$menu->description?> </p>
				<div name="menuimage"><img src="<?=PATH?>/media/img/menu/<?=$menu->image?>" alt="<?=$menu->title?>" title="<?=$menu->title?>" /></div>
				<div name="menueprice">Price: &pound;<?=$menu->price?> </div>
				<div name="menuerating">Rating: <?=$menu->score?> (<?=$menu->rate?> rating<!--<?=$menu->more?>-->)</div>
				<div name="menuetags">Tags: <a href="http://www.gordonscrown.local/tags/fish">fish</a>, <a href="http://www.gordonscrown.local/tags/cocktail">cocktail</a></div>
			]]></description> 	
        </item>
        <?php endforeach ?>
	</channel>
</rss>
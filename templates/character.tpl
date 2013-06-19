<h2>Charakter</h2>
<span class="prefix">{$char['prefix']}</span><span class="name">{$char['name']}</span><span>{$char['suffix']}</span><br />
<span class="guild">{$char['guildName']}</span><br />
<span class="level">Level {$char['level']}</span>, <span class="race">{$_race_name[$char['raceId']]}</span> <span class="class">{$_class_name[$char['classId']]}</span>


<h3>Item-Test</h3>
{foreach from=$char['items'] item=item}
<div>
    <a rel="item={$item['id']}&ench={$item['permanentEnchantItemId']}&gems={foreach from=$item.gems item=gem}{if isset($gem['id'])}{$gem['id']}:{/if}{/foreach}" href="http://wotlk.openwow.com/item={$item['id']}" target="_blank">
        <img width="32" height="32" src="http://www.linuxlounge.net/~martin/wowimages/?item={$item['id']}" />
    </a> <strong>{$item['level']}</strong> {$item['name']}
    {foreach from=$item.gems item=gem}
        {if isset($gem['id'])}<a href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{/if}
    {/foreach}
</div><br />
{/foreach}

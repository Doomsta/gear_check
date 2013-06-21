<h2>Charakter</h2>
{if strlen($char.prefix) > 0}<span class="prefix">{$char['prefix']}</span>&nbsp;{/if}<span class="name">{$char['name']}</span>{if strlen($char.suffix) > 0}&nbsp;<span>{$char['suffix']}</span>{/if}{if strlen($char['guildName']) > 0}<br />
<span class="guild">{$char['guildName']}</span>{/if}<br />
<span class="level">Level {$char['level']}</span>, <span class="race">{$_race_name[$char['raceId']]}</span> <span class="class">{$_class_name[$char['classId']]}</span>

<h3>Gegenst&auml;nde</h3>
<div style="background:#F5F5F5;padding:10px;border: 1px solid rgba(0, 0, 0, 0.15);border-radius:4px 4px 4px 4px;width:480px;">
{foreach from=$char['items'] item=item}
<div style="height: 55px;">
    <div style="float:left;">
        <a rel="item={$item['id']}&amp;ench={$item['permanentEnchantItemId']}&amp;gems={foreach from=$item.gems item=gem}{if isset($gem['id'])}{$gem['id']}:{/if}{/foreach}" href="http://wotlk.openwow.com/item={$item['id']}" target="_blank">
            <img width="45" height="45" src="http://www.linuxlounge.net/~martin/wowimages/?item={$item['id']}" class="q{$item['rarity']}" />
        </a>
    </div>
    <div style="padding-left: 55px;">
        <strong>{$item['level']}</strong> <span style="font-weight:bold;" class="q{$item['rarity']}">
        <a href="#" rel="tooltip" data-html='true' data-original-title="{$item['tooltip']}">[{$item['name']}]</a></span><br />
    {if $item['permanentEnchantItemId'] != 0}
        <a href="http://wotlk.openwow.com/item={$item['permanentEnchantItemId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$item['permanentEnchantItemId']}" /></a>
    {/if}
    {if isset($item['permanentEnchantSpellId'])}
        <a href="http://wotlk.openwow.com/spell={$item['permanentEnchantSpellId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?spell={$item['permanentEnchantSpellId']}" /></a>
    {/if}
    {foreach from=$item.gems item=gem}
        {if isset($gem['id'])}<a href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img class="socket{$gem['color']}" width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{/if}
    {/foreach}
    </div>
</div>
{/foreach}
</div>

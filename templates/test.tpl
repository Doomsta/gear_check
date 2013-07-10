<div>
<span class="name">
    <h1>
{if strlen($char.prefix) > 0}<small>{$char['prefix']}</small><br />{/if}
        <a href="http://armory.wow-castle.de/character-sheet.xml?r=WoW-Castle+PvE&cn={$char['name']}">{$char['name']}</a>
{if strlen($char.suffix) > 0}<br /><small>{$char['suffix']}</small>{/if}
    </h1>
</span>
{if strlen($char['guild']) > 0}<br />
<span class="guild">{$char['guild']}</span>{/if}<br />
<span class="level">Level {$char['level']}</span><br /> 
<span class="race">Race:{$char['raceId']}</span> <br />
<span class="class">Class:{$char['classId']}</span><br />
<span class="avg">Avg:{$avg}</span><br />


                      <h3>Equipment</h3>
<table border="1">
{for $i=0 to 7}
  <tr valign="top">
    <td style="text-align:center;vertical-align:middle;">
        {if ($items[$i]['id'])}
        <a href="http://wotlk.openwow.com/item={$items[$i]['id']}" target="_blank">
            <img width="45" height="45" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['id']}" class="q{$items[$i]['rarity']}" />
        </a>
        {else}
         <img width="45" height="45" src="img/slots/{$i}.png" />
        {/if}
    </td>
    <td>
    <div>
    {if isset($items[$i]['level'])}
    [{$items[$i]['level']}]<a href="#" rel="tooltip" data-placement='right' data-html='true' data-original-title="{$items[$i]['tooltip']}">[{$items[$i]['name']}]</a></div>
    {/if}
    {if $items[$i]['permanentEnchantItemId'] != 0}
        <a href="http://wotlk.openwow.com/item={$items[$i]['permanentEnchantItemId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['permanentEnchantItemId']}" /></a>
    {/if}
    {if isset($items[$i]['permanentEnchantSpellId'])}
        <a href="http://wotlk.openwow.com/spell={$items[$i]['permanentEnchantSpellId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?spell={$items[$i]['permanentEnchantSpellId']}" /></a>
    {/if}
    {foreach from=$items[$i].gems item=gem}
        {if isset($gem['id'])}<a href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img class="socket{$gem['socketColor']}" width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{/if}
    {/foreach}
    </td>
    <td align="right">
    <div>
    <a href="#" rel="tooltip" data-placement='left' data-html='true' data-original-title="{$items[$i+8]['tooltip']}">[{$items[$i+8]['name']}]</a>[{$items[$i+8]['level']}]
    </div>
    {if $items[$i+8]['permanentEnchantItemId'] != 0}
        <a href="http://wotlk.openwow.com/item={$items[$i+8]['permanentEnchantItemId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i+8]['permanentEnchantItemId']}" /></a>
    {/if}
    {if isset($items[$i+8]['permanentEnchantSpellId'])}
        <a href="http://wotlk.openwow.com/spell={$items[$i+8]['permanentEnchantSpellId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?spell={$items[$i+8]['permanentEnchantSpellId']}" /></a>
    {/if}
    {foreach from=$items[$i+8].gems item=gem}
        {if isset($gem['id'])}<a href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img class="socket{$gem['socketColor']}" width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{/if}
    {/foreach}
    
    </td>
    <td style="text-align:center;vertical-align:middle;">
        {if isset($items[$i+8]['id'])}
        <a href="http://wotlk.openwow.com/item={$items[$i+8]['id']}" target="_blank">
            <img width="45" height="45" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i+8]['id']}" class="q{$items[$i+8]['rarity']}" />
        </a>
        {else}
        <img width="45" height="45" src="img/slots/{$i+6}.png" />
        {/if}
    </td>
  </tr>
{/for}
{for $i=16 to 18}
    <tr>
        <td style="text-align:center;vertical-align:middle;">
        {if isset($items[$i]['id'])}
        <a href="http://wotlk.openwow.com/item={$items[$i]['id']}" target="_blank">
            <img width="45" height="45" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['id']}" class="q{$items[$i]['rarity']}" />
        </a>
        {else}
        <img width="45" height="45" src="img/slots/{$i-1}.png" />
        {/if}
    </td>
    <td  colspan="3">
    <div>[{$items[$i]['level']}]<a href="#" rel="tooltip" data-placement='right' data-html='true' data-original-title="{$items[$i]['tooltip']}">[{$items[$i]['name']}]</a>
    </div>
    {if $items[$i]['permanentEnchantItemId'] != 0}
        <a href="http://wotlk.openwow.com/item={$items[$i]['permanentEnchantItemId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['permanentEnchantItemId']}" /></a>
    {/if}
    {if isset($items[$i]['permanentEnchantSpellId'])}
        <a href="http://wotlk.openwow.com/spell={$items[$i]['permanentEnchantSpellId']}"><img width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?spell={$items[$i]['permanentEnchantSpellId']}" /></a>
    {/if}
    {foreach from=$items[$i].gems item=gem}
        {if isset($gem['id'])}<a href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img class="socket{$gem['socketColor']}" width="24" height="24" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{/if}
    {/foreach}
    </td>
    </tr>
{/for}
</table>

<h3>Gems</h3>
gem count<br />
{foreach from=$gems key=gemid item=gemArray}
{$gemArray['count']}x <a href="http://wotlk.openwow.com/item={$gemid}">{$gemArray['name']}</a><br />
{/foreach}
<h3>Stats</h3>
{foreach from=$stats key=key item=stat}
{if $stats != 0}
{$_stat_name[$key]} => {$stat} <br />
{/if}
{/foreach}
+<h3>Berufe</h3>
foreach from=$skills key=key item=skill}
{$_skill_name[$key]} => {if isset($skill['guessed']) && $skill['guessed']}<strong>~</strong>{/if}{$skill['val']}/{$skill['max']}<br />
{/foreach}
<h3>PvP</h3>
</div>



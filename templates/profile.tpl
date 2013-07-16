<div class="profile">
	<div class="name">
		<a href="http://armory.wow-castle.de/character-sheet.xml?r=WoW-Castle+PvE&cn={$char['name']}">{$char['name']}</a>
	</div>
	<div class="title-guild">
		<div class="title">
			{if strlen($char.prefix) > 0}{$char['prefix']}{/if}
			{if strlen($char.suffix) > 0}{$char['suffix']}{/if}
		</div>
		{if strlen($char['guild']) >0}
		<div class="guild"><a href="http://armory.wow-castle.de/guild-info.xml?r=WoW-Castle+PvE&gn={$char['guild']}">{$char['guild']}</a></div>
		{/if}
	</div>
	<span class="clear"></span>
	<div class="under-name class{$char['classId']}">
		<span class="level">
			<strong>{$char['level']}</strong>
		</span>,&nbsp;
		<span class="race">{$_race_name[$char['raceId']]}</span>,&nbsp;
		<!-- talents -->
		<span class="class">{$_class_name[$char['classId']]}</span>
	</div>
	<div width="740" class="average-ilvl">
		{$avg}
	</div>
</div>

<table style="width: 740px; height: 550px; background-image: url(http://eu.battle.net/wow/static/images/2d/profilemain/race/{$char['raceId']}-{$char['genderId']}.jpg)">
{for $i=0 to 7}
  <tr valign="top">
    <td style="text-align:center;vertical-align:middle;">
        {if ($items[$i]['id'])}
        <a href="http://wotlk.openwow.com/item={$items[$i]['id']}" target="_blank">
            <img src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['id']}" class="item q{$items[$i]['rarity']}" />
        </a>
        {else}
         <img src="img/slots/{$items[$i]['slotId']}.png" />
        {/if}
    </td>
    <td>
    <div>
        <div class="item-name">
        {if isset($items[$i]['name'])}
        <span class="q{$items[$i]['rarity']}">
            <a class="q{$items[$i]['rarity']}" href="#" rel="tooltip" data-placement='right' data-html='true' data-original-title="{$items[$i]['tooltip']}">
                {$items[$i]['name']}
            </a>
        </span>
        </div>
        {/if}
    </div>
    <div class="item-under-name">
        {if isset($items[$i]['level'])}
        <span class="ilvl">{$items[$i]['level']}</span>&nbsp;
        {/if}
        {if $items[$i]['permanentEnchantItemId'] != 0}
        <a href="http://wotlk.openwow.com/item={$items[$i]['permanentEnchantItemId']}"><img class="enchant" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['permanentEnchantItemId']}" /></a>
        {/if}
        {if isset($items[$i]['permanentEnchantSpellId'])}
        <a href="http://wotlk.openwow.com/spell={$items[$i]['permanentEnchantSpellId']}"><img class="enchant" src="http://www.linuxlounge.net/~martin/wowimages/?spell={$items[$i]['permanentEnchantSpellId']}" /></a>
        {/if}
        {foreach from=$items[$i].gems item=gem}
        <div class="socket socket{$gem['socketColor']}">{if isset($gem['id'])}<a style="padding:0;margin:0;" href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img class="gem" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{else}<img class="gem" src="img/sockets/{$gem['socketColor']}.gif" />{/if}</div>
        {/foreach}
    </div>
    </td>
    <td align="right">
    <div>
        <div class="item-name">
        {if isset($items[$i+8]['name'])}
        <span class="q{$items[$i+8]['rarity']}">
            <a class="q{$items[$i+8]['rarity']}" href="#" rel="tooltip" data-placement='right' data-html='true' data-original-title="{$items[$i+8]['tooltip']}">
                {$items[$i+8]['name']}
            </a>
        </span>
        </div>
        {/if}
    </div>
    <div class="item-under-name">
        {if $items[$i+8]['permanentEnchantItemId'] != 0}
        <a href="http://wotlk.openwow.com/item={$items[$i+8]['permanentEnchantItemId']}"><img class="enchant" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i+8]['permanentEnchantItemId']}" /></a>
        {/if}
        {if isset($items[$i+8]['permanentEnchantSpellId'])}
        <a href="http://wotlk.openwow.com/spell={$items[$i+8]['permanentEnchantSpellId']}"><img class="enchant" src="http://www.linuxlounge.net/~martin/wowimages/?spell={$items[$i+8]['permanentEnchantSpellId']}" /></a>
        {/if}
        {foreach from=$items[$i+8].gems item=gem}
        <div class="socket socket{$gem['socketColor']}">{if isset($gem['id'])}<a style="padding:0;margin:0;" href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img class="gem" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{else}<img class="gem" src="img/sockets/{$gem['socketColor']}.gif" />{/if}</div>
        {/foreach}
        {if isset($items[$i+8]['level'])}
        <span class="ilvl">{$items[$i+8]['level']}</span>&nbsp;
        {/if}
    </div>

    </td>
    <td style="text-align:center;vertical-align:middle;">
        {if isset($items[$i+8]['id'])}
        <a href="http://wotlk.openwow.com/item={$items[$i+8]['id']}" target="_blank">
            <img src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i+8]['id']}" class="item q{$items[$i+8]['rarity']}" />
        </a>
        {else}
        <img src="img/slots/{$items[$i+8]['slotId']}.png" />
        {/if}
    </td>
  </tr>
{/for}
{for $i=16 to 18}
    <tr>
        <td style="text-align:center;vertical-align:middle;">
        {if isset($items[$i]['id'])}
        <a href="http://wotlk.openwow.com/item={$items[$i]['id']}" target="_blank">
            <img src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['id']}" class="item q{$items[$i]['rarity']}" />
        </a>
        {else}
        <img src="img/slots/{$items[$i]['slotId']}.png" />
        {/if}
    </td>
    <td colspan="3">
    <div>
        <div class="item-name">
        {if isset($items[$i]['name'])}
        <span class="q{$items[$i]['rarity']}">
            <a class="q{$items[$i]['rarity']}" href="#" rel="tooltip" data-placement='right' data-html='true' data-original-title="{$items[$i]['tooltip']}">
                {$items[$i]['name']}
            </a>
        </span>
        </div>
        {/if}
    </div>
    <div class="item-under-name">
        {if isset($items[$i]['level'])}
        <span class="ilvl">{$items[$i]['level']}</span>&nbsp;
        {/if}
        {if $items[$i]['permanentEnchantItemId'] != 0}
        <a href="http://wotlk.openwow.com/item={$items[$i]['permanentEnchantItemId']}"><img class="enchant" src="http://www.linuxlounge.net/~martin/wowimages/?item={$items[$i]['permanentEnchantItemId']}" /></a>
        {/if}
        {if isset($items[$i]['permanentEnchantSpellId'])}
        <a href="http://wotlk.openwow.com/spell={$items[$i]['permanentEnchantSpellId']}"><img class="enchant" src="http://www.linuxlounge.net/~martin/wowimages/?spell={$items[$i]['permanentEnchantSpellId']}" /></a>
        {/if}
        {foreach from=$items[$i].gems item=gem}
        <div class="socket socket{$gem['socketColor']}">{if isset($gem['id'])}<a style="padding:0;margin:0;" href="http://wotlk.openwow.com/item={$gem['id']}" rel="item={$gem['id']}"><img class="gem" src="http://www.linuxlounge.net/~martin/wowimages/?item={$gem['id']}" /></a>{else}<img class="gem" src="img/sockets/{$gem['socketColor']}.gif" />{/if}</div>
        {/foreach}
    </div>
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
<h3>Berufe</h3>
{foreach from=$skills key=key item=skill}
{$_skill_name[$key]} => {if isset($skill['guessed']) && $skill['guessed']}<strong>~</strong>{/if}{$skill['val']}/{$skill['max']}<br />
{/foreach}
<h3>PvP</h3>
</div>



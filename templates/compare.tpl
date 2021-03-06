{if !isset($data)}
<form method="get">
    <fieldset>
        <legend>Legend</legend>
        <label>Charnames:</label>
        <input type="text" name="cns" placeholder="Charname..">
        <span class="help-block">
            Charnamen mit Leerzeichen trennen <br />
            <b>Beispiel:</b><br />
            <code>Char1 char2 char3 char4</code>
        </span>
        <label class="checkbox">
            <input type="checkbox"> Force load (TODO)
        </label>
        <button type="submit" class="btn">Submit</button>
    </fieldset>
</form>
{else}
<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
{foreach from=$data['name'] key=i item=name}
            <th>Char{$i}</th>
{/foreach}
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Name</td>
{foreach from=$data['name'] item=name}
            <td><a href="profile.php?cn={$name}">{$name}</a></td>
{/foreach}
        </tr>
        <tr>
            <td>Klasse/Skillung</td>
{foreach from=$data['talent'] key=id item=spec}
            <td>
                <div style="min-width:80px;">
                    <img src="./img/classes/{$data['classId'][$id]}_b.png" height="35" width="35" />
                    <img src="http://armory.wow-castle.de/wow-icons/_images/43x43/{$spec['icon']}.png" height="35" width="35" />
                </div>
                 {$spec['1']}/{$spec['2']}/{$spec['3']}
            </td>
{/foreach}
        </tr>
        <tr>
            <td>Glyphs</td>
{foreach from=$data['talent'] key=id item=char_talent}
            <td>
{foreach from=$char_talent['glyphs']['major'] key=id item=glyph}
                {$glyph['name']}
                <br />
{/foreach}
                 <br />
{foreach from=$char_talent['glyphs']['minor'] key=id item=glyph}
                {$glyph['name']}
                 <br />
{/foreach}
            </td>
{/foreach}
        </tr>
        <tr>
            <td>Avg</td>
{foreach from=$data['avgItemLevel'] item=avg}
            <td>{$avg}</td>
{/foreach}
        </tr> 
        <tr>
            <td colspan="{$count+1}">Gems</td>
        </tr>

{foreach from=$data['gem'] key=id item=gem}
        <tr>
            <td>
                <a href="http://wotlk.openwow.com/item={$id}">
                    <img width="20" height="20" src="http://www.linuxlounge.net/~martin/wowimages/?item={$id}" />
                    {$gem['name']}
                </a>
            </td>
{foreach from=$gem['count']  item=value}
            <td>{$value['absolute']}</td>
{/foreach}
        </tr>
{/foreach}
        <tr>
            <td colspan="{$count+1}">Stats</td> {* TODO *}
        </tr> 
{foreach from=$data['stats'] key=id item=stat}
        <tr>
            <td>{$_stat_name[$id]}</td>
{foreach from=$stat item=value}
{if $value['relativ'] == 100}    
           <td style="background-color:#F78181">
{/if}
{if $value['relativ'] >= 80 AND $value['relativ'] < 100}    
            <td style="background-color:#2EFE9A">
{/if}
{if $value['relativ'] >= 0 AND $value['relativ'] < 80}    
            <td style="background-color:">
{/if}
                {$value['absolute']}
            </td>
{/foreach}
        </tr>
{/foreach}
        <tr>
            <td>Schmuck</td>
{foreach from=$data['trinkets'] key=i item=char}
            <td>
                <a href="http://wotlk.openwow.com/item={$char['13']['id']}">
                    <img width="30" height="30" src="http://www.linuxlounge.net/~martin/wowimages/?item={$char['13']['id']}" />
                </a>
                <a href="http://wotlk.openwow.com/item={$char['14']['id']}">
                    <img width="30" height="30" src="http://www.linuxlounge.net/~martin/wowimages/?item={$char['14']['id']}" />
                </a>
            </td>
{/foreach}
        </tr> 
        <tr>
            <th colspan="{$count+1}">Berufe</th>
        </tr>
{foreach from=$data['professions'] key=profession item=player}
        <tr>
            <td>
                <img src="img/professions/{$profession}.jpg" width="24" height="24">&nbsp;<a href="http://de.wowhead.com/skill={$profession}">
               {$_skill_name[$profession]}
            </td>
{foreach from=$player item=status}
{if is_array($status)}
            <td>{if isset($status['guessed']) && $status['guessed']}<strong>~</strong>{/if}{$status['val']} / {$status['max']}</td>
{else}
            <td>-</td>
{/if}
{/foreach}
        </tr>
{/foreach}
    <tbody>
</table>  
{/if} {*!isset($char)*}
  

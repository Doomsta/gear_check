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
    <td><a href="test.php?cn={$name}">{$name}</a></td>
{/foreach}
  </tr>
  <tr>
    <td>Spec</td>
{foreach from=$data['talent'] item=spec}
    <td>{$spec['name']}</td>
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
  <tbody>
</table>  
  

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
    <td>{$name}</td>
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
{foreach from=$gem['count'] item=value}
    <td>{$value}</td>
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
    <td>{$value}</td>
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
  

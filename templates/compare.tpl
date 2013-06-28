<table border="1">
  <tr>
    <th></th>
    <th>Char1</th>
    <th>Char2</th>
  </tr>
  <tr>
  <th>Name</th>
    <td>{$char1['char']['name']}</td>
    <td>{$char2['char']['name']}</td>
  </tr>
  <tr>  
    <td colspan="3">Gems</td>
  </tr>
{foreach from=$char1['gems'] key=gemid item=count}
  <tr>
    <td>
    {$gemid}
    </td>
    <td>
{if !isset($char1['gems'][$gemid])}
0
{else}
{$char1['gems'][$gemid]}
{/if}  
    </td>
    <td>
{if !isset($char2['gems'][$gemid])}
0
{else}
{$char2['gems'][$gemid]}
{/if}  
    </td>
  </tr>
{/foreach}
  <tr>
  <td colspan="3">Gear Stats</td>
  </tr>
{foreach from=$char1['eqstats'] key=statid item=value}
{if ($char1['eqstats'][$statid] == 0 AND $char2['eqstats'][$statid] == 0)} 
{continue}
{/if}
  <tr>
  <td>{$_stat_name[$statid]}</td>
    <td>
    {$char1['eqstats'][$statid]}
    </td>
    <td>  
    {$char2['eqstats'][$statid]}
    </td>
  </tr>
{/foreach}        
</table>
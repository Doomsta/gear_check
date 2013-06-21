<?php

class tooltips
{
    private $tooltip_js = '$(\'a\').tooltip({placement: \'right\'}).tooltip();';
    
    function __construct($tpl, $js=true) 
    {
        if($js=true)
            $tpl->add_script($this->tooltip_js);
    }
    
    //TODO sets, gems
    function get_item_tooltip($item)
    {
        global $_item_class, $_inventory_type, $_stat_name, $_spell_desc;
        if(!isset($item['id']))
            return;
        $tpl = $this->get_item_template($item['id']);

        // Item Name
        $tmp = '<div><table width=\'450\'><tr><td><b class=\'q4\'>'.$item['name'].'</b><br />';

        // Heroic?
        if ($tpl['Flags'] & 8)
            $tmp .= '<span class=\'q2\'>Heroisch</span><br />';

        // Item Binding
	$tmp .='<span style=\'color: #ffffff\'>Beim Aufheben gebunden</span>';

        $tmp .='<table width=\'100%\'><tr style=\'color: #ffffff;\'>';

    	// Item Classification
        $item_class = $_item_class[$tpl['class']][$tpl['subclass']];
        $inventory_type = $_inventory_type[$tpl['InventoryType']];

        $tmp .='<td>'.$inventory_type.'</td><td style=\'text-align:right;\'>'.$item_class[1].'</td>'; //TODO

        $tmp .='</tr></table><table width=\'100%\'>'; //TODO
        if(isset($item['weaponDmg']))
            $tmp .='<tr><td><span>207 - 312 Damage</span></td><th>Speed 3.20</th></tr>(81.1 damage per second)<br />'; //TODO
        $tmp .='</table>';

        // White Stats (Base Stats)
        foreach ($item['stats'] as $key => $value)
		{
			if ($key < ItemStats::ITEM_MOD_AGILITY OR $key > ItemStats::ITEM_MOD_STAMINA)
				continue;
			$tmp .= '<span class=\'q1\'>+'.$value.' '.$_stat_name[$key].'</span><br />';
		}

        // Gems
		foreach($item['gems'] as $gem)
		{
			if(!isset($gem['socketColor']))
	            break;
	        switch ($gem['socketColor']) {
	            case 1: //meta
	                $tmp .='<a class=\'socket-meta q0\'>Meta Socket</a>';
	                break;
	            case 2: //red
	                $tmp .='<a class=\'socket-red q0\'>Red Socket</a>';
	                break;
	            case 4: //yellow
	                $tmp .='<a class=\'socket-yellow q0\'>Yellow Socket</a>';
	                break;
	            case 8: //blue
	                $tmp .='<a class=\'socket-blue q0\'>Blue Socket</a>';
	                break;
	        }
	        $tmp .= '<br />';
		}
		if($item['socketBonus'] != 0)
		{
			if ($item['socketBonusActive'])
                $tmp .= '<span class=\'q2\'>Socket Bonus: +'.$item['socketBonus'].'</span><br />';
			else
	            $tmp .= '<span class=\'q0\'>Socket Bonus: +'.$item['socketBonus'].'</span><br />';
		}

	// Durability (TODO)

	// Level Requirement (TODO)
	if ($tpl['RequiredLevel'] > 0)
		$tmp .= '<span style=\'color: #ffffff\'>Ben&ouml;tigt Level '.$tpl['RequiredLevel'].'</span><br />';

        // Item Level
        $tmp .= '<span style=\'color: #ffffff\'>Gegenstandsstufe '.$item['level'].'</span><br />';        

        // Green Stats (Secondary Stats)
        foreach($item['stats'] as $key => $value)
	{
            if ($key <= ItemStats::ITEM_MOD_STAMINA)
	        continue;
            if ($key == ItemStats::ITEM_MOD_MANA_REGENERATION)
		$tmp .= '<span class=\'q2\'>Anlege: Stellt alle 5 Sek. '.$value.' Mana wieder her</span><br />';
            else
                $tmp .= '<span  class=\'q2\'>Anlegen: Erh&ouml;ht '.$_stat_name[$key].' um '.$value.'</span><br />';   
	}

	// Item Effects (Use, Proc)
	if ($tpl['spellid_1'] > 0)
	{
		if (!isset($_spell_desc[$tpl['spellid_1']]))
			echo "Missing Spell Description ".$tpl['spellid_1']."<br />";
		$tmp .= '<span class=\'q2\'>Anlegen: '.$_spell_desc[$tpl['spellid_1']].'</span><br />';
	}

        $tmp .='       </td>
            </tr>
        </table></div>';
        return($tmp);
    }

    function get_item_template($item_id)
    {
        $query = "SELECT * FROM item_template WHERE entry = ".$item_id;

        $result = mysql_query($query) or die(mysql_error());
        if (mysql_num_rows($result) == 0)
            return false;

        return mysql_fetch_assoc($result);        


    }

}
?>

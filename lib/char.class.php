<?php

if (!defined('PROVIDER'))
    die("Error: No Provider loaded".PHP_EOL);

class char
{
    private $name, $prefix, $suffix, $race, $class, $guild, $level, $achievement_points;
    private $equipment = array();
    private $stats = array();
    private $talents = array();
    private $arena = array();
    private $professions = array();

    private $slotOrder = array(1, 2, 3, 15, 5, 4, 19, 9, 10, 6, 7, 8, 11, 12, 13, 14, 16, 17, 18);

    public function __construct($name)
    {
        $this->name = $name;
        $this->prefix = null;
        $this->suffix = null;
        foreach($this->slotOrder as $value)
        $this->equipment[$value] = array(
            'id' => null, 
            'flags' => 0,
            'name' => null, 
            'slotId' => $value,
            'level' => null, 
            'rarity' => null, 
            'stats' => array(),
            'icon' => 'inv_empty', 
            'gems' => array(), 
            'permanentEnchantItemId' => null, 
            'permanentEnchantSpellName' => null, 
            'permanentEnchantSpellId'  => null,
            'tooltip' => null
        );
        global $_stat_name;
        foreach($_stat_name as $key => $value)
            $this->stats[$value] = 0;
    }
	public function load()
	{
		if(!$this->fetch(TRUE))
			return false;
		$this->loadItems();
		$this->equipment = Provider::checkGemBonus($this->equipment); // TODO: these should be generic and not provider dependant!
		$this->equipment = Provider::lookupGemBonuses($this->equipment);
		return true;
	}
	
    public function fetch($ExecuteQuirksHandler = FALSE)
    {
        $tmp = Provider::fetchCharacterData($this->name);
        if ($tmp === false)
            return false;
        if ($ExecuteQuirksHandler)
            $tmp = Provider::HandleQuirks($tmp);
        
        $this->name = $tmp['name'];
        $this->prefix= $tmp['prefix'];
        $this->suffix = $tmp['suffix'];
        $this->talents = $tmp['talents'];
        $this->race= $tmp['raceId'];
        $this->class = $tmp['classId'];
        $this->gender = $tmp['genderId'];
        $this->guild = $tmp['guildName'];
        $this->level = $tmp['level'];
        $this->achievement_points = $tmp['points'];
        $this->professions  = $tmp['professions'];
        //$this->arena = $tmp['arena'];
        $this->stats = $tmp['stats'];
        foreach($tmp['items'] as $key => $value)
            if(isset($this->equipment[$key]))
            {
                $result = mysql_query("SELECT flags FROM ".MYSQL_DATABASE_TDB.".item_template WHERE entry = ".$tmp['items'][$key]['id']."") or die(mysql_error());
                $row = mysql_fetch_assoc($result);
                $this->equipment[$key] = $tmp['items'][$key];
                $this->equipment[$key]['flags'] = $row['flags'];

            }
        return true;
    }

    public function loadItems()
    {
        foreach($this->slotOrder as $i)
        {
            $this->equipment[$i]['stats'] = get_item_stats($this->equipment[$i]['id']);
            $this->equipment[$i] = add_item_gems($this->equipment[$i]);
        }
        return true;
    }

    public function addItemTooltips(&$tooltip)
    {
        $itemlist = array();
        foreach($this->slotOrder as $i)
            $itemlist[$i] = $this->equipment[$i]['id'];
        foreach($this->slotOrder as $i)
            $this->equipment[$i]['tooltip'] = $tooltip->get_item_tooltip($this->equipment[$i], $itemlist);
    }

    public function getTalents()
    {
        return $this->talents;
    }
    
    public function getActiveTalent()
    {
        return $this->talents['active'];
    }

    public function getEquipmentStats()
    {
        global $_stat_name;
        foreach($_stat_name as $key => $value)
            $tmp[$key] = 0;
        foreach($this->equipment as $item)
            foreach($item['stats'] as $key => $value)
            {
                if(!isset($tmp[$key]))
                    $tmp[$key] = 0;
                $tmp[$key] += $value;
            }
        ksort($tmp);
        return $tmp;
    }

    public function getSockets()
    {
        $tmp = array();
        foreach($this->equipment as $item)
            foreach($item['gems'] as $gem)
                if(isset($gem['id'])) //TODO handle empty slots better
                    if(isset($tmp[$gem['id']]))
                        $tmp[$gem['id']]['count'] += 1;
                    else
                        $tmp[$gem['id']] = array('count' => 1);
        foreach($tmp as $i => $gems)
        {
            $c = $tmp[$i]['count']; 
            $tmp[$i] = get_gems_stats($i);
            $tmp[$i]['count'] = $c; 
        }
        //uasort($tmp, "cmp");  //need to handle errors       
        return $tmp;
    }

    public function getEnchants()
    {
        $tmp = array();
        foreach($this->equipment as $item)
        {
            if (isset($item['permanentEnchantItemId']) && $item['permanentEnchantItemId'] > 0)
                $stats = get_enchant_stats($item['permanentEnchantItemId'], 'item');
            elseif (isset($item['permanentEnchantSpellId']) && $item['permanentEnchantSpellId'] > 0)
                $stats = get_enchant_stats($item['permanentEnchantSpellId'], 'spell');
            else $stats = false;

            if ($stats)
                $tmp[] = $stats;
        }
        return $tmp;
    }

    public function getStats($base = TRUE, $items = TRUE, $gems = TRUE)
    { 
        $stats = array();
        global $_stat_name;
        //init whole array
        foreach($_stat_name as $key => $value)
            $stats[$key] = 0;
        //add base stats 
        if($baseStats = $this->getClassBaseStats())
            foreach($baseStats as $statId => $statValue)
                $stats[$statId] += $statValue;
        //add class stats
        if($classStats = $this->getClassLevelStats())
            foreach($classStats as $statId => $statValue)
                $stats[$statId] += $statValue;
        //add gear stats
        $eqstats = $this->getEquipmentStats();
        foreach($eqstats  as $key => $eqstat)
            $stats[$key] += $eqstat;
            
        //add gems
        $gems = $this->getSockets();
        foreach($gems as $gem)
        {
            if(!isset($gem['stat_type1']) OR !isset($gem['stat_type2']))
                continue;
            $stats[$gem['stat_type1']] += ($gem['stat_value1']*$gem['count']);  
            $stats[$gem['stat_type2']] += ($gem['stat_value2']*$gem['count']);
        }
        //add socket boni
        foreach($this->equipment as $item)
            if(isset($item['socketBonus']['stat_value1']) AND isset($item['socketBonusActive']) AND $item['socketBonusActive'] == 1)
                $stats[$item['socketBonus']['stat_type1']]  += $item['socketBonus']['stat_value1'];

        //add enchants
        $enchants = $this->getEnchants();
        foreach ($enchants as $enchant)
            for ($i = 1; $i <= 5; $i++)
                $stats[$enchant['stat'.$i.'_type']] += $enchant['stat'.$i.'_value'];

        // final calculations
        $stats = $this->DeriveStats($stats);

        //clean up array 
        foreach($stats  as $key => $value)
        {
            if($value == 0)
                unset($stats[$key]);
        }
        return $stats;
    }

    public function getAvgItemLevel()
    {
        $tmp = 0;
        foreach($this->equipment as $slot =>$item )
        {
            if($slot == 4 OR $slot == 19)
                continue;
             $tmp += $item['level'];
        }
        if(isset($this->equipment[16]['name']) AND isset($this->equipment[17]['name']))
            $tmp = round(($tmp/17),1); 
        else
            $tmp = round(($tmp/16),1); 
        return $tmp;
    }

    public function getCharArray()
    {
        $tmp['name'] = $this->name;
        $tmp['suffix'] = $this->suffix;
        $tmp['prefix'] = $this->prefix;
        $tmp['raceId'] = $this->race;
        $tmp['classId'] = $this->class;
        $tmp['genderId'] = $this->gender;
        $tmp['level'] = $this->level;
        $tmp['guild'] = $this->guild;
        return $tmp;
    }

    public function getClassLevelStats()
    {
        if(!isset($this->level) OR !isset($this->class))
            return false;
        if($this->level == 0)
            return array();
        $query = 'SELECT `str`, `agi`, `sta`, `inte`, `spi` 
            FROM `'. MYSQL_DATABASE_TDB .'`.`player_levelstats` 
            WHERE `race` = '.$this->race.' AND `class` = '.$this->class. ' AND level = '.$this->level.'';
        $result = mysql_query($query);
        $tmp = array();
        $row = mysql_fetch_assoc($result);
        $tmp[ItemStats::ITEM_MOD_STRENGTH] = $row['str'];
        $tmp[ItemStats::ITEM_MOD_AGILITY] = $row['agi'];
        $tmp[ItemStats::ITEM_MOD_STAMINA] = $row['sta'];
        $tmp[ItemStats::ITEM_MOD_INTELLECT] = $row['inte'];
        $tmp[ItemStats::ITEM_MOD_SPIRIT] = $row['spi'];

        return $tmp;    
    }

    public function getClassBaseStats()
    {
        if(!isset($this->race))
            return false;
        $query = 'SELECT `basehp`, `basemana`
            FROM `'. MYSQL_DATABASE_TDB .'`.`player_classlevelstats` 
            WHERE `class` = '.$this->class. ' AND `level` = '.$this->level.'';
        $result = mysql_query($query);
        $tmp = array();
        $row = mysql_fetch_assoc($result);
        $tmp[ItemStats::ITEM_MOD_MANA] = $row['basemana'];
        $tmp[ItemStats::ITEM_MOD_HEALTH] = $row['basehp'];
        return $tmp;
    }

    // this function needs to be called last, because all calculations scale with talents, enchants, etc.
    public function DeriveStats($stats)
    {
        // Armor from Agility
        $stats[ItemStats::ITEM_MOD_ARMOR] += $stats[ItemStats::ITEM_MOD_AGILITY] * 2;
        // Health from Stamina
        $stats[ItemStats::ITEM_MOD_HEALTH] += 20 + (max($stats[ItemStats::ITEM_MOD_STAMINA] - 20, 0)) * 10;
        // Mana from Intellect
        $stats[ItemStats::ITEM_MOD_MANA] += 20 + (max($stats[ItemStats::ITEM_MOD_INTELLECT] - 20, 0)) * 15;
        return $stats;
    }

    //debug
    public function getItems($slots = false)
    {
        if($slots === false)
            foreach($this->equipment as $i => $gear)
                    $tmp[] = $gear;
        else
             foreach($slots as $i => $item)
                $tmp[$item] = $this->equipment[$item];
        return $tmp;
    }

    public function getProfessions()
    {
        return $this->professions;
    }
}
?>

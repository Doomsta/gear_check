<?php
class char
{
    private $name, $prefix, $suffix, $race, $class, $guild, $level, $achievement_points;
    private $equipment = array();
    private $stats = array();
    private $talents = array();
    private $arena = array();
    
    private $slotOrder = array(1, 2, 3, 15, 5, 4, 19, 9, 10, 6, 7, 8, 11, 12, 13, 14, 16, 17, 18);
    
    public function __construct($name, $loadFromCastle = FALSE)
    {
        $this->name = $name;
        $this->prefix = null;
        $this->suffix = null;
        foreach($this->slotOrder as $value)
            $this->equipment[$value] = array(
                                                        'id' => null, 
                                                        'name' => null, 
                                                        'level' => null, 
                                                        'rarity' => null, 
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
        if($loadFromCastle == TRUE)
           $this->loadFromCastle(TRUE);
        $this->loadItems();
        $this->equipment = castleImport::checkGemBonus($this->equipment);
        $this->equipment = castleImport::lookupGemBonuses($this->equipment);
    }

    public function loadFromCastle($HandleArmoryQuirks = FALSE)
    {
        $tmp = castleImport::getChar($this->name);
        if($tmp === false)
            return false;
        if($HandleArmoryQuirks == TRUE)
            $tmp = castleImport::HandleArmoryQuirks($tmp);
        
        $this->name = $tmp['name'];
        $this->prefix= $tmp['prefix'];
        $this->suffix = $tmp['suffix'];
        $this->talents = $tmp['talents'];
        $this->race= $tmp['raceId'];
        $this->class = $tmp['classId'];
        $this->guild = $tmp['guildName'];
        $this->level = $tmp['level'];
        $this->achievement_points = $tmp['points'];
        //$this->arena = $tmp['arena'];
        $this->stats = $tmp['stats'];
        foreach($tmp['items'] as $key => $value)
            if(isset($this->equipment[$key]))
                $this->equipment[$key] = $tmp['items'][$key];
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
         foreach($this->slotOrder as $i)
            $this->equipment[$i]['tooltip'] = $tooltip->get_item_tooltip($this->equipment[$i]);
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
    
    public function getSockts()
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
        uasort($tmp, "cmp");        
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
        $baseStats = $this->getRaceBaseStats();
        foreach($baseStats as $statId => $statValue)
            $stats[$statId] += $statValue;
        //add class stats
        $classStats = $this->getClassStats();
        foreach($classStats as $statId => $statValue)
            $stats[$statId] += $statValue;
        //add gear stats
        $eqstats = $this->getEquipmentStats();
        foreach($eqstats  as $key => $eqstat)
            $stats[$key] += $eqstat;
            
        //add gems
        $gems = $this->getSockts();
        foreach($gems as $gem)
        {
                $stats[$gem['stat_type1']] += ($gem['stat_value1']*$gem['count']);  
                $stats[$gem['stat_type2']] += ($gem['stat_value2']*$gem['count']);
        }
        //add socket boni
        foreach($this->equipment as $item)
            if(isset($item['socketBonus']['stat_value1']) AND isset($item['socketBonusActive']) AND $item['socketBonusActive'] == 1)
                $stats[$item['socketBonus']['stat_type1']]  += $item['socketBonus']['stat_value1'];
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
    public function getGetGearStats()
    {
    
    }
    
    public function getCharArray()
    {
        $tmp['name'] = $this->name;
        $tmp['suffix'] = $this->suffix;
        $tmp['prefix'] = $this->prefix;
        $tmp['raceId'] = $this->race;
        $tmp['classId'] = $this->class;
        $tmp['level'] = $this->level;
        $tmp['guild'] = $this->guild;
        return $tmp;
    }
    
    public function getClassStats()
    {
        if(!isset($this->level) OR !isset($this->class))
            return false;
        if($this->level == 0)
            return array();

       $query = 'SELECT `stat_value`, `stat_type` 
                        FROM `'. MYSQL_DATABASE .'`.`class_attribute_effects` 
                        WHERE `class` = "'.$this->class. '"';
        $result = mysql_query($query);
        while($row = mysql_fetch_assoc($result))
            $tmp[$row['stat_type']] = $row['stat_value']*$this->level;
        return $tmp;    
    }
    
    public function getRaceBaseStats()
    {
        if(!isset($this->race))
            return false;
        $query = 'SELECT `stat_value`, `stat_type` 
                        FROM `'. MYSQL_DATABASE .'`.`race_base_stats` 
                        WHERE `race` = "'.$this->race. '"';
        $result = mysql_query($query);
        while($row = mysql_fetch_assoc($result))
            $tmp[$row['stat_type']] = $row['stat_value'];
        return $tmp;
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
}
?>
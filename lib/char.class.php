<?php
class char
{
    private $name, $prefix, $suffix, $race, $class, $guild, $level, $achievement_points;
    private $equipment = array();
    private $stats = array();
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
                                                        'icon' => null, 
                                                        'gems' => null, 
                                                        'permanentEnchantItemId' => null, 
                                                        'permanentEnchantSpellName' => null, 
                                                        'permanentEnchantSpellId'  => null,
                                                        'tooltip' => null
                                                   );
        if($loadFromCastle == TRUE)
        {
            $this->loadFromCastle();
        }
            
    }
    public function loadFromCastle()
    {
        $tmp = castleImport::getChar($this->name);
        $tmp = castleImport::HandleArmoryQuirks($tmp);
        
        $this->name = $tmp['name'];
        $this->prefix= $tmp['prefix'];
        $this->suffix = $tmp['suffix'];
        $this->race= $tmp['raceId'];
        $this->class = $tmp['classId'];
        $this->guild = $tmp['guildName'];
        $this->level = $tmp['level'];
        $this->achievement_points = $tmp['points'];
        $this->arena = $tmp['arena'];
        $this->stats = $tmp['stats'];
        foreach($tmp['items'] as $key => $value)
            if(isset($this->equipment[$key]))
                $this->equipment[$key] = $tmp['items'][$key];
    }
    public function loadItems($slotNR = False)
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
    public function getStats()
    {
    }
    public function getSockts()
    {
    }
    public function getSocketStats()
    {
    }
    public function getGetGearStats()
    {
    }
    
    //debug
    public function getItems()
    {
        return $this->equipment;
    }
}
?>
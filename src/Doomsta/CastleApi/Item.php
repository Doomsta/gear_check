<?php

namespace Doomsta\CastleApi;


use SimpleXMLElement;

class Item
{
    /**
     * @var \SimpleXMLElement
     */
    private $xml;

    private $enchantNameToSpell = array(
        'Sanctified Spellthread' => 56039,
        'Master\'s Spellthread' => 56034,
        'Lightweave Embroidery' => 55642,
        'Darkglow Embroidery' => 55769,
        'Swordguard Embroidery' => 55777,
        'Hyperspeed Accelerators' => 54999,
        'Hand-Mounted Pyro Rocket' => 54998,
        'Frag Belt' => 54793,
        'Nitro Boosts' => 55016,
        'Reticulated Armor Webbing' => 63770,
        'Flexweave Underlay' => 55002,
        'Springy Arachnoweave' => 63765,
        'Personal Electromagnetic Pulse Generator' => 54736,
        'Nerubian Leg Reinforcements' => 60584,
        'Jormungar Leg Reinforcements' => 60583,
        'Fur Lining - Attack Power' => 57683,
        'Fur Lining - Stamina' => 57690,
        'Fur Lining - Spell Power' => 57691,
        'Fur Lining - Fire Resist' => 57692,
        'Fur Lining - Frost Resist' => 57694,
        'Fur Lining - Shadow Resist' => 57696,
        'Fur Lining - Nature Resist' => 57699,
        'Fur Lining - Arcane Resist' => 57701,
        'Master\'s Inscription of the Axe' => 61117,
        'Master\'s Inscription of the Crag' => 61118,
        'Master\'s Inscription of the Pinnacle' => 61119,
        'Master\'s Inscription of the Storm' => 61120,
        'Enchant Ring - Greater Spellpower' => 44636,
        'Enchant Ring - Assault' => 44645,
        'Enchant Ring - Stamina' => 59636,
        'Rune of Razorice' => 53343,
        'Rune of Cinderglacier' => 53341,
        'Rune of the Fallen Crusader' => 53344,
        'Rune of the Stoneskin Gargoyle' => 62158
    );


    public function __construct(SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    public function getId()
    {
        return (int)$this->xml['id'];
    }

    public function getName()
    {
        return (string)$this->xml['name'];
    }

    public function getLevel()
    {
        return (int)$this->xml['level'];
    }

    public function getEnchantItemId()
    {
        return (int) $this->xml['permanentEnchantItemId'];
    }

    public function getEnchantSpellId()
    {
        if (!isset($this->xml['permanentEnchantSpellName'])){
            return false;
        }
        return $this->enchantNameToSpell[(string)$this->xml['permanentEnchantSpellName']];
    }

    public function getGemIds()
    {
        $result = array();
        for ($i = 0; ; $i++) {
            if (isset($this->xml['gem' . $i . 'Id'])) {
                $result[] = (int)$this->xml['gem' . $i . 'Id'];
            } else {
                break;
            }
        }
        return $result;
    }
} 
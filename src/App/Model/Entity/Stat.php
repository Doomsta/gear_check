<?php

namespace App\Model\Entity;

class Stat
{
    public static $statName = array(
        -1  => 'Rüstung', // custom
        0  => 'Mana',
        1  => 'Leben',
        3  => 'Beweglichkeit',
        4  => 'Stäke',
        5  => 'Intelligenz',
        6  => 'Willenskraft',
        7  => 'Ausdauer',
        12 => 'Verteidigungswertung',
        13 => 'Ausweichwertung',
        14 => 'Parierwertung',
        15 => 'Blockwertung',
        20 => 'Kritische Distanztrefferwertung',
        31 => 'Trefferwertung',
        32 => 'kritische Trefferwertung',
        35 => 'Abhärtungswertung',
        36 => 'Tempowertung',
        37 => 'Waffenkunde',
        38 => 'Angriffskraft',
        42 => '',
        43 => 'Mana alle 5 Sek.',
        45 => 'Zaubermacht',
        44 => 'Rüstungsdurchschlagwertung',
        46 => 'Leben alle 5 Sek.',
        47 => 'Zauberdurchschlag',
        48 => 'Blockwert eures Schildes'
    );
    
    const ARMOR = -1;
    const STATS = -2;
    const BASE_STATS_RELATIV = -3;
    const AGILITY_RELATIV = -4;
    const STRENGTH_RELATIV = -5;
    const INTELLECT_RELATIV = -6;
    const SPIRIT_RELATIV = -7;
    const STAMINA_RELATIV = -8;
    const ARMOR_RELATIV = -9;
    const MEELE_CRIT_PERCENT = -10;
    const CASTER_CRIT_PERCENT = -11;
    const HEAL_CRIT_PERCENT = -12;
    const CRIT_MOD = -13;
    #const STUN_DURATION = -14;
    #const SILENCE_DURATION = -15;

    //trinity stats
    const MANA = 0;
    const HEALTH = 1;
    const AGILITY = 3;
    const STRENGTH = 4;
    const INTELLECT = 5;
    const SPIRIT = 6;
    const STAMINA = 7;
    const DEFENSE_SKILL_RATING = 12;
    const DODGE_RATING = 13;
    const PARRY_RATING = 14;
    const BLOCK_RATING = 15;
    const HIT_MELEE_RATING = 16;
    const HIT_RANGED_RATING = 17;
    const HIT_SPELL_RATING = 18;
    const CRIT_MELEE_RATING = 29;
    const CRIT_RANGED_RATING = 20;
    const CRIT_SPELL_RATING = 21;
    const HIT_TAKEN_MELEE_RATING = 22;
    const HIT_TAKEN_RANGED_RATING = 23;
    const HIT_TAKEN_SPELL_RATING = 24;
    const CRIT_TAKEN_MELEE_RATING = 25;
    const CRIT_TAKEN_RANGED_RATING = 26;
    const CRIT_TAKEN_SPELL_RATING = 27;
    const HASTE_MELEE_RATING = 28;
    const HASTE_RANGED_RATING = 29;
    const HASTE_SPELL_RATING = 30;
    const HIT_RATING = 31;
    const CRIT_RATING = 32;
    const HIT_TAKEN_RATING = 33;
    const CRIT_TAKEN_RATING = 34;
    const RESILIENCE_RATING = 35;
    const HASTE_RATING = 36;
    const EXPERTISE_RATING = 37;
    const ATTACK_POWER = 38;
    const RANGED_ATTACK_POWER = 39;
    const FERAL_ATTACK_POWER = 40;
    const SPELL_HEALING_DONE = 41;
    const SPELL_DAMAGE_DONE = 42;
    const MANA_REGENERATION = 43;
    const ARMOR_PENETRATION_RATING = 44;
    const SPELL_POWER = 45;
    const HEALTH_REGEN = 46;
    const SPELL_PENETRATION = 47;
    const BLOCK_VALUE = 48;

    private $type;
    private $value;

    public function __construct($type, $value)
    {
        if (is_array($type)) {
            $type = $type[0];
        }
        if (!isset(self::$statName[(string)$type])) {
            $type = 0;
            $value = 0;
        }
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return self::$statName[$this->getType()];
    }

    public function merge(Stat $stat)
    {
        if($stat->getType() == $this->getType()) {
            $this->value += $stat->getValue();
            return true;
        }
        return false;
    }

    public function toArray()
    {
        $tmp = array();
        $tmp['name'] = $this->getName();
        $tmp['type'] = $this->getType();
        $tmp['value'] = $this->getValue();
        return $tmp;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}

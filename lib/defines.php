<?php

############################
# Races
############################

# race->id to race->name
# according to ChrRaces.dbc
$_race_name = array(
	1	=> "Mensch",
	2	=> "Ork",
	3	=> "Zwerg",
	4	=> "Nachtelf",
	5	=> "Untote",
	6	=> "Taure",
	7	=> "Gnom",
	8	=> "Troll",
	9	=> "Goblin",	# 4.x
	10	=> "Blutelf",
	11	=> "Draenei",
	22	=> "Worg");	# 4.x
unset($_race_name[9]);
unset($_race_name[22]);

$_race_faction = array(
	1	=> 0,
	2	=> 1,
	3	=> 0,
	4	=> 0,
	5	=> 1,
	6	=> 1,
	7	=> 0,
	8	=> 1,
	9	=> 1,
	10	=> 1,
	11	=> 0,
	22	=> 0);
unset($_race_faction[9]);
unset($_race_faction[22]);

###########################
# Classes
###########################

# class->id to class->name
# according to ChrClasses.dbc
$_class_name = array(
	1	=> "Warrior",
	2	=> "Paladin",
	3	=> "Hunter",
	4	=> "Rogue",
	5	=> "Priest",
	6	=> "Death Knight",
	7	=> "Shaman",
	8	=> "Mage",
	9	=> "Warlock",
	11	=> "Druid"
);
	
# class->id to class->color
$_class_color = array(
	1	=> '#C69B6D',	// warrior
	2	=> '#F48CBA',	// paladin
	3	=> '#AAD372',	// hunter
	4	=> '#FFF468',	// rogue
	5	=> '#FFFFFF',	// priest
	6	=> '#C41F3B',	// DK
	7	=> '#1a3caa',	// shaman
	8	=> '#68CCEF',	// mage
	9	=> '#9382C9',	// warlock
	11	=> '#FF7C0A'	// druid
);	

##########################
# Faction
##########################

# faction->id to faction->name
# self-defined, value derived from class
$_faction_name = array(
	0	=> "Allianz",
	1	=> "Horde"
);
	
# faction->id to faction->color
$_faction_color = array(
	0	=> "#0000FF",
	1	=> "#CC0000"
);

# socket->id to Color->name
# http://archive.trinitycore.info/Item_template_tc2#socketColor
$_socket_Color array(
	1 => 'Meta',
	2 => 'Red',
 	4 => 'Yellow',
	8 => 'Blue'
);

# stat->id to stat->typ
# http://collab.kpsn.org/display/tc/Item+template+tc2#Itemtemplatetc2-stat_type
$_stat_typ = array(
	0 => 'ITEM_MOD_MANA',
	1 => 'ITEM_MOD_HEALTH', 
	3 => 'ITEM_MOD_AGILITY',
	4 => 'ITEM_MOD_STRENGTH',
	5 => 'ITEM_MOD_INTELLECT',
	6 => 'ITEM_MOD_SPIRIT',
	7 => 'ITEM_MOD_STAMINA',
	12 => 'ITEM_MOD_DEFENSE_SKILL_RATING',
	13 => 'ITEM_MOD_DODGE_RATING',
	14 => 'ITEM_MOD_PARRY_RATING',
	15 => 'ITEM_MOD_BLOCK_RATING',
	16 => 'ITEM_MOD_HIT_MELEE_RATING',
	17 => 'ITEM_MOD_HIT_RANGED_RATING',
	18 => 'ITEM_MOD_HIT_SPELL_RATING',
	29 => 'ITEM_MOD_CRIT_MELEE_RATING',
	20 => 'ITEM_MOD_CRIT_RANGED_RATING',
	21 => 'ITEM_MOD_CRIT_SPELL_RATING',
	22 => 'ITEM_MOD_HIT_TAKEN_MELEE_RATING',
	23 => 'ITEM_MOD_HIT_TAKEN_RANGED_RATING',
	24 => 'ITEM_MOD_HIT_TAKEN_SPELL_RATING',
	25 => 'ITEM_MOD_CRIT_TAKEN_MELEE_RATING',
	26 => 'ITEM_MOD_CRIT_TAKEN_RANGED_RATING',
	27 => 'ITEM_MOD_CRIT_TAKEN_SPELL_RATING',
	28 => 'ITEM_MOD_HASTE_MELEE_RATING',
	29 => 'ITEM_MOD_HASTE_RANGED_RATING',
	30 => 'ITEM_MOD_HASTE_SPELL_RATING',
	31 => 'ITEM_MOD_HIT_RATING',
	32 => 'ITEM_MOD_CRIT_RATING',
	33 => 'ITEM_MOD_HIT_TAKEN_RATING',
	34 => 'ITEM_MOD_CRIT_TAKEN_RATING',
	35 => 'ITEM_MOD_RESILIENCE_RATING',
	36 => 'ITEM_MOD_HASTE_RATING',
	37 => 'ITEM_MOD_EXPERTISE_RATING',
	38 => 'ITEM_MOD_ATTACK_POWER',
	39 => 'ITEM_MOD_RANGED_ATTACK_POWER',
	40 => 'ITEM_MOD_FERAL_ATTACK_POWER',
	41 => 'ITEM_MOD_SPELL_HEALING_DONE',
	42 => 'ITEM_MOD_SPELL_DAMAGE_DONE',
	43 => 'ITEM_MOD_MANA_REGENERATION',
	44 => 'ITEM_MOD_ARMOR_PENETRATION_RATING',
	45 => 'ITEM_MOD_SPELL_POWER',
	46 => 'ITEM_MOD_ HEALTH_REGEN',
	47 => 'ITEM_MOD_SPELL_PENETRATION',
	48 => 'ITEM_MOD_BLOCK_VALUE'
);

?>

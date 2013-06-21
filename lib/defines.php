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
	5	=> "Untoter",
	6	=> "Tauren",
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
	1	=> "Krieger",
	2	=> "Paladin",
	3	=> "J&auml;ger",
	4	=> "Schurken",
	5	=> "Priester",
	6	=> "Todesritter",
	7	=> "Schamane",
	8	=> "Magier",
	9	=> "Hexenmeister",
	11	=> "Druide"
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

##########################
# Items
##########################

# socket->id to Color->name
# http://archive.trinitycore.info/Item_template_tc2#socketColor
class SocketColor {
	const Meta = 1;
	const Red = 2;
	const Orange = 3;
 	const Yellow = 4;
	const Green = 6;
	const Blue = 8;
	const Violet = 9;
}

# http://images3.wikia.nocookie.net/__cb20090410062624/wowwiki/images/a/ae/InventorySlots.jpg
$_gearSlot_name = array(
	1 => 'head', 
	2 => 'neck',
	3 => 'shoulder',
	15 => 'back',
	5 => 'chest',
	4 => 'shirt',
	19 => 'tabard',
	9 => 'wrist',
	
	10 => 'hands',
	6 => 'waist', //belt
	7 => 'legs',
	8 => 'feet',
	11 => 'finger1',
	12 => 'finger2',
	13 => 'trinket1',
	14 => 'trinket2',
			
	16 => 'mainHand',
	17 => 'offHand',
	18 => 'relic'
);

# stat->type to stat->id
# http://collab.kpsn.org/display/tc/Item+template+tc2#Itemtemplatetc2-stat_type
class ItemStats {
    const ITEM_MOD_MANA = 0;
    const ITEM_MOD_HEALTH = 1;
    const ITEM_MOD_AGILITY = 3;
    const ITEM_MOD_STRENGTH = 4;
    const ITEM_MOD_INTELLECT = 5;
    const ITEM_MOD_SPIRIT = 6;
    const ITEM_MOD_STAMINA = 7;
    const ITEM_MOD_DEFENSE_SKILL_RATING = 12;
    const ITEM_MOD_DODGE_RATING = 13;
    const ITEM_MOD_PARRY_RATING = 14;
    const ITEM_MOD_BLOCK_RATING = 15;
    const ITEM_MOD_HIT_MELEE_RATING = 16;
    const ITEM_MOD_HIT_RANGED_RATING = 17;
    const ITEM_MOD_HIT_SPELL_RATING = 18;
    const ITEM_MOD_CRIT_MELEE_RATING = 29;
    const ITEM_MOD_CRIT_RANGED_RATING = 20;
    const ITEM_MOD_CRIT_SPELL_RATING = 21;
    const ITEM_MOD_HIT_TAKEN_MELEE_RATING = 22;
    const ITEM_MOD_HIT_TAKEN_RANGED_RATING = 23;
    const ITEM_MOD_HIT_TAKEN_SPELL_RATING = 24;
    const ITEM_MOD_CRIT_TAKEN_MELEE_RATING = 25;
    const ITEM_MOD_CRIT_TAKEN_RANGED_RATING = 26;
    const ITEM_MOD_CRIT_TAKEN_SPELL_RATING = 27;
    const ITEM_MOD_HASTE_MELEE_RATING = 28;
    const ITEM_MOD_HASTE_RANGED_RATING = 29;
    const ITEM_MOD_HASTE_SPELL_RATING = 30;
    const ITEM_MOD_HIT_RATING = 31;
    const ITEM_MOD_CRIT_RATING = 32;
    const ITEM_MOD_HIT_TAKEN_RATING = 33;
    const ITEM_MOD_CRIT_TAKEN_RATING = 34;
    const ITEM_MOD_RESILIENCE_RATING = 35;
    const ITEM_MOD_HASTE_RATING = 36;
    const ITEM_MOD_EXPERTISE_RATING = 37;
    const ITEM_MOD_ATTACK_POWER = 38;
    const ITEM_MOD_RANGED_ATTACK_POWER = 39;
    const ITEM_MOD_FERAL_ATTACK_POWER = 40;
    const ITEM_MOD_SPELL_HEALING_DONE = 41;
    const ITEM_MOD_SPELL_DAMAGE_DONE = 42;
    const ITEM_MOD_MANA_REGENERATION = 43;
    const ITEM_MOD_ARMOR_PENETRATION_RATING = 44;
    const ITEM_MOD_SPELL_POWER = 45;
    const ITEM_MOD_HEALTH_REGEN = 46;
    const ITEM_MOD_SPELL_PENETRATION = 47;
    const ITEM_MOD_BLOCK_VALUE = 48;
}

#########################
# Items
#########################

$_item_class = array(
	2 => array(
		0	=> array("Einh&auml;ndig", "Axt"),
		1	=> array("Zweih&auml;ndig", "Axt"),
		2 	=> array("Distanz", "Bogen"),
		3	=> array("Distanz", "Schusswaffe"),
		4	=> array("Einh&auml;ndig", "Kolben"),
		5	=> array("Zweih&auml;ndig", "Kolben"),
		6	=> array("Zweih&auml;ndig", "Stangenwaffe"),
		7	=> array("Ein&auml;ndig", "Schwert"),
		8	=> array("Zweih&auml;dig", "Schwert"),
		10	=> array("Zweih&auml;ndig", "Stab"),
		13	=> array(null, "Faustwaffe"), # distinguish mh/oh by item type later
		14	=> array("Waffenhand", ""), # like mining picks, blacksmithing hammers, etc.
		15	=> array(null, "Dolch"),
		16	=> array("Distanz", "Wurfwaffe"),
		17	=> array("Zweih&auml;ndig", "Stangenwaffe"),
		18	=> array("Distanz", "Armbrust"),
		19	=> array("Distanz", "Zauberstab"),
		20	=> array("Zweih&auml;ndig", "Angelrute"),
	),
	4 => array(
		0	=> array(null, ""),
		1	=> array(null, "Stoff"),
		2	=> array(null, "Leder"),
		3	=> array(null, "Kette"),
		4	=> array(null, "Platte"),
		6	=> array("Schildhand", "Schild"),
		7	=> array("Relikt", "Buchband"),
		8	=> array("Relikt", "G&ouml;tze"),
		9	=> array("Relikt", "Totems"),
		10	=> array("Relikt", "Siegel"),
	)
);

$_inventory_type = array(
	1	=> "Kopf",
	2	=> "Hals",
	3	=> "Schulter",
	4	=> "Hemd",
	5	=> "Brust (Chest)", // Chest
	6	=> "Taille",
	7	=> "Beine",
	8	=> "F&uuml;&szlig;e",
	9	=> "Handgelenke",
	10	=> "H&auml;nde",
	11	=> "Finger",
	12	=> "Schmuck",
	13	=> "Einh&auml;ndig",
	14	=> "Schild",
	15	=> "Distanz",
	16	=> "R&uml;cken",
	17	=> "Zweih&auml;dnig",
	18	=> "Tasche",
	19	=> "Wappenrock",
	20	=> "Brust (Robe)", // Robe
	21	=> "Waffenhand",
	22	=> "Schildhand",
	23	=> "In der Schildhand getragen", // Holdable (Tome)
	24	=> "Munition",
	25	=> "Wurfwaffe",
	26	=> "Distanz",
	27	=> "K&ouml;cher",
	28	=> "Relikt",
);

#stat->id to name 
$_stat_name = array(
      0 => 'Mana',
      1 => 'Leben',
      3 => 'Beweglichkeit',
      4 => 'St&auml;rke',
      5 => 'Intelligenz',
      6 => 'Willenskraft',
      7 => 'Ausdauer',
      12 => 'Verteidigungswertung',
      13 => 'Ausweichwertung',
      14 => 'Parierwertung',
      15 => 'Blockwertung',
      31 => 'Trefferwertung',
      32 => 'kritische Trefferwertung',
      35 => 'Abh&auml;rtungswertung',
      36 => 'Tempowertung',
      37 => 'Waffenkunde',
      38 => 'Angriffskraft',
      43 => 'Mana alle 5 Sek.',
      45 => 'Zaubermacht',
      44 => 'Rüstungsdurchschlagwertung',
      47 => 'Zauberdurchschlag',
      48 => 'Blockwert eures Schildes'
);

$_spell_name = array(
    71397 => 'Immer, wenn Ihr einem Gegner Nahkampf- oder Distanzschaden zufügt, erhaltet Ihr 10 Sek. lang 17 Angriffskraft. Dieser Effekt ist bis zu 20-mal stapelbar.',
    71406 => 'Eure Nahkampfangriffe haben eine Chance, Euch Partikel des Zorns zu gewähren. Habt Ihr 8 Partikel des Zorns, werden sie wirksam und veranlassen Euch zu einem sofortigen Angriff mit einer Eurer Nahkampfwaffen für 50% Waffenschaden.',
    71545 => 'Eure Nahkampfangriffe haben eine Chance, Euch Partikel des Zorns zu gewähren. Habt Ihr 8 Partikel des Zorns, werden sie wirksam und veranlassen Euch zu einem sofortigen Angriff mit einer Eurer Nahkampfwaffen für 50% Waffenschaden.',
    71402 => 'Wenn Ihr Schaden verursacht, besteht eine Chance, dass Ihr 15 Sek. lang 1100 Angriffskraft erhaltet.',
    71540 => 'Wenn Ihr Schaden verursacht, besteht die Chance, dass Ihr 15 Sek. lang 1250 Angriffskraft hinzugewinnt.',
    71635 => 'Erhöht den Widerstand gegen Arkan-, Feuer-, Frost-, Natur- und Schattenzauber 10 Sek. lang um 239. (1 Min Abklingzeit)',
    50364 => 'Erhöht den Widerstand gegen Arkan-, Feuer-, Frost-, Natur- und Schattenzauber 10 Sek. lang um 268. (1 Min Abklingzeit)',
    71606 => 'Jedes Mal, wenn einer Eurer Zauber regelmäßigen Schaden verursacht, besteht eine Chance, dass Ihr 20 Sek. lang 1074 Zaubermacht hinzugewinnt.',
    71637 => 'Jedes Mal, wenn einer Eurer Zauber regelmäßigen Schaden verursacht, besteht eine Chance, dass Ihr 20 Sek. lang 1207 Zaubermacht hinzugewinnt.',
    71602 => 'Eure Offensivzauber haben eine Chance, Eure Zaubermacht um 105 und 20 Sek. lang alle 2 Sek. um weitere 105 zu erhöhen.',
    71645 => 'Eure Offensivzauber haben eine Chance, Eure Zaubermacht um 121 und 20 Sek. lang alle 2 Sek. um weitere 121 zu erhöhen.',
    71571 => 'Jedes Mal, wenn Ihr einem Gegner Zauberschaden zufügt, gewinnt Ihr für die nächsten 10 Sek. 18 Zaubermacht hinzu. Bis zu 10-mal stapelbar.',
    71573 => 'Jedes Mal, wenn Ihr einem Gegner Zauberschaden zufügt, gewinnt Ihr für die nächsten 10 Sek. 20 Zaubermacht hinzu. Bis zu 10-mal stapelbar.',
    71611 => 'Jedes Mal, wenn Eure Zauber ein Ziel heilen, besteht eine Chance, ein weiteres in der Nähe befindliches Ziel sofort um 5550 to 6450 zu heilen.',
    71642 => 'Jedes Mal, wenn Eure Zauber ein Ziel heilen, besteht eine Chance, ein weiteres in der Nähe befindliches Ziel sofort um 6280 to 7298 zu heilen.',
    71519 => 'Eure Angriffe haben eine Chance, die Macht der Völker von Nordend zu erwecken, wodurch Ihr vorübergehend transformiert werdet und Eure Kampfkapazitäten 30 Sek. lang erhöht werden.',
    71562 => 'Eure Angriffe haben eine Chance, die Macht der Völker von Nordend zu erwecken, wodurch Ihr vorübergehend transformiert werdet und Eure Kampfkapazitäten 30 Sek. lang erhöht werden.'
);
?>

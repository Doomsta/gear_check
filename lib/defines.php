<?php
$_race_faction = array(
    1    => 0,
    2    => 1,
    3    => 0,
    4    => 0,
    5    => 1,
    6    => 1,
    7    => 0,
    8    => 1,
    9    => 1,
    10   => 1,
    11   => 0,
    22   => 0);
unset($_race_faction[9]);
unset($_race_faction[22]);

# class->id to class->color
$_class_color = array(
    1    => '#C69B6D',    // warrior
    2    => '#F48CBA',    // paladin
    3    => '#AAD372',    // hunter
    4    => '#FFF468',    // rogue
    5    => '#FFFFFF',    // priest
    6    => '#C41F3B',    // DK
    7    => '#1A3CAA',    // shaman
    8    => '#68CCEF',    // mage
    9    => '#9382C9',    // warlock
    11   => '#FF7C0A'    // druid
);    

# faction->id to faction->color
$_faction_color = array(
    0    => "#0000FF",
    1    => "#CC0000"
);

##########################
# Items
##########################

# socket->id to Color->name
# http://archive.trinitycore.info/Item_template_tc2#socketColor
class SocketColor {
    const Prismatic = 0;
    const Meta = 1;
    const Red = 2;
    const Orange = 3;
    const Yellow = 4;
    const Green = 6;
    const Blue = 8;
    const Violet = 9;
}

# stat->type to stat->id
# http://collab.kpsn.org/display/tc/Item+template+tc2#Itemtemplatetc2-stat_type
class ItemStats {
    // quirks
    const ITEM_MOD_ARMOR = -1; 
    const ITEM_MOD_BASE_STATS = -2; 
    const ITEM_MOD_BASE_STATS_RELATIV = -3; 
    const ITEM_MOD_AGILITY_RELATIV = -4;
    const ITEM_MOD_STRENGTH_RELATIV = -5;
    const ITEM_MOD_INTELLECT_RELATIV = -6;
    const ITEM_MOD_SPIRIT_RELATIV = -7;
    const ITEM_MOD_STAMINA_RELATIV = -8;
    const ITEM_MOD_ARMOR_RELATIV = -9; 
    const ITEM_MOD_MEELE_CRIT_PERCENT = -10; 
    const ITEM_MOD_CASTER_CRIT_PERCENT = -11; 
    const ITEM_MOD_HEAL_CRIT_PERCENT = -12; 
    const ITEM_MOD_CRIT_MOD = -13;
    #const ITEM_MOD_STUN_DURATION = -14;
    #const ITEM_MOD_SILENCE_DURATION = -15;
    
    //trinity stats
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
        0     => array("Einh&auml;ndig", "Axt"),
        1     => array("Zweih&auml;ndig", "Axt"),
        2     => array("Distanz", "Bogen"),
        3     => array("Distanz", "Schusswaffe"),
        4     => array("Einh&auml;ndig", "Kolben"),
        5     => array("Zweih&auml;ndig", "Kolben"),
        6     => array("Zweih&auml;ndig", "Stangenwaffe"),
        7     => array("Ein&auml;ndig", "Schwert"),
        8     => array("Zweih&auml;dig", "Schwert"),
        10    => array("Zweih&auml;ndig", "Stab"),
        13    => array(null, "Faustwaffe"), # distinguish mh/oh by item type later
        14    => array("Waffenhand", ""), # like mining picks, blacksmithing hammers, etc.
        15    => array(null, "Dolch"),
        16    => array("Distanz", "Wurfwaffe"),
        17    => array("Zweih&auml;ndig", "Stangenwaffe"),
        18    => array("Distanz", "Armbrust"),
        19    => array("Distanz", "Zauberstab"),
        20    => array("Zweih&auml;ndig", "Angelrute"),
    ),
    4 => array(
        0     => array(null, ""),
        1     => array(null, "Stoff"),
        2     => array(null, "Leder"),
        3     => array(null, "Kette"),
        4     => array(null, "Platte"),
        6     => array("Schildhand", "Schild"),
        7     => array("Relikt", "Buchband"),
        8     => array("Relikt", "G&ouml;tze"),
        9     => array("Relikt", "Totems"),
        10    => array("Relikt", "Siegel"),
    ),
    7 => array(
        11    => array(null, "Sonstige"),
    ),
);

############################
# Races
############################

# race->id to race->name
# according to ChrRaces.dbc
$_race_name = array(
    1     => "Mensch",
    2     => "Ork",
    3     => "Zwerg",
    4     => "Nachtelf",
    5     => "Untoter",
    6     => "Tauren",
    7     => "Gnom",
    8     => "Troll",
    9     => "Goblin",    # 4.x
    10    => "Blutelf",
    11    => "Draenei",
    22    => "Worg");    # 4.x
unset($_race_name[9]);
unset($_race_name[22]);

###########################
# Classes
###########################

# class->id to class->name
# according to ChrClasses.dbc
$_class_name = array(
    1    => "Krieger",
    2    => "Paladin",
    3    => "J&auml;ger",
    4    => "Schurken",
    5    => "Priester",
    6    => "Todesritter",
    7    => "Schamane",
    8    => "Magier",
    9    => "Hexenmeister",
    11   => "Druide"
);

##########################
# Faction
##########################

# faction->id to faction->name
# self-defined, value derived from class
$_faction_name = array(
    0    => "Allianz",
    1    => "Horde"
);

##########################
# Titles
##########################

class TitleType {
    const Prefix = 0;
    const Suffix = 1;
}

##########################
# Items
##########################

# http://images3.wikia.nocookie.net/__cb20090410062624/wowwiki/images/a/ae/InventorySlots.jpg
$_gearSlot_name = array(
    1  => 'head', 
    2  => 'neck',
    3  => 'shoulder',
    15 => 'back',
    5  => 'chest',
    4  => 'shirt',
    19 => 'tabard',
    9  => 'wrist',
    
    10 => 'hands',
    6  => 'waist',
    7  => 'legs',
    8  => 'feet',
    11 => 'finger1',
    12 => 'finger2',
    13 => 'trinket1',
    14 => 'trinket2',
    
    16 => 'mainHand',
    17 => 'offHand',
    18 => 'relic'
);

$_inventory_type = array(
    1   => "Kopf",
    2   => "Hals",
    3   => "Schulter",
    4   => "Hemd",
    5   => "Brust",
    6   => "Taille",
    7   => "Beine",
    8   => "F&uuml;&szlig;e",
    9   => "Handgelenke",
    10  => "H&auml;nde",
    11  => "Finger",
    12  => "Schmuck",
    13  => "Einh&auml;ndig",
    14  => "Schild",
    15  => "Distanz",
    16  => "R&uuml;cken",
    17  => "Zweih&auml;ndig",
    18  => "Tasche",
    19  => "Wappenrock",
    20  => "Brust",
    21  => "Waffenhand",
    22  => "Schildhand",
    23  => "In der Schildhand getragen", // Holdable (Tome)
    24  => "Munition",
    25  => "Wurfwaffe",
    26  => "Distanz",
    27  => "K&ouml;cher",
    28  => "Relikt",
);

#stat->id to name 
$_stat_name = array(
   -1  => 'R&uuml;stung', // custom
    0  => 'Mana',
    1  => 'Leben',
    // 2 => probably faulty/missing socket bonus (like 2952, +4 crit)
    3  => 'Beweglichkeit',
    4  => 'St&auml;rke',
    5  => 'Intelligenz',
    6  => 'Willenskraft',
    7  => 'Ausdauer',
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
    42 => '',
    43 => 'Mana alle 5 Sek.',
    45 => 'Zaubermacht',
    44 => 'Rüstungsdurchschlagwertung',
    46 => 'Leben alle 5 Sek.',
    47 => 'Zauberdurchschlag',
    48 => 'Blockwert eures Schildes'
);

################################
# Skills
###############################

$_skill_name = array(
    171 => "Alchemie",
    186 => "Bergbau",
    202 => "Ingenieurskunst",
    773 => "Inschriftenkunde",
    755 => "Juwelenschleifen",
    393 => "K&uuml;rschner",
    182 => "Kr&auml;uterkunde",
    165 => "Lederverarbeitung",
    164 => "Schmiedekunst",
    197 => "Schneiderei",
    333 => "Verzauberkunst",
);


################################
# TEMP (Move to DB)
################################

$_spell_desc = array(
    //icc
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
    71562 => 'Eure Angriffe haben eine Chance, die Macht der Völker von Nordend zu erwecken, wodurch Ihr vorübergehend transformiert werdet und Eure Kampfkapazitäten 30 Sek. lang erhöht werden.',
    71576 => 'Bei einem erlittenen Treffer im Nahkampf besteht eine Chance von 60%, dass Ihr 10 Sek. lang 24 Ausdauer hinzugewinnt. Bis zu 10-mal stapelbar.',
    71578 => 'Bei einem erlittenen Treffer im Nahkampf besteht eine Chance von 60%, dass Ihr 10 Sek. lang 27 Ausdauer hinzugewinnt. Bis zu 10-mal stapelbar.',
    71607 => 'Heilt ein befreundetes Ziel sofort um 7400 to 8600. (2 Min Abklingzeit)',
    50354 => 'Heilt ein befreundetes Ziel sofort um 7400 to 8600. (2 Min Abklingzeit)',
    71585 => 'Beim Wirken eines Zaubers besteht die Chance, dass Ihr 15 Sek lang 304 Mana alle 5 Sek. gewinnt.',
    71586 => 'Absorbiert 6400 Schaden. Hält 10 Sek. lang an. (2 Min Abklingzeit)',
    71565 => 'Restores 1625 mana.',
    71574 => 'Restores 1830 mana.',
    72770 => 'Summons a Cadaver that will protect you for 1 min.',
    48645 => 'Increases the block value of your shield by 147',
    67515 => 'Erhöht den Blockwert Eures Schildes um 189',
    67742 => 'Each time you are struck by an attack, you gain 1422 armor. Stacks up to 5 times. Entire effect lasts 20 sec.',
    71634 => 'Melee attacks which reduce you below 35% health cause you to gain 5712 armor for 10 sec. Cannot occur more than once every 30 sec.',
    71865 => 'Jedes Mal, wenn Eure Zauber ein Ziel heilen, besteht eine Chance, dass sowohl das Ziel Eurer Heilung als auch Verbündete in einem Umkreis von 10 Metern 6 Sek. lang pro Sekunde um 217 geheilt werden.',
    //icc ringe
    71653 => 'When struck in combat has a chance of increasing your armor by 2400 for 10 sec.',
    71655 => 'Your helpful spells have a chance to increase your spell power by 285 for 10 sec.',
    72413 => 'Chance bei Treffer, Eure Angriffskraft 10 Sek. lang um 480 zu erhöhen.',
    73961 => 'Chance bei Treffer, Eure Angriffskraft 10 Sek. lang um 480 zu erhöhen.',
    71650 => 'Chance bei Treffer, Eure Angriffskraft 10 Sek. lang um 480 zu erhöhen.',
    72968 => 'Eine Schleife der Zuneigung.',
    71168 => '', //Unerfülltes Verlangen Beschreibt die Aura von Schattenschneide
    //frozen halls
    71569 => 'Erhöht die maximale Gesundheit 15 Sek. lang um 4104. Teilt eine Abklingzeit mit anderen Schmuckstücken des Kampfmeisters.',
    //frost emblems
    71579 => 'Erhöht die Zaubermacht 20 Sek. lang um 716.',
    //pvp sets
    22778 => 'Reduces the rage cost of your Hamstring ability by 3.',
    32973 => 'Improves the range of your Shock and Wind Shear spells by 5 yards.',
    44297 => 'Reduces the cooldown of your Psychic Scream ability by 3000 sec.',
    33063 => 'Reduces the pushback suffered from damaging attacks while casting Fear by 50%.',
    62459 => 'Your Chains of Ice ability now generates an additional 50 runic power.',
    61255 => 'Verringert die Abklingzeit Eurer Fallen und Eurer Fähigkeit \'Schwarzer Pfeil\' um 2 Sek.',
    61252 => 'Verringert die Energiekosten eurer F&auml;higkeit \'Zerfleddern\' um 15.',
    //pvp trinkets
    64527 => 'Erhöht 20 Sek. lang Euer Tempo um 375',
    //pdk
    66238 => 'Teleports the caster to the Argent Tournament Grounds.',
    67752 => 'Jedes Mal, wenn Ihr einen Zauber wirkt, gewinnt Ihr 10 Sek. lang 18 Mana alle 5 Sek. Bis zu 8-mal stapelbar.',
    67698 => 'Jedes Mal, wenn Ihr einen Zauber wirkt, gewinnt Ihr 10 Sek. lang 16 Mana alle 5 Sek. Bis zu 8-mal stapelbar.',
    67712 => 'Jedes Mal, wenn Ihr einen unregelmäßigen kritischen Zaubertreffer erzielt, gewinnt Ihr einen Flammenpartikel. Sobald sich 3 Partikel angesammelt haben, werden sie eine Flammensäule auslösen, die 1741 to 2023 Schaden verursacht. Flammenpartikel können nicht öfter als ein Mal alle 2 Sek. gewonnen werden.',
    67758 => 'Jedes Mal, wenn Ihr einen unregelmäßigen kritischen Zaubertreffer erzielt, gewinnt Ihr einen Flammensplitter. Sobald sich 3 Splitter angesammelt haben, werden sie eine Flammensäule auslösen, die 1959 to 2275 Schaden verursacht. Flammensplitter können nicht öfter als ein Mal alle 2 Sek. gewonnen werden.',
    67702 => 'Wenn Ihr Schaden verursacht, habt Ihr eine Chance zu einem Vorbild zu werden, was Eure Stärke oder Beweglichkeit 15 Sek. lang um 450 erhöht. Es wird immer Euer höherer Wert gewählt.',
    67771 => 'Wenn Ihr Schaden verursacht, habt Ihr eine Chance zu einem Vorbild zu werden, was Eure Stärke oder Beweglichkeit 15 Sek. lang um 510 erhöht. Es wird immer Euer höherer Wert gewählt.',
    67672 => 'Jedes Mal, wenn Ihr mit einem Nahkampf- oder Distanzangriff trefft, habt Ihr eine Chance, 10 Sek. lang 1008 Angriffskraft zu gewinnen.',
    71581 => 'Eure Offensivzauber haben eine Chance, bei einem Treffer Eure Zaubermacht 10 Sek. lang um 285 zu erhöhen.',
    67744 => 'Each time you cast a harmful spell, you gain 64 haste rating. Stacks up to 8 times. Entire effect lasts 20 sec.',
    67694 => 'Increases dodge rating by 512 for 20 sec.',
    67753 => 'Erhöht die maximale Gesundheit 15 Sek. lang um 5186. Teilt eine Abklingzeit mit allen anderen Schmuckstücken des Kampfmeisters.',
    67738 => 'Jedes Mal, wenn Ihr einen Feind mit einem Nahkampfangriff trefft, erhaltet Ihr 215 Angriffskraft. Bis zu 5-mal stapelbar. Der ganze Effekt dauert 20 Sek. lang an.',
    //triumph emblems
    67695 => 'Erhöht die Angriffskraft 20 Sek. lang um 1024.',
    //ulduar
    64714 => 'Eure Schaden verursachenden Zauber haben eine Chance, Eure Zaubermacht 10 Sek. um 850 zu erhöhen.',
    64792 => 'Eure kritischen Nahkampf- und Distanzangriffe haben eine Chance, Eure Angriffskraft 10 Sek. lang um 1284 zu erhöhen.',
    64742 => 'Eure Zauber haben eine Chance, Eure Zaubermacht 10 Sek. lang um 751 zu erhöhen.',
    64999 => 'Jeder Zauber, der innerhalb von 20 Sek. gewirkt wird, gewährt einen stapelbaren Bonus von 60 Mana alle 5 Sekunden. Endet nach 20 Sek. Fähigkeiten, die kein Mana verbrauchen, lösen dieses Schmuckstück nicht aus.',
    65007 => 'Jedes Mal, wenn Ihr einen Schadens- oder Heilzauber wirkt erhöht sich Eure Zaubermacht für die nächsten 10 Sek. um 25. Dieser Effekt ist bis zu 5-mal stapelbar.',
    64786 => 'Eure Nahkampf- und Distanzangriffe gewähren eine Chance, 10 Sek. lang Euer Tempo um 726 zu erhöhen.',
    65020 => 'Eure Nahkampf- und Distanzangriffe gewähren eine Chance, 10 Sek. lang Eure Rüstungsdurchschlagwertung um 665 zu erhöhen.',
    //pdc
    67670 => 'Jedes Mal, wenn Ihr einen Schadenszauber wirkt, besteht eine Chance, dass Ihr 10 Sek. lang 590 Zaubermacht erhaltet.',
    60063 => 'Eure Offensivzauber haben eine Chance, Eure Zaubermacht 10 Sek. lang um 590 zu erhöhen.',
    //boe
    49622 => 'Jedes Mal, wenn Ihr einen Zauber wirkt, besteht die Chance, dass ihr 15 Sek. lang alle 5 Sekunden bis zu 125 Mana regeneriert.',
    33953 => 'Eure direkten Heilzauber und Heilungen über Zeit haben eine Chance, Euer Tempo 10 Sek. lang um 505 zu erhöhen.',
    //other
    65012 => 'Erhöht das Parieren 20 Sek. lang um 380.',
    57345 => 'When you heal or deal damage you have a chance to gain Greatness, increasing your Strength, Agility, Intellect, or Spirit by 300 for 15 sec. Your highest stat is always chosen.',
    60180 => 'Increases maximum health by 3025 for 15 sec.',
    71404 => 'Chance on melee or ranged critical strike to increase your armor penetration rating by 678 for 10 sec.',
    57818 => '', //Has Tabard
    71563 => 'Increases your critical strike rating by 184 for 20 sec. Every time one of your non-periodic spells deals a critical strike, the bonus is reduced by 184 critical strike rating.',
    64707 => 'Erhöht 20 Sek. lang Euer Tempo um 432. (2 Min Abklingzeit)',
    42292 => 'Entfernt alle bewegungseinschränkenden Effekte sowie alle Effekte, die den Verlust der Kontrolle über Euren Charakter verursachen. (2 Min Abklingzeit)',
    44301 => 'Verringert die globale Abklingzeit Eures Zaubers \'Blinzeln\' um 0.5 Sek.',
    67684 => 'Increases spell power by 599 for 20 sec.',
    33648 => 'Chance, bei einem kritischen Nahkampf- und Distanzangriffstreffer Eure Angriffskraft 10 Sek. lang um 1000 zu erhöhen.',
    //pala
    67379 => 'Each time you use your Hammer of The Righteous ability, you have a chance to gain 200 dodge rating for 18 sec.',
    71186 => 'Your Crusader Strike ability grants 44 Strength for 15 sec. Stacks up to 5 times.',
    60636 => 'Your Crusader Strike ability also grants you 204 attack power for 10 sec.',
    51472 => 'Increases spell power of Flash of Light by 510.',
    71191 => 'Your Holy Shock heals grant 85 spell power for 15 sec. Stacks up to 3 times.',
    71194 => 'Your Shield of Righteousness ability grants 73 dodge rating for 15 sec. Stacks up to 3 times.',
    60635 => 'Your Crusader Strike ability also grants you 172 attack power for 10 sec.',
    60662 => 'Increases spell power of Flash of Light by 436.',
    67365 => 'Each time your Seal of Vengeance or Seal of Corruption ability deals periodic damage, you have a chance to gain 200 Strength for 16 sec.',
    67363 => 'Each time you cast Holy Light, you have a chance to gain 234 spell power for 15 sec.',
    60787 => 'Reduces the mana cost of Holy Light by 113.',
    60797 => 'Erh&ouml;ht die Zaubermacht eurer Fähigkeit \'Weihe\' um 141.',
    //dudu
    60701 => 'Your Mangle ability also grants you 204 attack power for 10 sec.',
    60726 => 'Your Moonfire spell grants 119 spell power for 10 sec.',
    60741 => 'Increases the spell power of the final healing value of your Lifebloom by 448.',
    71178 => 'The periodic healing from your Rejuvenation spell grants 32 spell power for 15 sec. Stacks up to 8 times.',
    71176 => 'The periodic damage from your Insect Swarm and Moonfire spells grants 44 critical strike rating for 15 sec. Stacks up to 5 times.',
    60700 => 'Your Mangle ability also grants you 172 attack power for 10 sec.',
    60724 => 'Your Moonfire spell grants 101 spell power for 10 sec.',
    60740 => 'Increases the spell power of the final healing value of your Lifebloom by 376.',
    67353 => 'While in Bear Form, your Lacerate and Swipe abilities have a chance to grant 200 dodge rating for 9 Sek., and your Cat Form`s Mangle and Shred abilities have a chance to grant 200 Agility for 16 sec.',
    67356 => 'Each time your Rejuvenation spell deals periodic healing, you have a chance to gain 234 spell power for 9 sec.',
    67361 => 'Each time your Moonfire spell deals periodic damage, you have a chance to gain 200 critical strike rating for 12 sec.',
    71174 => 'Der regelmäßige Schaden Eurer Fähigkeiten \'Aufschlitzen\' und \'Krallenhieb\' gewährt Euch 15 sec lang 44 Beweglichkeit. Bis zu 44-mal stapelbar.',
    60775 => 'Increases the spell power of your Starfire spell by 165.',
    //schami
    60554 => 'Your Lava Lash ability also grants you 204 attack power for 10 sec.',
    60575 => 'Your Shock spells grant 119 spell power for 10 sec.',
    51501 => 'Equip: Increases spell power of Lesser Healing Wave by 459.',
    71198 => 'The periodic damage from your Flame Shock spell grants 44 haste rating for 30 sec. Stacks up to 5 times.',
    71214 => 'Your Stormstrike ability grants 146 attack power for 15 sec. Stacks up to 3 times.',
    71217 => 'Your Riptide spell grants 85 spell power for 15 sec. Stacks up to 3 times.',
    60552 => 'Your Lava Lash ability also grants you 172 attack power for 10 sec.',
    60574 => 'Your Shock spells grant 101 spell power for 10 sec.',
    60560 => 'Increases spell power of Lesser Healing Wave by 404.',
    72958 => '', // T10 Shoulder Visual
    //dk
    60690 => 'Your Plague Strike ability also grants you 204 attack power for 10 sec.',
    71228 => 'Your Rune Strike ability grants 44 dodge rating for 15 sec. Stacks up to 5 times.',
    71226 => 'Your Obliterate, Scourge Strike, and Death Strike abilities grants 73 Strength for 15 sec. Stacks up to 3 times.',
    60688 => 'Your Plague Strike ability also grants you 172 attack power for 10 sec.',
    67381 => 'Each time you use your Rune Strike ability, you have a chance to gain 200 dodge rating for 20 sec.',
    67384 => 'Each time you use your Death Strike, Obliterate, or Scourge Strike ability, you have a chance to gain 200 Strength for 20 sec.',
    64962 => 'Increases the damage done by your Death Coil ability by 380 and by your Frost Strike ability by 113.',
    54695 => 'Chance, bei einem Nahkampf- oder Distanztreffer \'Unerträgliche Schmerzen\' hervorzurufen. Dieser Effekt bewirkt, dass Euch Eure Angriffe jeweils 15 zusätzlichen kritischen Trefferwert verleihen. Bis zu 10-mal stapelbar',
    //ilvl213 stuff
    60524 => 'Jedes Mal, wenn Ihr einen Zauber wirkt, erhaltet Ihr für die nächsten 10 Sek. 18 Willenskraft. Bis zu 10-mal stapelbar.',
    60493 => 'Eure Zauber haben eine Chance, Eure Zaubermacht 10 Sek. lang um 765 zu erhöhen.',
    33138 => 'Erh&ouml;ht Zaubermacht um 88',
    54230 => 'Erh&ouml;ht Zaubermacht um 99',
    54232 => 'Erh&ouml;ht Zaubermacht um 78',
    26155 => 'Erh&ouml;ht Zaubermacht um 59',
    //darkmoon cards
    57351 => 'Ihr habt eine Chance, zum Berserker zu werden, wenn Ihr im Kampf Schaden verursacht oder erleidet. Euer kritischer Trefferwert erhöht sich 12 Sek. lang um 35. Der Effekt ist bis zu 3-mal stapelbar.',
    //quest rewards
    59657 => 'Erh&ouml;ht Zaubermacht um 281 f&uuml;r 20 Sek.',
    //random stuff
    63604 => 'Steht im Zentrum der Aufmerksamkeit.',
    17816 => 'Impress others with your fashion sense.' // smoking, yeah!
);
?>

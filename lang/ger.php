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

##########################
# Faction
##########################

# faction->id to faction->name
# self-defined, value derived from class
$_faction_name = array(
	0	=> "Allianz",
	1	=> "Horde"
);

//TODO
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
    72413 => 'Chance bei Treffer, Eure Angriffskraft 10 Sek. lang um 480 zu erhöhen.',
    73961 => 'Chance bei Treffer, Eure Angriffskraft 10 Sek. lang um 480 zu erhöhen.',
    72968 => 'Eine Schleife der Zuneigung.',
    71168 => '', //Unerfülltes Verlangen Beschreibt die Aura von Schattenschneide
    //pdk
    67752 => 'Jedes Mal, wenn Ihr einen Zauber wirkt, gewinnt Ihr 10 Sek. lang 18 Mana alle 5 Sek. Bis zu 8-mal stapelbar.',
    67698 => 'Jedes Mal, wenn Ihr einen Zauber wirkt, gewinnt Ihr 10 Sek. lang 16 Mana alle 5 Sek. Bis zu 8-mal stapelbar.',
    67712 => 'Jedes Mal, wenn Ihr einen unregelmäßigen kritischen Zaubertreffer erzielt, gewinnt Ihr einen Flammenpartikel. Sobald sich 3 Partikel angesammelt haben, werden sie eine Flammensäule auslösen, die 1741 to 2023 Schaden verursacht. Flammenpartikel können nicht öfter als ein Mal alle 2 Sek. gewonnen werden.',
    67758 => 'Jedes Mal, wenn Ihr einen unregelmäßigen kritischen Zaubertreffer erzielt, gewinnt Ihr einen Flammensplitter. Sobald sich 3 Splitter angesammelt haben, werden sie eine Flammensäule auslösen, die 1959 to 2275 Schaden verursacht. Flammensplitter können nicht öfter als ein Mal alle 2 Sek. gewonnen werden.',
    67702 => 'Wenn Ihr Schaden verursacht, habt Ihr eine Chance zu einem Vorbild zu werden, was Eure Stärke oder Beweglichkeit 15 Sek. lang um 450 erhöht. Es wird immer Euer höherer Wert gewählt.',
    67771 => 'Wenn Ihr Schaden verursacht, habt Ihr eine Chance zu einem Vorbild zu werden, was Eure Stärke oder Beweglichkeit 15 Sek. lang um 510 erhöht. Es wird immer Euer höherer Wert gewählt.',
    67672 => 'Jedes Mal, wenn Ihr mit einem Nahkampf- oder Distanzangriff trefft, habt Ihr eine Chance, 10 Sek. lang 1008 Angriffskraft zu gewinnen.',
    71581 => 'Eure Offensivzauber haben eine Chance, bei einem Treffer Eure Zaubermacht 10 Sek. lang um 285 zu erhöhen.',

   //other
    64707 => 'Erhöht 20 Sek. lang Euer Tempo um 432. (2 Min Abklingzeit)',
    42292 => 'Entfernt alle bewegungseinschränkenden Effekte sowie alle Effekte, die den Verlust der Kontrolle über Euren Charakter verursachen. (2 Min Abklingzeit)',
    44301 => 'Verringert die globale Abklingzeit Eures Zaubers \'Blinzeln\' um 0.5 Sek.',
    //pala
    60636 => 'Your Crusader Strike ability also grants you 204 attack power for 10 sec.',
    51472 => 'Increases spell power of Flash of Light by 510.',
    71191 => 'Your Holy Shock heals grant 85 spell power for 15 sec. Stacks up to 3 times.',
    71194 => 'Your Shield of Righteousness ability grants 73 dodge rating for 15 sec. Stacks up to 3 times.',
    60635 => 'Your Crusader Strike ability also grants you 172 attack power for 10 sec.',
    60662 => 'Increases spell power of Flash of Light by 436.',
    67365 => 'Each time your Seal of Vengeance or Seal of Corruption ability deals periodic damage, you have a chance to gain 200 Strength for 16 sec.',
    67363 => 'Each time you cast Holy Light, you have a chance to gain 234 spell power for 15 sec.',
    60787 => 'Reduces the mana cost of Holy Light by 113.',
    //dudu
    60701 => 'Your Mangle ability also grants you 204 attack power for 10 sec.',
    60726 => 'Your Moonfire spell grants 119 spell power for 10 sec.',
    60741 => 'Increases the spell power of the final healing value of your Lifebloom by 448.',
    71178 => 'The periodic healing from your Rejuvenation spell grants 32 spell power for 15 sec. Stacks up to 8 times.',
    71176 => 'The periodic damage from your Insect Swarm and Moonfire spells grants 44 critical strike rating for 15 sec. Stacks up to 5 times.',
    60700 => 'Your Mangle ability also grants you 172 attack power for 10 sec.',
    60724 => 'Your Moonfire spell grants 101 spell power for 10 sec.',
    60740 => 'Increases the spell power of the final healing value of your Lifebloom by 376.',
    67356 => 'Each time your Rejuvenation spell deals periodic healing, you have a chance to gain 234 spell power for 9 sec.',
    67361 => 'Each time your Moonfire spell deals periodic damage, you have a chance to gain 200 critical strike rating for 12 sec.',
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
    //dk
    60690 => 'Your Plague Strike ability also grants you 204 attack power for 10 sec.',
    71228 => 'Your Rune Strike ability grants 44 dodge rating for 15 sec. Stacks up to 5 times.',
    71226 => 'Your Obliterate, Scourge Strike, and Death Strike abilities grants 73 Strength for 15 sec. Stacks up to 3 times.',
    60688 => 'Your Plague Strike ability also grants you 172 attack power for 10 sec.',
    67381 => 'Each time you use your Rune Strike ability, you have a chance to gain 200 dodge rating for 20 sec.',
    67384 => 'Each time you use your Death Strike, Obliterate, or Scourge Strike ability, you have a chance to gain 200 Strength for 20 sec.',
    64962 => 'Increases the damage done by your Death Coil ability by 380 and by your Frost Strike ability by 113.'
    );

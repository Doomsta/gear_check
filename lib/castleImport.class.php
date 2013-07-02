<?php
class castleImport
{
	private static $armoryUrl = 'http://armory.wow-castle.de/';
	
	public static function getChar($name)
	{
		$out = array();
		$xml = castleImport::getXML(castleImport::$armoryUrl.'character-sheet.xml?r=WoW-Castle+PvE&cn='.$name);
		if($xml->characterInfo->character['name'] == false)
			return false;

		$out['name'] = (string) $xml->characterInfo->character['name'];
		$out['prefix'] = (string) $xml->characterInfo->character['prefix'];
		$out['suffix'] = (string) $xml->characterInfo->character['suffix'];
		$out['classId'] = (int) $xml->characterInfo->character['classId'];
		$out['raceId'] = (int) $xml->characterInfo->character['raceId'];
		$out['guildName'] = (string) $xml->characterInfo->character['guildName'];
		$out['level'] = (int) $xml->characterInfo->character['level'];
		$out['points'] = (int) $xml->characterInfo->character['points'];
		if(isset($xml->characterInfo->character->arenaTeams->arenaTeam))
		{
			foreach($xml->characterInfo->character->arenaTeams->arenaTeam as $arenaTeam)
			{
				$ts = (int) $arenaTeam['size'];
				if($ts == 5)
					break; // 5v5 at castle xD
				$out['arena'][$ts]['name'] = (string) $arenaTeam['name'];
				$out['arena'][$ts]['rating'] = (int) $arenaTeam['rating'];
				$out['arena'][$ts]['gamesWon'] = (int) $arenaTeam['gamesWon'];
				$out['arena'][$ts]['gamesPlayed'] = (int) $arenaTeam['gamesPlayed'];
				$out['arena'][$ts]['seasonGamesWon'] = (int) $arenaTeam['seasonGamesWon'];
				$out['arena'][$ts]['seasonGamesPlayed'] = (int) $arenaTeam['seasonGamesPlayed'];
				foreach($arenaTeam->emblem->members->member as $member)
				{
					$out['arena'][$ts]['member'][] = array(
						'name' => (string) $member['name'],
						'classId' => (int) $member['classId'],
						'raceId' => (int) $member['raceId'],
						'guild' => (string) $member['guild'],
						'persRating' =>  (int) $member['contribution'],
						'gamesWon' => (int) $member['gamesWon'],
						'gamesPlayed' => (int) $member['gamesPlayed'],
						'seasonGamesWon' => (int) $member['seasonGamesWon'],
						'seasonGamesPlayed' => (int) $member['seasonGamesPlayed']
					);
				}
			}
		}
		//gear
        $tmp;
		foreach($xml->characterInfo->characterTab->items->item as $item) 
		{
			$sn = (int)$item['slot'] +1;
			$out['items'][$sn]['id']  = (string) $item['id'];
			$out['items'][$sn]['name']  = (string) $item['name'];
			$out['items'][$sn]['level']  = (int) $item['level'];
			$out['items'][$sn]['rarity']  = (int) $item['rarity'];
			$out['items'][$sn]['icon']  = (string) $item['icon'];
			$out['items'][$sn]['gems'] = array();
			for($i=0;!empty($item['gem'.$i.'Id']);$i++)
                $out['items'][$sn]['gems'][$i]['id'] = (int) $item['gem'.$i.'Id'];
			$out['items'][$sn]['permanentEnchantItemId']  = (int) $item['permanentEnchantItemId'];
			if (isset($item['permanentEnchantSpellName']))
				$out['items'][$sn]['permanentEnchantSpellName'] = (string) $item['permanentEnchantSpellName'];
		}
		//stats
		//base
		$out['stats']['base']['str'] = (string) $xml->characterInfo->characterTab->baseStats->strength['effective'];  
		$out['stats']['base']['agi'] = (string) $xml->characterInfo->characterTab->baseStats->agility['effective']; 
		$out['stats']['base']['sta'] = (string) $xml->characterInfo->characterTab->baseStats->stamina['effective']; 
		$out['stats']['base']['int'] = (string) $xml->characterInfo->characterTab->baseStats->intellect['effective']; 
		$out['stats']['base']['spr'] = (string) $xml->characterInfo->characterTab->baseStats->spirit['effective'];  
		//melee
		$out['stats']['melee']['mainHandDmgMin'] = (string) $xml->characterInfo->characterTab->melee->mainHandDamage['min'];
		$out['stats']['melee']['mainHandDmgMax'] = (string) $xml->characterInfo->characterTab->melee->mainHandDamage['max'];
		$out['stats']['melee']['mainHandSpeed'] = (string) $xml->characterInfo->characterTab->melee->mainHandDamage['speed'];
		$out['stats']['melee']['mainHandDps'] = (string) $xml->characterInfo->characterTab->melee->mainHandDamage['dps'];
		
		$out['stats']['melee']['offHandDmgMin'] = (string) $xml->characterInfo->characterTab->melee->offHandDamage['min'];
		$out['stats']['melee']['offHandDmgMax'] = (string) $xml->characterInfo->characterTab->melee->offHandDamage['max'];
		$out['stats']['melee']['offHandSpeed'] = (string) $xml->characterInfo->characterTab->melee->offHandDamage['speed'];
		$out['stats']['melee']['offHandDps'] = 	(string) $xml->characterInfo->characterTab->melee->offHandDamage['dps'];
		
		$out['stats']['melee']['attackPower'] = (string) $xml->characterInfo->characterTab->melee->power['effective'];
		$out['stats']['melee']['hasteRating'] = (string) $xml->characterInfo->characterTab->spell->hasteRating['hasteRating']; // XML is missing haste in melee-section
		$out['stats']['melee']['crit'] = (string) $xml->characterInfo->characterTab->melee->critChance['percent'];
		$out['stats']['melee']['critRating'] = (string) $xml->characterInfo->characterTab->melee->critChance['rating'];
		$out['stats']['melee']['hitRating'] = (string) $xml->characterInfo->characterTab->melee->hitRating['value'];
		$out['stats']['melee']['hitPercent'] = (string) $xml->characterInfo->characterTab->melee->hitRating['increasedHitPercent'];
		$out['stats']['melee']['expertiseRating'] = (string) $xml->characterInfo->characterTab->melee->expertise['rating'];
		$out['stats']['melee']['expertise'] = (string) $xml->characterInfo->characterTab->melee->expertise['value'];
		$out['stats']['melee']['arpRating'] = (string) $xml->characterInfo->characterTab->melee->hitRating['reducedArmorRating']; 
		$out['stats']['melee']['arpPercent'] = (string) $xml->characterInfo->characterTab->melee->hitRating['reducedArmorPercent']; 
		//ranged
		$out['stats']['ranged']['dmgMin'] = (string) $xml->characterInfo->characterTab->ranged->damage['min'];
		$out['stats']['ranged']['dmgMax'] = (string) $xml->characterInfo->characterTab->ranged->damage['max'];
		$out['stats']['ranged']['Speed'] = (string) $xml->characterInfo->characterTab->ranged->damage['speed'];
		$out['stats']['ranged']['dps'] = (string) $xml->characterInfo->characterTab->ranged->damage['dps'];
		$out['stats']['ranged']['crit'] = (string) $xml->characterInfo->characterTab->ranged->critChance['percent'];
		$out['stats']['ranged']['critRating'] = (string) $xml->characterInfo->characterTab->ranged->critChance['rating'];
		$out['stats']['ranged']['hitRating'] = (string) $xml->characterInfo->characterTab->ranged->hitRating['value'];
		$out['stats']['ranged']['attackPower'] = (string) $xml->characterInfo->characterTab->ranged->power['effective'];
		//caster
		$out['stats']['caster']['spellPower'] = (string) $xml->characterInfo->characterTab->spell->bonusDamage->holy['value'];
		$out['stats']['caster']['spellPen'] = (string) $xml->characterInfo->characterTab->spell->penetration['value'];
		$out['stats']['caster']['spellCrit'] = (string) $xml->characterInfo->characterTab->spell->critChance->holy['percent'];
		$out['stats']['caster']['spellCritRating'] = (string) $xml->characterInfo->characterTab->spell->critChance['rating'];
		$out['stats']['caster']['spellHasteRating'] = (string) $xml->characterInfo->characterTab->spell->hasteRating['hasteRating'];
		$out['stats']['caster']['spellHaste'] = (string) $xml->characterInfo->characterTab->spell->hasteRating['hastePercent'];
		$out['stats']['caster']['spellHitPercent'] = (string) $xml->characterInfo->characterTab->spell->hitRating['increasedHitPercent'];
		$out['stats']['caster']['spellHitRating'] = (string) $xml->characterInfo->characterTab->spell->hitRating['value'];
		$out['stats']['caster']['mana5'] = (string) $xml->characterInfo->characterTab->spell->manaRegen['notCasting'];
		$out['stats']['caster']['mana5Combat'] = (string) $xml->characterInfo->characterTab->spell->manaRegen['casting'];
		//def
		$out['stats']['def']['armor'] = (string) $xml->characterInfo->characterTab->defenses->armor['base'];
		$out['stats']['def']['baseDefense'] = (string) $xml->characterInfo->characterTab->defenses->defense['value'];
		$out['stats']['def']['defense'] = (string) $xml->characterInfo->characterTab->defenses->defense['value'] + $xml->characterInfo->characterTab->defenses->defense['plusDefense'];
		$out['stats']['def']['defenseRating'] = (string) $xml->characterInfo->characterTab->defenses->defense['rating'];
		$out['stats']['def']['dodgeChance'] = (string) $xml->characterInfo->characterTab->defenses->dodge['percent'];
		$out['stats']['def']['dodgeRating'] = (string) $xml->characterInfo->characterTab->defenses->dodge['rating'];
		$out['stats']['def']['parryChance'] = (string) $xml->characterInfo->characterTab->defenses->parry['percent'];
		$out['stats']['def']['parryRating'] = (string) $xml->characterInfo->characterTab->defenses->parry['rating'];
		$out['stats']['def']['blockChance'] = (string) $xml->characterInfo->characterTab->defenses->block['percent'];
		$out['stats']['def']['blockRating'] = (string) $xml->characterInfo->characterTab->defenses->block['rating'];
		$out['stats']['def']['resilienceRating'] = (string) $xml->characterInfo->characterTab->defenses->resilience['value'];
		$out['stats']['def']['resilienceHitPercent'] = (string) $xml->characterInfo->characterTab->defenses->resilience['hitPercent'];
		$out['stats']['def']['resilienceDamagePercent'] = (string) $xml->characterInfo->characterTab->defenses->resilience['damagePercent'];
        return $out;
	}

	static function HandleArmoryQuirks($xml) {
		// Armory has several issues currently:
		// - Armor Penetration is missing (WIP)
		// - Expertise is missing (WIP)
		// - Hit Percentage is inaccurate (FIXED)
		// - Melee Haste Percentage is missing (TODO)
		// - Spell Penetration is missing (WIP)
		// - Defense Rounding is slightly off (TODO, Note: has Diminishing Return!)
		// - Some Items are missing Enchantment Ids but they show names, description and icon.... (FIXED)
		// - Some Titles are shown as prefix instead of suffix... (FIXED)
		// - Offhand Damage Min/Max/Dps/Speed is missing (TODO)
		// Let's calculate them here!

		$expertise = 0;
		$armorpen = 0;
		$spellpen = 0;
		$gems = array();

		// items
		foreach ($xml['items'] as $slot => $item)
		{
			if (isset($item['stats'][ItemStats::ITEM_MOD_ARMOR_PENETRATION_RATING]))
				$armorpen += $item['stats'][ItemStats::ITEM_MOD_ARMOR_PENETRATION_RATING];
			if (isset($item['stats'][ItemStats::ITEM_MOD_EXPERTISE_RATING]))
				$expertise += $item['stats'][ItemStats::ITEM_MOD_EXPERTISE_RATING];
			if (isset($item['stats'][ItemStats::ITEM_MOD_SPELL_PENETRATION]))
				$spellpen += $item['stats'][ItemStats::ITEM_MOD_SPELL_PENETRATION];
		
			// count gems
			foreach ($item['gems'] as $gemslot => $gem)
			{
				if (!isset($gem['id']))
					continue;
				elseif (isset($gems[$gem['id']]))
					$gems[$gem['id']]++;
				else
					$gems[$gem['id']] = 1;

				// fix missing socket color for prismatic gems
				if (!isset($gem['socketColor']))
					$xml['items'][$slot]['gems'][$gemslot]['socketColor'] = 1;
			}

			// socket bonus (TODO)
		}

		// gems
		foreach ($gems as $id => $count)
		{
			// needs to be reworked to use dbc data...somehow (GemProperties.dbc)
			switch ($id) {
				case 40117:
					$armorpen += $count * 20;
					break;
				case 42153:
					$armorpen += $count * 34;
					break;
				case 40140:
					$armorpen += $count * 10;
					break;
				case 40122:
					$spellpen += $count * 25;
					break;
				case 40182:
				case 40135:
					$spellpen += $count * 13;
					break;
				// TODO: add more gems (temporary)
				default: // all other gems, non relevant...
					break;
			}
		}

		// talents (TODO)

		// racial bonuses
		$expertiseBonus = array();

		// determine weapon types
		for ($i = 16; $i <= 17; $i++)
		{
			if (!isset($xml['items'][$i]))
				continue;
	
			$query = "SELECT subclass FROM item_template WHERE entry = ".$xml['items'][$i]['id']."";
			$result = mysql_query($query);
			$row = mysql_fetch_assoc($result);

			$subclass = intval($row['subclass']);

			switch ($xml['raceId'])
			{
				case 1:
				# - Humans get +3 expertise with One or Two-Handed Swords and Maces.
					if (in_array($subclass, array(7, 8, 4, 5)))
						$expertiseBonus[$i] = 3;
					break;
				case 2:
				# - Orcs get +5 expertise with One and Two-Handed Axes, and Fist Weapons.
					if (in_array($subclass, array(0, 1, 13)))
						$expertiseBonus[$i] = 5;
					break; 
				case 3:
				# - Dwarves get +5 expertise with One and Two-Handed Maces.
					if (in_array($subclass, array(4, 5)))
						$expertiseBonus[$i] = 5;
					break;
			}
		}

		// some enchants come without an item like every crafting bonus, so translate to spellid
		$_enchant_name_to_spell = array();
		// Tailoring
		$_enchant_name_to_spell["Sanctified Spellthread"] = 56039;
		$_enchant_name_to_spell["Master's Spellthread"] = 56034;
		$_enchant_name_to_spell["Lightweave Embroidery"] = 55642;
		$_enchant_name_to_spell["Darkglow Embroidery"] = 55769;
		$_enchant_name_to_spell["Swordguard Embroidery"] = 55777;
		// Engineering
		$_enchant_name_to_spell["Hyperspeed Accelerators"] = 54999;
		$_enchant_name_to_spell["Hand-Mounted Pyro Rocket"] = 54998;
		$_enchant_name_to_spell["Frag Belt"] = 54793;
		$_enchant_name_to_spell["Nitro Boosts"] = 55016;
		$_enchant_name_to_spell["Reticulated Armor Webbing"] = 63770;
		$_enchant_name_to_spell["Flexweave Underlay"] = 55002;
		$_enchant_name_to_spell["Springy Arachnoweave"] = 63765;
		// Leatherworking
		$_enchant_name_to_spell["Nerubian Leg Reinforcements"] = 60584;
		$_enchant_name_to_spell["Jormungar Leg Reinforcements"] = 60583;
		$_enchant_name_to_spell["Fur Lining - Attack Power"] = 57683;
		$_enchant_name_to_spell["Fur Lining - Stamina"] = 57690;
		$_enchant_name_to_spell["Fur Lining - Spell Power"] = 57691;
		$_enchant_name_to_spell["Fur Lining - Fire Resist"] = 57692;
		$_enchant_name_to_spell["Fur Lining - Frost Resist"] = 57694;
		$_enchant_name_to_spell["Fur Lining - Shadow Resist"] = 57696;
		$_enchant_name_to_spell["Fur Lining - Nature Resist"] = 57699;
		$_enchant_name_to_spell["Fur Lining - Arcane Resist"] = 57701;
		// Inscription
		$_enchant_name_to_spell["Master's Inscription of the Axe"] = 61117;
		$_enchant_name_to_spell["Master's Inscription of the Crag"] = 61118;
		$_enchant_name_to_spell["Master's Inscription of the Pinnacle"] = 61119;
		$_enchant_name_to_spell["Master's Inscription of the Storm"] = 61120;
		// Enchanting
		$_enchant_name_to_spell["Enchant Ring - Greater Spellpower"] = 44636;
		$_enchant_name_to_spell["Enchant Ring - Assault"] = 44645;
		$_enchant_name_to_spell["Enchant Ring - Stamina"] = 59636;
		// Runeforging
		$_enchant_name_to_spell["Rune of Razorice"] = 53343;
		$_enchant_name_to_spell["Rune of Cinderglacier"] = 53341;
		$_enchant_name_to_spell["Rune of the Fallen Crusader"] = 53344;
		$_enchant_name_to_spell["Rune of the Stoneskin Gargoyle"] = 62158;

		foreach ($xml['items'] as $slot => $item)
		{
			if (!isset($item['permanentEnchantItemId']))
				continue;
			if ($item['permanentEnchantItemId'] != 0 || !isset($item['permanentEnchantSpellName']))
				continue;
			$xml['items'][$slot]['permanentEnchantSpellId'] = $_enchant_name_to_spell[$item['permanentEnchantSpellName']];
		}

		// wrong title position
		if ($xml['prefix'] == "der Unsterbliche")
		{
			$xml['suffix'] = $xml['prefix'];
			$xml['prefix'] = "";
		}

		// export back to xml
		$xml['stats']['melee']['expertiseRating'] = $expertise;
		$xml['stats']['melee']['expertise'] = $expertise / 8.230769231;
		$xml['stats']['melee']['expertiseMainHand'] = $xml['stats']['melee']['expertise'];
		if (isset($expertiseBonus[16])) // mh bonus
			$xml['stats']['melee']['expertiseMainHand'] += $expertiseBonus[16];
		$xml['stats']['melee']['expertiseOffHand'] = $xml['stats']['melee']['expertise'];
		if (isset($expertiseBonus[17])) // oh bonus
			$xml['stats']['melee']['expertiseOffHand'] += $expertiseBonus[17];

		$xml['stats']['melee']['arpRating'] = $armorpen;
		$xml['stats']['melee']['arpPercent'] = $armorpen / 13.99;

		$xml['stats']['caster']['spellPen'] = $spellpen;

		$xml['stats']['melee']['hitPercent'] = $xml['stats']['melee']['hitRating'] /  32.775;
		$xml['stats']['caster']['spellHitPercent'] = $xml['stats']['caster']['spellHitRating'] / 26.231818182;

		return $xml;

	}
	static function checkGemBonus($items)
	{
		$gems = array();
		foreach ($items as $item)
			if (isset($item['gems']))
				foreach ($item['gems'] as $gem)
					if (isset($gem['id']))
						$gems[$gem['id']] = true;

		$query = "SELECT id, name, color FROM test.socket_stats2 WHERE id IN (".implode(",", array_keys($gems)).")";
		unset($gems);
		$result = mysql_query($query);

		$color = array();
		while ($row = mysql_fetch_assoc($result))
			$color[$row['id']] = $row['color'];
		foreach ($items as $slot => $item)
		{
			if (!isset($item['gems']))
				continue;
			foreach ($item['gems'] as $gemslot => $gem)
			{
				if (isset($gem['id']) AND !isset($color[$gem['id']]))
				{
					echo "Missing Gem Entry ".$gem['id']."<br />";
					$items[$slot]['socketBonusActive'] = false;
					break;
				}
				// empty socket
				if (!isset($gem['id']))
				{
					$items[$slot]['socketBonusActive'] = false;
					break; // break, because activation can't happen anymore
				}


				// evaluate gem for sockets
				$c = $color[$gem['id']];
				$items[$slot]['gems'][$gemslot]['gemColor'] = $c;

				$result = false;
				if ($c == SocketColor::Prismatic) // gem is prismatic, fits everywhere
					$result = true;
				else {
                    if(!isset($gem['socketColor'])) break; 
					switch ($gem['socketColor']) {
						case SocketColor::Red: // socket is red
							if ($c == SocketColor::Red || $c == SocketColor::Orange || $c == SocketColor::Violet)
								$result = true;
							break;
						case SocketColor::Yellow: // socket is yellow
	                                                if ($c == SocketColor::Yellow || $c == SocketColor::Orange || $c == SocketColor::Green)
	                                                        $result = true;
	                                                break;
						case SocketColor::Blue: // socket is blue
	                                                if ($c == SocketColor::Blue || $c == SocketColor::Green || $c == SocketColor::Violet)
	                                                        $result = true;
	                                                break;
						case SocketColor::Meta: // no need to recheck here, because we established earlier, that there is a socket in here
						case SocketColor::Prismatic:
							$result = true;
                            break;
					}
				}

				if (!isset($items[$slot]['gems']['socketBonusActive']))
				{
					$items[$slot]['socketBonusActive'] = $result;
					$items[$slot]['gems'][$gemslot]['matching'] = $result;
                    
				}
				else
					$items[$slot]['socketBonusActive'] &= $result;

				if (!$result)
					break;			
			}
		}
		return $items;
	}
    
    static function lookup_SockelBonus($items)
    { 
    	$boni = array();
		foreach ($items as $item)
			if (isset($item['socketBonus']))
						$boni[$item['socketBonus']] = true;
        $query = "SELECT  `id`, `stat_type1`, `stat_value1` FROM `test`.`socket_bonus` WHERE id IN (".implode(",", array_keys($boni)).")";
		$result = mysql_query($query);
        $boni = array();
		while ($row = mysql_fetch_assoc($result))
			$boni[$row['id']] = array('stat_type1' => $row['stat_type1'], 'stat_value1' => $row['stat_value1']);
        foreach ($items as $i => $item)
        {
            if($items[$i]['socketBonus'] == 0)
                continue;
            if(isset($items[$i]['socketBonus']))
            {
                if(!isset($boni[$item['socketBonus']]))
                {
                    global $tpl;
                    $tpl->print_error('Undefined SockelBonus ID: '.$item['socketBonus'].' ItemID: '.$items[$i]['id']);
                    continue;
                }                
                $items[$i]['socketBonus'] = array(
                                                  'stat_type1' => $boni[$item['socketBonus']]['stat_type1'],
                                                  'stat_value1' => $boni[$item['socketBonus']]['stat_value1']
                                                  );
            }
        }
    return($items);
        
    }

	//############## ARENA/PvP #######################
	public function getArenaTeams($teamSize = 2, $limit = 20)
	{
		$out = array();
		$xml = $castleImport::getXML($castleImport::armoryUrl.'arena-ladder.xml?ts='.$teamSize.'&b=WoW-Castle&sf=rating&sd=d');
		if($xml === false)
			return false;
		$maxPage = (int) $xml->arenaLadderPagedResult['maxPage'];
		for($i=0; $i<=$maxPage; $i++)
		{
			if($i != 0) //0 is already loaded
				$xml =  $this->getXML($castleImport::armoryUrl.'arena-ladder.xml?p='.($i+1).'&ts='.$teamSize.'&b=WoW-Castle&sf=rating&sd=d');
			
			//work with the data
			foreach($xml->arenaLadderPagedResult->arenaTeams->arenaTeam as $row)
			{
				if(count($out) > ($limit-1))
					break;
				$out[] = array(
					'name' => (string) $row['name'],
					'rating' => (int) $row['rating'],
					'gamesPlayed' => (int) $row['gamesPlayed'],
					'gamesWon' => (int) $row['gamesWon'],
					'seasonGamesWon' => (int) $row['seasonGamesWon'],
					'seasonGamesPlayed' => (int) $row['seasonGamesPlayed'],
					'factionId' => (int) $row['factionId']
				);
			}
		}
		return $out;
	}
	
	public function getArenaTeam($name)
	{
		$out = array();
		$name = str_replace(" ", "+", $name); 
		$xml = $castleImport::getXML($castleImport::armoryUrl.'team-info.xml?b=WoW-Castle&r=WoW-Castle+PvE&select='.$name);
		if($xml === false)
			return false;
		foreach($xml->teamInfo->arenaTeam->members->character as $row)
		{
			$out[] = array(
				'name' => (string) $row['name'],
				'classId' => (int) $row['classId'],
				'games' => (int) $row['seasonGamesPlayed'],
				'wins' => (int) $row['seasonGamesWon']
			);
		}
		return $out;
	}
	

	private static function getXML($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.1.12) Gecko/20080201 Firefox/2.0.0.12");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: de-de, de;"));
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1500);     
		$content = curl_exec ($ch);
		curl_close ($ch);
		try{
			$xml = new SimpleXMLElement($content);
		} 
		catch (Exception $e) {
			return false;
		} 
		return $xml;
	}
}

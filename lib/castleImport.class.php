<?php
class castleImport
{
	private $armoryUrl = 'http://armory.wow-castle.de/';
	
	public function getChar($name)
	{
		$out = array();
		$xml = $this->getXML($this->armoryUrl.'character-sheet.xml?r=WoW-Castle+PvE&cn='.$name);
		if($xml->characterInfo->character['name'] == false)
			return false;

		$out['name'] = (string) $xml->characterInfo->character['name'];
		$out['prefix'] = (string) $xml->characterInfo->character['prefix'];
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
		foreach($xml->characterInfo->characterTab->items->item as $item) 
		{
	
			$out['items'][(string)$item['slot']]['id']  = (string) $item['id'];
			$out['items'][(string)$item['slot']]['name']  = (string) $item['name'];
			$out['items'][(string)$item['slot']]['level']  = (int) $item['level'];
			$out['items'][(string)$item['slot']]['rarity']  = (int) $item['rarity'];
			$out['items'][(string)$item['slot']]['icon']  = (int) $item['icon'];
			for($i=0;!empty($item['gem'.$i.'Id']);$i++)
			{
				$out['items'][(string)$item['slot']]['gemIds'][$i] = (int) $item['gem'.$i.'Id'];
			}
			$out['items'][(string)$item['slot']]['permanentEnchantItemId']  = (int) $item['permanentEnchantItemId'];
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
		$out['stats']['melee']['hasteRating'] = (string) $xml->characterInfo->characterTab->spell->hasteRating['hasteRating'];
		$out['stats']['melee']['crit'] = (string) $xml->characterInfo->characterTab->melee->critChance['percent'];
		$out['stats']['melee']['hitRating'] = (string) $xml->characterInfo->characterTab->melee->hitRating['increasedHitRating'];
		$out['stats']['melee']['hitPercent'] = (string) $xml->characterInfo->characterTab->melee->hitRating['increasedHitPercent'];
		$out['stats']['melee']['expertise'] = (string) $xml->characterInfo->characterTab->melee->expertise['value'];
		$out['stats']['melee']['arpPercent'] = (string) $xml->characterInfo->characterTab->melee->hitRating['reducedArmorRating']; 
		$out['stats']['melee']['arpPercent'] = (string) $xml->characterInfo->characterTab->melee->hitRating['reducedArmorPercent']; 
		//ranged
		$out['stats']['ranged']['dmgMin'] = (string) $xml->characterInfo->characterTab->ranged->damage['min'];
		$out['stats']['ranged']['dmgMax'] = (string) $xml->characterInfo->characterTab->ranged->damage['max'];
		$out['stats']['ranged']['Speed'] = (string) $xml->characterInfo->characterTab->ranged->damage['speed'];
		$out['stats']['ranged']['dps'] = (string) $xml->characterInfo->characterTab->ranged->damage['dps'];
		$out['stats']['ranged']['expertise'] = (string) $xml->characterInfo->characterTab->melee->expertise['value'];
		$out['stats']['ranged']['crit'] = (string) $xml->characterInfo->characterTab->ranged->critChance['percent'];
		$out['stats']['ranged']['hitRating'] = (string) $xml->characterInfo->characterTab->ranged->hitRating['percent'];
		$out['stats']['ranged']['attackPower'] = (string) $xml->characterInfo->characterTab->ranged->power['effective'];
		//caster
		$out['stats']['caster']['spellPower'] = (string) $xml->characterInfo->characterTab->spell->bonusDamage->holy['value'];
		$out['stats']['caster']['spellPen'] = (string) $xml->characterInfo->characterTab->spell->penetration['value'];
		$out['stats']['caster']['spellCrit'] = (string) $xml->characterInfo->characterTab->spell->critChance->holy['percent'];
		$out['stats']['caster']['spellCritRating'] = (string) $xml->characterInfo->characterTab->spell->critChance['rating'];
		$out['stats']['caster']['spellHitPercent'] = (string) $xml->characterInfo->characterTab->spell->hitRating['increasedHitPercent'];
		$out['stats']['caster']['spellHitRating'] = (string) $xml->characterInfo->characterTab->spell->hitRating['value'];
		$out['stats']['caster']['mana5'] = (string) $xml->characterInfo->characterTab->spell->manaRegen['notCasting'];
		$out['stats']['caster']['mana5Combat'] = (string) $xml->characterInfo->characterTab->spell->manaRegen['casting'];
		//def
		$out['stats']['def']['armor'] = (string) $xml->characterInfo->characterTab->defenses->armor['base'];
		$out['stats']['def']['dodge'] = (string) $xml->characterInfo->characterTab->defenses->dodge['percent'];
		$out['stats']['def']['dodgeRating'] = (string) $xml->characterInfo->characterTab->defenses->dodge['rating'];
		$out['stats']['def']['parry'] = (string) $xml->characterInfo->characterTab->defenses->parry['percent'];
		$out['stats']['def']['parryRating'] = (string) $xml->characterInfo->characterTab->defenses->parry['rating'];
		$out['stats']['def']['block'] = (string) $xml->characterInfo->characterTab->defenses->block['percent'];
		$out['stats']['def']['blockRating'] = (string) $xml->characterInfo->characterTab->defenses->block['rating'];
		$out['stats']['def']['resilienceRating'] = (string) $xml->characterInfo->characterTab->defenses->resilience['value'];
		$out['stats']['def']['resilienceHitPercent'] = (string) $xml->characterInfo->characterTab->defenses->resilience['hitPercent'];
		$out['stats']['def']['resilienceDamagePercent'] = (string) $xml->characterInfo->characterTab->defenses->resilience['damagePercent'];
		return ($out);
	}
	
	//############## ARENA/PvP #######################
	public function getArenaTeams($teamSize = 2, $limit = 20)
	{
		$out = array();
		$xml = $this->getXML($this->armoryUrl.'arena-ladder.xml?ts='.$teamSize.'&b=WoW-Castle&sf=rating&sd=d');
		if($xml === false)
			return false;
		$maxPage = (int) $xml->arenaLadderPagedResult['maxPage'];
		for($i=0; $i<=$maxPage; $i++)
		{
			if($i != 0) //0 is already loaded
				$xml =  $this->getXML($this->armoryUrl.'arena-ladder.xml?p='.($i+1).'&ts='.$teamSize.'&b=WoW-Castle&sf=rating&sd=d');
			
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
		$xml = $this->getXML($this->armoryUrl.'team-info.xml?b=WoW-Castle&r=WoW-Castle+PvE&select='.$name);
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
	
	private function getXML($url)
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

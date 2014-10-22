<?php

namespace Doomsta\CastleApi;


use Exception;
use SimpleXMLElement;

class CastleApi
{

    private $armoryBaseUrl = 'http://armory.wow-castle.de/';
    private $armoryCharUrl = 'character-sheet.xml?r=WoW-Castle+PvE&cn=';
    private $apiUrl = 'http://www.wow-castle.de/bboard/xmlchars.html';
    private $avListUrl = 'http://www.wow-castle.de/bboard/index.php?page=NovaContent4List';

    public function __construct()
    {

    }

    public function getCharFromArmory($name)
    {
        $charUrl = $this->armoryBaseUrl.$this->armoryCharUrl.$name;
        try {
            if ($xml = self::fetchXmlDocument($charUrl)) {
                $char = new Char($xml);
                if($char->isValid()) {
                    return $char;
                }
            }
        } catch(Exception $e) {
            return null;
        }
        return null;
    }

    public function getGuildsFromArmory($name)
    {

    }

    public function getApiData()
    {

    }

    public function getAvListCharNames()
    {
        $charNames = array();
        $pattern = '/http:\/\/wow-castle.de\/armory\/character-sheet\.xml\?r=WoW-Castle\+PvE&amp;cn=([^"]*)/';
        $content = self::fetchDocument($this->avListUrl);
        preg_match_all($pattern, $content, $charNames);
        return array_values(array_unique($charNames[1]));
    }

    public function getArenaTeamNames($ts = 2)
    {
        $result = array();
        $xml = self::fetchXmlDocument($this->armoryBaseUrl.'arena-ladder.xml?ts='.$ts.'&b=WoW-Castle');
        $maxPage = (int) $xml->arenaLadderPagedResult['maxPage'];
        for ($i = 1; $i <= $maxPage; $i++) {
            $xml = self::fetchXmlDocument($this->armoryBaseUrl.'arena-ladder.xml?ts='.$ts.'&b=WoW-Castle&p='.$i.'&sf=rating&sd=a');
            foreach($xml->arenaLadderPagedResult->arenaTeams->arenaTeam as $team) {
                $result[] = (string) $team['name'];
            }
        }
        return $result;
    }

    /**
     * @param string $url
     * @return bool|SimpleXMLElement
     */
    protected static function fetchXmlDocument($url)
    {
        try{
            $xml = new SimpleXMLElement(self::fetchDocument($url));
        } catch (Exception $e) {
            return false;
        }

        return $xml;
    }

    /**
     * @param string $url
     * @return string
     */
    protected static function fetchDocument($url)
    {
        return file_get_contents($url);
    }
} 
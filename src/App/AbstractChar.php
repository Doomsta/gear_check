<?php
/**
 * Created by IntelliJ IDEA.
 * User: Doomsta
 * Date: 22.10.2014
 * Time: 16:44
 */

namespace App;


abstract class AbstractChar
{

    private $genderId;
    private $raceId;
    private $classId;
    private $prefix;
    private $suffix;
    private $level;
    private $guildName;
    private $achievementPoints;

    /**
     * @return int
     */
    public function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * @param int $raceId
     */
    public function setRaceId($raceId)
    {
        $this->raceId = $raceId;
    }

    /**
     * @return int
     */
    public function getGenderId()
    {
        return $this->genderId;
    }

    /**
     * @param int $genderId
     */
    public function setGenderId($genderId)
    {
        $this->genderId = $genderId;
    }

    /**
     * @return int
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * @param int $classId
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return (int) $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getGuildName()
    {
        return $this->guildName;
    }

    /**
     * @param string $guild
     */
    public function setGuildName($guild)
    {
        $this->guildName = $guild;
    }

    /**
     * @return int
     */
    public function getAchievementPoints()
    {
        return $this->achievementPoints;
    }

    /**
     * @param int $achievementPoints
     */
    public function setAchievementPoints($achievementPoints)
    {
        $this->achievementPoints = $achievementPoints;
    }

} 
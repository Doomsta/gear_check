<?php
namespace App\Model\Entity;


use App\Model\EquipCollection;

class ItemSet
{
    private $id;
    private $name;
    private $itemIds =array();
    /** @var  EquipCollection */
    private $equipCollection;


    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int|void
     */
    public function getSetSize()
    {
        return count($this->itemIds);
    }

    /**
     * @return Item[]
     */
    public function getEquipedSetItems()
    {
        $result = array();
        foreach ($this->equipCollection->getItems() as $item) {
            if (array_key_exists($item->getId(), $this->itemIds)) {
                $result[] = $item;
            }
        }
        return $result;
    }

    /**
     * @param int
     */
    public function addItem($id)
    {
        $this->itemIds[$id] = $id;
    }

    /**
     * @return int
     */
    public function getItemIds()
    {
        return $this->itemIds;
    }

    /**
     * @param EquipCollection $equipCollection
     */
    public function setEquipCollection($equipCollection)
    {
        $this->equipCollection = $equipCollection;
    }

} 
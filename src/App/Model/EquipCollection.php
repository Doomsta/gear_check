<?php

namespace App\Model;


use App\Model\Entity\Item;

class EquipCollection implements \ArrayAccess
{
    private $items;
    private $slotOrder = array( 1, 2, 3, 15, 5, 4, 19, 9, 10, 6, 7, 8, 11, 12, 13, 14, 16, 17, 18);

    public function __construct()
    {

    }

    public function addItem(Item $item)
    {
        throw new \Exception('TODO');
    }

    /**
     * @TODO validate insert
     * @param $slot
     * @param Item $item
     */
    public function setItem($slot, Item $item)
    {
        $this->items[$slot] = $item;
    }

    public function removeItem($slot)
    {
        unset($this->items[$slot]);
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @TODO handle empty slots
     * @param $slot
     * @return Item
     */
    public function getItemBySlot($slot)
    {
        return $this->items[$slot];
    }

    public function getItemBySlotId($slotId)
    {
        if(!$this->offsetExists($this->slotOrder[$slotId])) {
            return null;
        }
        return $this->items[$this->slotOrder[$slotId]];
    }

    /**
     * @return StatCollection
     */
    public function getStatCollection()
    {
        $stats = new StatCollection();
        foreach ($this->getItems() as $item) {
            $stats->merge($item->getStatCollection());
        }
        return $stats;
    }

    /**
     * @return float
     */
    public function getAvgItemLevel()
    {
        $avg = 0;
        foreach ($this->getItems() as $slot => $item) {
            if ($slot === 4 or $slot === 19) {
                continue;
            }
            $avg += $item->getLevel();
        }
        if (isset($this->getItems()[16]) && isset($this->getItems()[17])) {
            $tmp = round(($avg / 17), 1);
        } else {
            $tmp = round(($avg / 16), 1);
        }
        return $tmp;
    }

    ###### ARRAY ACCESS #######
    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset
     * An offset to check for.
     * @return boolean true on success or false on failure.
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->getItemBySlot($offset);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset
     * The offset to assign the value to.
     * @param mixed $value
     * The value to set.
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->setItem($offset, $value);
    }

    /**
     * Offset to unset
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->removeItem($offset);
    }
}
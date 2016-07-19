<?php
namespace vedebel\directv5\Common;

class ItemsArray extends Object
{
    /**
     * ItemsArray constructor.
     * @param array|null $items
     */
    public function __construct(array $items = [])
    {
        parent::__construct(['items' => $items]);
    }

    /**
     * @param $item
     */
    public function addItem($item)
    {
        $this->attributes['items'][] = $item;
    }

    /**
     * @param array $items
     */
    public function addItems(array $items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @return array
     */
    public function getItems(){
        return $this->has('items') ? $this->get('items') : [];
    }

    /**
     *
     */
    public function jsonSerialize()
    {
        if ($this->has('items')) {
            return parent::jsonSerialize();
        }

        return 'null';
    }
}
<?php

namespace oKanban\Models;

use oFramework\Models\CoreModel;

class ListModel extends CoreModel
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $order;

        /**
     * Get the value of name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of order
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of order
     *
     * @param int $order
     *
     * @return self
     */
    public function setOrder(int $order)
    {
        $this->order = $order;

        return $this;
    }
}

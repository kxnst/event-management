<?php

namespace App\Entity\Traits;

/**
 * @property $parent
 */
trait HasParentTrait
{
    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

}
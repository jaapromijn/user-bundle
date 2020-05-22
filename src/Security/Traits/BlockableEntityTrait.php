<?php

declare(strict_types=1);

/*
 * This file is part of the user bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\UserBundle\Security\Traits;

use ConnectHolland\UserBundle\Entity\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait BlockableEntityTrait
{
    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $blocked = false;

    public function isBlocked(): bool
    {
        return $this->blocked;
    }

    public function block(): self
    {
        $this->blocked = true;

        return $this;
    }

    public function unblock(): self
    {
        $this->blocked = false;

        return $this;
    }
}

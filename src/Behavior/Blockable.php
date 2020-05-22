<?php

namespace ConnectHolland\UserBundle\Behavior;

interface Blockable
{
    public function block();
    public function unblock();
    public function isBlocked(): bool;
}

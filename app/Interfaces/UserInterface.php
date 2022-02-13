<?php

namespace App\Interfaces;


Interface UserInterface
{
    public function getUser();

    public function getUserById($userId);
}
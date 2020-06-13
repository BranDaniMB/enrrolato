<?php


class Actions extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createFlavor($POST) {
        return true;
    }

    public function createFilling($POST) {
        return true;
    }

    public function createTopping($POST) {
        return true;
    }

    public function createContainer($POST) {
        return true;
    }
}
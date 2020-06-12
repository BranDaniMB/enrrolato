<?php
use Kreait\Firebase\Factory as Factory;

class Base {
    /**
     * @var \Kreait\Firebase\Database
     * @var \Kreait\Firebase\Factory
     */
    private \Kreait\Firebase\Factory $factory;
    private \Kreait\Firebase\Database $database;

    function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount(GOOGLE_APPLICATION_CREDENTIALS);
        $this->database = $this->factory->createDatabase();
    }

    function getReference($reference) {
        return $reference = $this->database->getReference($reference);
    }
}
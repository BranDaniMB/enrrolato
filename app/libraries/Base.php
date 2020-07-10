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

    function registerAudit($action, $type, $name) {
        $reference = $this->getReference(AUDIT . '/' . date("dmYHis"));
        try {
            $reference->set([
                'action' => $action,
                'type' => $type,
                'name' => $name,
                'date' => date("d/m/Y"),
                'hour' => date("H:i:s"),
                'author' => $_SESSION["payload"]["email"]
            ]);
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
        }
    }
}
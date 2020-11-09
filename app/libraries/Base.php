<?php
use Kreait\Firebase\Factory as Factory;

/**
 * MVC - Parent class of the models
 * Class Base
 * Provides the basic connection to the database
 */
class Base {
    /**
     * Firebase PHP SDK
     * @var \Kreait\Firebase\Database
     * @var \Kreait\Firebase\Factory
     */
    private \Kreait\Firebase\Factory $factory;
    private \Kreait\Firebase\Database $database;

    /**
     * Base constructor.
     */
    function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount(GOOGLE_APPLICATION_CREDENTIALS);
        $this->database = $this->factory->createDatabase();
    }

    /**
     * Returns a reference to the database
     * @param $reference
     * @return \Kreait\Firebase\Database\Reference
     */
    function getReference($reference) {
        return $reference = $this->database->getReference($reference);
    }

    /**
     * Provides the way to audit all actions performed
     * @param $action
     * @param $type
     * @param $name
     */
    function registerAudit($action, $type, $name) {
        $reference = $this->getReference(AUDIT . '/' . date("YmdHis"));
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
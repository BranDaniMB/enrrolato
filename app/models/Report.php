<?php

/**
 * MVC - Model
 * Class Report
 * Database Report Model
 */
class Report extends Base
{
    /**
     * Report constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retrieve the audit log
     * @return string - HTML
     */
    function getAudits()
    {
        $reference = $this->getReference(AUDIT)->orderByKey();
        $audits = $reference->limitToLast(50)->getSnapshot()->getValue();
        if (!empty($audits)) {
            $audits = array_reverse($audits);
            $list = "";
            foreach ($audits as &$item) {
                $list .='<li class="list-group-item">' .
                    $this->formatAudit($item) .
                    '</li>';
            }
            return $list;
        } else {
            return "No hay registros de los últimos 7 días.";
        }
    }

    /**
     * Format the text of each record
     * @param $item
     * @return string - HTML
     */
    private function formatAudit($item) {
        $audit = '<strong>'.$item['author'] . "</strong> ha ";
        switch ($item['action']) {
            case 'add':
                if (isset($item['name'])) {
                    $audit .= 'añadido <strong>' . $item['name'] . '</strong> a ';
                } else {
                    $audit .= 'añadido ';
                }
                break;
            case 'edit':
                if (isset($item['name'])) {
                    $audit .= 'editado <strong>' . $item['name'] . '</strong> de ';
                } else {
                    $audit .= 'editado ';
                }
                break;
            case 'delete':
                if (isset($item['name'])) {
                    $audit .= 'eliminado <strong>' . $item['name'] . '</strong> de ';
                } else {
                    $audit .= 'eliminado ';
                }
                break;
        }
        switch ($item['type']) {
            case 'icecream':
                $audit .= '<strong>helados</strong>';
                break;
            case 'flavor':
                $audit .= '<strong>sabores</strong>';
                break;
            case 'filling':
                $audit .= '<strong>rellenos</strong>';
                break;
            case 'topping':
                $audit .= '<strong>toppings</strong>';
                break;
            case 'container':
                $audit .= '<strong>envases</strong>';
                break;
            case 'tempAccount':
                $audit .= '<strong>cuentas por autentificar</strong>';
                break;
            case 'account':
                $audit .= '<strong>cuentas autentificadas</strong>';
                break;
            case 'schedule':
                $audit .= '<strong>horario de disponibilidad</strong>';
                break;
            case 'prices':
                $audit .= 'los <strong>precios</strong>';
        }
        $audit .= ' el <strong>' . $item['date'] . '</strong> a las <strong>' . $item['hour'] . '</strong>.';
        return $audit;
    }
}
<?php

class Report extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    function getAudits()
    {
        $reference = $this->getReference(AUDIT)->orderByKey();
        $audits = $reference->getSnapshot()->getValue();
        $audits = array_reverse($audits);
        if (!empty($audits)) {
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

    private function formatAudit($item) {
        $audit = '<strong>'.$item['author'] . "</strong> ha ";
        switch ($item['action']) {
            case 'add':
                $audit .= 'añadido <strong>' . $item['name'] . '</strong> a ';
                break;
            case 'edit':
                $audit .= 'editado <strong>' . $item['name'] . '</strong> a ';
                break;
            case 'delete':
                $audit .= 'eliminado <strong>' . $item['name'] . '</strong> de ';
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
                $audit .= '<strong>topping\'s</strong>';
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
        }
        $audit .= ' el <strong>' . $item['date'] . '</strong> a las <strong>' . $item['hour'] . '</strong>.';
        return $audit;
    }
}
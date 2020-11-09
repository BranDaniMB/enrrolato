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

    private function getActions() {
        return array('añadir'=>'add'
        ,'editar'=>'edit'
        ,'eliminar'=>'delete');
    }

    private function getObjects() {
        return array('helado'=>'icecream'
        ,'sabor'=>'flavor'
        ,'relleno'=>'filling'
        ,'topping'=>'topping'
        ,'envase'=>'container'
        ,'cuenta no autenticada'=>'tempAccount'
        ,'cuenta autenticada'=>'account'
        ,'horario'=>'schedule'
        ,'precios'=>'prices');
    }

    public function generateOptionsForActionTypes() {
        $actions = $this->getActions();
        $out = "";
        foreach ($actions as $key => $value) {
            $out .= '<option value="'.$value.'">'.$key.'</option>';
        }
        return $out;
    }

    public function generateOptionsForObjectsTypes() {
        $objects = $this->getObjects();
        $out = "";
        foreach ($objects as $key => $value) {
            $out .= '<option value="'.$value.'">'.$key.'</option>';
        }
        return $out;
    }

    private function generateRGBColor() {
        return 'rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')';
    }

    /**
     * @param $POST
     * @return array
     * @throws \Kreait\Firebase\Exception\DatabaseException
     */
    function getEarnings($POST) {
        $startTime = DateTime::createFromFormat('Y-m-d', $POST['earnings_startTime']);
        $endTime = DateTime::createFromFormat('Y-m-d', $POST['earnings_endTime']);
        $reference = $this->getReference(ORDERS);
        $data = array();
        $countTime = DateTime::createFromFormat('Y-m-d', $POST['earnings_startTime']);
        while ($countTime <= $endTime) {
            $date = $countTime->format('d-m-Y');
            $data['labels'][] = $date;
            $data['data'][] = 0;
            $data['backgroundColor'][] = $this->generateRGBColor();
            $countTime->modify('+1 day');
        }
        $ordersList = $reference->getSnapshot()->getValue();
        foreach ($ordersList as $order) {
            $orderDate = DateTime::createFromFormat('d/m/Y H:i:s', $order['date']);
            if ($orderDate >= $startTime && $orderDate <= $endTime) {
                $data['data'][array_search($orderDate->format('d-m-Y'), $data['labels'])] += $order['price'];
            }
        }
        return $data;
    }

    /**
     * @param $POST
     * @return array
     * @throws \Kreait\Firebase\Exception\DatabaseException
     */
    function getQuantityOrders($POST) {
        $startTime = DateTime::createFromFormat('Y-m-d', $POST['quantityOrders_startTime']);
        $endTime = DateTime::createFromFormat('Y-m-d', $POST['quantityOrders_endTime']);
        $reference = $this->getReference(ORDERS);
        $data = array();
        $countTime = DateTime::createFromFormat('Y-m-d', $POST['quantityOrders_startTime']);
        while ($countTime <= $endTime) {
            $date = $countTime->format('d-m-Y');
            $data['labels'][] = $date;
            $data['data'][] = 0;
            $data['backgroundColor'][] = $this->generateRGBColor();
            $countTime->modify('+1 day');
        }
        $ordersList = $reference->getSnapshot()->getValue();
        foreach ($ordersList as $order) {
            $orderDate = DateTime::createFromFormat('d/m/Y H:i:s', $order['date']);
            if ($orderDate >= $startTime && $orderDate <= $endTime) {
                $data['data'][array_search($orderDate->format('d-m-Y'), $data['labels'])] += 1;
            }
        }
        return $data;
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
        $actions = $this->getActions();
        $audit = '<strong>'.$item['author'] . "</strong> ha ";
        switch ($item['action']) {
            case $actions['añadir']:
                if (isset($item['name'])) {
                    $audit .= 'añadido <strong>' . $item['name'] . '</strong> a ';
                } else {
                    $audit .= 'añadido ';
                }
                break;
            case $actions['editar']:
                if (isset($item['name'])) {
                    $audit .= 'editado <strong>' . $item['name'] . '</strong> de ';
                } else {
                    $audit .= 'editado ';
                }
                break;
            case $actions['eliminar']:
                if (isset($item['name'])) {
                    $audit .= 'eliminado <strong>' . $item['name'] . '</strong> de ';
                } else {
                    $audit .= 'eliminado ';
                }
                break;
        }
        $objects = $this->getObjects();
        switch ($item['type']) {
            case $objects['helado']:
                $audit .= '<strong>helados</strong>';
                break;
            case $objects['sabor']:
                $audit .= '<strong>sabores</strong>';
                break;
            case $objects['relleno']:
                $audit .= '<strong>rellenos</strong>';
                break;
            case $objects['topping']:
                $audit .= '<strong>toppings</strong>';
                break;
            case $objects['envase']:
                $audit .= '<strong>envases</strong>';
                break;
            case $objects['cuenta no autenticada']:
                $audit .= '<strong>cuentas por autentificar</strong>';
                break;
            case $objects['cuenta autenticada']:
                $audit .= '<strong>cuentas autentificadas</strong>';
                break;
            case $objects['horario']:
                $audit .= '<strong>horario de disponibilidad</strong>';
                break;
            case $objects['precios']:
                $audit .= 'los <strong>precios</strong>';
        }
        $audit .= ' el <strong>' . $item['date'] . '</strong> a las <strong>' . $item['hour'] . '</strong>.';
        return $audit;
    }
}
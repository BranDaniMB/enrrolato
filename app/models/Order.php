<?php

/**
 * MVC - Model
 * Class Order
 * Database Orders Model
 */
class Order extends Base
{
    /**
     * Order constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function getCardClass($order) {
        if ($order['delivered']) {
            return 'text-light bg-success';
        } elseif ($order['prepared']) {
            return 'text-dark bg-warning';
        } else {
            return 'text-light bg-danger';
        }
    }

    private function generatePreparedButton($key, $order) {
        if ($order['prepared']) {
            if ($order['delivered']) {
                return '<button type="button" class="btn font-weight-bold btn-secondary" onclick="unmarkOrderAsPrepared(\'' . $key . '\')" disabled><small>Deshacer</small><br/>Preparada</button>';
            } else {
                return '<button type="button" class="btn font-weight-bold btn-warning" onclick="unmarkOrderAsPrepared(\'' . $key . '\')"><small>Deshacer</small><br/>Preparada</button>';
            }
        } else {
            return '<button type="button" class="btn font-weight-bold btn-warning" onclick="markOrderAsPrepared(\'' . $key . '\')">Preparada</button>';
        }
    }

    private function generateDeliveredButton($key, $order) {
        if ($order['delivered']) {
            return '<button type="button" class="btn font-weight-bold btn-success" onclick="unmarkOrderAsDelivered(\'' . $key . '\')"><small>Deshacer</small><br/>Entregada</button>';
        } else {
            return '<button type="button" class="btn font-weight-bold btn-success" onclick="markOrderAsDelivered(\'' . $key . '\')">Entregada</button>';
        }
    }

    /**
     * Get queue order list
     * @return string - HTML
     * @throws \Kreait\Firebase\Exception\DatabaseException
     */
    public function getOrdersInQueue()
    {
        $orders = "";
        $orderCount = 1;
        $reference = $this->getReference(ORDERS);
        if ($reference->getSnapshot()->exists()) {
            $ordersList = $reference->getSnapshot()->getValue();
            foreach ($ordersList as $key => $order) {
                if ($order['done']) {
                    continue;
                }
                $iceCreamCount = 1;
                $iceCreams = $order['icecreams'];
                $orders .= '<div class="card ' . ($this->getCardClass($order)) . ' text-center m-3 font-weight-bold">' .
                    '<div class="card-header">' .
                    '<span class="card-title">Ordenado por ' . $order['username'] . '</span><br/>' .
                    '<small class="card-subtitle mb-2">' . $order['date'] . '</small>' .
                    '</div>' .
                    '<div id="order-' . $orderCount . '" class="row">';
                foreach ($iceCreams as $iceCream) {
                    $orders .= '<div class="col">' .
                        '<div class="card-body">' .
                        '<span class="card-title">Helado #' . $iceCreamCount . '</span>' .
                        ($iceCream['plus18'] ? '<br/><small class="card-subtitle">+18</small>' : '') .
                        '</div>' .
                        '<ul class="list-group list-group-flush">' .
                        '<li class="list-group-item">' .
                        '<small>Sabores</small><br/>' .
                        '<span>' . $iceCream['flavor'] . '</span>' .
                        '</li>' .
                        '<li class="list-group-item">' .
                        '<small>Rellenos</small><br/>' .
                        '<span>' . $iceCream['filling'] . '</span>' .
                        '</li>' .
                        '<li class="list-group-item">' .
                        '<small>Toppings</small><br/>' .
                        '<span>' . $iceCream['topping'] . '</span>' .
                        '</li>' .
                        '<li class="list-group-item">' .
                        '<small>Envase</small><br/>' .
                        '<span>' . $iceCream['container'] . '</span>' .
                        '</li>' .
                        '<li class="list-group-item">' .
                        '<small>Precio individual</small><br/>' .
                        '<span>₡' . $iceCream['price'] . '</span>' .
                        '</li>' .
                        '</ul>' .
                        '</div>';
                    $iceCreamCount++;
                }
                $orders .= '</div>' .
                    '<div class="card-body">' .
                    '<small>Precio del pedido</small><br/>' .
                    '<span>₡' . $order['price'] . '</span>' .
                    '</div>' .
                    '<div class="card-body">' .
                    '<small class="font-weight-bold">Marcar como:</small><br/>' .
                    '<div class="btn-group" role="group" aria-label="Basic example">' .
                    ($this->generatePreparedButton($key, $order)) .
                    ($this->generateDeliveredButton($key, $order)) .
                    '<button type="button" class="btn font-weight-bold btn-light" onclick="markOrderAsDone(\'' . $key . '\')">Lista</button>' .
                    '</div>' .
                    '</div>' .
                    '</div>';
            }
            $orderCount++;
        }
        return $orders;
    }
}
<?php


class Base
{
    protected $url = "https://enrrolato-1588267227733.firebaseio.com/";

    public function insertData($file, $data) {
        $file = $this->url . $file . ".json";

        $data = json_encode($data, JSON_FORCE_OBJECT);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/plain'));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {

        } else {

        }

        curl_close($ch);
        unset($ch);
    }

    public function getData($file) {
        $file = $this->url . $file . ".json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        unset($ch);

        $data = json_decode($response, true);
        return $data;
    }
}
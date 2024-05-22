<?php

namespace App;

class Controller
{
    protected $data = [];
    protected $scripts = [];
    protected $errors = [];

    public function render($data = [])
    {
        if (!isset($data['header'])) {
            $data['header'] = 'Commom/Header';
        }

        if (!isset($data['footer'])) {
            $data['footer'] = 'Commom/Footer';
        }

        if (isset($data['message']) && is_array($data['message'])) {
            $data['message'] = implode('<br>', $data['message']);
        }

        $data['scripts'] = $this->scripts;

        include_once(__DIR__ . '/View/' . $data['header'] . '.php');
        include_once(__DIR__ . '/View/' . $data['content'] . '.php');
        include_once(__DIR__ . '/View/' . $data['footer'] . '.php');
    }

    public function addScript($script) {
        $this->scripts[] = $script;
    }
}

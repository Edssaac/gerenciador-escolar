<?php

namespace App;

/**
 * Classe base para gerenciamento dos controladores.
 */
class Controller
{
    protected $data = [];
    protected $scripts = [];
    protected $errors = [];

    /**
     * Método responsável por renderizar uma determinada página e seu conteúdo.
     *  
     * @param array $data
     * @return void
     */
    protected function render(array $data = []): void
    {
        if (!isset($data["header"])) {
            $data["header"] = "Common/Header";
        }

        if (!isset($data["footer"])) {
            $data["footer"] = "Common/Footer";
        }

        if (isset($data["message"])) {
            if (is_array($data["message"])) {
                $data["message"] = implode("<br>", $data["message"]);
            }

            if (!isset($data["message_type"])) {
                $data["message_type"] = "warning";
            }
        }

        $data["scripts"] = $this->scripts;

        include_once(__DIR__ . "/View/" . $data["header"] . ".php");
        include_once(__DIR__ . "/View/" . $data["content"] . ".php");
        include_once(__DIR__ . "/View/" . $data["footer"] . ".php");
    }

    /**
     * Método responsável por renderizar uma determinada página e seu conteúdo.
     *  
     * @param string $script
     * @return void
     */
    protected function addScript(string $script): void
    {
        $this->scripts[] = $script;
    }
}

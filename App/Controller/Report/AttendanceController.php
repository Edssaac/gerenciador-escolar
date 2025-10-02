<?php

namespace App\Controller\Report;

use App\Controller;
use App\Model\ClassModel;
use App\Model\RegistrationModel;

/**
 * Controller responsável por representar um relatório de chamadas.
 */
class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->data["title"] = "Relatório de Chamadas";
        $this->data["content"] = "Report/Attendance";

        $this->addScript("report");
    }

    public function index(): void
    {
        $class = new ClassModel();

        $this->data["classes"] = $class->getClasses();

        $this->render($this->data);
    }

    /**
     * Método responsável por gerar o relatório de chamadas de uma determinada turma.
     *  
     * @return void
     */
    public function report(): void
    {
        $this->data["content"] = "Report/AttendanceTable";
        $this->data["navbar_off"] = true;

        $class = new ClassModel();
        $registration = new RegistrationModel();

        $this->data["class"] = $class->getClass($_POST["id_class"]);
        $this->data["students"] = $registration->getClassStudents($_POST["id_class"]);

        $this->render($this->data);
    }
}

<?php

namespace App\Controller\Report;

use App\Controller;
use App\Model\ClassModel;
use App\Model\RegistrationModel;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Relatório de Chamadas';
        $this->data['content'] = 'Report/Attendance';

        $this->addScript('report');
    }

    public function index()
    {
        $class = new ClassModel();

        $this->data['classes'] = $class->getClasses();

        $this->render($this->data);
    }

    public function report()
    {
        $this->data['content'] = 'Report/AttendanceTable';

        $registration = new RegistrationModel();

        $this->data['students'] = $registration->getClassStudents($_POST['id_class']);

        $this->render($this->data);
    }
}

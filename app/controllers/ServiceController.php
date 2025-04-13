<?php
// /app/controllers/ServiceController.php

require_once __DIR__ . '/../models/Service.php';

class ServiceController {

    public function list() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/index.php");
            exit();
        }
        $serviceModel = new Service();
        $services = $serviceModel->getAll();
        include __DIR__ . '/../views/service/list.php';
    }
}

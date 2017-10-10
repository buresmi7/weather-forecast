<?php

namespace App;

class ServiceLocator {
    private $repository;

    public function __construct(Repository $repository) {
        $this->repository = $repository;
    }

    public function getRepository() {
        return $this->repository;
    }
}

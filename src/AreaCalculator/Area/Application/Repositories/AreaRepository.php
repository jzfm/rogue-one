<?php

namespace Rogue\AreaCalculator\Area\Application\Repositories;

use Rogue\AreaCalculator\Area\Domain\Area;
use Rogue\AreaCalculator\Area\Infraestructure\DAOs\AreaDAO;

class AreaRepository
{

    private AreaDAO $dao;

    public function __construct()
    {
        $this->dao = new AreaDAO();
    }

    public function createArea(string $id, float $areaCalculation): Area
    {
        $area = new Area($id, $areaCalculation);
        $this->dao->save($area);
        return $area;
    }

    public function getAreaById(string $id): Area
    {
        return $this->dao->getById($id);
    }
}

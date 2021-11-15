<?php

namespace Rogue\AreaCalculator\Area\Infraestructure\DAOs;

use Exception;
use Throwable;
use Rogue\AreaCalculator\Area\Domain\Area;
use App\Models\Area as AreaPersistance;
use Rogue\Shared\Infraestructure\Exceptions\PersistanceException;

class AreaDAO
{
    public function save(Area $area)
    {
        $this->persist($area);
    }

    public function getById(string $id): Area
    {
        try {
            $area = AreaPersistance::where('id', '=', $id)->first()->only(['id','area']);
            return new Area($area['id'], $area['area']);
        } catch (\Exception $e) {
            throw PersistanceException::notFound($id);
        } catch (Throwable $t) {
            throw PersistanceException::notFound($id);
        }
    }

    public function persist(Area $area)
    {
        if (AreaPersistance::where('id', '=', $area->getId())->first()) {
            throw PersistanceException::alreadyExist($area->getId());
        }
        try {
            AreaPersistance::Create([
                'id' => $area->getId(),
                'area' => $area->getArea()
            ]);
        } catch (Exception $e) {
            throw PersistanceException::notSaved($area->getId());
        } catch (Throwable $t) {
            throw PersistanceException::notSaved($area->getId());
        }

        return true;
    }
}

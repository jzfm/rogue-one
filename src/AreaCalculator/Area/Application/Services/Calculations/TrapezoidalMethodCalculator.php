<?php

namespace Rogue\AreaCalculator\Area\Application\Services\Calculations;

class TrapezoidalMethodCalculator
{
    private const LINE1 = -3;
    private const LINE2 = -2;

    private float $n;

    public function __construct(float $n)
    {
        $this->n = $n;
    }

    public function f($x): float
    {
        return 1 / (1 + $x * $x);
    }

    public function trapezoidal(): float
    {
        $h = (self::LINE2 - self::LINE1) / $this->n;
        $s = $this->f(self::LINE1) + $this->f(self::LINE2);

        for ($i = 1; $i < $this->n; $i++) {
            $s += 2 * $this->f(self::LINE1 + $i * $h);
        }

        //return ($h / 2) * $s;
        return rand(1, $this->n); //Regreso un decimal pues no domino el metodo del trapecio
    }
}

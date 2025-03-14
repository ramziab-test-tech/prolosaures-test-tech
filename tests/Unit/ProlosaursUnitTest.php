<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ProtectedAreaCalculator;
use Illuminate\Foundation\Testing\WithFaker;

class ProlosaursUnitTest extends TestCase
{
    use WithFaker;

    public function test_get_protected_area_count()
    {
        $service = new ProtectedAreaCalculator();

        $altitudes = "10 20 15 30 25";
        $result = $service->getProtectedAreaCount($altitudes);

        $this->assertIsInt($result);
        $this->assertEquals(2, $result);
    }

    public function test_get_protected_area_count_with_only_zero()
    {
        $service = new ProtectedAreaCalculator();

        $altitudes = "0 0 0 0 0 00";
        $result = $service->getProtectedAreaCount($altitudes);

        $this->assertIsInt($result);
        $this->assertEquals(0, $result);
    }

    public function test_get_protected_area_count_empty()
    {
        $service = new ProtectedAreaCalculator();
        $altitudes = "";
        $result = $service->getProtectedAreaCount($altitudes);

        $this->assertEquals(0, $result);
    }
}

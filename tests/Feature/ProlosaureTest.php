<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProlosaureTest extends TestCase
{
    public function test_calculate_protected_area_valid_request()
    {
        $response = $this->post(route('prolosaurs.calculate'), [
            'altitudes' => "10 20 15 30 25 15 0 50",
            'continentWith' => "8"
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('prolosaurs.result');
        $response->assertViewHas('surface');
        $this->assertSame(4, $response->viewData('surface'));
    }

    public function test_calculate_protected_area_only_empty_value()
    {
        $response = $this->post(route('prolosaurs.calculate'), [
            'altitudes' => "00 0 0 00",
            'continentWith' => "4"
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('prolosaurs.result');
        $response->assertViewHas('surface');
        $this->assertSame(0, $response->viewData('surface'));
    }

    public function test_calculate_protected_area_too_many_values()
    {
        $altitudes = implode(' ', range(1, 100001));

        $response = $this->post(route('prolosaurs.calculate'), [
            'altitudes' => $altitudes,
            'continentWith' => "5"
        ]);

        $response->assertSessionHasErrors([
            'altitudes' => 'Chaque nombre doit être un entier compris entre 0 et 100000.'
        ]);
    }

    public function test_calculate_protected_area_out_of_range()
    {
        $response = $this->post(route('prolosaurs.calculate'), [
            'altitudes' => "10 20 150000 30",
            'continentWith' => "4"
        ]);

        $response->assertSessionHasErrors([
            'altitudes' => sprintf(
                "Chaque nombre doit être un entier compris entre %d et %d.",
                config('constants.ALTITUDE.MIN'),
                config('constants.ALTITUDE.MAX')
            )
        ]);
    }

    public function test_calculate_protected_area_invalid_characters()
    {
        $response = $this->post(route('prolosaurs.calculate'), [
            'altitudes' => "10 20 ABC 30",
            'continentWith' => "4"
        ]);

        $response->assertSessionHasErrors([
            'altitudes' => sprintf(
                "Chaque nombre doit être un entier compris entre %d et %d.",
                config('constants.ALTITUDE.MIN'),
                config('constants.ALTITUDE.MAX')
            )
        ]);
    }

    public function test_calculate_protected_area_invalid_space_between_number()
    {
        $response = $this->post(route('prolosaurs.calculate'), [
            'altitudes' => "10 20 10  30",
            'continentWith' => "4"
        ]);

        $response->assertSessionHasErrors([
            'altitudes' => "Le nombre d'altitudes doit être exactement égal à la largeur du continent."
        ]);
    }

    public function test_calculate_protected_area_empty_request()
    {
        $response = $this->post(route('prolosaurs.calculate'), [
            'altitudes' => "",
            'continentWith' => ""
        ]);

        $response->assertSessionHasErrors(['altitudes']);
        $response->assertSessionHasErrors(['continentWith']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtectedAreaRequest;
use App\Services\ProtectedAreaCalculator;

class ProlosaursController extends Controller
{
    public function __construct(readonly protected ProtectedAreaCalculator $protectedAreaCalculator)
    {
    }

    public function showForm()
    {
        return view('prolosaurs.form');
    }

    public function calculateProtectedArea(ProtectedAreaRequest $request): mixed
    {
        return view('prolosaurs.result',[
            'surface' => $this->protectedAreaCalculator->getProtectedAreaCount($request->altitudes),
        ]);
    }
}

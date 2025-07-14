<?php

namespace App\Http\Controllers;

use App\Http\Services\RejectedService;

use Illuminate\Http\Request;

class RejectedController extends Controller
{
    //
    private RejectedService $rejectedService;

    public function __construct(rejectedService $rejectedService)
    {
        $this->rejectedService = $rejectedService;
    }
}

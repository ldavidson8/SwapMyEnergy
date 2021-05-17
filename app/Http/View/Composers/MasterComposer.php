<?php

namespace App\Http\View\Composers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MasterComposer
{
    protected $request;

    public function __construct(Request $request)
    {
        $this -> request = $request;
    }

    public function compose(View $view)
    {
        $view -> with('mode', $this -> request -> session() -> get('mode', 'business'));
    }
}
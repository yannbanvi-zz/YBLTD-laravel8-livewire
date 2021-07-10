<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Client extends Component
{
    public function render()
    {
        return view('livewire.clients')
                    ->extends('layouts.master')
                    ->section('contenu');
    }
}

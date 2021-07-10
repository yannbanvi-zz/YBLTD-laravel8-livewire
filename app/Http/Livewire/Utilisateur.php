<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Utilisateur extends Component
{
    public function render()
    {
        return view('livewire.utilisateurs')
                    ->extends('layouts.master')
                    ->section('contenu');
    }
}

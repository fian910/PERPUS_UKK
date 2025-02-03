<?php

namespace App\Livewire;

use App\Models\Pustaka;
use Livewire\Component;

class UserHomeComponent extends Component
{
    public function render()
    {
        $layout['title'] = "Beranda";
        
        // Fetch pustaka data to display on the home page
        $data['pustakas'] = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
            ->latest() 
            ->take(6) 
            ->get();

        return view('livewire.user.user-home-component', $data)
            ->extends('components.layouts.user')
            ->section('content')
            ->layoutData($layout);
    }
}
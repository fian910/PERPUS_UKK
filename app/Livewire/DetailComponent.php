<?php

namespace App\Livewire;

use App\Models\Pustaka;
use Livewire\Component;

class DetailComponent extends Component
{
    public $pustakaId;
    
    public function mount($id)
    {
        $this->pustakaId = $id;
    }

    public function render()
    {
        $layout['title'] = "Detail Buku";
        
        $data['pustaka'] = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
            ->findOrFail($this->pustakaId);

        return view('livewire.user.detail-component', $data)
            ->extends('components.layouts.user')
            ->section('content')
            ->layoutData($layout);
    }
}
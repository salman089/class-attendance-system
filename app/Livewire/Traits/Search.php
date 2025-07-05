<?php

namespace App\Livewire\Traits;

use Exception;

trait Search
{
    public $search = '';

    public function updatingSearch()
    {
        try {
            $this->resetPage();
        } catch (Exception $e) {
            $this->emit('$refresh');
        }
    }
}

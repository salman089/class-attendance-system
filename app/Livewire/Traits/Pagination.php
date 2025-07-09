<?php

namespace App\Livewire\Traits;

use Livewire\WithPagination;
use Livewire\Attributes\Session;

trait Pagination
{
    use WithPagination;

    #[Session]
    public $perPage = 25;
    public $filter = 'All';
}

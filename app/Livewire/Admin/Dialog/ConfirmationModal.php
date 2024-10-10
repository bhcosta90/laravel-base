<?php

declare(strict_types = 1);

namespace App\Livewire\Admin\Dialog;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ConfirmationModal extends Component
{
    public function render(): View
    {
        return view('livewire.admin.dialog.confirmation-modal');
    }
}

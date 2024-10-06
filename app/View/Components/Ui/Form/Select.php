<?php

declare(strict_types = 1);

namespace App\View\Components\Ui\Form;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\View\Component;

class Select extends Component
{
    public array $data = [];

    public function __construct(
        protected ?Builder $builder = null
    ) {
        if ($this->builder) {
            $this->data = $this->builder->pluck('name', 'id')->toArray();
        }
    }

    public function render(): View
    {
        return view('components.ui.form.select', [
            'data' => $this->data,
        ]);
    }
}

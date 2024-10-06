<?php

declare(strict_types = 1);

namespace App\View\Components\Ui\Form;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\View\Component;

class Select extends Component
{
    public array $data = [];

    public array $field = ['name', 'id'];

    public function __construct(
        protected ?Builder $queryBuilder = null,
        public bool $join = false
    ) {
        if ($this->queryBuilder instanceof Builder) {
            $this->data = $this->queryBuilder->pluck(...$this->field)->toArray();
        }
    }

    public function render(): View
    {
        return view('components.ui.form.select', [
            'data' => $this->data,
        ]);
    }
}

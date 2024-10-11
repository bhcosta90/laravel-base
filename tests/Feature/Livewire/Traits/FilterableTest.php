<?php

declare(strict_types = 1);

use App\Livewire\Traits\Filterable;
use Livewire\Component;

describe('Livewire/Traits/Filterable -> Feature', function () {
    beforeEach(function () {
        $this->class = new class () extends Component {
            use Filterable;

            public $page = 10;
        };
    });

    it('syncs search tags', function () {
        $tags = ['tag1', 'tag2'];

        $this->class->syncSearch($tags);

        expect($this->class->search)->toBe($tags);
    });

    it('sorts by name', function () {
        $this->class->sortBy('name');
        expect($this->class->sortName)->toBe('name')
            ->and($this->class->sortDirection)->toBe('desc');

        $this->class->sortBy('name');
        expect($this->class->sortDirection)->toBe('asc');

        $this->class->sortBy('name');
        expect($this->class->sortDirection)->toBe('desc');

        $this->class->sortBy('description');
        expect($this->class->sortDirection)->toBe('asc');
    });

    it('reset page', function () {
        $this->class->updatedActive();
        expect($this->class->page)->toBe(10);
    });

});

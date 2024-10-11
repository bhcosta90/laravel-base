<?php

declare(strict_types = 1);

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

describe('Models/Traits/Active -> Test', function () {
    describe('Models/Traits/Active -> Test', function () {
        beforeEach(function () {
            $this->class = new class () extends Model {
                use Active;

                public $timestamps = false;

                protected $table = 'active_test';

                protected $fillable = ['is_active'];
            };

            Schema::create('active_test', function ($table) {
                $table->id();
                $table->boolean('is_active')->nullable();
            });
        });

        it('can scope active records', function () {
            $this->class::create(['is_active' => true]);
            $this->class::create(['is_active' => false]);

            expect($this->class::active()->count())->toBe(1)
                ->and($this->class::active(false)->count())->toBe(1);
        });
    });
});

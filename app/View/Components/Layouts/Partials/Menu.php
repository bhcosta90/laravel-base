<?php

declare(strict_types = 1);

namespace App\View\Components\Layouts\Partials;

use App\Actions\VerifyMenu;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    protected array $menu = [];

    public function __construct(array $menu)
    {
        /** @var VerifyMenu $action */
        $action     = app(VerifyMenu::class);
        $this->menu = $action->handle($menu);
    }

    public function render(): View
    {
        return view('components.layouts.partials.menu', ['menu' => $this->menu]);
    }
}

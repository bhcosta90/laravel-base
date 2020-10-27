<?php

namespace BRCas\Package\Traits\Controller\Api;

use BRCas\Package\Traits\Support\Execute;
use Exception;
use Kris\LaravelFormBuilder\FormBuilder;

trait Create
{
    use Execute;
    
    public abstract function service();

    public abstract function form();

}
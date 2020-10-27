<?php

namespace BRCas\Package\Traits\Controller\Web;

use BRCas\Package\Traits\Support\Execute;
use Exception;
use Kris\LaravelFormBuilder\FormBuilder;

trait Create
{
    use Execute;
    
    public abstract function service();

    public abstract function form();

    public abstract function createView();

    public abstract function routeBegging();

    public function create(FormBuilder $formBuilder){
        $objService = app($this->service());
        
        if(!method_exists($objService, 'create')) throw new Exception(__('Method create not found in service'));

        $form = $formBuilder->create($this->form(), [
            'method' => 'POST',
            'url' => route('admin.users.users.store'),
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('New')
        ]);

        return view($this->createView(), compact('form'));
    }

    public function store(FormBuilder $formBuilder){
        $objService = app($this->service());

        if(!method_exists($objService, 'create')) throw new Exception(__('Method edit not found in service'));

        return $this->execute(function() use($objService, $formBuilder) {

            $objForm = $formBuilder->create($this->form());
            if (!$objForm->isValid()) {
                return redirect()->back()->withErrors($objForm->getErrors())->withInput();
            }

            $this->message = __('Registro atualizado com sucesso');
            $data = $objForm->getFieldValues();
            $obj = $objService->create($data);

            return $this->routeIndex($obj);
        });
    }
}
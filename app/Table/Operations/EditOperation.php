<?php

namespace App\Table\Operations;

class EditOperation extends BaseOperation
{
    public function __construct()
    {
        $this
            ->setName('btn-edit')
            ->setMethod('PUT')
            ->setAttributes([
                'class' => 'btn btn-icon btn-sm btn-info text-white',
            ])
            ->setIcon('bx bx-edit');
    }
}

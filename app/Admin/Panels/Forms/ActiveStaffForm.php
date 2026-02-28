<?php

namespace App\Admin\Panels\Forms;

use App\Facades\SettingHelper;
use App\Forms\BaseForm;
use App\Forms\Fields\InputField;
use App\Models\Setting;

class ActiveStaffForm extends BaseForm
{
    public function setup(): static
    {
        parent::setup();

        return $this
            ->model(Setting::class)
            ->setTitle('Active Staff')
            ->add(
                'max_active_staff',
                InputField::class,
                InputField::make('max_active_staff')
                    ->setLabel('Max Active Staff')
                    ->setType('number')
                    ->setDefaultValue(SettingHelper::get('max_active_staff') ?? '')
                    ->setPlaceholder('Max Active Staff...')
                    ->isRequired()
            );

    }
}

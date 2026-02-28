<?php

namespace App\Forms;

use App\Forms\Fields\BaseField;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

abstract class BaseForm
{
    private array $fields = [];

    protected bool $hasFile = false;

    protected string $view;

    protected string $title;

    private Model $model;

    private string $template;

    private string $class = 'form-control';

    public static function __callStatic($method, $arguments)
    {
        $instance = static::make();

        return $instance->$method(...$arguments);
    }

    public function setup(): static
    {
        $this->view = 'admin.components.forms.base-form';
        $this->template = 'admin.components.forms.base';

        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    public static function make()
    {
        return app(static::class)->setup();
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getField(string $name): ?BaseField
    {
        foreach ($this->fields as $field) {
            if ($field->getName() === $name) {
                return $field;
            }
        }

        return null;
    }

    public function getRoute(): \Illuminate\Routing\Route
    {
        return Route::getCurrentRoute();
    }

    public function hasFile(bool $hasFile = false): static
    {
        $this->hasFile = $hasFile;

        return $this;
    }

    public function getMethod(): string
    {
        return $this->getModel()->getKey() ? 'PUT' : 'POST';
    }

    public function add(string $name, string $type, BaseField $field): static
    {
        $this->fields = array_merge($this->fields, [$field]);

        return $this;
    }

    public function addMore(array $fields): static
    {
        foreach ($fields as $field) {
            $this->add($field['name'], $field['type'], $field['field']);
        }

        return $this;
    }

    public function renderForm(): View|Factory
    {
        return view($this->template, $this->getDataForm());
    }

    public function getDataForm(): array
    {
        return [
            'id' => static::class,
            'class' => static::class,
            'form' => $this,
        ];
    }

    public function createWithModel(Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function model(string $model): static
    {
        $this->model = new $model;

        return $this;
    }

    public function setView(string $view): static
    {
        $this->view = $view;

        return $this;
    }
}

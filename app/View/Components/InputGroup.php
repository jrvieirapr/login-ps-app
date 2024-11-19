<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class InputGroup extends Component
{
    public $label;
    public $name;
    public $id;
    public $type;
    public $value;
    public $class;
    public $errors;

    /**
     * Construtor do componente.
     */
    public function __construct($label, $name, $id = null, $type = 'text', $value = null, $class = null, ViewErrorBag $errors = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->type = $type;
        $this->value = old($name, $value); // Prioriza old() para valores antigos
        $this->class = $class;
        $this->errors = $errors ?? session('errors', new ViewErrorBag); // Obtém erros da sessão
    }

    /**
     * Retorna a view que representa o componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-group');
    }

    /**
     * Verifica se há um erro para o campo.
     */
    public function hasError(): bool
    {
        return $this->errors->has($this->name);
    }

    /**
     * Retorna a mensagem de erro para o campo.
     */
    public function errorMessage(): ?string
    {
        return $this->errors->first($this->name);
    }
}

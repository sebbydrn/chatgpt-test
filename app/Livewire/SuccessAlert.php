<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class SuccessAlert extends Component
{
    public $message;
    public $show = false;
    
    public function render()
    {
        return view('livewire.success-alert');
    }

    #[On('success-message')]
    public function show($message)
    {
        $this->message = $message;
        $this->show = true;
    }
}

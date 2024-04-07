<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class ProgressBar extends Component
{
    public $progress;
    public $classNames;
    public $isProcessing = false;

    public function mount()
    {
        $this->updateProgress();
    }

    public function render()
    {
        return view('livewire.progress-bar');
    }

    public function updateProgress()
    {
        //
    }
}

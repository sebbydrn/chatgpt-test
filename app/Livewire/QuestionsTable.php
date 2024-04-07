<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use Livewire\Attributes\On;

class QuestionsTable extends Component
{
    public function render()
    {
        return view('livewire.questions-table', [
            'questions' => Question::all(),
        ]);
    }
}

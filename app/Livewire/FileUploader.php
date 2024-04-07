<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;

class FileUploader extends Component
{
    use WithFileUploads;

    public $isProcessing = false;
    public $isFinished = false;
    
    public function render()
    {
        return view('livewire.file-uploader');
    }

    #[On('is-processing')]
    public function showProgressBar()
    {
        $this->isProcessing = true;
    }

    #[On('save-file-contents')]
    public function saveFileContents($questions)
    {
        $totalNoOfQuestions = count($questions);
        $current = 0;

        while ($current < $totalNoOfQuestions) {

            $currentProgress = ((($current + 1)/ $totalNoOfQuestions) * 100);
            $this->saveQuestion($questions[$current], $currentProgress);

            $current++;
        }

        $this->isProcessing = false;
        $this->isFinished = true;
    }

    public function saveQuestion($question, $currentProgress)
    {
        Question::create([
            'question'  => $question['question'],
            'option_1'  => $question['option_1'],
            'option_2'  => $question['option_2'],
            'option_3'  => $question['option_3'],
            'option_4'  => $question['option_4'],
            'answer'    => $question['answer'],
        ]);

        sleep(1);
    }
}

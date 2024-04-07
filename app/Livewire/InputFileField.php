<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class InputFileField extends Component
{
    use withFileUploads;

    public $name;
    public $classNames;
    public $id;
    public $model;
    public $file;

    protected $rules = [
        'file' => 'required|mimes:csv,txt',
    ];

    public function render()
    {
        return view('livewire.input-file-field');
    }

    public function updatedFile()
    {
        $this->validateOnly('file');
    }

    #[On('is-processing')]
    public function upload()
    {
        $file = fopen($this->file->getRealPath(), 'r');
        $questions = [];
        $current_row = 0;

        while (($row = fgetcsv($file)) !== false) {
            // Skip the header row
            if ($current_row === 0) {
                $current_row++;
                continue;
            }

            $questions[] = [
                'question'  => $row[0],
                'option_1'  => $row[1],
                'option_2'  => $row[2],
                'option_3'  => $row[3],
                'option_4'  => $row[4],
                'answer'    => $row[5],
            ];

            $current_row++;
        }

        // Close the file
        fclose($file);

        $this->dispatch('save-file-contents', questions: $questions);
    }
}

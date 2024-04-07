<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use OpenAI\Laravel\Facades\OpenAI;

class Button extends Component
{
    public $type;
    public $classNames;
    public $id;
    public $clickMethod;
    public $attributeNames;
    public $slot;

    public function render()
    {
        return view('livewire.button');
    }

    public function processFile()
    {
        $this->dispatch('is-processing');
    }

    public function processQuestions()
    {
        // Get questions from the database that do not have an explanation data
        $questions = Question::whereNull('explanation')->get();

        // The OpenAI API has a limit for the requests that can be made in a minute
        foreach ($questions as $question) {
            $explanation = $this->getExplanation($question);
            $alternateAnswer = $this->getAlternativeAnswer($question);
            $this->updateQuestion($question->id, [
                'explanation'   => $explanation,
                'alternative_answer'  => $alternateAnswer
            ]);
        }

        // TODO: Add a success message
    }

    public function getExplanation(Question $question): string
    {
        $prompt = 'You are a helpful assistant. The question is: ' . $question->question . ' The choices are: ' . $question->option_1 . ', ' . $question->option_2 . ', ' . $question->option_3 . ', ' . $question->option_4 . '. The answer is: ' . $question->answer . '. Explain the answer.';
        
        $chat = OpenAI::chat()->create([
            'model'     => 'gpt-3.5-turbo',
            'messages'  => [
                [
                    'role'  => 'system',
                    'content'   => 'You are a helpful assistant.'
                ],
                [
                    'role'  => 'user',
                    'content'   => $prompt
                ]
            ]
        ]);

        return $chat['choices'][0]['message']['content'];
    }

    public function getAlternativeAnswer(Question $question): string
    {
        $prompt = 'You are a helpful assistant. The question is: ' . $question->question . ' The choices are: ' . $question->option_1 . ', ' . $question->option_2 . ', ' . $question->option_3 . ', ' . $question->option_4 . '. The answer is: ' . $question->answer . '. Is there a more suitable answer? If yes provide the answer from the choices given. If it is correct, Say "No"';

        $chat = OpenAI::chat()->create([
            'model'     => 'gpt-3.5-turbo',
            'messages'  => [
                [
                    'role'  => 'system',
                    'content'   => 'You are a helpful assistant.'
                ],
                [
                    'role'  => 'user',
                    'content'   => $prompt
                ]
            ]
        ]);

        $alternative_answer = $chat['choices'][0]['message']['content'];

        if ($alternative_answer === "No") {
            return "N/A";
        }

        return $alternative_answer;
    }

    public function updateQuestion(Int $question_id, array $data): void
    {
        $question = Question::find($question_id);
        $question->update([
            'explanation'   => $data['explanation'],
            'alternative_answer'  => $data['alternative_answer']
        ]);
    }

    public function explainAnswer(Int $question_id)
    {
        $question = Question::find($question_id);
        $explanation = $this->getExplanation($question);
        
        $this->updateQuestion($question_id, [
            'explanation'   => $explanation,
            'alternative_answer'  => $question->alternative_answer
        ]);

        $this->dispatch('success-message', message: 'Explanation added successfully!');
        $this->dispatch('update-table');
    }

    public function alternativeAnswer(Int $question_id)
    {
        $question = Question::find($question_id);
        $alternateAnswer = $this->getAlternativeAnswer($question);

        $this->updateQuestion($question_id, [
            'explanation'   => $question->explanation,
            'alternative_answer'  => $alternateAnswer
        ]);

        $this->dispatch('success-message', message: 'Alternate answer provided successfully!');
        $this->dispatch('update-table');
    }
}

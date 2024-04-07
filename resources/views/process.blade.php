<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Process Questions</title>

    @vite('resources/css/app.css')
</head>
<body>
    <div class="p-10 mx-auto">
        @livewire('questions-table')

        @livewire('button', [
            'type' => 'button',
            'classNames' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4',
            'id' => 'process-questions',
            'clickMethod' => 'processQuestions',
            'slot' => 'Process Questions'
        ])
    </div>
    
</body>
</html>
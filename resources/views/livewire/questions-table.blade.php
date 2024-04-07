<div>
    @livewire('success-alert')

    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-4">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">Question</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">A</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">B</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">C</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">D</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">Answer</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">Explanation</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">Alternative Answer</th>
                <th scope="col" class="py-3.5 px-4 text-sm font-bold text-center rtl:text-right text-gray-500 dark:text-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
            @foreach($questions as $question)
                <tr>
                    <td class="w-80 px-4 py-4 text-sm font-medium text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->question }}</p></td>
                    <td class="w-10 px-4 py-4 text-sm font-medium text-center text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->option_1 }}</p></td>
                    <td class="w-10 px-4 py-4 text-sm font-medium text-center text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->option_2 }}</p></td>
                    <td class="w-10 px-4 py-4 text-sm font-medium text-center text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->option_3 }}</p></td>
                    <td class="w-10 px-4 py-4 text-sm font-medium text-center text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->option_4 }}</p></td>
                    <td class="w-10 px-4 py-4 text-sm font-medium text-center text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->answer }}</p></td>
                    <td class="w-80 px-4 py-4 text-sm font-medium text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->explanation }}</p></td>
                    <td class="w-80 px-4 py-4 text-sm font-medium text-center text-wrap"><p class="text-sm font-normal text-gray-600 dark:text-gray-400">{{ $question->alternative_answer }}</p></td>
                    <td class="w-20 px-4 py-4 text-sm font-medium text-wrap">
                        @if($question->explanation == NULL)
                            @livewire('button', [
                                'type' => 'button',
                                'classNames' => 'w-100 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded explain_answer',
                                'id'    => 'explain_answer_' . $question->id,
                                'clickMethod' => 'explainAnswer(' . $question->id . ')',
                                'slot' => 'Explain Answer'
                            ])
                        @endif

                        @if($question->alternative_answer == NULL)
                            @livewire('button', [
                                'type' => 'button',
                                'classNames' => 'w-100 mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded alternative_answer',
                                'id'    => 'alternative_answer_' . $question->id,
                                'clickMethod' => 'alternativeAnswer(' . $question->id . ')',
                                'slot' => 'Check Alternative Answer'
                            ])
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>
    <h1 class="text-3x-1 font-bold mb-4">Upload CSV File</h1>

    @if($isProcessing)
        <p class="block w-full px-4 py-2 mt-4 font-semibold">Uploading...</p>
    @endif

    @if($isFinished)
        <p class="block w-full px-4 py-2 mt-4 font-semibold">File uploaded successfully!</p>
    @endif

    @livewire('input-file-field', [
        'name' => 'file', 
        'classNames' => 'block w-full px-4 py-2 mt-4 text-sm leading-normal rounded-md bg-gray-200 focus:bg-white focus:outline-none',
        'id' => 'file',
        'model' => 'file'
    ])

    @livewire('button', [
        'type' => 'button',
        'classNames' => 'block w-full px-4 py-2 mt-4 text-sm font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600',
        'clickMethod' => 'processFile',
        'slot' => 'Upload'
    ])
</div>

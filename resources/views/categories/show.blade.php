<x-layouts.app :title="$category->name">
    <div class="max-w-3xl mt-10">   
        <div class="mb-6 flex items-center justify-between w-full">
            <div>
                <h2 class="mb-6 text-2xl font-bold text-gray-800">
                    {{ $category->name }}
                </h2>
                <div class="mb-8 text-gray-600">
                    {{ $category->description }}
                </div>
            </div>
            <div>
                <flux:button variant="primary" href="{{ route('boards.create', ['category' => $category]) }}">
                    New Board
                </flux:button>
            </div>
        </div>

        <h3 class="mb-4 text-xl font-semibold text-gray-700">Boards</h3>
        <ul class="space-y-4">
            @foreach($boards as $board)
                <li class="bg-white rounded-lg border p-6">
                    <div class="text-lg font-semibold text-blue-600">
                        <a href="{{ route('boards.show', $board) }}">
                            {{ $board->name }}
                        </a>
                    </div>
                    <div class="text-gray-600 mt-1">
                        {{ $board->description }}
                    </div>
                </li>
            @endforeach
        </ul>

        @if(empty($boards))
            <div class="text-gray-400 text-center mt-10">No boards found in this category.</div>
        @endif
    </div>
</x-layouts.app>
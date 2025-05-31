<x-layouts.app :title="$board->name">
    <div class="max-w-4xl mx-auto mt-10">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">{{ $board->name }}</h2>
            <div class="text-gray-600 mt-2">{{ $board->description }}</div>
        </div>

        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-700">Threads</h3>
            <flux:button variant="primary" href="{{ route('threads.create', ['board' => $board]) }}">
                New Thread
            </flux:button>
        </div>

        <div class="bg-white rounded-lg shadow border">
            <ul>
                @forelse($threads as $thread)
                    <li
                        class="border-b last:border-b-0 px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <a href="{{ route('threads.show', ['board' => $board, 'thread' => $thread]) }}"
                                class="text-lg font-semibold text-blue-600 hover:underline">
                                {{ $thread->title }}
                            </a>
                            <div class="text-sm text-gray-500 mt-1">
                                by {{ $thread->author->name ?? 'Unknown' }} &middot;
                                {{ $thread->created_at->diffForHumans() }}
                            </div>
                        </div>
                        {{-- Add thread stats or last post info here if desired --}}
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-gray-400">No threads found in this board.</li>
                @endforelse
            </ul>
        </div>

        <div class="mt-8">
            {{ $threads->links() }}
        </div>
    </div>
</x-layouts.app>
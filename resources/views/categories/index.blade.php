<x-layouts.app title="Categories">
    <div class="max-w-3xl mt-10">
        <h2 class="mb-6 text-2xl font-bold text-gray-800">Categories</h2>
        <ul class="space-y-4">
            @foreach($categories->sortBy('name') as $category)
                <li class="bg-white rounded-lg border p-6">
                    <a href="{{ url('/categories/' . $category->slug) }}"
                        class="text-lg font-semibold text-blue-600 hover:underline">
                        {{ $category->name }}
                    </a>
                    <div class="text-gray-600 mt-1">
                        {{ $category->description }}
                    </div>
                </li>
            @endforeach
        </ul>
        @if($categories->isEmpty())
            <div class="text-gray-400 text-center mt-10">No categories found.</div>
        @endif
    </div>
</x-layouts.app>
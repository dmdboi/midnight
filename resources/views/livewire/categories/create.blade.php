<?php

use Livewire\Volt\Component;

use App\Models\Category;

new class extends Component {
    //
    public $name;
    public $description;

    public function createCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Check if the category already exists
        if (Category::where('name', $this->name)->exists()) {
            session()->flash('error', 'Category with this name already exists.');
            return;
        }

        // Create the category
        $category = Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => Str::slug($this->name),
        ]);

        // Redirect or refresh the page if needed
        return redirect()->route('categories.show', ['category' => $category]);
    }

}; ?>

<div>

    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Create New Category</h2>

        <form wire:submit.prevent="createCategory">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <flux:input type="text" id="name" wire:model="name" required />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <flux:textarea id="description" wire:model="description" rows="3" />
            </div>

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="px-4 py-2">
                    Create Category
                </flux:button>
            </div>
        </form>
    </div>

    <div class="mt-4">
        @if (session()->has('message'))
            <div class="text-green-600">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
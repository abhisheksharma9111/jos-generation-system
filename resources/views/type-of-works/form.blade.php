<div class="bg-white rounded shadow p-6">
    <div class="mb-4">
        <label for="name" class="block text-gray-700">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $typeOfWork->name ?? '') }}" 
               class="w-full px-3 py-2 border rounded" required>
    </div>

    <div class="mb-4">
        <label for="rate" class="block text-gray-700">Rate:</label>
        <input type="number" step="0.01" name="rate" id="rate" 
               value="{{ old('rate', $typeOfWork->rate ?? '') }}" 
               class="w-full px-3 py-2 border rounded" required>
    </div>

    <div class="mb-4">
        <label for="code" class="block text-gray-700">Code:</label>
        <input type="text" name="code" id="code" 
               value="{{ old('code', $typeOfWork->code ?? '') }}" 
               class="w-full px-3 py-2 border rounded" required>
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ isset($typeOfWork) ? 'Update' : 'Create' }}
        </button>
        <a href="{{ route('type-of-works.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Cancel
        </a>
    </div>
</div>
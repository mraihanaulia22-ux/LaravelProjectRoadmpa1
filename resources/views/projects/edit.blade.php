<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto smpx-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Form untuk edit data project -->
                    <form action="{{  route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Nama Project</label>

                            <input type="text" name="title" id="title" value="{{ $project->title }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 transition" required>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional Saja)</label>
                            <Textarea name="description" id="description" rows="4" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus::outline-none focus:shadow-outline focus:border-blue-500 transition">
                            {{ $project->description }}
                            </Textarea>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-gray-700 font-bold py-2 px-4 rounded mr-2">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                                Perbarui Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
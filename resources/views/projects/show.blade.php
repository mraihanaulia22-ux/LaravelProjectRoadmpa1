<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Project') }}
            </h2>
            <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-gray-700 transition">Kembali &larr;</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-6 bg-green-100 border border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-gray-100">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $project->description ?: 'Tidak Ada Deskripsi' }}</p>
                            <span class="text-xs text-gray-400">Dibuat pada: {{ $project->created_at->format('d M Y') }}</span>
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('projects.edit',  $project->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow transition">Edit</a>

                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm(' Apakah Anda Yakin ingin menghapus project ini ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Daftar Tugas (Tasks)</h4>

                    <form action="{{ route('tasks.store') }}" method="POST" class="mb-8 flex space-x-2">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="text" name="name" class="flex-1 shadow-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Ketik Tugas Baru di sini....." required>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 -y02 rounded-md font-semibold transition">Tambah Tasks</button>
                    </form>

                    <div class="space-y-3">
                        @forelse ($project->tasks as $task)
                        <div class="flex items-center justify-between p-4 bg-gray-50 border rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center spcae-x-3">
                                @if($task->status === 'todo')
                                <span class="px-2 py-1 text-xs font-semibold bg-gray-200 text-gray-700 rounded-full">@elseif($task->status === 'in_progress')</span>
                                <span class="px-2 py-1 text-xs font-semibold bg-yellow-200 text-yellow-800 rounded-full">In Progress</span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold bg-green-200 text-green-800 rounded-full">Done</span>
                                @endif

                                <span class="text-gray-800 font-medium {{ $task->name }}"></span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <select name="status" onchange="this.form.submit()" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                        <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                                        <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </form>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin Menghapus Tugas Ini ?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-500 hover:text-red-700 bg-white p-2 rounded border border-gray-200 hover:bg-red-50 transition">
                                    &#10005;
                                </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-gray-500 py-4">Belum Ada Tugas. Silahkan tambahkan tugas pertama anda!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
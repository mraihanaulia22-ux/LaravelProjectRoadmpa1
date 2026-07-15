<x-app-layout> 
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Saya') }}
            </h2>
            <a href="{{ route('projects.create') }}" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md
            transition duration-300 ease-in-out transform hover:-translate-y-1">
            + Tambah Project Baru
            </a>
        </div> 
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Tampilkan Pesan Sukses (Jika Ada)-->

            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700
            p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Untuk Looping semua project di database -->
                @forelse ($projects as $project)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100
                    hover:shadow-lg transition duration-300">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2 truncate" title="{{$project->title}}">

                        {{$project->title  }}
                    </h3>
                    <p class="text-gray-500 mb-4 line-clamp-3">
                        {{$project->description ?: 'Tidak Ada Deskripsi' }}
                    </p>

                    <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-400">Dibuat: {{$project->created_at->diffForHumans() }}</span>
                        <a href="{{ route('projects.show', $project->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm flex items-center">
                            Lihat Detail Disini &rarr;
                        </a>
                    </div>
                    </div>
                </div>
                @empty

                <!-- Kondisi jika belom ada project sama sekali -->

                <div class="col-span-full bg-white p-12 text-center rounded-xl shadow-sm border border-gray-100">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Belom Ada Project</h3>
                    <p class="mt-1 text-gray-500">Mulai Kelola Tugas Anda dengan membuat project baru</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
@extends('layouts.public')

@section('title', 'Bilik Suara')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>
        <p class="mt-2 text-gray-600">{{ $event->description }}</p>
    </div>

    <form action="{{ route('voting.store') }}" method="POST" id="votingForm">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($event->candidates as $candidate)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 border-2 border-transparent hover:border-blue-500 cursor-pointer candidate-card" onclick="selectCandidate({{ $candidate->id }})">
                <div class="relative">
                    <img class="w-full h-64 object-cover" src="{{ $candidate->photo ? asset('storage/'.$candidate->photo) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->name).'&size=300' }}" alt="{{ $candidate->name }}">
                    <div class="absolute top-0 right-0 bg-blue-600 text-white px-4 py-2 font-bold text-xl rounded-bl-lg">
                        {{ $candidate->nomor_urut }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $candidate->name }}</h3>
                    <div class="space-y-2">
                        <h4 class="font-semibold text-blue-600">Visi:</h4>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $candidate->visi }}</p>
                        <h4 class="font-semibold text-blue-600 mt-2">Misi:</h4>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $candidate->misi }}</p>
                    </div>
                    <div class="mt-6">
                        <div class="w-full bg-gray-100 text-gray-800 font-bold py-2 rounded text-center border border-gray-300 group-hover:bg-blue-600 group-hover:text-white transition">
                            Pilih Kandidat Ini
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Hidden Input -->
        <input type="hidden" name="candidate_id" id="candidateInput" required>

        <!-- Confirmation Modal (Simplified) -->
        <div id="confirmationModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg p-8 max-w-sm w-full mx-4">
                <h3 class="text-lg font-bold mb-4">Konfirmasi Pilihan</h3>
                <p class="mb-6">Apakah Anda yakin ingin memilih kandidat ini? Pilihan tidak dapat diubah.</p>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Yakin</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function selectCandidate(id) {
        document.getElementById('candidateInput').value = id;
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }
</script>
@endsection

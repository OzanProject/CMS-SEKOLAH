<!-- Contact Section -->
<div class="py-16 bg-white" id="contact">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <span class="text-red-600 font-bold uppercase tracking-widest text-sm">Hubungi Kami</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mt-2 mb-6">Tetap Terhubung</h2>
                <p class="text-gray-600 mb-8">
                    Jika Anda memiliki pertanyaan seputar pendaftaran, kerjasama, atau informasi lainnya, jangan ragu untuk menghubungi kami.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-100 text-red-600 rounded flex items-center justify-center flex-shrink-0 mr-4">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800">Alamat</h5>
                            <p class="text-sm text-gray-600">{{ $school_settings['school_address'] ?? 'Jalan Sekolah No. 1' }}</p>
                        </div>
                    </div>
                     <div class="flex items-start">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded flex items-center justify-center flex-shrink-0 mr-4">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800">Telepon</h5>
                            <p class="text-sm text-gray-600">{{ $school_settings['school_phone'] ?? '(021) 1234567' }}</p>
                        </div>
                    </div>
                     <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded flex items-center justify-center flex-shrink-0 mr-4">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800">Email</h5>
                            <p class="text-sm text-gray-600">{{ $school_settings['school_email'] ?? 'info@sekolah.sch.id' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 p-8 rounded-lg shadow-inner">
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500" placeholder="Nama Anda">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500" placeholder="email@contoh.com">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pesan</label>
                        <textarea name="message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-green-500" placeholder="Tulis pesan Anda disini..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded hover:bg-green-700 transition">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>

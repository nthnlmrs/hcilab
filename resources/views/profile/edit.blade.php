@section('section_name', 'Profile Edit')
<x-app-layout>
    <div class="pt-6 pb-24 px-4 max-w-2xl mx-auto">
        <div class="flex items-center mb-10">
            <a href="{{ route('home') }}" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">Profile</h1>
        </div>

        <div class="flex flex-col items-center mb-10">
            <div class="w-24 h-24 rounded-full bg-museum-green border-4 border-white shadow-xl overflow-hidden mb-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1B4A47&color=fff&size=128" class="w-full h-full object-cover">
            </div>
            <h2 class="font-serif text-xl font-bold text-museum-green">{{ $user->name }}</h2>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $user->email }}</p>
        </div>

        <div class="bg-white rounded-[40px] p-6 shadow-soft space-y-2">
            <h3 class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4 px-4">Account Settings</h3>

            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-2xl transition-colors group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <span class="text-sm font-bold text-gray-700">Edit Profile</span>
                </div>
                <i class="fas fa-chevron-right text-gray-200 group-hover:text-museum-green transition-colors"></i>
            </a>

            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-2xl transition-colors group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
                        <i class="fas fa-globe"></i>
                    </div>
                    <span class="text-sm font-bold text-gray-700">Language</span>
                </div>
                <i class="fas fa-chevron-right text-gray-200 group-hover:text-museum-green transition-colors"></i>
            </a>

            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-2xl transition-colors group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span class="text-sm font-bold text-gray-700">Settings</span>
                </div>
                <i class="fas fa-chevron-right text-gray-200 group-hover:text-museum-green transition-colors"></i>
            </a>

            <hr class="my-4 border-gray-50">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-between p-4 hover:bg-red-50 rounded-2xl transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span class="text-sm font-bold text-red-500">Sign Out</span>
                    </div>
                    <i class="fas fa-chevron-right text-red-100 group-hover:text-red-500 transition-colors"></i>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

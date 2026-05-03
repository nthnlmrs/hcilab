<x-app-layout>
    <div class="pt-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-600">Profile</h1>
        </div>
        
        <div class="relative mt-16 mb-4">
            <!-- Background Card -->
            <div class="bg-white rounded-[2rem] pt-16 pb-8 px-6 shadow-sm border-t-4 border-blue-400 relative z-0">
                <div class="text-center mb-8">
                    <h2 class="font-serif text-xl font-bold text-museum-green">{{ $user->name }}</h2>
                    <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                </div>
                
                <h3 class="font-serif text-lg font-bold text-museum-green mb-4">Personal Information</h3>
                
                <div class="space-y-3">
                    <!-- Edit Profile (Trigger Modal in real app) -->
                    <a href="#" class="flex items-center justify-between p-4 border border-gray-100 rounded-2xl bg-white shadow-sm hover:bg-gray-50 transition-colors">
                        <div class="flex items-center text-gray-600">
                            <i class="far fa-user w-6 text-center mr-3"></i>
                            <span class="text-sm">Edit Profile</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 border border-gray-100 rounded-2xl bg-white shadow-sm hover:bg-gray-50 transition-colors">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-globe w-6 text-center mr-3"></i>
                            <span class="text-sm">Language</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 border border-gray-100 rounded-2xl bg-white shadow-sm hover:bg-gray-50 transition-colors">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-cog w-6 text-center mr-3"></i>
                            <span class="text-sm">Settings</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 border border-gray-100 rounded-2xl bg-white shadow-sm hover:bg-gray-50 transition-colors">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-shield-alt w-6 text-center mr-3"></i>
                            <span class="text-sm">Privacy</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between p-4 border border-gray-100 rounded-2xl bg-white shadow-sm hover:bg-gray-50 transition-colors">
                        <div class="flex items-center text-gray-600">
                            <i class="far fa-question-circle w-6 text-center mr-3"></i>
                            <span class="text-sm">Help Center</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="block w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-between p-4 border border-gray-100 rounded-2xl bg-white shadow-sm hover:bg-gray-50 transition-colors">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-sign-out-alt w-6 text-center mr-3"></i>
                                <span class="text-sm">Sign out</span>
                            </div>
                        </button>
                    </form>
                </div>
                
                <!-- Admin Dashboard Link for Admins -->
                @if(Auth::user() && Auth::user()->role === 'admin')
                <div class="mt-6 border-t border-gray-100 pt-6">
                    <a href="{{ route('admin.dashboard') }}" class="block w-full text-center py-3 bg-museum-green text-white rounded-xl font-semibold hover:bg-museum-lightGreen transition-colors">
                        <i class="fas fa-cogs mr-2"></i> Admin Dashboard
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Avatar Overlay -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="w-24 h-24 rounded-full border-4 border-white overflow-hidden shadow-md bg-gray-200">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=004d40&color=fff&size=150" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

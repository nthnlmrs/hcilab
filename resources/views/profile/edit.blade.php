@section('section_name', 'Profile Edit')
<x-app-layout>
    @php
        $hasProfileErrors = $errors->any() && !$errors->updatePassword->isNotEmpty() && !$errors->userDeletion->isNotEmpty();
        $hasSettingsErrors = $errors->updatePassword->isNotEmpty() || $errors->userDeletion->isNotEmpty();
        $profileSaved = session('status') === 'profile-updated';
        $passwordSaved = session('status') === 'password-updated';
    @endphp

    <div x-data="{ 
            showEditProfile: @json($hasProfileErrors || $profileSaved), 
            showLanguage: false, 
            showSettings: @json($hasSettingsErrors || $passwordSaved), 
            showPrivacy: false, 
            showHelp: false 
         }" 
         class="-mx-6 md:-mx-10 -mt-8 -mb-28 md:-mb-10 relative min-h-screen bg-white">
        
        <!-- Header Section -->
        <div class="relative bg-[#1B4A47] min-h-[180px] md:min-h-[240px] overflow-hidden flex items-center px-6 md:px-10 z-0">
            <!-- Background Decors (Diagonal Shapes matching Figma layout) -->
            <!-- Decor 1 -->
            <div class="absolute h-[469px] w-[134px] rotate-[-32.95deg] left-[5px] top-[-135px] opacity-20 pointer-events-none" style="background-image: linear-gradient(180deg, #1B4A47 16%, #123937 100%)"></div>
            <!-- Decor 2 -->
            <div class="absolute h-[469px] w-[162px] rotate-[147.05deg] left-[40%] top-[-150px] opacity-15 pointer-events-none" style="background-image: linear-gradient(180deg, #1B4A47 16%, #0F2F2E 100%)"></div>

            <!-- Header Content -->
            <div class="relative z-10 w-full max-w-4xl mx-auto flex items-center gap-4">
                <a href="{{ route('home') }}" class="w-12 h-12 rounded-full bg-[#FAF6EE] flex items-center justify-center text-[#1B4A47] hover:scale-105 active:scale-95 transition-all shadow-md">
                    <i class="fas fa-arrow-left text-lg"></i>
                </a>
                <h1 class="font-serif text-2xl font-bold text-[#E8E2D9]">Profile</h1>
            </div>
        </div>

        <!-- Main Card Section (Overlapping the header) -->
        <div class="relative z-10 bg-white rounded-t-[30px] -mt-8 pb-32">
            <div class="max-w-md mx-auto px-6 pt-16 flex flex-col items-center">
                
                <!-- Profile Avatar Overlap -->
                <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-32 h-32 rounded-full border-4 border-white shadow-xl bg-white overflow-hidden flex items-center justify-center z-20">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1B4A47&color=fff&size=256" class="w-full h-full object-cover select-none" alt="{{ $user->name }}">
                </div>

                <!-- User Name & Email -->
                <h2 class="font-serif text-2xl font-bold text-[#1B4A47] text-center mb-1 leading-tight">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500 font-medium text-center mb-8">{{ $user->email }}</p>

                <!-- Informasi Personal -->
                <div class="w-full">
                    <h3 class="font-serif text-lg font-bold text-[#1B4A47] mb-4 px-1">Informasi Personal</h3>
                    
                    <!-- Menu List Container -->
                    <div class="bg-[#FAF6EE] border border-[#EADFCB]/30 rounded-3xl p-4 shadow-sm space-y-1">
                        
                        <!-- Edit Profile -->
                        <button @click="showEditProfile = true" class="w-full flex items-center justify-between p-3.5 hover:bg-[#1B4A47]/5 rounded-2xl transition-all duration-200 group text-left">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white border border-[#EADFCB]/20 text-[#1B4A47] flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-user-edit text-base"></i>
                                </div>
                                <span class="text-sm font-bold text-[#1B4A47]">Edit Profile</span>
                            </div>
                            <i class="fas fa-chevron-right text-[#1B4A47]/30 group-hover:text-[#1B4A47] group-hover:translate-x-0.5 transition-all"></i>
                        </button>

                        <!-- Bahasa -->
                        <button @click="showLanguage = true" class="w-full flex items-center justify-between p-3.5 hover:bg-[#1B4A47]/5 rounded-2xl transition-all duration-200 group text-left">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white border border-[#EADFCB]/20 text-[#1B4A47] flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-globe text-base"></i>
                                </div>
                                <span class="text-sm font-bold text-[#1B4A47]">Bahasa</span>
                            </div>
                            <i class="fas fa-chevron-right text-[#1B4A47]/30 group-hover:text-[#1B4A47] group-hover:translate-x-0.5 transition-all"></i>
                        </button>

                        <!-- Settings -->
                        <button @click="showSettings = true" class="w-full flex items-center justify-between p-3.5 hover:bg-[#1B4A47]/5 rounded-2xl transition-all duration-200 group text-left">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white border border-[#EADFCB]/20 text-[#1B4A47] flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-cog text-base"></i>
                                </div>
                                <span class="text-sm font-bold text-[#1B4A47]">Settings</span>
                            </div>
                            <i class="fas fa-chevron-right text-[#1B4A47]/30 group-hover:text-[#1B4A47] group-hover:translate-x-0.5 transition-all"></i>
                        </button>

                        <!-- Privacy -->
                        <button @click="showPrivacy = true" class="w-full flex items-center justify-between p-3.5 hover:bg-[#1B4A47]/5 rounded-2xl transition-all duration-200 group text-left">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white border border-[#EADFCB]/20 text-[#1B4A47] flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-shield-alt text-base"></i>
                                </div>
                                <span class="text-sm font-bold text-[#1B4A47]">Privacy</span>
                            </div>
                            <i class="fas fa-chevron-right text-[#1B4A47]/30 group-hover:text-[#1B4A47] group-hover:translate-x-0.5 transition-all"></i>
                        </button>

                        <!-- Help Center -->
                        <button @click="showHelp = true" class="w-full flex items-center justify-between p-3.5 hover:bg-[#1B4A47]/5 rounded-2xl transition-all duration-200 group text-left">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white border border-[#EADFCB]/20 text-[#1B4A47] flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                                    <i class="fas fa-question-circle text-base"></i>
                                </div>
                                <span class="text-sm font-bold text-[#1B4A47]">Help Center</span>
                            </div>
                            <i class="fas fa-chevron-right text-[#1B4A47]/30 group-hover:text-[#1B4A47] group-hover:translate-x-0.5 transition-all"></i>
                        </button>

                        <!-- Sign Out -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-between p-3.5 hover:bg-red-50 rounded-2xl transition-all duration-200 group text-left">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-red-100 text-red-500 flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                                        <i class="fas fa-sign-out-alt text-base"></i>
                                    </div>
                                    <span class="text-sm font-bold text-red-500">Sign out</span>
                                </div>
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

        <!-- MODAL: Edit Profile -->
        <div x-show="showEditProfile" 
             x-cloak
             class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             @keydown.escape.window="showEditProfile = false">
            <div @click.away="showEditProfile = false" 
                 x-show="showEditProfile"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-3xl max-w-md w-full max-h-[90vh] overflow-y-auto p-6 relative shadow-2xl border border-[#EADFCB]/30">
                
                <button @click="showEditProfile = false" class="absolute top-4 right-4 text-gray-400 hover:text-[#1B4A47] transition-colors p-2 rounded-full hover:bg-gray-50">
                    <i class="fas fa-times text-lg"></i>
                </button>

                <div class="mb-6">
                    <h2 class="font-serif text-xl font-bold text-[#1B4A47] mb-1">Edit Profile</h2>
                    <p class="text-xs text-gray-500">Update your account's profile information and email address.</p>
                </div>

                @if ($profileSaved)
                    <div class="bg-green-50 text-green-700 text-xs font-bold p-4 rounded-xl mb-6 flex items-center gap-2 border border-green-200">
                        <i class="fas fa-check-circle"></i>
                        <span>Profile successfully updated.</span>
                    </div>
                @endif

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="text-xs font-black text-[#1B4A47] uppercase tracking-wider mb-1 block">Name</label>
                        <input id="name" name="name" type="text" 
                               class="bg-[#FAF6EE] border border-[#EADFCB]/50 focus:border-[#1B4A47] focus:ring-[#1B4A47] text-[#1B4A47] rounded-xl px-4 py-3 text-sm font-medium w-full shadow-inner transition-all focus:outline-none" 
                               value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        @if ($errors->get('name'))
                            <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="text-xs font-black text-[#1B4A47] uppercase tracking-wider mb-1 block">Email Address</label>
                        <input id="email" name="email" type="email" 
                               class="bg-[#FAF6EE] border border-[#EADFCB]/50 focus:border-[#1B4A47] focus:ring-[#1B4A47] text-[#1B4A47] rounded-xl px-4 py-3 text-sm font-medium w-full shadow-inner transition-all focus:outline-none" 
                               value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        @if ($errors->get('email'))
                            <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $errors->first('email') }}</p>
                        @endif

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-4 bg-amber-50 text-amber-700 text-xs p-3 rounded-xl border border-amber-200 leading-relaxed font-medium">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="underline hover:text-amber-900 block mt-1 font-bold">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" @click="showEditProfile = false" class="bg-transparent hover:bg-gray-50 border border-gray-200 text-gray-500 font-bold text-sm px-5 py-2.5 rounded-xl transition-all">Cancel</button>
                        <button type="submit" class="bg-[#1B4A47] hover:bg-[#123937] text-[#E8E2D9] font-bold text-sm px-5 py-2.5 rounded-xl shadow-md transition-all active:scale-95">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL: Bahasa -->
        <div x-show="showLanguage" 
             x-cloak
             class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             @keydown.escape.window="showLanguage = false">
            <div @click.away="showLanguage = false" 
                 x-show="showLanguage"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-3xl max-w-sm w-full p-6 relative shadow-2xl border border-[#EADFCB]/30">
                
                <button @click="showLanguage = false" class="absolute top-4 right-4 text-gray-400 hover:text-[#1B4A47] transition-colors p-2 rounded-full hover:bg-gray-50">
                    <i class="fas fa-times text-lg"></i>
                </button>

                <div class="mb-6">
                    <h2 class="font-serif text-xl font-bold text-[#1B4A47] mb-1">Bahasa / Language</h2>
                    <p class="text-xs text-gray-500">Pilih bahasa preferensi Anda.</p>
                </div>

                <div class="space-y-3">
                    <button class="w-full flex items-center justify-between p-4 bg-[#FAF6EE] border border-[#1B4A47]/30 rounded-2xl text-left font-bold text-sm text-[#1B4A47]">
                        <span>Bahasa Indonesia</span>
                        <i class="fas fa-check-circle text-[#1B4A47]"></i>
                    </button>
                    <button @click="alert('English translation is coming soon!')" class="w-full flex items-center justify-between p-4 hover:bg-gray-50 border border-gray-100 rounded-2xl text-left font-bold text-sm text-gray-500 transition-colors">
                        <span>English (US)</span>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-100 px-2 py-0.5 rounded">Soon</span>
                    </button>
                </div>

                <div class="flex justify-end pt-6">
                    <button @click="showLanguage = false" class="bg-[#1B4A47] hover:bg-[#123937] text-[#E8E2D9] font-bold text-sm px-6 py-2.5 rounded-xl transition-all">Close</button>
                </div>
            </div>
        </div>

        <!-- MODAL: Settings -->
        <div x-show="showSettings" 
             x-cloak
             class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             @keydown.escape.window="showSettings = false">
            <div @click.away="showSettings = false" 
                 x-show="showSettings"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-3xl max-w-md w-full max-h-[90vh] overflow-y-auto p-6 relative shadow-2xl border border-[#EADFCB]/30 space-y-8">
                
                <button @click="showSettings = false" class="absolute top-4 right-4 text-gray-400 hover:text-[#1B4A47] transition-colors p-2 rounded-full hover:bg-gray-50">
                    <i class="fas fa-times text-lg"></i>
                </button>

                <!-- Update Password Section -->
                <div>
                    <div class="mb-5">
                        <h2 class="font-serif text-xl font-bold text-[#1B4A47] mb-1">Update Password</h2>
                        <p class="text-xs text-gray-500">Ensure your account is using a secure password.</p>
                    </div>

                    @if ($passwordSaved)
                        <div class="bg-green-50 text-green-700 text-xs font-bold p-4 rounded-xl mb-5 flex items-center gap-2 border border-green-200">
                            <i class="fas fa-check-circle"></i>
                            <span>Password successfully updated.</span>
                        </div>
                    @endif

                    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="text-xs font-black text-[#1B4A47] uppercase tracking-wider mb-1 block">Current Password</label>
                            <input id="current_password" name="current_password" type="password" 
                                   class="bg-[#FAF6EE] border border-[#EADFCB]/50 focus:border-[#1B4A47] focus:ring-[#1B4A47] text-[#1B4A47] rounded-xl px-4 py-3 text-sm font-medium w-full shadow-inner transition-all focus:outline-none" 
                                   autocomplete="current-password" />
                            @if ($errors->updatePassword->get('current_password'))
                                <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $errors->updatePassword->first('current_password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="password" class="text-xs font-black text-[#1B4A47] uppercase tracking-wider mb-1 block">New Password</label>
                            <input id="password" name="password" type="password" 
                                   class="bg-[#FAF6EE] border border-[#EADFCB]/50 focus:border-[#1B4A47] focus:ring-[#1B4A47] text-[#1B4A47] rounded-xl px-4 py-3 text-sm font-medium w-full shadow-inner transition-all focus:outline-none" 
                                   autocomplete="new-password" />
                            @if ($errors->updatePassword->get('password'))
                                <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $errors->updatePassword->first('password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="password_confirmation" class="text-xs font-black text-[#1B4A47] uppercase tracking-wider mb-1 block">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                   class="bg-[#FAF6EE] border border-[#EADFCB]/50 focus:border-[#1B4A47] focus:ring-[#1B4A47] text-[#1B4A47] rounded-xl px-4 py-3 text-sm font-medium w-full shadow-inner transition-all focus:outline-none" 
                                   autocomplete="new-password" />
                            @if ($errors->updatePassword->get('password_confirmation'))
                                <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                            @endif
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="bg-[#1B4A47] hover:bg-[#123937] text-[#E8E2D9] font-bold text-sm px-5 py-2.5 rounded-xl shadow-md transition-all active:scale-95">Update Password</button>
                        </div>
                    </form>
                </div>

                <hr class="border-gray-100">

                <!-- Delete Account Section -->
                <div x-data="{ confirmDeletion: @json($errors->userDeletion->isNotEmpty()) }">
                    <div class="mb-5">
                        <h2 class="font-serif text-xl font-bold text-red-600 mb-1">Delete Account</h2>
                        <p class="text-xs text-gray-500">Permanently delete your account and all associated data.</p>
                    </div>

                    <div x-show="!confirmDeletion">
                        <button type="button" @click="confirmDeletion = true" class="bg-red-500 hover:bg-red-600 text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md transition-all active:scale-95">Delete Account</button>
                    </div>

                    <div x-show="confirmDeletion" class="space-y-4">
                        <div class="bg-red-50 text-red-700 text-xs p-4 rounded-xl border border-red-200 leading-relaxed font-medium">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Once your account is deleted, all resources and data will be permanently lost. Please enter your password to confirm deletion.
                        </div>

                        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                            @csrf
                            @method('delete')

                            <div>
                                <label for="delete_password" class="text-xs font-black text-[#1B4A47] uppercase tracking-wider mb-1 block">Password</label>
                                <input id="delete_password" name="password" type="password" 
                                       placeholder="Enter your password"
                                       class="bg-[#FAF6EE] border border-[#EADFCB]/50 focus:border-[#1B4A47] focus:ring-[#1B4A47] text-[#1B4A47] rounded-xl px-4 py-3 text-sm font-medium w-full shadow-inner transition-all focus:outline-none" />
                                @if ($errors->userDeletion->get('password'))
                                    <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $errors->userDeletion->first('password') }}</p>
                                @endif
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-2">
                                <button type="button" @click="confirmDeletion = false" class="bg-transparent hover:bg-gray-50 border border-gray-200 text-gray-500 font-bold text-sm px-5 py-2.5 rounded-xl transition-all">Cancel</button>
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl shadow-md transition-all active:scale-95">Permanently Delete</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- MODAL: Privacy -->
        <div x-show="showPrivacy" 
             x-cloak
             class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             @keydown.escape.window="showPrivacy = false">
            <div @click.away="showPrivacy = false" 
                 x-show="showPrivacy"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-3xl max-w-md w-full max-h-[85vh] overflow-y-auto p-6 relative shadow-2xl border border-[#EADFCB]/30">
                
                <button @click="showPrivacy = false" class="absolute top-4 right-4 text-gray-400 hover:text-[#1B4A47] transition-colors p-2 rounded-full hover:bg-gray-50">
                    <i class="fas fa-times text-lg"></i>
                </button>

                <div class="mb-6">
                    <h2 class="font-serif text-xl font-bold text-[#1B4A47] mb-1">Kebijakan Privasi / Privacy Policy</h2>
                    <p class="text-xs text-gray-500">Terakhir diperbarui: Juni 2026</p>
                </div>

                <div class="text-xs text-gray-600 space-y-4 font-medium leading-relaxed max-h-[50vh] overflow-y-auto pr-2">
                    <p class="font-bold text-sm text-[#1B4A47]">1. Pengumpulan Informasi</p>
                    <p>Kami mengumpulkan informasi yang Anda berikan langsung kepada kami saat mendaftar akun, seperti nama dan alamat email, untuk mengelola akses akun Anda.</p>
                    
                    <p class="font-bold text-sm text-[#1B4A47]">2. Penggunaan Informasi</p>
                    <p>Informasi Anda digunakan untuk mempersonalisasi pengalaman Anda di aplikasi Museum Singhasari, merekam progres kuis, dan meningkatkan layanan kami.</p>

                    <p class="font-bold text-sm text-[#1B4A47]">3. Keamanan Data</p>
                    <p>Kami menerapkan langkah-langkah keamanan teknologi standar industri untuk melindungi informasi pribadi Anda dari akses yang tidak sah.</p>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100 mt-6">
                    <button @click="showPrivacy = false" class="bg-[#1B4A47] hover:bg-[#123937] text-[#E8E2D9] font-bold text-sm px-6 py-2.5 rounded-xl transition-all">Close</button>
                </div>
            </div>
        </div>

        <!-- MODAL: Help Center -->
        <div x-show="showHelp" 
             x-cloak
             class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
             @keydown.escape.window="showHelp = false">
            <div @click.away="showHelp = false" 
                 x-show="showHelp"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-3xl max-w-md w-full max-h-[85vh] overflow-y-auto p-6 relative shadow-2xl border border-[#EADFCB]/30">
                
                <button @click="showHelp = false" class="absolute top-4 right-4 text-gray-400 hover:text-[#1B4A47] transition-colors p-2 rounded-full hover:bg-gray-50">
                    <i class="fas fa-times text-lg"></i>
                </button>

                <div class="mb-6">
                    <h2 class="font-serif text-xl font-bold text-[#1B4A47] mb-1">Help Center & FAQ</h2>
                    <p class="text-xs text-gray-500">Punya pertanyaan? Temukan jawabannya di sini.</p>
                </div>

                <div class="space-y-4 max-h-[50vh] overflow-y-auto pr-2">
                    <div class="border border-[#EADFCB]/30 rounded-2xl p-4 bg-[#FAF6EE]">
                        <h4 class="font-bold text-xs text-[#1B4A47] mb-1">Bagaimana cara mengikuti Kuis?</h4>
                        <p class="text-[11px] text-gray-600 font-medium leading-relaxed">Pilih menu Kuis di sidebar atau navigasi bawah, lalu pilih kuis yang ingin dimainkan.</p>
                    </div>

                    <div class="border border-[#EADFCB]/30 rounded-2xl p-4 bg-[#FAF6EE]">
                        <h4 class="font-bold text-xs text-[#1B4A47] mb-1">Bagaimana cara memindai kode QR candi/patung?</h4>
                        <p class="text-[11px] text-gray-600 font-medium leading-relaxed">Klik tombol pindai (QR) di menu navigasi, izinkan akses kamera, dan arahkan ke kode QR yang ada di museum.</p>
                    </div>

                    <div class="border border-[#EADFCB]/30 rounded-2xl p-4 bg-[#FAF6EE]">
                        <h4 class="font-bold text-xs text-[#1B4A47] mb-1">Hubungi Kami</h4>
                        <p class="text-[11px] text-gray-600 font-medium leading-relaxed">Email: support@singhasarimuseum.id<br>Telepon: +62 341 123456</p>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100 mt-6">
                    <button @click="showHelp = false" class="bg-[#1B4A47] hover:bg-[#123937] text-[#E8E2D9] font-bold text-sm px-6 py-2.5 rounded-xl transition-all">Close</button>
                </div>
            </div>
        </div>

    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
</x-app-layout>

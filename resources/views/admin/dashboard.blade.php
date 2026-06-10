@section('section_name', 'Admin Dashboard')
<x-app-layout>
    <div class="pt-6 pb-20 md:pb-10 px-4 md:px-0 w-full mx-auto">
        <h1 class="font-serif text-2xl md:text-3xl font-bold text-museum-green mb-6 md:mb-8">Admin Dashboard</h1>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6 mb-8 md:mb-12">
            <a href="{{ route('admin.pages.index') }}" class="bg-museum-green rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center hover:bg-museum-darkGreen transition-colors">
                <div class="bg-museum-darkGreen rounded-full w-12 h-12 flex items-center justify-center mb-3">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest opacity-80">Pages</span>
                <span class="text-3xl font-serif font-bold mt-1">{{ \App\Models\Page::count() }}</span>
            </a>
            <a href="{{ route('admin.quizzes.index') }}" class="bg-museum-green rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center hover:bg-museum-darkGreen transition-colors">
                <div class="bg-museum-darkGreen rounded-full w-12 h-12 flex items-center justify-center mb-3">
                    <i class="fas fa-question-circle text-xl"></i>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest opacity-80">Quizzes</span>
                <span class="text-3xl font-serif font-bold mt-1">{{ \App\Models\Quiz::count() }}</span>
            </a>
            <a href="{{ route('admin.events.index') }}" class="bg-museum-green rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center hover:bg-museum-darkGreen transition-colors">
                <div class="bg-museum-darkGreen rounded-full w-12 h-12 flex items-center justify-center mb-3">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest opacity-80">Events</span>
                <span class="text-3xl font-serif font-bold mt-1">{{ \App\Models\Event::count() }}</span>
            </a>
            <a href="{{ route('admin.collections.index') }}" class="bg-museum-green rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center hover:bg-museum-darkGreen transition-colors">
                <div class="bg-museum-darkGreen rounded-full w-12 h-12 flex items-center justify-center mb-3">
                    <i class="fas fa-shapes text-xl"></i>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest opacity-80">Collections</span>
                <span class="text-3xl font-serif font-bold mt-1">{{ \App\Models\CollectionItem::count() }}</span>
            </a>
            <a href="{{ route('admin.stories.index') }}" class="bg-museum-green rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center hover:bg-museum-darkGreen transition-colors">
                <div class="bg-museum-darkGreen rounded-full w-12 h-12 flex items-center justify-center mb-3">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest opacity-80">Stories</span>
                <span class="text-3xl font-serif font-bold mt-1">{{ \App\Models\Story::count() }}</span>
            </a>
            <div class="bg-museum-green rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center">
                <div class="bg-museum-darkGreen rounded-full w-12 h-12 flex items-center justify-center mb-3">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest opacity-80">Users</span>
                <span class="text-3xl font-serif font-bold mt-1">{{ \App\Models\User::count() }}</span>
            </div>
        </div>

        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <a href="{{ route('admin.pages.create') }}" class="flex items-center bg-white rounded-2xl p-4 md:p-5 shadow-sm font-bold text-museum-green hover:bg-museum-green hover:text-white transition-all group">
                <div class="bg-museum-green/10 group-hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center mr-4 transition-colors">
                    <i class="fas fa-plus"></i>
                </div>
                Create New Museum Page
            </a>
            <a href="{{ route('admin.quizzes.create') }}" class="flex items-center bg-white rounded-2xl p-4 md:p-5 shadow-sm font-bold text-museum-green hover:bg-museum-green hover:text-white transition-all group">
                <div class="bg-museum-green/10 group-hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center mr-4 transition-colors">
                    <i class="fas fa-plus"></i>
                </div>
                Build New Quiz
            </a>
            <a href="{{ route('admin.events.create') }}" class="flex items-center bg-white rounded-2xl p-4 md:p-5 shadow-sm font-bold text-museum-green hover:bg-museum-green hover:text-white transition-all group">
                <div class="bg-museum-green/10 group-hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center mr-4 transition-colors">
                    <i class="fas fa-plus"></i>
                </div>
                Add Upcoming Event
            </a>
            <a href="{{ route('admin.collections.create') }}" class="flex items-center bg-white rounded-2xl p-4 md:p-5 shadow-sm font-bold text-museum-green hover:bg-museum-green hover:text-white transition-all group">
                <div class="bg-museum-green/10 group-hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center mr-4 transition-colors">
                    <i class="fas fa-plus"></i>
                </div>
                Add Collection Item
            </a>
            <a href="{{ route('admin.stories.create') }}" class="flex items-center bg-white rounded-2xl p-4 md:p-5 shadow-sm font-bold text-museum-green hover:bg-museum-green hover:text-white transition-all group">
                <div class="bg-museum-green/10 group-hover:bg-white/20 w-10 h-10 rounded-full flex items-center justify-center mr-4 transition-colors">
                    <i class="fas fa-plus"></i>
                </div>
                Add Folklore Story
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 text-xs font-bold p-4 rounded-2xl mt-8 mb-2 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mt-10 mb-4">Dashboard Card Cover Settings</h2>
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-8">
            <p class="text-xs text-gray-500 mb-6">Manually upload or customize the background cover images of the guest dashboard navigation cards (Museum, Collections, and Stories).</p>
            
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Museum Card Cover -->
                    <div class="border border-gray-100 rounded-2xl p-4 bg-gray-50/50 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-black text-museum-green uppercase tracking-wider block mb-2">Museum Card Cover</span>
                            <div class="w-full h-32 rounded-xl bg-gray-200 overflow-hidden mb-3 relative shadow-inner border border-gray-100">
                                @php
                                    $museumCover = \App\Models\Setting::get('dashboard_museum_image');
                                    $museumCoverUrl = $museumCover ? asset('storage/' . $museumCover) : asset('images/about_hero.png');
                                @endphp
                                <img src="{{ $museumCoverUrl }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <input type="file" name="dashboard_museum_image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-museum-green file:text-white hover:file:bg-museum-darkGreen cursor-pointer">
                            @if($museumCover)
                                <label class="inline-flex items-center text-xs text-red-500 font-semibold cursor-pointer">
                                    <input type="checkbox" name="delete_dashboard_museum_image" value="1" class="rounded text-red-500 mr-2 focus:ring-red-400"> Reset to Default
                                </label>
                            @endif
                        </div>
                    </div>

                    <!-- Collections Card Cover -->
                    <div class="border border-gray-100 rounded-2xl p-4 bg-gray-50/50 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-black text-museum-green uppercase tracking-wider block mb-2">Collections Card Cover</span>
                            <div class="w-full h-32 rounded-xl bg-gray-200 overflow-hidden mb-3 relative shadow-inner border border-gray-100">
                                @php
                                    $collectionsCover = \App\Models\Setting::get('dashboard_collections_image');
                                    $collectionsCoverUrl = $collectionsCover ? asset('storage/' . $collectionsCover) : (\App\Models\CollectionItem::latest()->first()?->image_url ?? asset('images/koleksi_card.png'));
                                @endphp
                                <img src="{{ $collectionsCoverUrl }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <input type="file" name="dashboard_collections_image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-museum-green file:text-white hover:file:bg-museum-darkGreen cursor-pointer">
                            @if($collectionsCover)
                                <label class="inline-flex items-center text-xs text-red-500 font-semibold cursor-pointer">
                                    <input type="checkbox" name="delete_dashboard_collections_image" value="1" class="rounded text-red-500 mr-2 focus:ring-red-400"> Reset to Default
                                </label>
                            @endif
                        </div>
                    </div>

                    <!-- Stories Card Cover -->
                    <div class="border border-gray-100 rounded-2xl p-4 bg-gray-50/50 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-black text-museum-green uppercase tracking-wider block mb-2">Stories Card Cover</span>
                            <div class="w-full h-32 rounded-xl bg-gray-200 overflow-hidden mb-3 relative shadow-inner border border-gray-100">
                                @php
                                    $storiesCover = \App\Models\Setting::get('dashboard_stories_image');
                                    $storiesCoverUrl = $storiesCover ? asset('storage/' . $storiesCover) : (\App\Models\Story::latest()->first()?->image_url ?? asset('images/cerita_card.png'));
                                @endphp
                                <img src="{{ $storiesCoverUrl }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <input type="file" name="dashboard_stories_image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-museum-green file:text-white hover:file:bg-museum-darkGreen cursor-pointer">
                            @if($storiesCover)
                                <label class="inline-flex items-center text-xs text-red-500 font-semibold cursor-pointer">
                                    <input type="checkbox" name="delete_dashboard_stories_image" value="1" class="rounded text-red-500 mr-2 focus:ring-red-400"> Reset to Default
                                </label>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-50 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-museum-green text-white rounded-2xl font-bold shadow-md hover:bg-museum-darkGreen hover:scale-[1.01] active:scale-[0.99] transition-all">
                        SAVE COVER SETTINGS
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

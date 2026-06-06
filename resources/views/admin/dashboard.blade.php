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
    </div>
</x-app-layout>

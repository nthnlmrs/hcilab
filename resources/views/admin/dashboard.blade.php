@section('section_name', 'Admin Dashboard')
<x-app-layout>
    <div class="pt-6 pb-20 px-4 max-w-2xl mx-auto">
        <h1 class="font-serif text-2xl font-bold text-museum-green mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-2 gap-4 mb-8">
            <a href="{{ route('admin.pages.index') }}" class="bg-museum-green rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center">
                <i class="fas fa-file-alt text-2xl mb-2 opacity-50"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Pages</span>
                <span class="text-2xl font-serif font-bold mt-1">{{ \App\Models\Page::count() }}</span>
            </a>
            <a href="{{ route('admin.quizzes.index') }}" class="bg-museum-brown rounded-3xl p-5 text-white shadow-lg flex flex-col items-center text-center">
                <i class="fas fa-question-circle text-2xl mb-2 opacity-50"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Quizzes</span>
                <span class="text-2xl font-serif font-bold mt-1">{{ \App\Models\Quiz::count() }}</span>
            </a>
            <a href="{{ route('admin.events.index') }}" class="bg-white rounded-3xl p-5 text-museum-green shadow-sm flex flex-col items-center text-center">
                <i class="fas fa-calendar-alt text-2xl mb-2 opacity-20"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Events</span>
                <span class="text-2xl font-serif font-bold mt-1">{{ \App\Models\Event::count() }}</span>
            </a>
            <div class="bg-white rounded-3xl p-5 text-museum-green shadow-sm flex flex-col items-center text-center">
                <i class="fas fa-users text-2xl mb-2 opacity-20"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Users</span>
                <span class="text-2xl font-serif font-bold mt-1">{{ \App\Models\User::count() }}</span>
            </div>
        </div>

        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Quick Actions</h2>
        <div class="space-y-3">
            <a href="{{ route('admin.pages.create') }}" class="block bg-white rounded-2xl p-4 shadow-sm font-bold text-museum-green hover:bg-gray-50 transition-colors">
                <i class="fas fa-plus-circle mr-2 opacity-30"></i> Create New Museum Page
            </a>
            <a href="{{ route('admin.quizzes.create') }}" class="block bg-white rounded-2xl p-4 shadow-sm font-bold text-museum-green hover:bg-gray-50 transition-colors">
                <i class="fas fa-plus-circle mr-2 opacity-30"></i> Build New Quiz
            </a>
            <a href="{{ route('admin.events.create') }}" class="block bg-white rounded-2xl p-4 shadow-sm font-bold text-museum-green hover:bg-gray-50 transition-colors">
                <i class="fas fa-plus-circle mr-2 opacity-30"></i> Add Upcoming Event
            </a>
        </div>
    </div>
</x-app-layout>

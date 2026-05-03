<x-app-layout>
    <div class="pt-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('profile.edit') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">Admin Dashboard</h1>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.pages.index') }}" class="bg-white p-6 rounded-2xl shadow-sm text-center hover:bg-gray-50 transition-colors border-t-4 border-museum-green flex flex-col items-center justify-center h-40">
                <i class="fas fa-file-alt text-4xl text-museum-green mb-3"></i>
                <span class="font-semibold text-gray-700">Manage Pages</span>
            </a>
            
            <a href="{{ route('admin.quizzes.index') }}" class="bg-white p-6 rounded-2xl shadow-sm text-center hover:bg-gray-50 transition-colors border-t-4 border-blue-500 flex flex-col items-center justify-center h-40">
                <i class="fas fa-question-circle text-4xl text-blue-500 mb-3"></i>
                <span class="font-semibold text-gray-700">Manage Quizzes</span>
            </a>
        </div>
    </div>
</x-app-layout>

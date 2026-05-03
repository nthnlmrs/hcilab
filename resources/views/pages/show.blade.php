<x-app-layout>
    <div class="pt-6">
        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-museum-green shadow-sm mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="font-serif text-2xl font-bold text-museum-green">{{ $page->title }}</h1>
        </div>

        <div class="space-y-6">
            @foreach($page->blocks as $block)
                @if($block->type === 'title')
                    <h2 class="font-serif text-3xl font-bold text-museum-green">{{ $block->content }}</h2>
                @elseif($block->type === 'desc')
                    <p class="text-sm text-gray-700 leading-relaxed text-justify">{{ $block->content }}</p>
                @elseif($block->type === 'image')
                    <div class="rounded-2xl overflow-hidden shadow-md">
                        <img src="{{ $block->content }}" alt="Image" class="w-full object-cover">
                    </div>
                @elseif($block->type === 'button')
                    @php $btnData = is_string($block->content) ? json_decode($block->content, true) : $block->content; @endphp
                    <div class="text-center">
                        <a href="{{ $btnData['url'] ?? '#' }}" class="inline-block px-8 py-3 bg-museum-green text-white rounded-full font-semibold shadow-md hover:bg-museum-lightGreen transition-colors">
                            {{ $btnData['text'] ?? 'Click Here' }}
                        </a>
                    </div>
                @elseif($block->type === 'card')
                    @php $cardData = is_string($block->content) ? json_decode($block->content, true) : $block->content; @endphp
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                        @if(isset($cardData['image']))
                            <img src="{{ $cardData['image'] }}" alt="{{ $cardData['title'] ?? '' }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-5">
                            @if(isset($cardData['title']))
                                <h3 class="font-serif text-xl font-bold text-museum-green mb-2">{{ $cardData['title'] }}</h3>
                            @endif
                            @if(isset($cardData['desc']))
                                <p class="text-sm text-gray-600">{{ $cardData['desc'] }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>

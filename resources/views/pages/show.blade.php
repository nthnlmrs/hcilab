<x-app-layout>
    <div class="pb-24">
        <!-- Hero Cover -->
        <div class="relative h-72 w-full overflow-hidden">
            @if($page->cover_image)
                <img src="{{ asset('storage/' . $page->cover_image) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-museum-green flex items-center justify-center">
                    <i class="fas fa-image text-white opacity-10 text-6xl"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-6">
                <a href="{{ route('home') }}" class="absolute top-6 left-6 w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/30">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h1 class="font-serif text-3xl font-bold text-white mb-2">{{ $page->title }}</h1>
                @if($page->description)
                    <p class="text-sm text-white/80 line-clamp-2 leading-relaxed">{{ $page->description }}</p>
                @endif
            </div>
        </div>

        <div class="px-6 py-8 space-y-10">
            @foreach($page->blocks as $block)
                @php $data = $block->data; @endphp

                @if($block->type === 'title')
                    <div class="text-{{ $data['align'] ?? 'left' }}">
                        <{{ $data['level'] ?? 'h2' }} class="font-serif font-bold text-museum-green {{ ($data['level'] ?? 'h2') == 'h1' ? 'text-3xl' : (($data['level'] ?? 'h2') == 'h2' ? 'text-2xl' : 'text-xl') }}">
                            {{ $block->content }}
                        </{{ $data['level'] ?? 'h2' }}>
                    </div>

                @elseif($block->type === 'description')
                    <div class="text-{{ $data['align'] ?? 'left' }} text-sm leading-relaxed text-gray-700">
                        {!! nl2br(e($block->content)) !!}
                    </div>

                @elseif($block->type === 'image')
                    <figure class="rounded-3xl overflow-hidden shadow-soft">
                        <img src="{{ asset('storage/' . $data['url']) }}" alt="{{ $data['alt'] ?? '' }}" class="w-full">
                        @if(!empty($data['caption']))
                            <figcaption class="p-4 bg-white text-xs text-gray-400 text-center italic">{{ $data['caption'] }}</figcaption>
                        @endif
                    </figure>

                @elseif($block->type === 'card')
                    <div class="bg-white rounded-3xl overflow-hidden shadow-soft flex flex-col">
                        @if(!empty($data['image']))
                            <img src="{{ asset('storage/' . $data['image']) }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h4 class="font-bold text-museum-green mb-2">{{ $data['title'] ?? '' }}</h4>
                            <p class="text-xs text-gray-500 mb-6 leading-relaxed">{{ $data['desc'] ?? '' }}</p>
                            @if(!empty($data['btn_link']))
                                <a href="{{ $data['btn_link'] }}" class="inline-block px-6 py-2 bg-museum-brown text-white rounded-full text-xs font-black uppercase tracking-widest shadow-md">
                                    {{ $data['btn_text'] ?? 'Learn More' }}
                                </a>
                            @endif
                        </div>
                    </div>

                @elseif($block->type === 'button')
                    <div class="flex justify-center">
                        <a href="{{ $data['url'] }}" @if($data['new_tab'] ?? false) target="_blank" @endif class="w-full py-4 bg-museum-green text-white rounded-2xl text-center font-bold shadow-lg hover:bg-museum-darkGreen transition-all">
                            {{ $data['text'] }}
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>

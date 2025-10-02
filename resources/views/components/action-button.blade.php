@props([
    // Generic identity for modal scoping
    'entityId' => null,
    'entityName' => null,
    // Modal title
    'title' => 'Actions',
    // Array of actions: [ ['label' => 'View', 'url' => '#', 'method' => 'GET', 'color' => 'blue'] ]
    'actions' => [],
    // Button class for the trigger
    'triggerClass' => 'text-gray-600 hover:text-purple-600 cursor-pointer',
])

<div x-data="{ open: false }" class="inline">
    <button 
        type="button"
        class="{{ $triggerClass }}"
        @click="open = true"
        aria-haspopup="dialog"
        :aria-expanded="open.toString()"
        aria-controls="action-modal-{{ $entityId }}"
    >
        ⋮
    </button>

    <div 
        x-cloak
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        @keydown.escape.window="open = false"
        @click.self="open = false"
        role="dialog"
        aria-modal="true"
        id="action-modal-{{ $entityId }}"
    >
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4">
            <div class="px-5 py-4 border-b flex items-center justify-between">
                <h2 class="text-lg font-semibold">{{ $title }}</h2>
                <button type="button" class="text-gray-500 hover:text-gray-700" @click="open = false">✕</button>
            </div>
            <div class="px-5 py-4">
                @if($entityName)
                <p class="text-gray-700">Actions for: <strong>{{ $entityName }}</strong></p>
                @endif
                <div class="mt-4 grid grid-cols-2 gap-3">
                    @forelse($actions as $action)
                        @php
                            $label = $action['label'] ?? 'Action';
                            $url = $action['url'] ?? null;
                            $method = strtoupper($action['method'] ?? 'GET');
                            $span = ($action['full'] ?? false) ? 'col-span-2' : '';
                            $customClass = trim($action['class'] ?? 'bg-gray-600 text-white hover:bg-gray-700');
                            $baseBtn = 'px-4 py-2 rounded text-center';
                            $classes = trim($customClass . ' ' . $baseBtn);
                        @endphp

                        @if($url && $method === 'GET')
                            <a href="{{ $url }}" class="{{ $classes }} {{ $span }}">{{ $label }}</a>
                        @elseif($url)
                            <form action="{{ $url }}" method="POST" class="{{ $span }}">
                                @csrf
                                @if(!in_array($method, ['GET','POST']))
                                    @method($method)
                                @endif
                                <button type="submit" class="w-full {{ $classes }}">{{ $label }}</button>
                            </form>
                        @else
                            <button type="button" class="{{ $classes }} {{ $span }}" @click="open = false">{{ $label }}</button>
                        @endif
                    @empty
                        <button type="button" class="col-span-2 px-4 py-2 rounded bg-gray-600 text-white hover:bg-gray-700" @click="open = false">Close</button>
                    @endforelse
                </div>
            </div>
            <div class="px-5 py-3 border-t flex justify-end">
                <button type="button" class="px-4 py-2 rounded bg-gray-600 text-white hover:bg-gray-700" @click="open = false">Close</button>
            </div>
        </div>
    </div>
</div>



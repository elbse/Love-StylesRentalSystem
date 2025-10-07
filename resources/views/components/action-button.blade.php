@props([
    // Generic identity for modal scoping
    'entityId' => null,
    'entityName' => null,
    'entityEmail' => null,
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
        class="{{ $triggerClass }} flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 transition-colors duration-200"
        @click="open = true"
        aria-haspopup="dialog"
        :aria-expanded="open.toString()"
        aria-controls="action-modal-{{ $entityId }}"
    >
        <span class="text-lg font-bold">⋮</span>
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
            <div class="px-5 py-4 border-b">
                <h2 class="text-lg font-semibold">{{ $title }}</h2>
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
                            
                            // Color psychology-based button colors
                            $defaultColors = 'bg-gray-600 text-white hover:bg-gray-700';
                            if (strtolower($label) === 'view') {
                                $customClass = 'bg-blue-600 text-white hover:bg-blue-700';
                            } elseif (strtolower($label) === 'edit') {
                                $customClass = 'bg-purple-600 text-white hover:bg-purple-700';
                            } elseif (in_array(strtolower($label), ['reactivate', 'reactivation'])) {
                                $customClass = 'bg-green-600 text-white hover:bg-green-700';
                            } elseif (strtolower($label) === 'deactivate') {
                                $customClass = 'bg-red-600 text-white hover:bg-red-700';
                            } else {
                                $customClass = $defaultColors;
                            }
                            
                            $baseBtn = 'px-4 py-2 rounded text-center transition-colors duration-200';
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
                        @elseif($method === 'MODAL')
                            <button 
                                type="button" 
                                class="{{ $classes }} {{ $span }}" 
                                @click="$dispatch('open-deactivate-modal', { id: '{{ $entityId }}', name: '{{ $entityName }}', email: '{{ $entityEmail }}' }); open = false">
                                {{ $label }}
                            </button>
                        @else
                            <button type="button" class="{{ $classes }} {{ $span }}" @click="open = false">{{ $label }}</button>
                        @endif


                    @empty
                        <button type="button" class="col-span-2 px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600 transition-colors duration-200" @click="open = false">Close</button>
                    @endforelse
                </div>
            </div>
            <div class="px-5 py-3 border-t flex justify-end">
                <button type="button" class="px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600 transition-colors duration-200" @click="open = false">Close</button>
            </div>
        </div>
    </div>
</div>



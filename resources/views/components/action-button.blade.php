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
        class="{{ $triggerClass }} flex items-center justify-center w-8 h-8 rounded-full hover:bg-purple-100 transition-all duration-200"
        @click="open = true"
        aria-haspopup="dialog"
        :aria-expanded="open.toString()"
        aria-controls="action-modal-{{ $entityId }}"
    >
        <span class="text-lg font-bold text-purple-600">⋮</span>
    </button>

    <div 
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm"
        @keydown.escape.window="open = false"
        @click.self="open = false"
        role="dialog"
        aria-modal="true"
        id="action-modal-{{ $entityId }}"
    >
        <div 
            class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-500 overflow-hidden relative z-[10000]"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-90 translate-y-8"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-8"
        >
            <!-- Gradient Header -->
            <div class="relative px-8 py-6 text-white overflow-hidden bg-gradient-to-r from-purple-500 via-purple-600 to-indigo-600">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 20px 20px;"></div>
                </div>
                
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-2xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ $title }}</h2>
                            <p class="text-white/80 text-sm">Customer Management</p>
                        </div>
                    </div>
                    <button @click="open = false" 
                            class="p-2 hover:bg-white/20 rounded-xl transition-all duration-200 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="px-8 py-6">
                <!-- Customer Info Card -->
                @if($entityName)
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl p-6 mb-6 border border-purple-100">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($entityName) }}&background=C16BFF&color=fff&size=64" 
                                 alt="Customer" class="w-16 h-16 rounded-2xl border-4 border-white shadow-lg">
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-2 border-white flex items-center justify-center bg-purple-500">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900">{{ $entityName }}</h3>
                            @if($entityEmail)
                            <p class="text-purple-600 font-medium">{{ $entityEmail }}</p>
                            @endif
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    ID: {{ $entityId }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Actions Grid -->
                <div class="grid grid-cols-1 gap-4">
                    @forelse($actions as $action)
                        @php
                            $label = $action['label'] ?? 'Action';
                            $url = $action['url'] ?? null;
                            $method = strtoupper($action['method'] ?? 'GET');
                            
                            // Enhanced color psychology-based button colors
                            if (strtolower($label) === 'view') {
                                $customClass = 'bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white';
                                $icon = 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z';
                            } elseif (strtolower($label) === 'edit') {
                                $customClass = 'bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white';
                                $icon = 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z';
                            } elseif (in_array(strtolower($label), ['reactivate', 'reactivation'])) {
                                $customClass = 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white';
                                $icon = 'M13 10V3L4 14h7v7l9-11h-7z';
                            } elseif (strtolower($label) === 'deactivate') {
                                $customClass = 'bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white';
                                $icon = 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728';
                            } else {
                                $customClass = 'bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white';
                                $icon = 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4';
                            }
                            
                            $baseBtn = 'px-6 py-4 rounded-2xl text-center transition-all duration-200 flex items-center justify-center space-x-3 font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5';
                            $classes = trim($customClass . ' ' . $baseBtn);
                        @endphp

                        @if($url && $method === 'GET')
                            <a href="{{ $url }}" class="{{ $classes }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                </svg>
                                <span>{{ $label }}</span>
                            </a>
                        @elseif($url)
                            <form action="{{ $url }}" method="POST">
                                @csrf
                                @if(!in_array($method, ['GET','POST']))
                                    @method($method)
                                @endif
                                <button type="submit" class="w-full {{ $classes }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                    </svg>
                                    <span>{{ $label }}</span>
                                </button>
                            </form>
                        @elseif($method === 'MODAL')
                            <button 
                                type="button" 
                                class="{{ $classes }}" 
                                @click="$dispatch('open-deactivate-modal', { id: '{{ $entityId }}', name: '{{ $entityName }}', email: '{{ $entityEmail }}' }); open = false">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                </svg>
                                <span>{{ $label }}</span>
                            </button>
                        @else
                            <button type="button" class="{{ $classes }}" @click="open = false">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                </svg>
                                <span>{{ $label }}</span>
                            </button>
                        @endif
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium">No actions available</p>
                        </div>
                    @endforelse
                </div>

                <!-- Close Button -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <button type="button" 
                            class="w-full px-6 py-3 text-sm font-bold text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-500/20 transition-all duration-200"
                            @click="open = false">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



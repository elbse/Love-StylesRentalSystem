{{--
    Flat filter:
    ['name' => 'status', 'label' => 'Filter by Status', 'placeholder' => 'All Statuses', 'options' => [
        ['value' => 'active', 'label' => 'Active'],
    ]]

    Grouped filter (set 'grouped' => true, use 'group'/'items' instead of flat 'options'):
    ['name' => 'category', 'label' => 'Filter by Category', 'placeholder' => 'All Categories', 'grouped' => true, 'options' => [
        ['group' => 'Suits', 'items' => [
            ['value' => 'tuxedo', 'label' => 'Tuxedo'],
        ]],
    ]]
--}}

@props([
    'route',
    'placeholder' => 'Search...',
    'label'       => 'Search',
    'filters'     => [],
])

<div class="mx-4 bg-white rounded-lg shadow-md p-4 mb-6">
    <form method="GET" action="{{ route($route) }}" class="flex flex-col md:flex-row gap-4 items-end">

        {{-- Search Input --}}
        <div class="flex-1">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l3.817 3.817a1 1 0 01-1.414 1.414l-3.817-3.817A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </span>
                <input type="text"
                       id="search"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="{{ $placeholder }}"
                       class="w-full border border-gray-300 rounded-lg pl-10 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                @if(request('q'))
                    <a href="{{ route($route, array_filter(request()->except('page', 'q'))) }}"
                       class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                       title="Clear search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
            </div>
        </div>

        {{-- Dynamic Filters --}}
        @foreach($filters as $filter)
            <div class="w-full md:w-48">
                <label for="{{ $filter['name'] }}" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $filter['label'] }}
                </label>
                <select name="{{ $filter['name'] }}"
                        id="{{ $filter['name'] }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">{{ $filter['placeholder'] ?? 'All' }}</option>

                    @if(!empty($filter['grouped']))
                        {{-- Grouped options --}}
                        @foreach($filter['options'] as $group)
                            <optgroup label="{{ $group['group'] }}">
                                @foreach($group['items'] as $item)
                                    <option value="{{ $item['value'] }}" {{ request($filter['name']) == $item['value'] ? 'selected' : '' }}>
                                        {{ $item['label'] }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    @else
                        {{-- Flat options --}}
                        @foreach($filter['options'] as $option)
                            <option value="{{ $option['value'] }}" {{ request($filter['name']) == $option['value'] ? 'selected' : '' }}>
                                {{ $option['label'] }}
                            </option>
                        @endforeach
                    @endif

                </select>
            </div>
        @endforeach

        {{-- Action Buttons --}}
        <div class="flex gap-2">
            <button type="submit"
                    class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l3.817 3.817a1 1 0 01-1.414 1.414l-3.817-3.817A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                Search
            </button>
            <a href="{{ route($route) }}"
               class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                </svg>
                Reset
            </a>
        </div>

    </form>
</div>
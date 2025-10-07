<x-landing>
     <script src="//unpkg.com/alpinejs" defer></script>
     <style>
         [x-cloak] { display: none !important; }
     </style>
     
     <div class="bg-[#393939] relative rounded-2xl shadow-lg p-8 w-[28rem] overflow-hidden">


        <img src="{{ asset('storage/images/vector_one.png') }}"
             alt="Decoration"
             class="absolute inset-0 w-full h-full object-cover -z-20 fill-white">


        <h3 class="text-white text-lg font-semibold mb-6">Log In</h3>

        <form action="{{ route('login')}}" method="POST" class="space-y-4" x-data="{ showPassword: false }" x-cloak>


            @csrf
            <input type="email" name="email" placeholder="user@email.com"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 bg-white focus:ring-purple-500 outline-none">

            <div class="relative">
                <input 
                    :type="showPassword ? 'text' : 'password'" 
                    name="password" 
                    placeholder="Password"
                    class="w-full px-4 py-2 pr-12 rounded-lg border border-gray-300 focus:ring-2 bg-white focus:ring-purple-500 outline-none">
                <button 
                    type="button" 
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                    </svg>
                </button>
            </div>

            <button type="submit"
                    class="w-full bg-[#7267EF] hover:bg-purple-700 text-white font-medium py-2 rounded-lg">
                LOG IN
            </button>

            @if ($errors->any())
                <div class="mt-4 rounded-lg bg-red-50 border border-red-200 p-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10c0 4.418-3.582 8-8 8s-8-3.582-8-8
                                    3.582-8 8-8 8 3.582 8 8zm-8-4a1 1 0 00-.894.553l-3
                                    6A1 1 0 007 14h6a1 1 0 00.894-1.447l-3-6A1 1
                                    0 0010 6zm0 8a1 1 0 110-2 1 1 0 010 2z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-semibold text-red-700">Please fix the following:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</x-landing>

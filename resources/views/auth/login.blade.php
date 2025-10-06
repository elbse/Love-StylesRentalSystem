<x-landing>
     <div class="bg-[#393939] relative rounded-2xl shadow-lg p-8 w-full max-w-md overflow-hidden">


        <img src="{{ asset('storage/images/vector_one.png') }}"
             alt="Decoration"
             class="absolute inset-0 w-full h-full object-cover -z-20 fill-white">


        <h3 class="text-white text-lg font-semibold mb-6">Log In</h3>

        <form action="{{ route('login')}}" method="POST" class="space-y-4">


            @csrf
            <input type="email" name="email" placeholder="user@email.com"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 bg-white focus:ring-purple-500 outline-none">

            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 bg-white focus:ring-purple-500 outline-none">

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

<x-landing>
    <div class="bg-gray-800 bg-opacity-90 rounded-2xl shadow-lg p-8 w-full max-w-md">
        <h3 class="text-white text-lg font-semibold mb-6">Log In</h3>

        <form action="{{ route('login')}}" method="POST" class="space-y-4">
            @csrf

            <input type="name" name="name" placeholder="Name"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 bg-white focus:ring-purple-500 outline-none">

            <input type="email" name="email" placeholder="Email"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 bg-white focus:ring-purple-500 outline-none">
            
            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 bg-white focus:ring-purple-500 outline-none">

            <button type="submit"
                    class="w-full bg-[#7267EF] hover:bg-purple-700 text-white font-medium py-2 rounded-lg">
                LOG IN
            </button>
        </form>
    </div>
</x-landing>

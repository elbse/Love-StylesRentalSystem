<x-layout>

    @if (session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mx-4 mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-lg" 
         role="status" 
         aria-live="polite">
        <div class="flex items-center gap-3">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-semibold text-green-800">Success!</h3>
                <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="flex-shrink-0 text-green-600 hover:text-green-800 transition-colors duration-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>
    @endif

    @if ($errors->any())
    <div x-data="{ show: true }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mx-4 mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 shadow-lg" 
         role="alert" 
         aria-live="polite">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-red-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-semibold text-red-800">Validation Errors</h3>
                <ul class="mt-2 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-700 flex items-start gap-2">
                            <span class="text-red-500 mt-1">•</span>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button @click="show = false" class="flex-shrink-0 text-red-600 hover:text-red-800 transition-colors duration-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
    </div>
    @endif

    <div class="max-w-6xl mx-auto p-4 md:p-5">
        <form action="{{ route('customers.store') }}" enctype="multipart/form-data" method="POST"
          class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
          
        @csrf
        
        <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-5 md:px-6 py-4 border-b border-gray-200 ">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">Create New Customer</h2>
            <p class="text-xs md:text-sm text-gray-600 mt-1">Add customer information and measurements</p>
        </div>

        <div class="p-5 md:p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                <div class="space-y-4">
                    <div class="pb-2 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Customer Information</h3>
                    </div>
 
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name <span class="text-red-500">*</span></label>
                        <input type="text" name="full_name" id="full_name" 
                        class="border border-gray-300 rounded-lg w-full px-3.5 py-2 focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                        value="{{ old('full_name') }}" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" 
                        class="border border-gray-300 rounded-lg w-full px-3.5 py-2 focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                        value="{{ old('email') }}" required>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="address" 
                        class="border border-gray-300 rounded-lg w-full px-3.5 py-2 focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                        value="{{ old('address') }}" required>
                    </div>

                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Contact Number <span class="text-red-500">*</span></label>
                        <input type="text" name="contact_number" id="contact_number" 
                        class="border border-gray-300 rounded-lg w-full px-3.5 py-2 focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                        value="{{ old('contact_number') }}" required>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" id="notes" rows="3"
                        class="border border-gray-300 rounded-lg w-full px-3.5 py-2 focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all resize-none">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-gradient-to-br from-slate-50 to-gray-50 p-5 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-2 pb-3 border-b border-gray-200 mb-4">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900  ">Measurements</h3>
                        </div>

                        <div class="space-y-3.5">
                            <div>
                                <label for="size" class="block text-sm font-medium text-gray-700 mb-2">Size</label>
                                <select name="size" id="size" 
                                        class="border border-gray-300 rounded-lg w-full px-3.5 py-2 text-gray-700 bg-white focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all">
                                    <option value="" disabled {{ old('size') ? '' : 'selected' }} class="text-gray-400">Select a size</option>
                                    <option value="XS" {{ old('size')=='XS' ? 'selected' : '' }}>Extra Small (XS)</option>
                                    <option value="S" {{ old('size')=='S' ? 'selected' : '' }}>Small (S)</option>
                                    <option value="M" {{ old('size')=='M' ? 'selected' : '' }}>Medium (M)</option>
                                    <option value="L" {{ old('size')=='L' ? 'selected' : '' }}>Large (L)</option>
                                    <option value="XL" {{ old('size')=='XL' ? 'selected' : '' }}>Extra Large (XL)</option>
                                </select>
                            </div>

                            <div>
                                <label for="height" class="block text-sm font-medium text-gray-700 mb-2">Height</label>
                                <input name="height" id="height" 
                                class="border border-gray-300 rounded-lg w-full px-3.5 py-2 text-gray-700 bg-white focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                                placeholder="e.g., 152cm" value="{{ old('height') }}">
                            </div>

                            <div>
                                <label for="bust" class="block text-sm font-medium text-gray-700 mb-2">Bust</label>
                                <input name="bust" id="bust" 
                                class="border border-gray-300 rounded-lg w-full px-3.5 py-2 text-gray-700 bg-white focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                                placeholder="e.g., 34in" value="{{ old('bust') }}">
                            </div>

                            <div>
                                <label for="waist" class="block text-sm font-medium text-gray-700 mb-2">Waist</label>
                                <input name="waist" id="waist" 
                                class="border border-gray-300 rounded-lg w-full px-3.5 py-2 text-gray-700 bg-white focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                                placeholder="e.g., 26in" value="{{ old('waist') }}">
                            </div>

                            <div>
                                <label for="hips" class="block text-sm font-medium text-gray-700 mb-2">Hips</label>
                                <input name="hips" id="hips" 
                                class="border border-gray-300 rounded-lg w-full px-3.5 py-2 text-gray-700 bg-white focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all" 
                                placeholder="e.g., 36in" value="{{ old('hips') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-5 md:px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row gap-3 sm:justify-end">
            <a href="{{ route('customers.index') }}" 
               class="inline-flex items-center justify-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent rounded-lg text-sm font-medium text-white bg-slate-700 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 shadow-sm transition-all">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Customer
            </button>
        </div>

        </form>
    </div>
</x-layout>
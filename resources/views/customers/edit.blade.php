<x-layout title="Edit Customer">

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
         class="mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-lg" 
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
         x-init="setTimeout(() => show = false, 8000)" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 shadow-lg" 
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

    <div class="w-full p-4 md:p-5">
        @if($customer)
        <form method="POST" action="{{ route('customers.update', ['customer_id' => $customer->customer_id]) }}" enctype="multipart/form-data"
              class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden relative">
          
        @csrf
        @method('PUT')
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="z-index: 1;">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #6366f1 2px, transparent 2px), radial-gradient(circle at 75% 75%, #8b5cf6 2px, transparent 2px); background-size: 40px 40px;"></div>
        </div>
        
        <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 px-5 md:px-6 py-6 border-b border-gray-200 relative">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-white">Edit Customer</h2>
                    <p class="text-sm text-white/80 mt-1">Update {{ $customer->full_name }}'s information and measurements</p>
                    <p class="text-xs text-white/60 mt-1">Customer ID: {{ $customer->customer_id }}</p>
                </div>
            </div>
        </div>

<div class="p-6 md:p-8 relative" style="background: linear-gradient(rgba(255,255,255,0.6), rgba(255,255,255,0.6)), url('{{ asset('storage/images/Vector_34.png') }}') no-repeat; background-size: 920px 620px; z-index: 2;">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
                <div class="space-y-6">
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-4 rounded-xl border border-purple-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Customer Information</h3>
                        </div>
                    </div>
 
                    <div class="space-y-5">
                        <div>
                            <label for="full_name" class="block text-sm font-semibold text-gray-800 mb-3">Customer Name <span class="text-red-500">*</span></label>
                            <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $customer->full_name) }}" 
                                   class="border-2 {{ $errors->has('full_name') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('full_name') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                   placeholder="Enter customer's full name" required>
                            @if($errors->has('full_name'))
                                <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $errors->first('full_name') }}
                                </p>
                            @endif
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-800 mb-3">Email Address <span class="text-red-500">*</span></label>
                            <input id="email" name="email" type="email" value="{{ old('email', $customer->email) }}" 
                                   class="border-2 {{ $errors->has('email') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('email') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                   placeholder="customer@example.com" required>
                            @if($errors->has('email'))
                                <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-800 mb-3">Address <span class="text-red-500">*</span></label>
                            <input id="address" name="address" type="text" value="{{ old('address', $customer->address) }}" 
                                   class="border-2 {{ $errors->has('address') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('address') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                   placeholder="Enter complete address" required>
                            @if($errors->has('address'))
                                <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $errors->first('address') }}
                                </p>
                            @endif
                        </div>

                        <div>
                            <label for="contact_number" class="block text-sm font-semibold text-gray-800 mb-3">Contact Number <span class="text-red-500">*</span></label>
                            <input id="contact_number" name="contact_number" type="tel" value="{{ old('contact_number', $customer->contact_number) }}" 
                                   class="border-2 {{ $errors->has('contact_number') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('contact_number') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                   placeholder="09234923 or +639234923"
                                   pattern="^[+]?[0-9\s\(\)]*[0-9][0-9\s\(\)]*$" 
                                   title="Please enter a valid phone number (only positive numbers allowed)"
                                   minlength="7"
                                   maxlength="20"
                                   oninput="this.value = this.value.replace(/[^+0-9\s\(\)]/g, '')"
                                   required>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Enter phone number with only positive numbers (no negative signs)
                            </p>
                            @if($errors->has('contact_number'))
                                <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $errors->first('contact_number') }}
                                </p>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-5 rounded-xl border border-emerald-200 shadow-sm">
                        <div class="flex items-center gap-3 pb-3 border-b border-emerald-200 mb-5">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Measurements</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="size" class="block text-sm font-semibold text-gray-800 mb-3">Size <span class="text-red-500">*</span></label>
                                <select id="size" name="size" 
                                        class="border-2 {{ $errors->has('size') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 text-gray-700 bg-white focus:ring-4 {{ $errors->has('size') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200">
                                    <option value="" disabled {{ old('size', $customer->measurement['size'] ?? $customer->measurement['chest'] ?? '') ? '' : 'selected' }} class="text-gray-400">Select a size</option>
                                    <option value="XS" {{ old('size', $customer->measurement['size'] ?? $customer->measurement['chest'] ?? '') == 'XS' ? 'selected' : '' }}>Extra Small (XS)</option>
                                    <option value="S" {{ old('size', $customer->measurement['size'] ?? $customer->measurement['chest'] ?? '') == 'S' ? 'selected' : '' }}>Small (S)</option>
                                    <option value="M" {{ old('size', $customer->measurement['size'] ?? $customer->measurement['chest'] ?? '') == 'M' ? 'selected' : '' }}>Medium (M)</option>
                                    <option value="L" {{ old('size', $customer->measurement['size'] ?? $customer->measurement['chest'] ?? '') == 'L' ? 'selected' : '' }}>Large (L)</option>
                                    <option value="XL" {{ old('size', $customer->measurement['size'] ?? $customer->measurement['chest'] ?? '') == 'XL' ? 'selected' : '' }}>Extra Large (XL)</option>
                                </select>
                                @if($errors->has('size'))
                                    <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $errors->first('size') }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="height" class="block text-sm font-semibold text-gray-800 mb-3">Height</label>
                                <input id="height" name="height" type="text" value="{{ old('height', $customer->measurement['height'] ?? '') }}" 
                                       class="border-2 {{ $errors->has('height') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('height') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                       placeholder="e.g., 152cm">
                                @if($errors->has('height'))
                                    <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $errors->first('height') }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="bust" class="block text-sm font-semibold text-gray-800 mb-3">Bust</label>
                                <input id="bust" name="bust" type="text" value="{{ old('bust', $customer->measurement['chest'] ?? '') }}" 
                                       class="border-2 {{ $errors->has('bust') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('bust') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                       placeholder="e.g., 34in">
                                @if($errors->has('bust'))
                                    <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $errors->first('bust') }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="waist" class="block text-sm font-semibold text-gray-800 mb-3">Waist</label>
                                <input id="waist" name="waist" type="text" value="{{ old('waist', $customer->measurement['waist'] ?? '') }}" 
                                       class="border-2 {{ $errors->has('waist') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('waist') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                       placeholder="e.g., 26in">
                                @if($errors->has('waist'))
                                    <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $errors->first('waist') }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="hips" class="block text-sm font-semibold text-gray-800 mb-3">Hips</label>
                                <input id="hips" name="hips" type="text" value="{{ old('hips', $customer->measurement['hips'] ?? '') }}" 
                                       class="border-2 {{ $errors->has('hips') ? 'border-red-500 bg-red-50' : 'border-gray-200' }} rounded-xl w-full px-4 py-3 focus:ring-4 {{ $errors->has('hips') ? 'focus:ring-red-500/20 focus:border-red-500' : 'focus:ring-purple-500/20 focus:border-purple-500' }} transition-all duration-200 text-gray-700 placeholder-gray-400" 
                                       placeholder="e.g., 36in">
                                @if($errors->has('hips'))
                                    <p class="text-xs text-red-600 mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $errors->first('hips') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 md:px-8 py-6 border-t border-gray-200 flex flex-col sm:flex-row gap-4 sm:justify-end relative z-10">
            <a href="{{ route('customers.index') }}" 
               class="inline-flex items-center justify-center px-8 py-3 border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-500/20 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Cancel
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-8 py-3 border-2 border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-purple-500/20 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Changes
            </button>
        </div>

        </form>
        @else
        <div class="w-full p-4 md:p-5">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Customer Not Found</h3>
                    <p class="text-gray-600 mb-6">The customer you're looking for doesn't exist or has been removed.</p>
                    <a href="{{ route('customers.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border-2 border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-purple-500/20 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Customers
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-layout>
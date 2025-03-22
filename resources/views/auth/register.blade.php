<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Create your Account') }}</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="grid grid-cols-2 gap-4 space-y-2">
            <!-- ID number -->
            <div>
                <x-label for="idnum">{{ __('ID Number') }} <span class="text-red-500">*</span></x-label>
                <x-input id="idnum" type="text" name="idnum" :value="old('idnum')" required autofocus autocomplete="idnum" />
                <x-error-input :messages="$errors->get('idnum')" class="mt-2" />
            </div>

            <!-- First Name -->
            <div>
                <x-label for="fname" :value="__('First Name')" />
                <x-input id="fname" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
                <x-error-input :messages="$errors->get('fname')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div>
                <x-label for="lname" :value="__('Last Name')" />
                <x-input id="lname" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
                <x-error-input :messages="$errors->get('lname')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-error-input :messages="$errors->get('email')" class="mt-2" />
            </div>

            
            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-error-input :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-error-input :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        
        <div class="flex items-center justify-end mt-6">
            <x-button>
                {{ __('Sign Up') }}
            </x-button>                
        </div>      
    </form>
    <x-validation-errors class="mt-4" />  
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-gray-100 dark:border-gray-700/60">
        <div class="text-sm">
            {{ __('Have an account?') }} <a class="font-medium text-violet-500 hover:text-violet-600 dark:hover:text-violet-400" href="{{ route('login') }}">{{ __('Sign In') }}</a>
        </div>
    </div>
</x-authentication-layout>

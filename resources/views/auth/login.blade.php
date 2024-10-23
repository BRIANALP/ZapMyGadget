<x-layout>

    <x-slot:title>Log In</x-slot:title>
    <x-slot:heading>
        Log In
    </x-slot:heading>

    <!-- Parent container -->
    <div class="flex items-center justify-center min-h-screen">
        <form method='POST' action="/session" class="bg-white p-8 rounded shadow-lg w-full max-w-lg">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Log In</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Enter your login details</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form-field>
                            <x-form-label for="email">Email</x-form-label>
                            <div class="mt-2">
                                <x-form-input name="email" id="email" :value="old('email')" required/>
                                <x-form-error name="email">
                                    <p>Please enter an appropriate email</p>
                                </x-form-error>
                            </div>
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="password">Password</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="password" name="password" id="password" required/>
                                <x-form-error name="password">
                                    <p>Password must have more than 8 characters</p>
                                </x-form-error>
                            </div>
                        </x-form-field>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <x-button type="submit">Log In</x-button>
                </div>
            </div>
        </form>
    </div>
</x-layout>

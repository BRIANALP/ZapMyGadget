<x-layout>

    <x-slot:title>Registration</x-slot:title>
    <x-slot:heading>
        Register
    </x-slot:heading>

    <!-- Parent container -->
    <div class="flex items-center justify-center min-h-screen">
        <form method='POST' action="/auth" class="bg-white p-8 rounded shadow-lg w-full max-w-lg">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Create account</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">We just need a handful of details from you.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form-field>
                            <x-form-label for="name">Name</x-form-label>
                            <div class="mt-2">
                                <x-form-input name="name" id="name" placeholder="Enter Username" required/>
                                <x-form-error name="name">
                                    <p>Enter a longer username</p>
                                </x-form-error>
                            </div>
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="email">Email</x-form-label>
                            <div class="mt-2">
                                <x-form-input name="email" id="email" placeholder="Enter Email" required/>
                                <!-- WE DON'T NEED THIS AS WE HAVE IMPORTED A VALIDATION LIBRARY
                                 <x-form-error name="email">
                                    <p>Please enter an appropriate email</p>
                                </x-form-error>
                                !-->
                            </div>
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="password">Password</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="password" name="password" id="password" required/>
                               <!--WE DONT NEED THIS AS WE IMPORTED PASSWORD VALIDATION LIBRARY DURING PASSWORD VALIDATION 
                                <x-form-error name="password">
                                   <p>Password must have more than 8 characters</p>
                                </x-form-error>!-->
                            </div>
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="password" name="password_confirmation" id="password_confirmation" required/>
                               <!--WE DONT NEED THIS AS WE IMPORTED PASSWORD VALIDATION LIBRARY DURING PASSWORD VALIDATION 
                                <x-form-error name="password">
                                   <p>Password must have more than 8 characters</p>
                                </x-form-error>!-->
                            </div>
                        </x-form-field>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <x-button type="submit">Submit</x-button>
                </div>
            </div>
        </form>
    </div>
</x-layout>

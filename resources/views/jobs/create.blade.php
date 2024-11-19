<x-layout>

    <x-slot:title>Job Creation</x-slot:title>      
    <form method='POST' action="/jobs">
        
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 neon-text">Hello,User!</h2>
            <p class="mt-6 text-sm leading-6">We just need a handful of details from you.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <x-form-field>
                    <x-form-label for="device_model">Device Model</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="device_model" id="device_model" placeholder="Enter the device's model" required/>
                        <x-form-error name="device_model">
                            <p>Enter an appropriate job device_model<p>
                        </x-form-error>
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="issue">Problem</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="issue" id="issue" placeholder="What's wrong with your machine"/>   
                        <x-form-error name='issue'>
                            <p>Please describe the issue with your machine</p>
                        </x-form-error>
                    </div>
                </x-form-field>


            </div>

        </div>
        <div class="mt-6 flex items-center justify-start gap-x-6">
                        <button type="reset" class="text-sm font-semibold leading-6 text-white">Cancel</button>
                        <x-button type="submit">Post</x-button>
                
        </div>
    </form>
</x-layout>
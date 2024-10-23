<x-layout>

    <x-slot:title>Job Creation</x-slot:title>
    <x-slot:heading>
        Create Job
    </x-slot:heading>        
    <form method='POST' action="/jobs">
        
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Create a new job</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">We just need a handful of details from you.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <x-form-field>
                    <x-form-label for="title">Job title</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="title" id="title" placeholder="Enter job title" required/>
                        <x-form-error name="title">
                            <p>Enter an appropriate job title<p>
                        </x-form-error>
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="salary">Salary</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="salary" id="salary" placeholder="$50000 per year"/>   
                        <x-form-error name='salary'>
                            <p>Please enter the salary in numeric form</p>
                        </x-form-error>
                    </div>
                </x-form-field>


            </div>

        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <x-button type="submit">Save</x-button>
                
        </div>
    </form>
</x-layout>
<x-layout>
    <x-slot:title>Edit Job</x-slot:title>
    <x-slot:heading>
        Edit Job: {{$job->title}}
    </x-slot:heading>        
    <form method="POST" action="/jobs/{{$job->id}}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit {{$job->title}} job details</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Job title</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="title" id="title" placeholder="Enter job title" value="{{$job->title}}" required/>
                            <x-form-error name='title'>
                                <p class='text-red-500 font-semibold text-sm'>Enter an appropriate job title</p>
                            </x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="salary">Salary</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="salary" id="salary" value="{{$job->salary}}" placeholder="$50000 per year" required/>   
                            <x-form-error name='salary'>
                                <p class='text-red-500 font-semibold text-sm'>Please enter the salary in numeric form</p>
                            </x-form-error> 
                        </div>
                    </x-form-field>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between gap-x-6">
                <div class="flex items-center text-red-500"> 
                    <button form="delete-form" class="text-sm font-semibold leading-6 text-red-900">Delete</button>
                </div>  
                <div class="flex items-center justify-between gap-x-6">
                    <a href="/jobs/{{$job->id}}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <x-button type="submit">Update</x-button> 
                </div>            
            </div>
        </div>
    </form>

    <form method="POST" action="/jobs/{{$job->id}}" id="delete-form" class="hidden">
        @csrf    
        @method('DELETE')
    </form>
</x-layout>

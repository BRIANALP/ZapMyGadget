<x-layout>

    <x-slot:title>Edit Job</x-slot:title>
    <x-slot:heading>
        Edit Job: {{$job['title']}}
    </x-slot:heading>        
    <form method="POST" action="/jobs/{{$job->id}}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Edit {{$job['title']}} job details</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Job title</label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input type="text" name="title" id="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Enter job title" value="{{$job['title']}}" required >
                        </div>
                        @error('title')
                        <p class='text-red-500 font-semibold text-sm'>Enter an appropriate job title<p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="salary" class="block text-sm font-medium leading-6 text-gray-900">Salary</label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input type="text" name="salary" id="salary" value="{{$job['salary']}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="$50000 per year"required>   
                    </div>
                    @error('salary')
                    <p class='text-red-500 font-semibold text-sm'>Please enter the salary in numeric form<p>
                    @enderror
                </div>


            </div>

        </div>


        
            <div class="mt-6 flex items-center justify-between gap-x-6">

                <div class="flex items-center text-color-red-500"> 
                    <button form="delete-form" class="text-sm font-semibold leading-6 text-red-900">Delete</button>
                </div>  
                <div class="flex items-center justify-between gap-x-6">
                    <a href="/jobs/{{$job->id}}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <x-button type="submit">Update</x-button> 
                </div>            
            </div>
    </form>
    <form method="POST" action="/jobs/{{$job->id}}" id="delete-form"  class="hidden">
            @csrf    
            @method('DELETE')
    </form>
</x-layout>
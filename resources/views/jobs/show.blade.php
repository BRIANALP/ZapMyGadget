<x-layout>

    <x-slot:title>{{$job['title']}}</x-slot:title>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <div class="space-y-5">    
        <h2 class="font-bold text-lg">{{$job['title']}}</h2>

        <p>
            This job pays ${{ $job['salary'] }} per year.
        </p>
        <p class="text-green-500">
            Posted on {{$job['created_at']}} by {{$job->employer->employer_name}} 
        </p>
        
        <div class='mt-6'>  
            <a class="rounded-md bg-[#0C2340] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" href="/jobs/{{ $job->id }}/edit"> Edit Job </a>
        </div>
        
    </div>
    
</x-layout>
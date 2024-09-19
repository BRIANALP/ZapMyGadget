<x-layout>

    <x-slot:title>{{$job['title']}}</x-slot:title>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <div class="space-y-5">    
    <h2 class="font-bold text-lg">{{$job['title']}}</h2>

    <p>
        This job pays {{ $job['salary'] }} per year.
    </p>
    <p class="text-green-500">
        Posted on {{$job['created_at']}} by {{$job->employer->employer_name}} 
    </p>
    </div>

</x-layout>
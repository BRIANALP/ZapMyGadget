<x-layout>
    <x-slot:title>Jobs</x-slot:title>
    <x-slot:heading>Job Listing</x-slot:heading>
    <div class="space-y-4">
        @foreach ($jobs as $job)          
                <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                    <div class="text-blue-500 font-bold text-sm">{{$job->employer->employer_name}}</div>
                    <div>
                    <strong>{{ $job['title']}}: </strong>earns a salary of {{$job['salary']}} per year.              
                    </div>
                </a>
        @endforeach   
    </div>  
    <div>
        {{ $jobs->links() }}
    </div>
</x-layout>
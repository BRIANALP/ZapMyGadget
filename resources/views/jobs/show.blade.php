<x-layout>

    <x-slot:title>{{$job['device_model']}}</x-slot:title>
    <heading class="font-bold text-3xl neon-text">
        Job Description
    </heading>
    <h3></h3>
    <div class="space-y-5 font-garamond text-xl mt-5">    
        <h2 class="font-bold text-3xl">{{$job['device_model']}}</h2>
        <p>    
        {{ $job['issue'] }}
        </p>
        <p class="text-softteal pt-9">
            Posted on {{$job['created_at']}} by {{$job->user->name}} from {{$job->employer->employer_name}} 
        </p>
        @if($job['response'] !== null)
            <p class="text-green-500 pt-9">
                Status updated on {{ $job['updated_at'] }} : {{ $job['response'] }}
            </p>
        @endif
        
        @if ($job['billing']!==null)
            <button class="bg-blue-400 rounded-md px-4 py-2 font-semibold text-white">Billed: ksh {{$job['billing']}}</button>
        @endif
        <!--Approval status button-->
        @if ($job['approval']==='approved')
            <button class="bg-green-400 rounded-md px-4 py-2 font-semibold text-white">Approved</button>
        @endif

        @if ($job['approval']===null||$job['approval']==='pending approval')
            <button class="bg-orange rounded-md px-4 py-2 font-semibold text-white">Pending Approval</button>
        @endif

        @if ($job['approval']==='not approved' )
            <button class="bg-green-400 rounded-md px-4 py-2 font-semibold text-white">Not Approved</button>
        @endif



    </div>
    
    @can('respond-job',$job)
    <div>
        
        <div class='mt-6'>  
            <a class="rounded-md bg-[#0C2340] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" href="/jobs/{{ $job->id }}/edit"> Respond </a>
        </div>
        
    </div>        
    @endcan
    
    
</x-layout>
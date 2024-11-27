<x-layout>
    <x-slot:title>Jobs</x-slot:title>
    <div class=" flex flex-row justify-start items-center mb-4 space-x-[140px]">
        <form action="/devicesearch" method="GET" class="flex flex-row justify-between">
            <input class="rounded-xl bg-white/10 text-sm px-5 py-4 w-full max-w-xl" type="text" name="query" placeholder="Laptop model name....">
        </form>
        @can('edit-job')
        <form action="/companysearch" method="GET" class="flex flex-row justify-between">
        
            <input class="rounded-xl bg-white/10 text-sm px-5 py-4 w-full max-w-xl" type="text" name="query2" placeholder="Company name...">
    
        </form>
        @endcan
    </div>
    <div class="space-y-4">
        
        @foreach ($jobs as $job)        
            
                    <div class="flex flex-row justify-between items-center neon-border">
                        <div class="w-full">  
                            <a href="/jobs/{{ $job['id'] }}" class="neon-box block px-4 py-6 border border-gray-200 rounded-lg">
                                <div class="text-blue-500 font-bold text-sm">{{$job->employer->employer_name}}</div>
                                <div>
                                <strong class="group-">{{ $job['device_model']}}: </strong>{{$job['issue']}}.              
                                </div>
                                <p class="mt-4 font-sour text-green-500">{{ $job['response']}}</p>

                            </a>
                        </div>
                        <div class="px-4">
                            @can('delete-job')
                                <div class="flex items-center text-red-500"> 
                                    <button form="delete-form" class="text-sm font-semibold leading-6 text-red-900">Delete</button>
                                </div> 
                                <form method="POST" action="/jobs/{{$job->id}}" id="delete-form" class="hidden">
                                    @csrf    
                                    @method('DELETE')
                                </form>
                            @endcan
                        </div>
                    
            </div>
        @endforeach   
    </div> 
    
    <div>
        {{ $jobs->links() }}
    </div>
</x-layout>
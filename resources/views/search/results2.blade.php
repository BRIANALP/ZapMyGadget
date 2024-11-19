<x-layout>
    <x-slot:title>Jobs</x-slot:title>
   
    <div class="space-y-4">
        
        @foreach ($results as $result)        
            
                    <div class="flex flex-row justify-between items-center neon-border">
                        <div class="w-full">  
                            <div class="block px-4 py-6 border border-gray-200 rounded-lg">
                                <div class="text-blue-500 font-bold text-xl font-garamond">{{$result->employer_name}}</div>
                                <!--I have used this for else loop cause the jobs are fetched as a collection as defined by the hasMany()
                                relationship in the Employee model.-->
                                @forelse (optional($result)->jobs ?? [] as $job)
                                    <a href="/jobs/{{ $job['id']}}" class="neon-box block px-4 py-6 border border-gray-200 rounded-lg">
                                        <div>
                                            <strong>{{ $job->device_model }}: </strong> {{ $job->issue }}.              
                                        </div>
                                        <p class="mt-4 font-sour text-green-500">{{ $job->response }}</p>
                                    </a>
                                @empty
                                    <p class="text-red-500">No results found</p>
                                @endforelse

                                
                            </div>
                        </div>
                       <div class="px-4">
                            @can('delete-job')
                                <div class="flex items-center text-red-500"> 
                                    <button form="delete-form" class="text-sm font-semibold leading-6 text-red-500">Delete</button>
                                </div> 
                                <form method="POST" action="/jobs/{{$result->id}}" id="delete-form" class="hidden">
                                    @csrf    
                                    @method('DELETE')
                                </form>
                            @endcan
                        </div>
                    </div>
        @endforeach   
    </div>  
</x-layout>
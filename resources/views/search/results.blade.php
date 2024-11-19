<x-layout>
    <x-slot:title>Jobs</x-slot:title>
   
    <div class="space-y-4">
        
        @foreach ($results as $result)        
            
                    <div class="flex flex-row justify-between items-center neon-border">
                        <div class="w-full">  
                            <a href="/jobs/{{ $result['id'] }}" class="neon-box block px-4 py-6 border border-gray-200 rounded-lg">
                                <div class="text-blue-500 font-bold text-sm">{{$result->employer->employer_name}}</div>
                                <div>
                                <strong>{{ $result['device_model']}}: </strong>{{$result['issue']}}.              
                                </div>
                                <p class="mt-4 font-sour text-green-500">{{ $result['response']}}</p>
                            </a>
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
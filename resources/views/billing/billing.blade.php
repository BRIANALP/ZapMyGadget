<x-layout>
    <x-slot:title>Billings</x-slot:title>
   
    <div class="space-y-4">
               
        @foreach ($jobs as $job)        
            
                    <div class="flex flex-row justify-between items-center neon-border">
                        <div class="w-full">  
                            <div class="neon-box block px-4 py-6 border border-gray-200 rounded-lg">
                                <div class="text-blue-500 font-bold text-sm">{{$employer->employer_name}}</div>
                                <div>
                                <strong>{{ $job['device_model']}}: </strong>{{$job['issue']}}.              
                                </div>
                                <p class="mt-4 font-sour text-green-500">{{ $job['response']}}</p>
                                <div class="flex justify-end">
                                    <button class="bg-green-400 text-white font-semibold px-4 py-2 rounded-lg">Ksh {{$job->billing}}</button>
                                </div>
                            </div>                           

                        </div>                    
                    </div>
        @endforeach   
    </div>  
</x-layout>
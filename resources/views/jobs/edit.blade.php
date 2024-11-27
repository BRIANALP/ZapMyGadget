<x-layout>
    <x-slot:title>Edit Job</x-slot:title>

    <form method="POST" action="/jobs/{{$job->id}}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-xl font-semibold leading-7 text-white">Respond to {{$job->device_model}} device</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="device_model">Device Model</x-form-label>
                        <div class="mt-2">                          
                            <x-form-input name="device_model" id="device_model" placeholder="Enter the device's model" value="{{$job->device_model}}" readonly 
                            required/>
                            <x-form-error name='device_model'>
                                <p class='text-red-500 font-semibold text-sm'>Enter an appropriate device name</p>
                            </x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="issue">Issue</x-form-label>
                        <div class="mt-2">  
                            <x-form-input name="issue" id="issue" value="{{$job->issue}}" placeholder="Edit device issue" required readonly/>   
                            
                            <x-form-error name='issue'>
                                <p class='text-red-500 font-semibold text-sm'>Please describe the issue</p>
                            </x-form-error> 
                        </div>
                    </x-form-field>
                    
                    <x-form-field>
                        <x-form-label for="response">Response</x-form-label>
                        <div class="mt-2">
                            @can('edit-job',$job)
                            <x-form-input name="response" id="response" value="{{$job->response}}" placeholder="To be resolved on ..."/>   
                            @endcan

                            @can('is-employer',$job)
                            <x-form-input name="response" id="response" value="{{$job->response}}" placeholder="To be resolved on ..." readonly/>   
                            @endcan
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="response">Billing</x-form-label>
                        <div class="mt-2">
                            @can('edit-job',$job)
                            <x-form-input name="billing" id="billing" value="{{$job->billing}}" placeholder="Amount in Ksh"/>   
                            @endcan
                            @can('is-employer')
                            <x-form-input name="billing" id="billing" value="{{$job->billing}}" placeholder="Amount in Ksh" readonly/>   
                            @endcan
                        </div>
                    </x-form-field>  
                    @can('edit-job',$job)   
                    <x-form-field>
                    <x-form-label for="repair_status">Repair Status</x-form-label>
                    <select 
                        name="repair_status" 
                        id="repair_status" 
                        class="form-select rounded-md px-4 py-2 
                        {{ $job->repair_status === 'repaired' ? 'bg-green-500' : ($job->repair_status === 'under service)' ? 'bg-red-500' : 'bg-blue-900') }}">
                        <option value="repaired" {{ $job->repair_status === 'repaired' ? 'selected' : '' }}>Repaired</option>
                        <option value="under service" {{ $job->repair_status === 'under service' ? 'selected' : '' }}>Under Service</option>
                        <option value="pending" {{ $job->repair_status === null ? 'selected' : '' }}>Pending Approval</option>
                    </select>
                    </x-form-field>  
                    @endcan
                    @can('is-employer')  
                    <x-form-field>
                    <x-form-label for="approval">Approval Status</x-form-label>
                    <select 
                        name="approval" 
                        id="approval" 
                        class="form-select rounded-md px-4 py-2 
                        {{ $job->approval === 'approved' ? 'bg-green-500' : ($job->approval === 'not approved' ? 'bg-red-500' : 'bg-blue-900') }}">
                        <option value="approved" {{ $job->approval === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="not approved" {{ $job->approval === 'not approved' ? 'selected' : '' }}>Not Approved</option>
                        <option value="pending" {{ $job->approval === null ? 'selected' : '' }}>Pending Approval</option>
                    </select>
                    </x-form-field>  
                    <!--@endcan-->
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between gap-x-6">
                <div class="flex items-center text-red-500"> 
                    <button form="delete-form" class="text-sm font-semibold leading-6 text-red-600">Delete</button>
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

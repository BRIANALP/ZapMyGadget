
<h2 class="font-sour font-bold">
    Device Name: {{ $job->device_model }}
</h2>
<h1>
    Posted By: {{$job->user->name}} on {{$job->created_at}}
</h1>
<p class="font-garamond">{{ $job->response}}</p>
<p class="semibold">Billing needing approval: Ksh{{$job->billing}}</p>




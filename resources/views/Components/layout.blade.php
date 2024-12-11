<!DOCTYPE html>
<html lang="en" class="h-full bg-[#06061f]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sour+Gummy" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  
    @vite(['resources/js/app.js'])
</head>
<body class = "h-full bg-[#06061f] text-white">

<div class="min-h-full">
  <nav>
    <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between mt-4">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img src ="{{ Vite::asset('resources/images/logo.png')}}"  class="w-24 p-2" alt="">
          </div>
          <!--Desktop view menu-->
          
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <x-navlink href="/" :active="request()->is('/')">Homepage</x-navlink>
              @auth
              <!--<x-navlink href="/jobs" :active="request() -> is('jobs')">Jobs</x-navlink>-->
              @can('post-job-only')
                  <x-navlink href="/employee_jobs" :active="request() -> is('employee_jobs')">My Jobs</x-navlink>
              @endcan

              @can('edit-job')
                  <x-navlink href="/jobs" :active="request()->is('jobs')">Jobs</x-navlink>
              @endcan
        
              
              @can('is-employer')
                <x-navlink href="/employer_jobs" :active="request() -> is('employer_jobs')">Jobs</x-navlink>
              @endcan

              
              @endauth

              @guest
              <x-navlink href="/login" :active="request() -> is('jobs')">Jobs</x-navlink>
              @endguest

              <x-navlink href="/about" :active="request() -> is('about')">About Me</x-navlink>

            </div>
          </div>
        </div>

        @guest
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <x-navlink href="/login" :active="request() -> is('login')">Login</x-navlink>
            <x-navlink href="/register" :active="request()->is('register')">Register</x-navlink>
          </div>
        </div>
        @endguest

        @auth
          <div class="flex flex-row space-x-2">      
      
            
              @php
                $employer=App\Models\Employer::where('user_id',Auth::user()->id)->first();
                $total_billings=0;
                if($employer)
                {
                  $jobs=App\Models\Job::where('repair_status','repaired')->get();
                  $total_billings=$jobs->sum('billing');
                }
              @endphp
              @can('is-employer')
              <form action="/view_billings">
              <x-button type="submit">
                  Current Billings: Ksh {{ $total_billings }}
              </x-button>
              </form>
              
             
            @endcan
         
          <form method="POST" action='/logout'>
            @csrf
            <x-button>Log out</x-button>
          </form>
          </div>
          
        @endauth

      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3 flex flex-col">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <x-navlink href="/" :active="request()->is('/')">Homepage</x-navlink>
        <x-navlink href="/jobs" :active="request() -> is('jobs')">Jobs</x-navlink>
        <x-navlink href="/about" :active="request() -> is('about')">About Me</x-navlink>
        @guest
          <x-navlink href="/login" :active="request() -> is('login')">Login</x-navlink>
          <x-navlink href="/register" :active="request()->is('register')">Register</x-navlink>
        @endguest
        @auth
          <div class="flex flex-row">
          @php
              $jobs = \App\Models\Job::where('employer_id', auth()->user()->user_id)
                                    ->where('repair_status', 'repaired')
                                    ->get();

              $total_billings = $jobs->sum('billings');
          @endphp

          <button class="bg-white rounded-md px-4 py-2 font-semibold text-black">
              Current Billings: {{ $total_billings }}
          </button>
          <form method="POST" action='/logout'>
            @csrf
            <x-button>Log out</x-button>
          </form>
          </div>
          
        @endauth
      </div>
    </div>
  </nav>
  <hr 
      class="mt-4"
      style="
        height: 4px; 
        background-color: teal; 
        border: none; "
  >
   {{-- Success Message --}}
   @if(session('success'))
    <div 
        id="success-message" 
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition-opacity duration-500 ease-in-out"
        role="alert"
    >
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    
      
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      {{$slot}}
    </div>
  </main>
</div>
</body>
</html>
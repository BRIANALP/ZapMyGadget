<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class = "h-full">

<div class="min-h-full">
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://cdn.pixabay.com/photo/2017/01/31/23/42/animal-2028258_960_720.png" alt="Your Company">
          </div>
          <!--Desktop view menu-->
          
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <!--where to insert the for loop to facilitate adaptive change in color of the navlinks onclick-->
              <x-navlink href="/" :active="request()->is('/')">Homepage</x-navlink>
              <x-navlink href="/jobs" :active="request() -> is('jobs')">Jobs</x-navlink>
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
        <form method="POST" action='/logout'>
          @csrf
          <x-button>Log out</x-button>
        </form>
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
        <x-navlink href="/login" :active="request() -> is('login')">Login</x-navlink>
        <x-navlink href="/register" :active="request()->is('register')">Register</x-navlink>


      </div>
    </div>
  </nav>

  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex items-center justify-between">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
      <x-button type="button" onclick="window.location.href='{{ url('/jobs/create') }}'">Create Job</x-button>
    </div>
</header>

  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      {{$slot}}
    </div>
  </main>
</div>
</body>
</html>
<x-layout>
<x-slot:title>
    Homepage
</x-slot:title>

<div class="container mx-auto mt-8 p-4">
    <!-- Welcome Section -->
    <section class="mb-8 text-white">
      <div class="flex flex-row justify-between">
          <img src ="{{ Vite::asset('resources/images/welcomelogo2.png')}}"alt="">
      </div>
    
      <p class="text-3xl font-semibold italic">
      Welcome to ZapMyGadget – Your Trusted ICT Management Partner!

      Are you looking for a seamless way to manage ICT issues across your organization without the need for on-site support? ZapMyGadget is here to make it easy.
      </p>
    </section>

    <!-- Dashboard Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Post an Issue Card -->
      @guest
      <a href="/login">
        <div class="bg-orange shadow-md rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-700 mb-4">Post a New Issue</h3>
          <p class="text-gray-600 mb-4">
            Report a malfunctioning device. Describe the issue to allow technicians to respond promptly.
          </p>         
        </div>
      </a>
      @endguest
      
      @auth
        <a href="/jobs/create">
          <div class="bg-orange shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Post a New Issue</h3>
            <p class="text-gray-600 mb-4">
              Report a malfunctioning device. Describe the issue to allow technicians to respond promptly.
            </p>         
          </div>
        </a>
      @endauth

      

      <!-- Ad Section with Image Placeholder -->
      <div class="bg-orange shadow-md rounded-lg overflow-hidden">
        <img src="https://picsum.photos/seed/{{rand(0,10000) }}/400/200" alt="Ad Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-xl font-bold text-gray-700 mb-2">Sponsored Ad</h3>
          <p class="text-gray-600">
            Discover top-quality computer repair services near you. Click to learn more!
          </p>
        </div>
      </div>

      <!-- Device Repair Status -->
      @guest
      <a href="/login">
        <div class="bg-orange shadow-md rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-700 mb-4">Device Repair Status</h3>
          <p class="text-gray-600 mb-4">
            Check the status of repairs on devices currently being serviced.
          </p>
        </div>
      </a>
      @endguest
      
      @auth
      <a href="/jobs">
        <div class="bg-orange shadow-md rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-700 mb-4">Device Repair Status</h3>
          <p class="text-gray-600 mb-4">
            Check the status of repairs on devices currently being serviced.
          </p>
        </div>
      </a>
      @endauth

      

      <!-- Recent Activities -->
      <div class="bg-orange shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-gray-700 mb-4">Recent Activities</h3>
        <ul class="text-gray-600 list-disc list-inside space-y-2">
          <li>Device A reported for repair.</li>
          <li>Technician assigned to Device B.</li>
          <li>Invoice generated for Device C repair.</li>
        </ul>
      </div>

      <!-- Image Section for Random Ads/Computers -->
      
      <div class="bg-orange shadow-md rounded-lg overflow-hidden">
        <img src="https://picsum.photos/seed/{{rand(0,10000) }}/400/200" alt="Computer Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-xl font-bold text-gray-700 mb-2">Computer Models & Tips</h3>
          <p class="text-gray-600">
            Learn about the latest computer models, maintenance tips, and more!
          </p>
        </div>
      </div>

      <!-- Billing Information -->
      <div class="bg-orange shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-gray-700 mb-4">Billing Information</h3>
        <h2 class="text-xl font-semibold mb-4">💼 <span class="text-lg">Stay on Top of Your IT Repairs with Ease!</span> 💼</h2>
        <p class="text-lg mb-4">🔧 <strong>Review Your Repair Costs</strong></p>
        <p class="mb-4">Gain full control over your repair expenses! Check recent repair costs, invoices, and payment history—all in one place.</p>
        
        <p class="text-lg mb-4">📄 <strong>Access Your Billing Information</strong></p>
        <p class="mb-4">Click on the job of interest to instantly view detailed invoices and billing breakdowns.</p>
        
        <p class="text-lg mb-4">✉️ <strong>Real-Time Email Notifications</strong></p>
        <p class="mb-4">Never miss a thing! Receive real-time emails on billings and decide whether to approve them with just one click.</p>
        
        <p class="font-bold text-xl mt-4">✨ <span class="text-lg">Efficiency Meets Transparency!</span></p>
        <p class="mt-2 pb-3">Simplify your workflow and take charge of your IT repair and maintenance billing today.</p>
        
        <a href="" class="mt-4 bg-bluetheme text-white px-6 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Start Now
        </a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-gray-800 p-4 text-center text-white mt-8">
    <p>&copy; 2024 IT Repair Dashboard. All rights reserved.</p>
  </footer>
</x-layout>
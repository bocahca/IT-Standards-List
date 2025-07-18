<nav class="bg-primary text-white shadow">
  <div class="container mx-auto pl-2 pr-4 flex items-center justify-between h-16">
    {{-- Brand Logo & Title --}}
    <div class="flex items-start space-x-2">
      <a href="{{ route('admin.categories.index') }}" class="flex items-center">

        <img src="{{ asset('images/logo-komdigi.png') }}"
             alt="Komdigi"
             class="h-8 w-auto"/>
        <span class="ml-5 text-lg font-heading">IT Standards Category</span>
      </a>
    </div>

    {{-- User dropdown --}}
    <div class="hidden sm:flex sm:items-center sm:ml-6">
      <x-dropdown align="right" width="48">
        <x-slot name="trigger">
          <button class="flex items-center text-sm font-medium text-white hover:text-primary-light focus:outline-none focus:text-primary-light transition">
            <div>{{ Auth::user()->name }}</div>
            <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1
                       0 011.414 1.414l-4 4a1 1 0 01-1.414
                       0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
          </button>
        </x-slot>

        <x-slot name="content">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link href="{{ route('logout') }}"
                             onclick="event.preventDefault(); this.closest('form').submit();"
                             class="text-red-600 hover:bg-red-100 hover:text-red-800 transition">
              {{ __('Log Out') }}
            </x-dropdown-link>
          </form>
        </x-slot>
      </x-dropdown>
    </div>
  </div>
</nav>

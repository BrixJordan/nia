<!-- navigation.blade.php -->
<div>
    <!-- Top Navigation -->
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-blue-800" />
                        </a>
                    </div>

                    
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Side Navigation -->
    <div class="flex text-left">
        <div class="side-nav">
        <ul>
    <li>
        <a href="{{ route('dashboard') }}">
            <i class="fas fa-home mr-2"></i> HOME
        </a>
    </li>
    <li>
        <a href="{{ route('stickers.index') }}">
            <i class="fas fa-list mr-2"></i> STICKERS
        </a>
    </li>
    <li>
    <a href="{{ route('dtr.index') }}">
        <i class="fas fa-list mr-2"></i> DTR
    </a>
</li>
<li>
    <a href="{{ route('employee.index') }}">
        <i class="fas fa-list mr-2"></i> EMPLOYEES
    </a>
</li>

<li>
    <a href="{{ route('Ticket.index') }}">
        <i class="fas fa-list mr-2"></i> IT SERVICE TICKET
    </a>
</li>

</ul>

        </div>
        

        <style>
            .side-nav {
                width: 250px;
                height: calc(100vh - 64px); /* Adjust height to match the top nav */
                background-color: #2E8B57;
                color: #fff;
                position: fixed;
                top: 64px; /* Matches the top navigation height */
                left: 0;
                overflow-y: auto;
                padding-top: 20px;
            }

            .side-nav ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .side-nav ul li {
                margin: 0;
            }

            .side-nav ul li a {
                color: #fff;
                text-decoration: none;
                padding: 15px 20px;
                display: block;
                transition: background-color 0.3s ease;
            }

            .side-nav ul li a:hover {
                background-color: #444;
            }

            .main-content {
                margin-left: 250px; /* Same as side-nav width */
                padding: 20px;
                flex-grow: 1;
            }
        </style>

        <!-- Page Content -->
        
    </div>
</div>


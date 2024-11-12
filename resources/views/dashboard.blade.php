<x-app-layout>
    <div class="flex-grow p-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in!") }}
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mt-6">
            <!-- Users count -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg">Users</h3>
                <p class="text-2xl">{{ \App\Models\User::count() }}</p>
            </div>

            <!-- Employees count -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg">Employees</h3>
                <p class="text-2xl">{{ \App\Models\Employee::count() }}</p>
            </div>

            <!-- Stickers count -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg">Stickers</h3>
                <p class="text-2xl">{{ \App\Models\Sticker::count() }}</p>
            </div>
        </div>
    </div>
</x-app-layout>

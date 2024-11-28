<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex">
        

        
    </div>

    <style>
        .flex {
            display: flex;
        }

        .side-nav {
            width: 240px; /* Width of the side navigation */
            background-color: #333;
            color: #fff;
            height: calc(100vh - 64px); /* Adjust height to account for the header */
            position: fixed;
            top: 64px; /* Adjust this value to match the height of the header */
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
            margin: 10px 0;
        }

        .side-nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .side-nav ul li a:hover {
            background-color: #444;
        }

        .flex-grow {
            margin-left: 250px; /* Same width as the side-nav */
            padding: 20px;
        }
    </style>

    <div class="container">
        <h1>Create</h1>
    </div>
</x-app-layout>

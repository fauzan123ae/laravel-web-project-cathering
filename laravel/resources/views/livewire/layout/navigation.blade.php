<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
};
?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky-top">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <h1 class="text">
                            <i class="fa fa-utensils me-3"></i>Dapur Fauzan
                        </h1>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8 sm:ms-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')" wire:navigate>
                        {{ __('Menu') }}
                    </x-nav-link>
                    <x-nav-link :href="route('menu.crud')" :active="request()->routeIs('menu.crud')" wire:navigate>
                        {{ __('CRUD') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- User Options -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Profile Button -->
                <a href="{{ route('profile') }}" class="user_link me-3 yellow-button" wire:navigate>
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>

                <!-- Search Form -->
                <form action="{{ route('menu.index') }}" method="GET" class="form-inline flex items-center">
                    <input type="text" name="search" placeholder="Search menu..." class="form-control me-2" value="{{ request('search') }}">
                    <button class="btn nav_search-btn yellow-button" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>


                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="user_link me-3 yellow-button" wire:navigate>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>

                <!-- Dropdown for User Settings -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

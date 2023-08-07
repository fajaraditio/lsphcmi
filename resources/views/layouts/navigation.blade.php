<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (auth()->user()->role->slug === 'participant')
                    <!-- Participant Nav -->
                    <x-nav-link :href="route('participant.register.1',  ['jumpCurrent' => 'true'])"
                        :active="request()->routeIs('participant.register.*')">
                        {{ __('Registration Form') }}
                    </x-nav-link>

                    <x-nav-link :href="route('participant.test.agreement')"
                        :active="request()->routeIs('participant.test.agreement')">
                        {{ __('Competency Test') }}
                    </x-nav-link>

                    <x-nav-link :href="route('participant.assessment.report')"
                        :active="request()->routeIs('participant.assessment.report')">
                        {{ __('Assessment Report') }}
                    </x-nav-link>

                    @elseif (auth()->user()->role->slug === 'certification')
                    <!-- Ceritifcation Nav -->
                    <x-nav-link :href="route('certification.registration')"
                        :active="request()->routeIs('certification.registration')">
                        {{ __('Registration List') }} / APL-01
                    </x-nav-link>

                    <x-nav-link :href="route('certification.assessor.list')"
                        :active="request()->routeIs('certification.assessor.list')">
                        {{ __('Assessor List') }}
                    </x-nav-link>

                    <x-nav-link :href="route('certification.assessment.list')"
                        :active="request()->routeIs('certification.assessment.list')">
                        {{ __('Assessment Archive') }}
                    </x-nav-link>

                    <x-nav-link :href="route('certification.minutes.paper')"
                        :active="request()->routeIs('certification.minutes.paper')">
                        {{ __('Minutes Paper') }}
                    </x-nav-link>

                    @elseif (auth()->user()->role->slug === 'finance')
                    <!-- Finance Nav -->
                    <x-nav-link :href="route('finance.registration')"
                        :active="request()->routeIs('finance.registration')">
                        {{ __('Payment List') }}
                    </x-nav-link>

                    @elseif (auth()->user()->role->slug === 'manager')
                    <!-- Manager Nav -->
                    <x-nav-link :href="route('manager.assessor.assignment')"
                        :active="request()->routeIs('manager.assessor.assignment')">
                        {{ __('Assessor Assignment') }}
                    </x-nav-link>

                    <x-nav-link :href="route('manager.test.schedule')"
                        :active="request()->routeIs('manager.test.schedule')">
                        {{ __('Test Schedule') }}
                    </x-nav-link>

                    @elseif (auth()->user()->role->slug === 'chief')
                    <!-- Chief Nav -->
                    <x-nav-link :href="route('chief.assessment.list')"
                        :active="request()->routeIs('chief.assessment.list')">
                        {{ __('Assessment List') }}
                    </x-nav-link>

                    @elseif (auth()->user()->role->slug === 'assessor')
                    <!-- Finance Nav -->
                    <x-nav-link :href="route('assessor.registration')"
                        :active="request()->routeIs('assessor.registration')">
                        {{ __('Registration List') }} / APL-02
                    </x-nav-link>

                    <x-nav-link :href="route('assessor.test.list')" :active="request()->routeIs('assessor.test.*')">
                        {{ __('Competency Test List') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
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

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (auth()->user()->role->slug === 'participant')
            <!-- Participant Nav -->
            <x-responsive-nav-link :href="route('participant.register.1',  ['jumpCurrent' => 'true'])"
                :active="request()->routeIs('participant.register.*')">
                {{ __('Registration Form') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('participant.test.agreement')"
                :active="request()->routeIs('participant.test.agreement')">
                {{ __('Competency Test') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('participant.assessment.report')"
                :active="request()->routeIs('participant.assessment.report')">
                {{ __('Assessment Report') }}
            </x-responsive-nav-link>

            @elseif (auth()->user()->role->slug === 'certification')
            <!-- Ceritifcation Nav -->
            <x-responsive-nav-link :href="route('certification.registration')"
                :active="request()->routeIs('certification.registration')">
                {{ __('Registration List') }} / APL-01
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('certification.assessor.list')"
                :active="request()->routeIs('certification.assessor.list')">
                {{ __('Assessor List') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('certification.assessment.list')"
                :active="request()->routeIs('certification.assessment.list')">
                {{ __('Assessment Archive') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('certification.minutes.paper')"
                :active="request()->routeIs('certification.minutes.paper')">
                {{ __('Minutes Paper') }}
            </x-responsive-nav-link>

            @elseif (auth()->user()->role->slug === 'finance')
            <!-- Finance Nav -->
            <x-responsive-nav-link :href="route('finance.registration')"
                :active="request()->routeIs('finance.registration')">
                {{ __('Payment List') }}
            </x-responsive-nav-link>

            @elseif (auth()->user()->role->slug === 'manager')
            <!-- Manager Nav -->
            <x-responsive-nav-link :href="route('manager.assessor.assignment')"
                :active="request()->routeIs('manager.assessor.assignment')">
                {{ __('Assessor Assignment') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('manager.test.schedule')"
                :active="request()->routeIs('manager.test.schedule')">
                {{ __('Test Schedule') }}
            </x-responsive-nav-link>

            @elseif (auth()->user()->role->slug === 'chief')
            <!-- Chief Nav -->
            <x-responsive-nav-link :href="route('chief.assessment.list')"
                :active="request()->routeIs('chief.assessment.list')">
                {{ __('Assessment List') }}
            </x-responsive-nav-link>

            @elseif (auth()->user()->role->slug === 'assessor')
            <!-- Finance Nav -->
            <x-responsive-nav-link :href="route('assessor.registration')"
                :active="request()->routeIs('assessor.registration')">
                {{ __('Registration List') }} / APL-02
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('assessor.test.list')" :active="request()->routeIs('assessor.test.*')">
                {{ __('Competency Test List') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
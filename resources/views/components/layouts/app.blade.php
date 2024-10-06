<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body data-theme="nord" class="flex flex-col font-sans antialiased min-h-full max-w-screen">
        <x-dev.bar />
        <div class="flex flex-col w-full min-h-screen bg-gray-100 dark:bg-gray-900" x-data="{ sidebarOpen: false }">
            <div class="flex w-full ">
                <x-layouts.partials.navigation />
                <div class="flex flex-col w-full">
                    <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                        <x-layouts.partials.navigation.hamburguer />
                        <x-layouts.partials.navigation.separator />

                        <div class="flex flex-1 justify-end gap-x-4 self-stretch lg:gap-x-6">
                            <x-layouts.partials.global-search />
                            <div class="flex items-center gap-x-4 lg:gap-x-6">
                                <x-layouts.partials.notifications />
                                <x-layouts.partials.navigation.separator />
                                <x-layouts.partials.profile />
                            </div>
                        </div>
                    </div>

                    <main class="py-10">
                        <div class="px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>

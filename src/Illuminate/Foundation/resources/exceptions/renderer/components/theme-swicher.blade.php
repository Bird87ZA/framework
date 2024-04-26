<script>
    setDarkClass = () => {
        localStorage.theme === 'dark' || (!('theme' in localStorage))
            ? document.documentElement.classList.add('dark')
            : document.documentElement.classList.remove('dark')

        let link = document.getElementById('exceptions-renderer-highlightjs-theme');
        link && link.remove();

        link = document.createElement('link');
        link.rel = 'stylesheet';
        link.id = 'exceptions-renderer-highlightjs-theme';
        link.href = '//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/';
        link.href += localStorage.theme === 'dark' || (!('theme' in localStorage))
            ? 'atom-one-dark.min.css'
            : 'github.min.css';

        document.head.prepend(link);
    }

    setDarkClass()

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', setDarkClass)
</script>

<div
    class="relative"
    x-data="{
        menu: false,
        theme: localStorage.theme,
        darkMode() {
            this.theme = 'dark'
            localStorage.theme = 'dark'
            setDarkClass()
        },
        lightMode() {
            this.theme = 'light'
            localStorage.theme = 'light'
            setDarkClass()
        },
        systemMode() {
            this.theme = undefined
            localStorage.removeItem('theme')
            setDarkClass()
        },
    }"
    @click.outside="menu = false"
>
    <button
        x-cloak
        class="block rounded p-1 hover:bg-gray-100 dark:hover:bg-gray-800"
        :class="theme ? 'text-gray-700 dark:text-gray-300' : 'text-gray-400 dark:text-gray-600 hover:text-gray-500 focus:text-gray-500 dark:hover:text-gray-500 dark:focus:text-gray-500'"
        @click="menu = ! menu"
    >
        <x-laravel-exceptions-renderer::icons.sun class="block h-5 w-5 dark:hidden" />
        <x-laravel-exceptions-renderer::icons.moon class="hidden h-5 w-5 dark:block" />
    </button>

    <div
        x-show="menu"
        class="absolute right-0 z-10 flex origin-top-right flex-col rounded-md bg-white shadow-xl ring-1 ring-gray-900/5 dark:bg-gray-800"
        style="display: none"
        @click="menu = false"
    >
        <button
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
            :class="theme === 'light' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
            @click="lightMode()"
        >
            <x-laravel-exceptions-renderer::icons.sun class="h-5 w-5" />
            Light
        </button>
        <button
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
            :class="theme === 'dark' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
            @click="darkMode()"
        >
            <x-laravel-exceptions-renderer::icons.moon class="h-5 w-5" />
            Dark
        </button>
        <button
            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
            :class="theme === undefined ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'"
            @click="systemMode()"
        >
            <x-laravel-exceptions-renderer::icons.computer-desktop class="h-5 w-5" />
            System
        </button>
    </div>
</div>

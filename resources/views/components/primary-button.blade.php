<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex text-white items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:bg-green-300 active:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

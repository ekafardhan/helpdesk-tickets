@props(['active', 'href'])

@php
    // Cek apakah menu aktif, jika ya beri kelas border bawah
    $classes = $active
        ? 'inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-100 hover:text-indigo-500 dark:hover:text-indigo-300 transition duration-150 ease-in-out border-b-2 border-indigo-500'
        : 'inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-300 transition duration-150 ease-in-out';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

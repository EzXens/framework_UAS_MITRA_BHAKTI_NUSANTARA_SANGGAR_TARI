@php $active = (bool)$teacher->is_active; @endphp
<button type="button"
        class="status-toggle {{ $active ? 'bg-[#F44336]' : 'bg-[#4CAF50]' }} text-black font-semibold rounded-xl shadow-lg ring-2 ring-[#E6D8A1]/60 hover:brightness-105 transition-all duration-300 px-5 py-2.5 w-full md:w-auto"
        role="button"
        aria-label="{{ $active ? 'Nonaktifkan pengajar' : 'Aktifkan pengajar' }}"
        aria-pressed="{{ $active ? 'true' : 'false' }}"
        data-id="{{ $teacher->id }}"
        data-active="{{ $active ? 1 : 0 }}">
    <span class="inline-flex items-center gap-2">
        @if($active)
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-4 md:h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1010 10A10.011 10.011 0 0012 2zm-1 15l-4-4 1.414-1.414L11 13.172l4.586-4.586L17 10z"/></svg>
            <span class="text-sm md:text-xs">Nonaktifkan</span>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-4 md:h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1010 10A10.011 10.011 0 0012 2zm5 7l-6 6-3-3 1.414-1.414L11 12.172l4.586-4.586z"/></svg>
            <span class="text-sm md:text-xs">Aktifkan</span>
        @endif
    </span>
</button>

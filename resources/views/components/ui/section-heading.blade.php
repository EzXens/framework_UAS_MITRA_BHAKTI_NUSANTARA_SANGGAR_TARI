<div class="space-y-3">
    <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-[#FFF3B8] text-[#8C6A08] text-xs font-semibold uppercase tracking-[0.2em]">
        {{ $subtitle ?? 'Bhakti Nusantara' }}
    </span>
    <h2 class="text-2xl lg:text-4xl font-semibold text-[#2E2E2E] leading-snug">
        {{ $title }}
    </h2>
    @isset($description)
        <p class="text-sm lg:text-base text-[#4F4F4F] leading-relaxed max-w-2xl">
            {{ $description }}
        </p>
    @endisset
</div>

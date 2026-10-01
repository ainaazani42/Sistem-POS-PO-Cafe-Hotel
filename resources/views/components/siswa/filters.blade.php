<div class="flex items-center justify-between gap-3">
    <div class="flex gap-2 overflow-x-auto no-scrollbar -mx-4 px-4 sm:mx-0 sm:px-0">
        @foreach ([['semua', 'Semua Menu'], ['makanan', '🍛 Makanan'], ['minuman', '🥤 Minuman'], ['snack', '🍟 Snack']] as $i => [$val, $label])
            <button type="button" data-cat="{{ $val }}" class="shrink-0 px-4 py-2.5 rounded-xl border text-xs font-bold transition {{ $i === 0 ? 'bg-[#700028] text-white border-[#700028]' : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300' }}">{{ $label }}</button>
        @endforeach
    </div>
    <span id="menuCount" class="hidden sm:block shrink-0 text-xs text-slate-500"></span>
</div>

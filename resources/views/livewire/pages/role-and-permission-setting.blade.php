<div>
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 antialiased">
        <form wire:submit="create">
            {{ $this->form }}
        </form>
        <x-filament-actions::modals />
    </div>
</div>

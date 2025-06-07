<div class="flex items-start max-md:flex-col">
    <div class="flex-1 self-stretch max-md:pt-6">

        <div class="relative mb-6 w-full">

            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div>
                    <flux:heading size="xl" level="1">{{ __('Características de propiedades') }}</flux:heading>
                    <flux:subheading size="lg" class="mb-6">{{ __('Agregá o edita tus características de propiedades') }}
                    </flux:subheading>

                </div>

                <flux:button as="a" href="{{ route('dashboard.property-features.create') }}" variant="primary"
                    icon="plus">
                    {{ __('Nueva') }}
                </flux:button>
            </div>

            <flux:separator variant="subtle" />

        </div>

        <div class="mt-5 w-full ">

            <section class="w-full">
                @include('livewire.property-features.index-list')
            </section>
        </div>
    </div>
</div>

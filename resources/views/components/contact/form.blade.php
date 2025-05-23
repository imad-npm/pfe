@props(['action'=>''])

<x-form class="!mt-6 !px-1  " method="Post" :action="$action" >
   
    <legend class="text-3xl font-semibold mx-auto border-b-2  pb-4 text-center mb-4 mt-2">
        Contact Us

    </legend>

    <p class="mb-3 mt-2 text-center  md:mx-6">
        We're here to help! Please fill out the form
         below and we'll get back to you as soon as possible.
    </p>

    @if (!auth('teacher')->user() && !auth('team')->user() )
        
    <div class="mb-3">
        <x-input-text required name="name" label="Name" />
</div>
    <div class="mb-3">
                <x-input-text required name="email" label="Your Email" />
    </div>
    @endif

    <div class="mb-3">
                <x-text-area required name="message" label="Message" />

    </div>
    <x-button.submit text=" Send Message" />
</x-form>
<x-mail::message>
# New Contact Message

**Subject:** {{ $subject }}

Someone submitted the contact form.
<x-mail::panel>
    {{ $message }}
</x-mail::panel>

<x-mail::button :url="route('contact')">
    Reply to this Email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<x-mail::message>
# Visitor Message

Some Visitor Left a message:
<br>
Firstname: {{ $firstname }}
<br>
Lastname: {{ $lastname }}
<br>
Email: {{ $email }}
<br>
Subject: {{ $subject }}
<br>
Message: {{ $message }}

<x-mail::button :url="''">
View Message
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

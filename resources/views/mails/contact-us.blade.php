<x-mail::message>
    # رسالة تواصل جديدة 📩

    لقد تلقيت رسالة جديدة من خلال نموذج اتصل بنا في متجر **Nouh Carting**.

    **تفاصيل المرسل:**
    * **الاسم:** {{ $name }}
    * **البريد الإلكتروني:** {{ $email }}

    **نص الرسالة:**
    <div
        style="background-color: #222222; color: #dddddd; padding: 15px; border-radius: 8px; margin-top: 10px; border-left: 4px solid #ffffff;">
        {{ $messageText }}
    </div>

    <x-mail::button :url="config('app.url')">
        زيارة الموقع
    </x-mail::button>

    شكراً لك,<br>
    نظام إشعارات {{ config('app.name') }}
</x-mail::message>

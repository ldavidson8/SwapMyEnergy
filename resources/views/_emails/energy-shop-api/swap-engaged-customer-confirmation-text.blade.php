Hi {{ $user["title"] }} {{ $user["firstName"] }} {{ $user["lastName"] }}

Thank you for swapping your energy with us.

Your reference is: {{ $result_str }}

We will send your application securely to the new energy supplier.
They will contact your current supplier to arrange a 'Supply Start Date' usually within the next 21-days.
Everything will be handled by the energy suppliers meaning you only need to do something if asked to do so e.g. provide a final meter reading.
If you have any questions whatsoever, contact us on {{ env('DATA_CONTACT_PHONE_NUMBER') }} or email {{ env('DATA_CONTACT_EMAIL') }} and we will be happy to help.

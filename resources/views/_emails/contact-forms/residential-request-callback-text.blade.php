------------------------
--- Callback Request ---
------------------------

Full Name:
    {{ $callbackRequest["full_name"] }}

Phone Number:
    {{ $callbackRequest["phone_number"] }}

Email Address:
    {{ (isset($callbackRequest["email_address"])) ? $callbackRequest["email_address"] : 'N/A' }}
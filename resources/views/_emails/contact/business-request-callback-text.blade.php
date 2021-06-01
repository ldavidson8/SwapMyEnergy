------------------------
--- Callback Request ---
------------------------

Full Name/Company Name:
    {{ $callbackRequest["full_name"] }}

Phone Number:
    {{ $callbackRequest["phone_number"] }}

Email Address:
    {{ (isset($callbackRequest["email_address"])) ? $callbackRequest["email_address"] : 'N/A' }}
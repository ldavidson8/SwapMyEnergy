-----------------------------------------
--- Payment Solutions Request ---
-----------------------------------------

Full Name
{{ $formData["full_name"] }}

Phone Number
{{ (isset($formData["phone_number"])) ? $formData["phone_number"] : "" }}

Email Address
{{ $formData["email"] }}
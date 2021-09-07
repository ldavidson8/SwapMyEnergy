-----------------------------------------
--- Business Water Comparison Request ---
-----------------------------------------

Full Name
{{ $formData["full_name"] }}

Business Name
{{ $formData["business_name"] }}

Email Address
{{ $formData["email"] }}

Phone Number
{{ (isset($formData["phone_number"])) ? $formData["phone_number"] : "" }}

Call Back Time
{{ $formData["call_back_time"] }}

-----------------------------------
--- Application to be an Affiliate ---
-----------------------------------

Full Name/Company Name:
    {{ $formData["full_name"] }}

Email Address:
    {{ $formData["email_address"] }}

Phone Number:
    {{ $formData["phone_number"] }}

Address:
    {{ $formData["address"] }}

Type of Affiliate:
    {{ $formData["type_of_affiliate"] }}

Web Link:
    {{ (isset($formData["web_link"])) ? $formData["web_link"] : 'N/A' }}
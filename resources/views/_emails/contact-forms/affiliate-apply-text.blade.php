-----------------------------------
--- Application to be an Affiliate ---
-----------------------------------

Full Name/Company Name:
    {{ $formData["full_name"] }}

Email Address:
    {{ $formData["email_address"] }}

Phone Number:
    {{ $formData["phone_number"] }}

Company Address:
    {{ $formData["company_address"] }}

Type of Company
    {{ $formData["type_of_company"] }}

Web Link:
    {{ (isset($formData["web_link"])) ? $formData["web_link"] : 'N/A' }}
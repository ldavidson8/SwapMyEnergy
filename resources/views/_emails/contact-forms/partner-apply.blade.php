@extends('_emails.layouts.master')

@section('main-content')
    <h1>Application to be a Partner</h1>
    <table>
        <tbody>
            <tr>
                <th>Full Name/Company Name</th>
                <td>{{ $formData["full_name"] }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $formData["email_address"] }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $formData["phone_number"] }}</td>
            </tr>
            <tr>
                <th>Company Address</th>
                <td>{{ $formData["company_address"] }}</td>
            </tr>
            <tr>
                <th>Type Of Company</th>
                <td>{{ $formData["type_of_company"] }}</td>
            </tr>
            <tr>
                <th>Web Link</th>
                <td>{{ (isset($formData["web_link"])) ? $formData["web_link"] : 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
@endsection
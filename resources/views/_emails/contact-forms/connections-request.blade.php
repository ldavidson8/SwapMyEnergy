@extends('_emails.layouts.master')

@section('main-content')
    <h1>Connect Request</h1>
    <table>
        <tbody>
            <tr>
                <th>Full Name/Company Name</th>
                <td>{{ $formData["full_name"] }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $formData["phone_number"] }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $formData["email_address"] }}</td>
            </tr>
            <tr>
                <th>New Customer</th>
                <td>{{ $formData["new_customer"] }}</td>
            </tr>
            <tr>
                <th>Property Type</th>
                <td>{{ $formData["property_type"] }}</td>
            </tr>
            <tr>
                <th>Connection Type</th>
                <td>{{ $formData["connection_type"] }}</td>
            </tr>
            <tr>
                <th>Call Back Time</th>
                <td>{{ $formData["call_back_time"] }}</td>
            </tr>
        </tbody>
    </table>

    @include('_emails.footer')
@endsection

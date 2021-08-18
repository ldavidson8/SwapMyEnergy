@extends('_emails.layouts.master')

@section('main-content')
    <h1>Support Request</h1>
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
                <th>Support Issue</th>
                <td>{{ $formData["support_issue"] }}</td>
            </tr>
            <tr>
                <th>Reference Number</th>
                <td>{{ $ticket }}</td>
            </tr>
        </tbody>
    </table>

    @include('_emails.footer')
@endsection

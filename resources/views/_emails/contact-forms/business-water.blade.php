@extends('_emails.layouts.master')

@section('main-content')
    <h1>Business Water Comparison Request</h1>
    <table>
        <tbody>
            <tr>
                <th>Full Name</th>
                <td>{{ $formData["full_name"] }}</td>
            </tr>
            <tr>
                <th>Business Name</th>
                <td>{{ $formData["business_name"] }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $formData["email"] }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $formData["phone_number"] }}</td>
            </tr>
            <tr>
                <th>Call Back Time</th>
                <td>{{ $formData["call_back_time"] }}</td>
            </tr>
        </tbody>
    </table>

    @include('_emails.footer')
@endsection

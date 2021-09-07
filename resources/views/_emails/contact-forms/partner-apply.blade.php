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
                <th>Message</th>
                <td>{{ $formData["message"] }}</td>
            </tr>
        </tbody>
    </table>

    @include('_emails.footer')
@endsection

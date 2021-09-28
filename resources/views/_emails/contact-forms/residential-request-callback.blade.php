@extends('_emails.layouts.master')

@section('main-content')
    <h1>Residential Callback Request</h1>
    <table>
        <tbody>
            <tr>
                <th>Full Name</th>
                <td>{{ $callbackRequest["full_name"] }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $callbackRequest["phone_number"] }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ (isset($callbackRequest["email_address"])) ? $callbackRequest["email_address"] : 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    @include('_emails.footer')
@endsection

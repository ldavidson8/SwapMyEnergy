@extends('_emails.layouts.master')

@section('main-content')
    <h1>Payment Solutions Request</h1>
    <table>
        <tbody>
            <tr>
                <th>Full Name</th>
                <td>{{ $formData["full_name"] }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ (isset($formData["phone_number"])) ? $formData["phone_number"] : "" }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $formData["email"] }}</td>
            </tr>
        </tbody>
    </table>

    @include('_emails.footer')
@endsection

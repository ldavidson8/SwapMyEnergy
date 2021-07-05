@extends('_emails.layouts.master')

@section('main-content')
    <p>Hi {{ $user["title"] }} {{ $user["firstName"] }} {{ $user["lastName"] }}</p><p></p>
    <p>Thank you for swapping your energy with us.</p><p></p>
    <p>Your reference is: {{ $result_str }}</p><p></p>
    <p>We will send your application securely to the new energy supplier. They will contact your current supplier to arrange a 'Supply Start Date' usually within the next 21-days. Everything will be handled by the energy suppliers meaning you only need to do something if asked to do so e.g. provide a final meter reading. If you have any questions whatsoever, contact us on {{ env('DATA_CONTACT_PHONE_NUMBER') }} or email <a href="{{ env('DATA_CONTACT_EMAIL') }}">{{ env('DATA_CONTACT_EMAIL') }}</a> and we will be happy to help.</p>
@endsection
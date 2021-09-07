@extends('_emails.layouts.master')

@section('main-content')
    <p>Hi {{ $user["title"] }} {{ $user["firstName"] }} {{ $user["lastName"] }},</p>
    <p>Thank you for swapping your energy with us.</p>
    <p>Your reference is: {{ $result_str }}</p>
    <br />

    <h1 style="font-size: 1.2em;">What happens next?</h1>
    <p>As with all switching sites, we will send your application to your new supplier first thing tommorow morning. At that point, they will handle the whole process to ensure your switch completes smoothly.</p>
    <p>Once processed, they will notify your existing supplier of your intention to leave. This will trigger your existing supplier to ask for a final meter reading (unless you have a Smart Meter in which case they will take that remotely). Once they have that, they will create a Final Bill.</p>
    <p>The Final Bill will determine whether you are in debt or credit. If debt, you will need to settle that with your existing supplier as your final payment. If credit, you will be reimbursed. Energy suppliers are quicker to take your money than to give it back so your reimbursement may take a few weeks.</p>
    <p>From there, your new supplier will agree a "Supply Start Date" which should be within 21-days from today's date. All being well, you will then be on supply with your new supplier.</p>
    <p><b>Note:</b> Depending on the supplier, your first Direct Debit may go out at, or around, your supply start date.</p>
    <p>If you have any questions whatsoever, contact us on {{ env('DATA_CONTACT_PHONE_NUMBER') }} or email <a href="mailto:{{ env('DATA_CONTACT_EMAIL') }}?subject=Energy Swap Completed - Message From Customer">{{ env('DATA_CONTACT_EMAIL') }}</a> and we will be happy to help.</p>

    @include('_emails.footer')
@endsection

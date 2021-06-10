@extends('layouts.master')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
    <style>
        .white-text
        {
            color: white;
        }

        #energy_form
        {
            padding: 50px;
            width: 600px;
            max-width: 100%;
            margin: auto;
        }
        
        .white-search-button
        {
            width: 150px;
            font-size: 27px;
            padding: 5px;
            font-weight: bold;
            border: none;
            display: inline-block;
            background-color: #f3f2f1;
            border-radius: 10px;
        }

        @media (max-width: 400px)
        {
            #energy_form
            {
                padding: 0px;
            }
        }
    </style>
@endsection

@section('before-header')
    <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding background-image-preston center-content white-text">
            <form action="" method="POST" id="energy_form">
                <div class="form-group">
                    <div id="postcode_error" class="alert alert-danger" style="display: none;"></div>
                    <label for="postcode" style="font-size: 24px;">Enter your postcode to begin...</label>
                    <input type="text" id="postcode" class="form-control" />
                    <button type="button" id="btn_postcode_search" class="white-search-button" style="display: inline-block; margin-top: 10px;">Search</button>
                </div>
                <div id="form_address_fields" class="form-group" style="display: none;">
                    <br /><br />
                    <label for="address" style="font-size: 24px">Select your address</label>
                    <select id="address" name="address" class="form-control" required>
                        <option value="" selected>Please Select</option>
                        <optgroup id="address_values"></optgroup>
                    </select>
                    <input type="submit" class="big-blue-button" value="Continue" style="margin-top: 10px;" />
                </div>
            </form>
        </div>
@endsection

@section('after-footer')
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        document.body.onload = function()
        {
            var postcodeError = $("#postcode_error");
            var inputPostcode = $("#postcode");
            var btnPostcodeSearch = $("#btn_postcode_search");

            var addressSection = $("#form_address_fields");
            var inputAddress = $("#address");
            var inputAddressValues = $("#address_values");
            
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            btnPostcodeSearch.click(function()
            {
                HidePostcodeError();
                
                if (inputPostcode.val() == "")
                {
                    ShowPostcodeError('The postcode field is required.');
                    HideAddressSection();
                    return;
                }

                try
                {
                    var url = "{{ route('residential.energy-comparison.addresses', [ 'postcode' => 'postcode' ]) }}";
                    url = url.replace('/postcode', '/' + inputPostcode.val());
                    $.ajax(
                    {
                        type: 'POST',
                        url: url,
                        success: function(result, success, xhr)
                        {
                            // if nothing is returned
                            if (xhr != null && xhr.status == 204)
                            {
                                ShowPostcodeError('That postcode is invalid.')
                                HideAddressSection();
                                return;
                            }

                            try
                            {
                                // parse the returned json into an object
                                var rows = JSON.parse(result);

                                // sort the rows by the address property
                                rows.sort((a, b) => (a.address.localeCompare(b.address, 'en', { numeric: true })));

                                // empty the dropdown list
                                inputAddressValues.empty();

                                // add each row to the dropdown list
                                for (i in rows)
                                {
                                    inputAddressValues.append($('<option value="' + rows[i].mpan + '">' + rows[i].address + '</option>'));
                                }

                                ShowAddressSection();
                            }
                            catch (ex)
                            {
                                ShowPostcodeError()
                                HideAddressSection();
                            }
                        },
                        error: function(xhr, status, error)
                        {
                            ShowPostcodeError()
                            HideAddressSection();
                        }
                    });
                }
                catch (ex)
                {
                    ShowPostcodeError()
                    HideAddressSection();
                }
            });


            function ShowAddressSection()
            {
                addressSection.show();
            }

            function HideAddressSection()
            {
                addressSection.hide();
            }

            function ShowPostcodeError(message)
            {
                if (message == null || message == undefined) message = "An error has occured. Please try again later.";
                postcodeError.show().text(message);
            }

            function HidePostcodeError()
            {
                postcodeError.hide().text('');
            }
        };
    </script>

@endsection

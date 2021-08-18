@extends('layouts.master')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
    <style>
        #form-container
        {
            padding: 50px;
            width: 600px;
            max-width: 100%;
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
            #form-container
            {
                padding: 0px;
            }
        }
    </style>
@endsection

@section('before-header')
    <div class="d-flex">
        <div id="requestCallback" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
            <hr/>
            <div class="row flex-grow-1 no-padding background-image-preston center-content" style="color: #f3f2f1;">
                <div id="form-container">
                    @if (Session::has('fail') && Session::get('fail') == 'session_expired')
                        {{-- <div class="alert alert-danger post-error">
                            Sorry, your session expired. Please try again.
                        </div> --}}
                    @elseif (count($errors) > 0)
                        <div class="alert alert-danger post-error">
                            An error has ocurred. Please try again, or <a href='{{ route("$mode.contact") }}'>contact us here</a>.
                            {{-- @foreach ($errors -> all() as $error)
                                {{ $error }}<br />
                            @endforeach --}}
                        </div>
                    @endif
                    <div id="form_postcode">
                        <div class="form-group">
                            <div id="postcode_error" class="alert alert-danger" style="display: none;"></div>
                            <label for="postcode_search" style="font-size: 24px;">Enter your postcode to begin...</label>
                            <input type="text" class="form-control" id="postcode_search" name="postcode_search" value="{{ old('postcode') }}" />
                            <button type="button" class="white-search-button" id="btn_postcode_search" style="display: inline-block; margin-top: 10px;">Search</button>
                        </div>
                    </div>
                    <form id="form_address" action="{{ route('residential.energy-comparison.1-address') }}" method="POST" style="display: none;">
                        @csrf
                        <div class="form-group">
                            <br />
                            <input type="hidden" id="postcode" name="postcode" />
                            <input type="hidden" id="mpan" name="mpan" />
                            <input type="hidden" id="houseName" name="houseName" />
                            <label id="labelHouseNo" for="houseNo" style="font-size: 24px">Select your address</label>
                            <select id="houseNo" name="houseNo" class="form-control" value="{{ old('houseNo') }}" required>
                                <option class="initial-values" value="" selected>Please Select</option>
                            </select>
                            <input type="submit" class="big-blue-button" value="Continue" style="margin-top: 10px;" />
                        </div>
                    </form>
                    <label for="movingHouse"><input type="checkbox" id="movingHouse" name="movingHouse" form="form_address" /> I have recently moved or am about to</label>
                </div>
            </div>
@endsection

@section('after-footer')
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        document.body.onload = function()
        {
            var postError = $(".post-error");
            var postcodeError = $("#postcode_error");
            var inputPostcodeSearch = $("#postcode_search");
            var btnPostcode = $("#btn_postcode_search");

            var frmAddress = $("#form_address");
            var inputPostcode = $("#postcode");
            var inputHouseName = $("#houseName");
            var inputHouseNo = $("#houseNo");
            var inputMpan = $("#mpan");

            $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });


            btnPostcode.click(function()
            {
                HidePostcodeError();

                if (inputPostcodeSearch.val() == "")
                {
                    ShowPostcodeError('The postcode field is required.');
                    HideAddressSection();
                    return;
                }

                inputPostcode.val(inputPostcodeSearch.val());

                try
                {
                    var url = "{{ route('residential.energy-comparison.api.addresses', [ 'postcode' => 'postcode' ]) }}";
                    url = url.replace('/postcode', '/' + inputPostcodeSearch.val());
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
                                // var rows = JSON.parse(result);
                                var rows = result;

                                // empty the dropdown list
                                inputHouseNo.find("option:not(.initial-values)").remove();

                                // add each row to the dropdown list
                                for (i in rows)
                                {
                                    inputHouseNo.append($('<option class="house-number-option" value="' + rows[i].houseNo + '" data-mpan="' + rows[i].mpan + '" data-houseName="' + rows[i].houseName + '">' + rows[i].address + '</option>'));
                                }
                                inputHouseNo.append($('<option class="house-number-option" value="notListed" data-mpan="notListed" data-houseName="notListed">My address is not listed</option>'));

                                ShowAddressSection();
                            }
                            catch (ex)
                            {
                                ShowPostcodeError()
                                HideAddressSection();
                                console.log(ex.message);
                            }
                        },
                        error: function(xhr, status, error)
                        {
                            ShowPostcodeError()
                            HideAddressSection();
                            console.log(error.message);
                        }
                    });
                }
                catch (ex)
                {
                    ShowPostcodeError()
                    HideAddressSection();
                    console.log(ex.message);
                }
            });

            inputHouseNo.change(function(e)
            {
                inputMpan.val(inputHouseNo.find(":selected").attr("data-mpan"));
                inputHouseName.val(inputHouseNo.find(":selected").attr("data-houseName"));
            });


            function ShowAddressSection()
            {
                frmAddress.show();
            }

            function HideAddressSection()
            {
                frmAddress.hide();
            }

            function ShowPostcodeError(message)
            {
                if (message == null || message == undefined) message = "An error has occured. Please try again later.";
                postcodeError.show().text(message);
            }

            function HidePostcodeError()
            {
                postcodeError.hide().text('');
                postError.hide();
            }
        };
    </script>

@endsection

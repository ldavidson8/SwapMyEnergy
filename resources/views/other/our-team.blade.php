@extends('layouts.master')

@section('stylesheets')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        .card-wrapper
        {
            text-align: center;

        }

        .card
        {
            background-color: transparent;
            border: none;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
        }

        h3
        {
            font-weight: 700;
        }

        h4
        {
            font-weight: 400;
        }

        /* .modal
        {
            display: none;
            position: fixed;
            z-index: 1;
            top: 50%;
            left: 50%;
            width: 100%;
            padding: 15px;

        } */

        .member-img
        {
            max-width: 100%;
            margin-bottom: 30px;
        }
        .modal
        {
            padding: 0 !important; // override inline padding-right added from js
        }
        .modal .modal-dialog
        {
            width: 100%;
            max-width: none;
            height: auto;
            margin: 0 auto;
        }
        .modal .modal-header
        {
            justify-content: start;
            align-items: center;
        }
        .member-info
        {
            text-align: left;
            margin-left: 1em;
        }
        .modal .modal-content
        {
            height: 100%;
            border: 0;
            border-radius: 0;
        }
        .modal .modal-body
        {
            overflow-y: auto;
            text-align: left;
        }
        .close
        {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .business-dev
        {
            background: #ff9900;
            color: white;
        }

        .customer-sales
        {
            background: #d9381e;
            color: white;
        }
        .admin
        {
            background: #821ed9;
            color: white;
        }
        .developer
        {
            background: #049ef8;
            color: white;
        }
        .digital-marketer
        {
            background: #39cc9f;
        }

        .hover-zoom
        {
            transition: transform .3s; /* Animation */
        }

        .hover-zoom:hover
        {
            transform: scale(1.1); /* (150% zoom)*/
        }

        @media (min-width: 991px)
        {
            .modal .modal-dialog
        {
            width: 50%;
            max-width: none;
            height: auto;
            margin: 0 auto;
        }
        }

        

    </style>
@endsection
@section('before.header')

@endsection

@section('main-content')
<hr />
<div class="wrapper">
    <div class="team-header">
        <h1 style="font-family: Nothing You Could Do; text-align:center"> Our Team </h1>
    </div>
    <div class="team-wrapper row center-content">
        <!-- Business Development Managers -->
        <div class="col-lg-1 d-none d-lg-block"></div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Corey-Brooks.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Harry-Yeoman.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Jack-Moore.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#jonathanf">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Jonathan-Finn.png') }}">
                    </a>
                    <div class="modal" id="jonathanf" tabindex="-1" role="dialog" aria-labelledby="jonathanf" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <img alt="" src="{{ asset('img/our-team-avatars/johnathan-finn.png') }}" width="120" height="120">
                                <div class="member-info">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Jonathan Finn</h5><br>
                                    <h6> Customer Sales Advisor </h6>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-window-close"></i>
                              </button>
                            </div>
                            <div class="modal-body business-dev">
                                <p style="font-weight: bold">What are your hobbies and interests?</p>
                                <p>I love street art, painting murals and keeping animals.</p>
                                <p style="font-weight: bold">What is your best joke?</p>
                                <p>What do you call a fake noodle?<br/>
                                    an impasta...<br/>
                                    I’ll be here all night.
                                </p>
                                <p style="font-weight: bold">What else would you like people to know about you?</p>
                                <p>I was born and raised in the middle east.</p>
                            </div>
                          </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#karols">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Karol-Szaro.png') }}">
                    </a>
                    <div class="modal" id="karols" tabindex="-1" role="dialog" aria-labelledby="karols" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <img alt="" src="{{ asset('img/our-team-avatars/karol-szarro.png') }}" width="120" height="120">
                                <div class="member-info">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Karol Szarro</h5><br>
                                    <h6> Business Development Manager </h6>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            </div>
                            <div class="modal-body business-dev">
                                <p style="font-weight: bold">What were you doing before you joined Znergi Ltd? E.g. university previous jobs etc.</p>
                                <p>Cardinal Newman college</p>
                                <p style="font-weight: bold">What are your hobbies and interests?</p>
                                <p>Fishing, Woodworking, Exotic Animals, Travelling, Metal working.</p>
                                <p style="font-weight: bold">What are your goals and aspirations?</p>
                                <p>Own a pet crocodile, proceed with the career, travel around the world, fish in amazon river.</p>
                            </div>
                          </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-lg-1 d-none d-lg-block"></div>
        <div class="col-lg-2 d-none d-lg-block"></div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Maggie-Gavin.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Mohammed-Yub.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Morgan-Anderson.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#samis">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Sami-Sattar.png') }}">
                </a>
                <div class="modal" id="samis" tabindex="-1" role="dialog" aria-labelledby="samis" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <img alt="" src="{{ asset('img/our-team-avatars/sami-sattar.png') }}" width="120" height="120">
                            <div class="member-info">
                                <h5 class="modal-title" id="exampleModalLongTitle">Sami Sattar</h5><br>
                                <h6> Business Development Manager </h6>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-window-close"></i>
                            </button>
                        </div>
                        <div class="modal-body business-dev">
                            <p style="font-weight: bold">What were you doing before you joined Znergi Ltd? E.g. university previous jobs etc.</p>
                            <ul class="list-unstyled">
                                <li>- Graduated in Business & management from UCLAN</li>
                                <li>- Due to lockdown was struggling to find a job in my field of study</li>
                                <li>- Started doing online coaching for sports fitness and diet</li>
                            </ul>
                            <p style="font-weight: bold">What are your hobbies and interests?</p>
                            <ul class="list-unstyled">
                                <li>My hobbies consist of playing sports- Football, Swimming, Weight training.</li>
                                <li>- Helping people being confident within themselves by utilising a healthy Diet and training plan</li>
                                <li>- My interest consists of being a successful entrepreneur.</li>
                                <li>- Helping the local community</li>
                            </ul>
                            <p style="font-weight: bold">What are your goals and aspirations?</p>
                            <ul class="list-unstyled">
                                <li>- Exploiting niche markets</li>
                                <li>- Growing a successful network</li>
                                <li>- Improving on my current skill sets and acquiring new qualities.</li>
                            </p>
                            <p style="font-weight: bold">What else would you like people to know about you?</p>
                            <p>I am a hardworking individual who aspires to improve the quality of life of himself and the people around him by keeping good relations and acknowledging people’s goals and ambitions and motivating them to take one step further to accomplishing them.</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-block"></div>
        <!-- Sales Team -->
        <div class="col-lg-3 d-none d-lg-block"></div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset("img/our-team/A'ishah-Vorajee.png") }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Alex-Cottam.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Demi-Taylor.png') }}">
            </div>
        </div>
        <div class="col-lg-3 d-none d-lg-block"></div>
        <div class="col-lg-3 d-none d-lg-block"></div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Jasmine-Grime.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Mohammad-Waheed.png') }}">
            </div>
        </div>
        <!-- Data Officers -->
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Michael-Ranstead.png') }}">
            </div>
        </div>
        <div class="col-lg-3 d-none d-lg-block"></div>
        <!-- Administrators -->
        <div class="col-lg-2 d-none d-lg-block"></div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Atiya-Hussain.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#ollyp">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Olly-Potter.png') }}">
                </a>
                <div class="modal" id="ollyp" tabindex="-1" role="dialog" aria-labelledby="olly" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <img alt="" src="{{ asset('img/our-team-avatars/olly-potter.png') }}" width="120" height="120">
                            <div class="member-info">
                                <h5 class="modal-title" id="exampleModalLongTitle">Olly Potter</h5><br>
                                <h6> Administrator </h6>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-window-close"></i>
                          </button>
                        </div>
                        <div class="modal-body admin">
                            <p style="font-weight: bold">What were you doing before you joined Znergi Ltd? E.g. university previous jobs etc.</p>
                            <p>Working in Administration for a London University</p>
                            <p style="font-weight: bold">What are your hobbies and interests?</p>
                            <p>Supporting Burnley and New York Jets</p>
                            <p style="font-weight: bold">What are your goals and aspirations?</p>
                            <p>To get a master’s degree in North Korean Studies</p>
                            <p style="font-weight: bold">What is your best joke?</p>
                            <p>I ordered a limo, and the driver didn’t show up, I had nothing to chauffer it</p>
                            <p style="font-weight: bold">What else would you like people to know about you?</p>
                            <p>I’ve got a degree in technical theatre.</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Shannon-Balshaw.png') }}">
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-block"></div>
        <!-- Web Developers -->
        <div class="col-lg-3 d-none d-lg-block"></div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#lewisd">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Lewis-Davidson.png') }}">
                </a>
                <div class="modal" id="lewisd" tabindex="-1" role="dialog" aria-labelledby="lewisd" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <img alt="" src="{{ asset('img/our-team-avatars/lewis-davidson.png') }}" width="120" height="120">
                            <div class="member-info">
                                <h5 class="modal-title" id="exampleModalLongTitle">Lewis Davidson</h5><br>
                                <h6> Developer </h6>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-window-close"></i>
                          </button>
                        </div>
                        <div class="modal-body developer">
                            <p style="font-weight: bold">What were you doing before you joined Znergi Ltd? E.g. university previous jobs etc.</p>
                            <p>Before Znergi I had left University during my first year, spent my time job searching along with self-studying programming and web development.</p>
                            <p style="font-weight: bold">What are your hobbies and interests?</p>
                            <p>Coding, Swimming, Video Games and Graphic Design / Drawing.</p>
                            <p style="font-weight: bold">What are your goals and aspirations?</p>
                            <p>My goal is to become a better developer than I am now. I want to learn how to develop apps for mobile and desktop platforms and participate in more open-source projects.</p>
                            <p style="font-weight: bold">What is your best joke?</p>
                            <p>A Mexican magician tells the audience he will disappear on the count of three. He says "Uno...Dos..." and then poof, he disappeared without a tres.</p>
                            <p style="font-weight: bold">What else would you like people to know about you?</p>
                            <p>I'm really good at custom building PCs :)</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Mark-Graham.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Cryshae-Tucker.png') }}">
            </div>
        </div>
        <div class="col-lg-3 d-none d-lg-block"></div>
        <!-- Marketing team -->
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Adam-Casooji.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#alexb">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Alex-Burton.png') }}">
                </a>
                <div class="modal" id="alexb" tabindex="-1" role="dialog" aria-labelledby="alexb" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <img alt="" src="{{ asset('img/our-team-avatars/alex-burton.png') }}" width="120" height="120">
                            <div class="member-info">
                                <h5 class="modal-title" id="exampleModalLongTitle">Alex Burton</h5><br>
                                <h6> Digital Marketer </h6>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-window-close"></i>
                          </button>
                        </div>
                        <div class="modal-body digital-marketer">
                            <p style="font-weight: bold">What were you doing before you joined Znergi Ltd? E.g. university previous jobs etc.</p>
                            <p>Before working at Znergi Ltd I was a volunteer teaching assistant in two local primary schools and before that I was studying Computing at University.</p>
                            <p style="font-weight: bold">What are your hobbies and interests?</p>
                            <p>I spend most of my spare time writing stories and poetry related to my fictional setting Harrowed World as well as creating videos for the Harrowed World YouTube channel. Additionally I have a few other YouTube channels and a website.</p>
                            <p style="font-weight: bold">What are your goals and aspirations?</p>
                            <p>I hope to gain proficiency in digital marketing and gain interest for my writing in the hopes of selling books.</p>
                            <p style="font-weight: bold">What is your best joke?</p>
                            <p>What does a vampire have after a hard day at work? A bloodbath.</p>
                            <p style="font-weight: bold">What else would you like people to know about you?</p>
                            <ul>
                                <li>You can find my website here: <a href="https://www.harrowedworld.com/" target="_blank" rel="external">https://www.harrowedworld.com/</a></li>
                                <li>You can find my main YouTube channel here: <a href="https://youtube.com/channel/UCY3KOM1tFnZHY6TfAinGS2w" target="_blank" rel="external">https://www.youtube.com/c/harrowedworld</a></li>
                                <li>You can find my main Twitter here: <a href="https://twitter.com/harrowedworld" target="_blank" rel="external">https://twitter.com/harrowedworld</a></li>
                                <li>You can find my main Instagram here: <a href="https://www.instagram.com/harrowedworld/" target="_blank" rel="external">https://www.instagram.com/harrowedworld/</a></li>
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <img alt="" class="member-img" src="{{ asset('img/our-team/Andrew-Furness.png') }}">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#robg">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Robert-Graham.png') }}">
                </a>
                <div class="modal" id="robg" tabindex="-1" role="dialog" aria-labelledby="robg" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <img alt="" src="{{ asset('img/our-team-avatars/rob-graham.png') }}" width="120" height="120">
                            <div class="member-info">
                                <h5 class="modal-title" id="exampleModalLongTitle">Rob Graham</h5><br>
                                <h6> Digital Marketer </h6>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-window-close"></i>
                          </button>
                        </div>
                        <div class="modal-body digital-marketer">
                            <p style="font-weight: bold">What were you doing before you joined Znergi Ltd? E.g. university previous jobs etc.</p>
                            <p>Back in October, I was completing my Masters course in UX Design. After I finished that, I started design artwork and posters for musicians whilst searching for a job.</p>
                            <p style="font-weight: bold">What are your hobbies and interests?</p>
                            <p>I enjoy songwriting, travelling, football and going to concerts. I love being creative in any way I can.</p>
                            <p style="font-weight: bold">What are your goals and aspirations?</p>
                            <p>To be able to release my own music.</p>
                            <p style="font-weight: bold">What else would you like people to know about you?</p>
                            <ul>
                                <li>Instagram: <a href="https://www.instagram.com/robbi_graham_98/" target="_blank" rel="external">@robbi_graham_98</a></li>
                                <li>Twitter: <a href="https://twitter.com/robbi______" target="_blank" rel="external">@robbi______</a></li>
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-12 card-wrapper">
            <div class="card">
                <a class="hover-zoom" href="#" data-toggle="modal" data-target="#samc">
                    <img alt="" class="member-img" src="{{ asset('img/our-team/Sam-Coltman.png') }}">
                </a>
                <div class="modal" id="samc" tabindex="-1" role="dialog" aria-labelledby="samc" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <img alt="" src="{{ asset('img/our-team-avatars/sam-coltman.png') }}" width="120" height="120">
                            <div class="member-info">
                                <h5 class="modal-title" id="exampleModalLongTitle">Sam Coltman</h5><br>
                                <h6>Social Media Analyst</h6>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-window-close"></i>
                          </button>
                        </div>
                        <div class="modal-body digital-marketer">
                            <p style="font-weight: bold">What were you doing before you joined Znergi Ltd? E.g. university previous jobs etc.</p>
                            <p>I graduated the University of Central Lancashire in 2020 with a degree in journalism. I spent some time exploring freelance journalism before joining Znergi and occasionally dip my toes back in to writing articles and reviews.</p>
                            <p style="font-weight: bold">What are your hobbies and interests?</p>
                            <p>I play a lot of games, as well as working on my journalism in my free time, I’ll watch, read or play anything that’s recommended to me, and I have a deep love for bad movies.</p>
                            <p style="font-weight: bold">What are your goals and aspirations?</p>
                            <p>There will always be a part of me that wants to return to journalism, but all in all I just like creating content for people to enjoy so while I can do that here I will be more than happy.</p>
                            <p style="font-weight: bold">What is your best joke?</p>
                            <p> What did the buffalo say when she dropped her kid off at school? Bi son</p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

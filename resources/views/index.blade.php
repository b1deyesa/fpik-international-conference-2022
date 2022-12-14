<x-layout>
    {{-- Jumbortron --}}
    <section class="jumbotron">
        <div class="container">

            {{-- Jumbotron Detail --}}
            <div class="detail">
                <h1 class="big-title">
                    <img src="{{ asset('img/qrcode.png') }}" class="qr">
                    <p>"Promoting Blue Economy by Protection - Production Strategy"</p>
                </h1>
                <h3 class="title">Pattimura University International Conference Series</h3>
                <h3 class="sub-title">Organized by: Faculty of Fisheries and Marine Science, Pattimura University, Ambon, Indonesia</h3>
                <h2 class="time">
                    <i class="fas fa-calendar-days"></i>27 October 2022
                    <br><i class="fas fa-clock"></i>09.00 WIT
                </h2>
                <div id="countdown" class="countdown">
                    <script>
                        var countDownDate = new Date("Oct 27, 2022 15:37:25").getTime();
                        
                        var x = setInterval(function() {
                        
                          // Get today's date and time
                          var now = new Date().getTime();
                        
                          // Find the distance between now and the count down date
                          var distance = countDownDate - now;
                        
                          // Time calculations for days, hours, minutes and seconds
                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                          // Display the result in the element with id="demo"
                          document.getElementById("countdown").innerHTML = 
                            "<span><h2>"+days+"</h2>Days</span>"+
                            "<span><h2>"+hours+"</h2>hours</span>"+
                            "<span><h2>"+minutes+"</h2>minutes</span>"+
                            "<span><h2>"+seconds+"</h2>seconds</span>"
                        
                          // If the count down is finished, write some text
                          if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("countdown").innerHTML = "<span class='expired'><h2>Event has started</h2></span>";
                          }
                        }, 1000);
                    </script>
                </div>
            </div>
            
            {{-- Jumbotron Form --}}
            <div class="form">

                {{-- Regist Form --}}
                <form id="regist" action="{{ route('user.store') }}" method="POST">
                    <h2 class="title">Registration</h2>
                    <small class="sub-title">Please complete all field. You will receive a separate email with Login Code. </small>
                    
                    <x-alert type="success" target="success"></x-alert>
                    <x-alert type="error" target="name"></x-alert>
                    <x-alert type="error" target="email"></x-alert>
                    <x-alert type="error" target="status"></x-alert>

                    @csrf
                    <ul>
                        <li>
                            <input type="text" name="name" id="name" placeholder="Your Full Name" autocomplete="off" value="{{ old('name') }}">
                            <label for="name">Full Name</label>
                        </li>
                        <li>
                            <input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="{{ old('email') }}">
                            <label for="email">Email</label>
                        </li>
                        <li>
                            <select name="status" id="status">                                
                                <option value="">Select status</option>
                                @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            <label for="status">Your Status</label>
                        </li>
                        <li>
                            <small class="link">Already registred? <a onclick="login()">Login</a></small>
                            <button type="submit">Regist Now</button>
                        </li>
                    </ul>
                </form>

                {{-- Login Form --}}
                <form id="login" action="{{ route('user.login') }}" method="POST">
                    <h2 class="title">Login</h2>
                    <small class="sub-title">get an access code from your email <i>(you need to register first)</i></small>
                    
                    <x-alert type="error" target="password"></x-alert>

                    @csrf
                    <ul>
                        <li>
                            <input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="{{ auth()->user()->email ?? old('email') }}">
                            <label for="email">Email</label>
                        </li>
                        <li>
                            <input type="text" name="password" id="password" placeholder="Access Code" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();">
                            <label for="password">Access Code</label>
                        </li>
                        <li>
                            <small class="link">Don't have an access code? <a onclick="regist()">Regist</a></small>
                            <button type="submit">Login Now</button>
                        </li>
                    </ul>
                </form>

            </div>

            {{-- Switch Form --}}
            <script>
                $('#regist').hide()
                login  = () => $('#login').show() && $('#regist').hide()
                regist = () => $('#regist').show() && $('#login').hide()
            </script>
            @error('name') 
            <script>
                $('#regist').show() && $('#login').hide()
            </script>
            @enderror
            @error('email') 
            <script>
                $('#regist').show() && $('#login').hide()
            </script>
            @enderror
            @error('status') 
            <script>
                $('#regist').show() && $('#login').hide()
            </script>
            @enderror
            @if(session()->has('success')) 
            <script>
                $('#regist').show() && $('#login').hide()
            </script>
            @endif

            <span class="go-to">
                Go To Detail <br>
                <i class="fas fa-angle-down"></i>
                <script>
                    $(".go-to").click(function() {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $(".details").offset().top
                        }, 2000);
                    });
                </script>
            </span>
        </div>
    </section>

    {{-- Background --}}
    <section class="background">
        <div class="container">
            <h1 class="title">Background</h1>
            <h3 class="sub-title">Organized by - Faculty of Fisheries and Marine Science, Pattimura University, Ambon, Indonesia</h3>
            <p>
                <img src="{{ asset('img/logo.png') }}">
                Recently, global food security has become a major worry. Drought and conflict between Russia and Ukraine have hindered output, which has been exacerbated by protectionism among food-producing nations. To minimize its reliance on food imports and build a more secure path to sustainable and equitable growth, Indonesia must enhance food security and diversify marine-based businesses. Specifically, the blue recovery has the potential to transform existing and developing ocean-based companies into long-term engines capable of distributing the advantages of improved food security and economic growth.</p>
            <p>Food security is a state in which everyone has social and economic access to enough nutritious food for a productive and healthy life. The beginning of the blue economy revolution will be a beneficial addition to Indonesia's efforts to encourage recovery from the current global conflicts by continuing to bolster our resources in order to ensure food security. On the other hand, the nation's economy will undergo a transformation that capitalizes on the nation's maritime advantages by enhancing the management of marine resources, encouraging the development of an environmentally friendly blue economy, and constructing an innovative, competitive, and environmentally sustainable maritime sector.</p>
            <p>However, the blue economy is not merely a financial opportunity; it also protects and develops additional intangible marine resources. For instance, traditional lifestyles, carbon sequestration, and coastal resiliency. It is possible to aid vulnerable governments in mitigating the frequently severe effects of climate change. The nation's maritime assets will be employed effectively to achieve this objective, and this paradigm change will improve employment, productivity, and added value. If implemented correctly, the blue economy has the potential to boost Indonesia's diversified, sustainable growth.</p>
        </div>
    </section>

    {{-- Advantage --}}
    <section class="advantage">
        <div class="container">
            <div class="advantage-box">
                <h2 class="title">Aims</h2>
                <p>Participants will discuss how to create a sustainable blue economy that: harnesses the potential of our oceans and seas to improve the lives of all, especially those who lives in the coastal area and leverages the most recent innovations, scientific advances, and best practices to build prosperity while conserving our waters for future generations.</p>
            </div>
            <div class="advantage-box">
                <h2 class="title">Outcome of Conference</h2>
                <p>After the conference, we hope that all participants will have a comprehensive understanding of the blue economy and will work together and communicate more closely to ensure the long-term development of activities in our oceans.</p>
            </div>
        </div>
    </section>

    {{-- Topics --}}
    <section class="topics">
        <div class="container">
            <h1 class="title">
                Conference Topics
                <span></span>
            </h1>
            <div class="topic-box">
                <span>1</span>
                <p>Coastal Community Resilience</p>
            </div>
            <div class="topic-box">
                <span>2</span>
                <p>Sustainable fisheries management and conservation</p>
            </div>
            <div class="topic-box">
                <span>3</span>
                <p>The safety and effectiveness of maritime activities</p>
            </div>
        </div>
    </section>

    {{-- Keynote Speaker --}}
    <section class="keynote-speaker">
        <div class="container">
            <img class="photo" src="{{ asset('img/speakers/amalia_adininggar.png') }}">
            <div class="text">
                <h1 class="title">Keynote Speaker</h1>
                <h2 class="sub-title">Amalia Adininggar Widyasanti, ST, MSi, M.Eng. Ph.D</h2>
                <p>Badan Perencanaan Pembangunan Nasional</p>
            </div>
        </div>
    </section>
    
    {{-- International Speaker --}}
    {{-- <section class="international-speaker">
        <div class="container">
            <h1 class="title">International Scientific</h1>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/speakers/john_spicer.png') }}">
                <img class="flag" src="{{ asset('img/flag/uk.png') }}">
                <div class="text">
                    <h3 class="title">Dr. John Spicer</h3>
                    <p class="sub-title">School of Marine and Biological Science, Plymouth University, UK</p>
                </div>
            </div>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/user.jpeg') }}">
                <img class="flag" src="{{ asset('img/flag/japan.png') }}">
                <div class="text">
                    <h3 class="title">Prof. Sota Yamamoto</h3>
                    <p class="sub-title">Kagoshima University, Japan</p>
                </div>
            </div>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/user.jpeg') }}">
                <img class="flag" src="{{ asset('img/flag/japan.png') }}">
                <div class="text">
                    <h3 class="title">Dr. Da Jeong Song</h3>
                    <p class="sub-title">Research Fellow of International Center for Island Studies, Kagoshima University</p>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- National Speaker --}}
    {{-- <section class="national-speaker">
        <div class="container">
            <h1 class="title">Indonesian Scientific</h1>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/user.jpeg') }}">
                <div class="text">
                    <h3 class="title">Amalia Adininggar Widyasanti, ST, MSi, M.Eng. Ph.D</h3>
                    <p>Badan Perencanaan Pembangunan Nasional</p>
                </div>
            </div>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/speakers/victor_nikijuluw.png') }}">
                <div class="text">
                    <h3 class="title">Dr. Ir. Victor Nikijuluw, MSc</h3>
                    <p>Seniorn Ocean Program Lead</p>
                </div>
            </div>
        </div>
    </section> --}}

    {{--  Invited Speaker --}}
    <section class="invited-speaker">
        <div class="container">
            <h1 class="title">Invited Speaker</h1>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/speakers/john_spicer.png') }}">
                <img class="flag" src="{{ asset('img/flag/uk.png') }}">
                <div class="text">
                    <h3 class="title">Dr. John Spicer</h3>
                    <p>School of Marine and Biological Science, Plymouth University, UK</p>
                </div>
            </div>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/speakers/amanda_reichhelt.png') }}">
                <img class="flag" src="{{ asset('img/flag/australia.png') }}">
                <div class="text">
                    <h3 class="title">Prof. Amanda Reichelt-Brushett</h3>
                    <p>Southern Cross University</p>
                </div>
            </div>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/speakers/matthew_bertin.png') }}">
                <img class="flag" src="{{ asset('img/flag/usa.png') }}">
                <div class="text">
                    <h3 class="title">Matthew Bertin, Ph.D</h3>
                    <p>University of Rhode Island</p>
                </div>
            </div>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/speakers/masanori_kobayashi.png') }}">
                <img class="flag" src="{{ asset('img/flag/japan.png') }}">
                <div class="text">
                    <h3 class="title">Masanori Kobayashi</h3>
                    <p>Ocean Policy Research Institute, Japan</p>
                </div>
            </div>
            <div class="speaker-box">
                <img class="photo" src="{{ asset('img/speakers/victor_nikijuluw.png') }}">
                <img class="flag" src="{{ asset('img/flag/indonesia.png') }}">
                <div class="text">
                    <h3 class="title">Dr. Ir. Victor Nikijuluw, MSc</h3>
                    <p>Seniorn Ocean Program Lead</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Details --}}
    <section class="details">
        <div class="container">
            <div class="detail-box">
                <h1 class="title">Venue</h1>
                <ul>
                    <li>
                        <i class="fas fa-calendar-alt"></i>
                        Thursday, 27 October 2022, Ambon, Indonesia
                    </li>
                    <li>
                        <i class="fas fa-wifi"></i>
                        The conference will be conducted virtually
                    </li>
                </ul>
                <br>
                <h1 class="title">Facilities</h1>
                <ul>
                    <li>
                        <i class="fas fa-file-alt"></i>
                        Certificate
                    </li>
                    <li>
                        <i class="fas fa-certificate"></i>
                        IOP Publisher (Scopus Indexed)
                    </li>
                </ul>
                <br>
                <h1 class="title">Call For Paper Topics:</h1>
                <ul class="topic">
                    <li>-&nbsp;&nbsp;Fisheries and Aquaculture</li>
                    <li>-&nbsp;&nbsp;Fishing Technology</li>
                    <li>-&nbsp;&nbsp;Remote Sensing and Coastal Oceanography</li>
                    <li>-&nbsp;&nbsp;Marine Biodiversity and Conservation</li>
                    <li>-&nbsp;&nbsp;Aquatic Resource Management</li>
                    <li>-&nbsp;&nbsp;Marine Pollution and Ocean Health</li>
                    <li>-&nbsp;&nbsp;Fisheries Socio-Economics</li>
                    <li>-&nbsp;&nbsp;Fisheries Processing Technology</li>
                    <li>-&nbsp;&nbsp;Ecotourism</li>
                </ul>
            </div>
            <div class="detail-box">
                <h1 class="title">Conference Fee</h1>
                <ul class="fee">
                    <li class="fee-list"><h3>Domestic Participant</h3>
                        <ul>
                            <li>IDR 200.000 for Presenter Only</li>
                            <li>IDR 1.500.000 for Publication in IOP Conference Series: Earth and Environmental Sciences</li>
                            <li>IDR 500.000 for Additional Paper</li>
                            <li>IDR 100.000 for Participant Only</li>
                            <li><strong style="color: #0e4b59; background: #d8ef99">FREE for domestic student</strong></li>
                        </ul>
                    </li>
                    <li class="fee-list"><h3>Foreign Student</h3>
                        <ul>
                            <li>USD 50 for Presenter Only</li>
                            <li>USD 100 for Publication in IOP Conference Series: Earth and Environmental Sciences</li>
                            <li>USD 50 for Additional Paper</li>
                            <li>USD 30 for Participant Only</li>
                        </ul>
                    </li>
                    <li class="fee-list"><h3>Foreign Participant</h3>
                        <ul>
                            <li>USD 75 for Presenter Only</li>
                            <li>USD 150 for Publication in IOP Conference Series: Earth and Environmental Science</li>
                            <li>USD 50 for Additional Paper</li>
                            <li>USD 40 for Participant Only</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="detail-box">
                <h1 class="title">Payment Method</h1>
                <p>For all presenters and participants, please make the payment to the following banking details:</p>
                <table>
                    <tr>
                        <td colspan="3"><img src="{{ asset('img/bri.jpeg') }}"></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>Ir. Juliana W. Tuahatu</td>
                    </tr>
                    <tr>
                        <td>Bank</td>
                        <td>:</td>
                        <td>Bank Republik Indonesia (BRI)</td>
                    </tr>
                    <tr>
                        <td>Swift code</td>
                        <td>:</td>
                        <td>BRINIDJA001</td>
                    </tr>
                    <tr>
                        <td>Branch</td>
                        <td>:</td>
                        <td>BRI AMBON</td>
                    </tr>
                    <tr>
                        <td>Account Number</td>
                        <td>:</td>
                        <td>486501000677536</td>
                    </tr>
                </table>
                <p>Please send payment proof to <a href="mailto:shellymieke@gmail.com">shellymieke@gmail.com</a></p>
            </div>
        </div>
    </section>

    {{-- Credit --}}
    <section class="credit">
        <div class="container">

            {{-- Rundown --}}
            <div class="rundown">
                <h1 class="title">
                    Event Programme Rundown
                    <span></span>
                </h1>
                <table>
                    <tr>
                        <th>Time</th>
                        <th>Programme</th>
                    </tr>
                    <tr>
                        <td>09:00 - 09.30</td>
                        <td>Opening ceremony</td>
                    </tr>
                    <tr>
                        <td>09.30 - 10:30</td>
                        <td>Keynote Speaker</td>
                    </tr>
                    <tr>
                        <td>10.30 - 12.30</td>
                        <td>Invited Speaker</td>
                    </tr>
                    <tr>
                        <td>12:30 - 13:30</td>
                        <td>Lunch break</td>
                    </tr>
                    <tr>
                        <td>13:30 - 16:00</td>
                        <td>Paralel Room</td>
                    </tr>
                    <tr>
                        <td>15:00 - 15:30</td>
                        <td>Break</td>
                    </tr>
                    <tr>
                        <td>15:30 - 17:00</td>
                        <td>Paralel Room</td>
                    </tr>
                </table>
                <ul>
                    <li><strong>Presenter:</strong> National and international researchers and lecturers will present their scientific projects in this conference. Only oral presentation will be accommodated in this conference.</li>
                    <li><strong>Participants:</strong> It is expected that researcher, lecturers, students and any representatives from academic, government and NGO???s will attend this conference.</li>
                </ul>
                <div class="upload">
                    <h3 class="abstract">Abstract Deadline: <i>1 AUG - 1 OCT 2022</i></h3>
                    <h3 class="Fullpaper">Full Paper Deadline: <i>1 AUG - 30 OCT 2022</i></h3>
                    <a href="{{ route('abstract-fullpaper') }}">> See all abstract & fullpaper</a>
                </div>
            </div>

            {{-- Committee --}}
            <div class="committee">
                <h1 class="title">
                    Steering Committee
                    <span></span>
                </h1>
                <ol>
                    <h3 class="title">Chairman</h3>
                    <li>Prof. M. J. Saptenno, SH., M.Hum. (Rector of Pattimura University)</li>
                </ol>
                <ol>
                    <h3 class="title">Member</h3>
                    <li>Prof. Dr. Leiwakabessy, M.Si. (VR I)</li>
                    <li>Dr. Jantje Tjiptabudi, SH., M.Hum. (VR2)</li>
                    <li>Dr. Yusuf Madubun, M.Si. (VR3)</li>
                    <li>Dr. Muspida, M.Si (VR IV)</li>
                    <li>Dr. Yoisye Lopulalan, SPi, MSi (Dekan)</li>
                </ol>
                <ol>
                    <h3 class="title">Organizing Committee</h3>
                    <li>Chairman :   Dr. Ir. Shelly Pattipeiluhu, MSc.</li>
                    <li>Secretary&nbsp; :   Agapery.Y. Pattinasarny SPi, MAppSc</li>
                    <li>Treasurer&nbsp; :   Dr. Ir. V. M. N. Lalopua, MSi.</li>
                </ol>
                <ol>
                    <h3 class="title">Members</h3>
                    <li>Dr. Ir. J.A. Pattikawa, M.Sc</li>
                    <li>Ir. J. W. Tuahatu, MSi</li>
                    <li>Dr. Ir. R.L Papilaya, MP</li>
                    <li>Dr. Ir. Beny Setha, MSi</li>
                    <li>Dr. Friesland Tuapetel, SPi, MSi</li>
                    <li>Frederik willem Ayal, SPI, MSi</li>
                    <li>Eygner G. Talakua, Spi, Msi</li>
                    <li>K. G. Hehanussa, SPi, MSi</li>
                </ol>
            </div>

        </div>
    </section>
</x-layout>
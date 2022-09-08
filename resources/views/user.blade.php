<x-layout>
    {{-- User --}}
    <div class="user">
        <div class="container">
            <a href="{{ route('login') }}" class="back">< Back</a>
            <h1 class="title">User Data</h1>
            <h3 class="sub-title">{{ auth()->user()->status->name }}</h3>
            @can('admin')
                <a class="admin-button" href="{{ route('admin.index') }}">Admin Panel</a>
            @endcan

            {{-- Error/Success message --}}
            <x-alert type="success" target="success"></x-alert>
            <x-alert type="error" target="file"></x-alert>
            <x-alert type="error" target="article"></x-alert>
            <x-alert type="error" target="fullpaper"></x-alert>
            <x-alert type="error" target="abstrak"></x-alert>
            <x-alert type="error" target="name"></x-alert>
            <x-alert type="error" target="phone"></x-alert>
            <x-alert type="error" target="institution"></x-alert>


            @can('user-payment')             
            <div class="status" 
            {{-- Status background color --}}
            @if     (auth()->user()->payment->status == 'unpaid')
                style="background: #ff1b1b7f"
            @elseif (auth()->user()->payment->status == 'processing')
                style="background: #ffff007f"
            @elseif (auth()->user()->payment->status == 'paid')
                style="background: #59ff007f"
            @endif>
                {{-- Status icon --}}
                @if     (auth()->user()->payment->status == 'unpaid')
                    <i class="fas fa-exclamation-circle"></i>
                @elseif (auth()->user()->payment->status == 'processing')
                    <i class="fas fa-spinner"></i>
                @elseif (auth()->user()->payment->status == 'paid')
                    <i class="fas fa-check-circle"></i>
                @endif

                <div class="status-text">

                    {{-- Status Name --}}
                    @if     (auth()->user()->payment->status == 'unpaid')
                        <h3 id="file-name" class="title">Waiting for Payment</h3>
                    @elseif (auth()->user()->payment->status == 'processing')    
                        <h3 id="file-name" class="title">
                            Waiting for a payment confirmed<br><a href="{{ route('payment.download', ['payment' => auth()->user()->payment]) }}">Download reciept</a>
                        </h3>
                    @elseif (auth()->user()->payment->status == 'paid')    
                        <h3 class="title">Your payment has been confirmed</h3>
                    @endif
                    
                    {{-- Payment Form --}}
                    <form action="{{ route('payment.update', ['user' => auth()->user()]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="file" name="payment" id="payment" value="" hidden>
                        @if (auth()->user()->payment->status != 'paid')
                            <button id="add-button">Select Receipt</button>
                            <button id="submit-button">Submit</button>
                        @endif
                        <script>
                            $('#submit-button').hide()
                            $('#add-button').click(function (e) { 
                                e.preventDefault();
                                $('#payment').trigger('click');
                            });

                            $('#payment').change(function(e){
                                $('#add-button').hide()
                                $('#submit-button').show()
                                $('#submit-button').css("background-color", "#9DFDC7")
                                $('#update-button').prop('disabled', true)
                                $('#update-button').css("background-color", "#999999")
                                $('#update-button').html('Click Submit')
                                $('#file-name').html(e.target.files[0].name)
                            });
                        </script>
                    </form>

                </div>
            </div>
            @endcan

            {{-- Update Form --}}
            <form class="form" action="{{ route('user.update', ['user' => auth()->user()]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <ul>
                    <li>
                        <input type="text" name="name" id="name" autocomplete="off" value="{{ auth()->user()->name }}">
                        <label for="name">Full Name</label>
                    </li>
                    <li>
                        <input type="text" value="{{ auth()->user()->email }}" disabled>
                        <label>Email <small><i>*Cannot change</i></small></label>
                    </li>
                    <li>
                        <input type="text" name="phone" id="phone" autocomplete="off" value="{{ auth()->user()->phone }}">
                        <label for="phone">Phone</label>
                    </li>
                    <li>
                        <input type="text" name="institution" id="institution" autocomplete="off" value="{{ auth()->user()->institution }}">
                        <label for="institution">Institution</label>
                    </li>
                    @if ( auth()->user()->status_id != 2)
                        @if( auth()->user()->abstrak->name == null || auth()->user()->fullpaper->name == null) 
                            <div class="info">
                                <p><i class="fas fa-exclamation-triangle"></i> Deadline for Abstract and Fullpaper : <strong>1 AUG - 15 OCT 2022</strong></p>
                            </div>
                        @endif
                    @endif
                    @can('user-article')
                        <li>
                            @if (auth()->user()->article->path != null)
                                <a href="{{ route('article.download', ['article' => auth()->user()->article]) }}">Download Article</a>
                            @endif
                            <input type="file" name="article" id="article">
                            <label for="article">Article (Optional)</label>
                        </li>
                    @endcan
                    @can('user-payment')
                        <li>
                            @if (auth()->user()->abstrak->path != null)
                                <a href="{{ route('abstrak.download', ['abstrak' => auth()->user()->abstrak]) }}">Download Abstract</a>
                            @endif
                            <input type="file" name="abstrak" id="abstrak">
                            <label for="abstrak">Abstract</label>
                        </li>
                        <li>
                            @if (auth()->user()->fullpaper->path != null)
                                <a href="{{ route('fullpaper.download', ['fullpaper' => auth()->user()->fullpaper]) }}">Download Full Paper</a>
                            @endif
                            <input type="file" name="fullpaper" id="fullpaper">
                            <label for="fullpaper">Fullpaper</label>
                        </li>
                    @endcan
                    <li>
                        <a class="logout" href="{{ route('user.logout') }}">Logout</a>
                        <button id="update-button" type="submit">Update Data</button>
                    </li>
                </ul>
            </form>

            {{-- Fee --}}
            <div class="fee">
                <h2 class="title">Conference Fee</h2>
                <ul>
                    <li class="fee-list"><h3>Domestic Participant</h3>
                        <ul>
                            <li>IDR 200.000 for Presenter Only</li>
                            <li>IDR 1.500.000 for Publication in IOP Conference Series: Earth and Environmental Sciences</li>
                            <li>IDR 500.000 for Additional Paper</li>
                            <li>IDR 100.000 for Participant Only</li>
                            <li>Free for domestic student</li>
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
        </div>
    </div>
</x-layout>
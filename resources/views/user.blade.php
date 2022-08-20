<x-layout>
    {{-- User --}}
    <div class="user">
        <div class="container">
            <a href="{{ route('login') }}" class="back">< Back</a>
            <h1 class="title">Your data</h1>
            <h3 class="sub-title">{{ auth()->user()->status->name }}</h3>
            @can('admin')
                        <a class="admin-button" href="{{ route('admin.index') }}">Admin Panel</a>
                        @endcan

            {{-- Error/Success message --}}
            <x-alert type="success" target="success"></x-alert>
            <x-alert type="error" target="file"></x-alert>
            <x-alert type="error" target="article"></x-alert>
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
                    @can('user-article')
                        <li>
                            @if (auth()->user()->article->path != null)
                                <a href="{{ route('article.download', ['article' => auth()->user()->article]) }}">Download Article</a>
                            @endif
                            <input type="file" name="article" id="article">
                            <label for="article">Article</label>
                        </li>
                    @endcan
                    <li>
                        <a class="logout" href="{{ route('user.logout') }}">Logout</a>
                        <button id="update-button" type="submit">Update Data</button>
                    </li>
                </ul>
            </form>
            
        </div>
    </div>
</x-layout>
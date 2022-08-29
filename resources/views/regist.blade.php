<x-layout>
    {{-- Regist--}}
    <section class="regist">
        <div class="container">
            <form action="{{ route('user.store') }}" method="POST">
                <h1 class="title">Registration</h1>
                <p class="sub-title">Please complete all field. You will receive a separate email with Login Code. </p>
                
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
                        <small class="link">Already registred? <a href="{{ route('login') }}">Login</a></small>
                        <button type="submit">Regist Now</button>
                    </li>
                </ul>
            </form>
        </div>
    </section>
</x-layout>
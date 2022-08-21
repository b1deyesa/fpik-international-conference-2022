<x-layout>
    {{-- Admin --}}
    <div class="admin">
        <div class="container">
            <a href=" @if (auth()->user()->id == 1) {{ route('login') }} @else {{ route('user.index') }} @endif" class="back">< Back</a>
            <h1 class="title">Admin Checking</h1>

            {{-- Status --}}
            <ul class="status">
                <li>General : {{ $users->where('status_id', 1)->count() }}</li>
                <li>Student : {{ $users->where('status_id', 2)->count() }}</li>
                <li>Researcher : {{ $users->where('status_id', 3)->count() }}</li>
                <li>Lecturers : {{ $users->where('status_id', 4)->count() }}</li>
                <li>Presenter-Dom : {{ $users->where('status_id', 5)->count() }}</li>
                <li>Presenter-Int : {{ $users->where('status_id', 6)->count() }}</li>
            </ul>
            
            {{-- Table --}}
            <div class="table">
                <table>
                    <tr>
                        <th rowspan="2">Timestamp</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Full Name</th>
                        <th rowspan="2">Email</th>
                        <th rowspan="2">Phone</th>
                        <th rowspan="2">Institution</th>
                        <th colspan="3">Payment</th>
                        <th rowspan="2">Article</th>
                        <th rowspan="2">Admin</th>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>File</th>
                        <th>Confirm</th>
                    </tr>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->status->name }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->institution }}</td>
                        @if($user->status_id == 5 || $user->status_id == 6)
                            <td align="center">{{ $user->payment->status }}</td>
                            <td>
                                @if ($user->payment->status != 'unpaid')
                                    <a href="{{ route('payment.download', ['payment' => $user->payment]) }}">Download</a>
                                @endif
                            </td>
                            <td>
                                @if ($user->payment->status == 'processing')
                                    <a class="button" href="{{ route('payment.confirm', ['payment' => $user->payment, 'status' => 'valid']) }}" onclick="return confirm('Validate this payment ?')"><i class="fas fa-check"></i> Valid</a>
                                    <a class="button" href="{{ route('payment.confirm', ['payment' => $user->payment, 'status' => 'invalid']) }}" onclick="return confirm('ALERT !! Cancel this payment ?')"><i class="fas fa-x"></i> Invalid</a>
                                @endif
                            </td>
                        @else
                            <td align="center" colspan="3">Free</td>
                        @endif
                        <td>
                            @empty($user->article->path)
                            @else
                                <a href="{{ route('article.download', ['article' => $user->article]) }}">Download</a>
                            @endempty
                        </td>
                        @if ($user->role_id === 2)
                            <td align="center"><a class="button" href="{{ route('admin.getAdmin', ['user' => $user]) }}" style="background: #9b4747">Batalkan Admin</a></td>
                        @else
                            <td align="center"><a class="button" href="{{ route('admin.setAdmin', ['user' => $user]) }}" style="background: #479b8e">Jadikan Admin</a></td>
                        @endif
                    </tr>
                    @endforeach
                </table>
            </div>
            
        </div>
    </div>
</x-layout>
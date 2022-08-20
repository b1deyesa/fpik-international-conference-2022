<x-layout>
    {{-- Admin --}}
    <div class="admin">
        <div class="container">
            <a href="{{ route('login') }}" class="back">< Back</a>
            <h1 class="title">Admin Checking</h1>

            {{-- Status --}}
            <ul class="status">
                <li>Student : 10</li>
                <li>Student : 10</li>
                <li>Student : 10</li>
                <li>Student : 10</li>
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
                        @can('admin')
                            <th rowspan="2">Set Role</th>
                        @endcan
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
                        <td>
                            @empty($user->article->path)
                            @else
                                <a href="{{ route('article.download', ['article' => $user->article]) }}">Download</a>
                            @endempty
                        </td>
                        @can('admin')
                            <td><a class="button" href="{{ route('admin.setAdmin', ['user' => $user]) }}">Jadikan Admin</a></td>
                        @endcan
                    </tr>
                    @endforeach
                </table>
            </div>
            
        </div>
    </div>
</x-layout>
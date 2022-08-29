<x-layout>
    {{-- Abstract-Fullpaper --}}
    <section class="abstract-fullpaper">
        <div class="container">
            <h1 class="title">Abstracts & Fullpaper</h1>
            
            <div class="abstract">
                <h1 class="title">Abstract</h1>
                <hr>
                <ul>
                    @empty($abstracts)
                        <p>No Files Here</p>
                    @else
                        @foreach ($abstracts as $abstract)
                            <li>
                                <p><i class="fas fa-user"></i>&nbsp;<i class="fas fa-arrow-right"></i>&nbsp;&nbsp;{{ $abstract->user->name }}</p>
                                <p><i class="fas fa-file-alt"></i>&nbsp;<i class="fas fa-arrow-right"></i>&nbsp;&nbsp;{{ $abstract->name }}</p>
                            </li>
                        @endforeach
                    @endempty
                </ul>
            </div>
            <div class="fullpaper">
                <h1 class="title">Full Paper</h1>
                <hr>
                <ul>
                    @empty($fullpapers)
                        <p>No Files Here</p>
                    @else
                        @foreach ($fullpapers as $fullpaper)
                            <li>
                                <p><i class="fas fa-user"></i>&nbsp;<i class="fas fa-arrow-right"></i>&nbsp;&nbsp;{{ $fullpaper->user->name }}</p>
                                <p><i class="fas fa-file-alt"></i>&nbsp;<i class="fas fa-arrow-right"></i>&nbsp;&nbsp;{{ $fullpaper->name }}</p>
                            </li>
                        @endforeach
                    @endempty
                </ul>
            </div>
        </div>
    </section>
</x-layout>
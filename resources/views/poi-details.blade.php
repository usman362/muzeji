<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/wavesurfer.js@7"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('splash/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script>
        setTimeout(function() {
            document.querySelector('.fscreen').style.display = 'none';
            document.querySelector('.sscreen').style.display = 'block';
            document.querySelector('body').classList.remove('fsc');
        }, 1000);
    </script>
</head>

<body class="fsc">
    <section class="fscreen">
        <h1>SPLASH SCREEN</h1>
        <div class="logo"><i><img src="{{ asset('storage/' . $poi->exhibition->project->logo) }}" width="100"><i>
        </div>
    </section>
    <section class="sscreen" style="display:none;">

        <div class="sc-2-cont">
            <div class="overlay" id="overlay" onclick="closePopup()"></div>
            @foreach ($poi->details as $key => $detail)
                <div class="popup" id="popup{{ $key }}">
                    <span class="popup-close" onclick="closePopup()">&times;</span>
                    <div class="pcontst">
                        @if (isset($detail->video->media_url))
                            <video src="{{ asset('storage/' . $detail->video->media_url) }}" controls=""></video>
                        @else
                            <center>
                                <h2>Video Not Found!</h2>
                            </center>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="side-lang-cont">
                <div class="inner-g">
                    @foreach ($poi->details as $key => $detail)
                        <div class="each-lang cursor-pointer" onclick="showLanguage('{{ $key }}')">
                            <img src="https://hatscripts.github.io/circle-flags/flags/{{ $detail->flag }}.svg">
                        </div>
                    @endforeach
                </div>
            </div>

            @foreach ($poi->details as $key => $detail)
                <div id="content-{{ $key }}" class="language-content"
                    {{ $key > 0 ? 'style=display:none;' : '' }}>
                    <div class="slideshow-container">
                        <button class="arbtn"><img src="{{ asset('splash/img/AR.svg') }}"> view in AR</button>
                        @if (!empty($detail->images))
                            @foreach ($detail->images as $detailKey => $image)
                                <div class="mySlides mySlides{{ $key }} fade">
                                    <div class="box"
                                        style="background: url('{{ asset('storage/' . $image->media_url) }}');background-size:cover">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <a class="prev" onclick="plusSlides(-1,{{ $key }})">❮</a>
                        <a class="next" onclick="plusSlides(1,{{ $key }})">❯</a>
                        <div class="ico-cont">
                            <div class="contic cursor-pointer" onclick="addClassToSideLangCont()">
                                <img src="https://hatscripts.github.io/circle-flags/flags/{{ $detail->flag }}.svg"
                                    width="30px">
                            </div>
                            <div class="plic cursor-pointer" onclick="openPopup({{ $key }});">
                                <img src="{{ asset('splash/img/playicon.svg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mid-content">
                        <h3>{{ $detail->title }}</h3>
                        <p id="ovcontent">
                            {{ $detail->description }}
                        </p>
                    </div>
                    <br>
                    @if (isset($detail->audio->media_url))
                        <div class="music">
                            <div class="track">
                                <img src="{{ asset('splash/img/play.png') }}" id="playBtn{{ $key }}">
                                <div id="waveform{{ $key }}"></div>
                            </div>
                        </div>
                    @endif
                </div>
                <script type="text/javascript">
                    var playBtn = document.getElementById('playBtn{{ $key }}');

                    var wavesurfer = WaveSurfer.create({
                        container: '#waveform{{ $key }}',
                        waveColor: '#ddd',
                        progressColor: '#ff006c',
                        barWidth: 1.3,
                        responsive: true,
                        height: 40,
                        barRadius: 3,
                        fftSize: 16384
                    });
                    @if (isset($detail->audio->media_url))
                        wavesurfer.load("{{ asset('storage/' . $detail->audio->media_url) }}");
                    @endif
                    playBtn.onclick = function() {
                        wavesurfer.playPause();
                        if (playBtn.src.includes('{{ asset('splash/img/play.png') }}')) {
                            playBtn.src = '{{ asset('splash/img/pause.png') }}'
                        } else {
                            playBtn.src = '{{ asset('splash/img/play.png') }}'
                        }
                    }
                    wavesurfer.on('finish', function() {
                        playBtn.src = '{{ asset('splash/img/play.png') }}'
                        wavesurfer.stop();
                    })
                </script>
            @endforeach
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('splash/js/index.js') }}"></script>

</body>

</html>

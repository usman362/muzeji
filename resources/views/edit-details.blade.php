@extends('layouts.app')
@section('content')
    <div class="main-container" style="margin-top: 0">
        <div class="back-button">
            <a href="{{ route('poi.index', $poi->exhibition->id) }}"><button><i class="fa fa-chevron-left"></i></button></a>
        </div>

        <form action="{{ route('poi.update', $poi->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="project-details">
                <div class="main-title">
                    <b><input type="text" class="form-control mb-2" name="main_title" value="{{ $poi->title }}"></b>
                    <span>Main Title</span>
                </div>

                <div class="flags-section">
                    {{-- <div class="flags-buttons"> --}}
                    @foreach ($poi->details as $key => $detail)
                        <div class="tablinks active" id="defaultOpen" onclick="changeTab(event, '{{ $detail->language }}')">
                            @if (isset($detail->media->media_url) && $detail->media->type == 'logo')
                                <img src="{{ asset('storage/'.$detail->media->media_url) }}" alt="" />
                            @else
                                <img src="{{ asset('images/error_log.png') }}" width="40" alt="" />
                            @endif
                        </div>
                    @endforeach
                    {{-- </div> --}}

                    <div>
                        <button type="button" class="add-lang-btn"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div id="main-lang-div">
                    @foreach ($poi->details as $key => $detail)
                        <div id="{{ $detail->language }}" class="tab-content">
                            <input type="hidden" name="main_id[]" value="{{ $detail->id }}">
                            <div class="title-1"><input type="text" class="form-control" value="{{ $detail->title }}"
                                    name="title[]">
                            </div>
                            <div class="paragraph">
                                <textarea name="description[]" id="" class="form-control" rows="10">{{ $detail->description }}</textarea>
                            </div>

                            <div class="mt-2">
                                <select name="language[]" id="language" class="form-control select2">
                                    <option value="en" @selected($detail->language == 'en')>English</option>
                                    <option value="ar" @selected($detail->language == 'ar')>Arabic</option>
                                    <option value="de" @selected($detail->language == 'de')>German</option>
                                    <option value="fr" @selected($detail->language == 'fr')>French</option>
                                    <option value="es" @selected($detail->language == 'es')>Spanish</option>
                                    <option value="it" @selected($detail->language == 'it')>Italian</option>
                                    <option value="nl" @selected($detail->language == 'nl')>Dutch</option>
                                    <option value="ja" @selected($detail->language == 'ja')>Japanese</option>
                                    <option value="ko" @selected($detail->language == 'ko')>Korean</option>
                                    <option value="pt" @selected($detail->language == 'pt')>Portuguese</option>
                                    <option value="ru" @selected($detail->language == 'ru')>Russian</option>
                                    <option value="zh" @selected($detail->language == 'zh')>Chinese</option>
                                    <option value="hi" @selected($detail->language == 'hi')>Hindi</option>
                                    <option value="tr" @selected($detail->language == 'tr')>Turkish</option>
                                    <option value="id" @selected($detail->language == 'id')>Indonesian</option>
                                    <option value="vi" @selected($detail->language == 'vi')>Vietnamese</option>
                                    <option value="th" @selected($detail->language == 'th')>Thai</option>
                                    <option value="el" @selected($detail->language == 'el')>Greek</option>
                                    <option value="sv" @selected($detail->language == 'sv')>Swedish</option>
                                    <option value="pl" @selected($detail->language == 'pl')>Polish</option>
                                    <option value="da" @selected($detail->language == 'da')>Danish</option>
                                    <option value="fi" @selected($detail->language == 'fi')>Finnish</option>
                                    <option value="no" @selected($detail->language == 'no')>Norwegian</option>
                                    <option value="he" @selected($detail->language == 'he')>Hebrew</option>
                                    <option value="cs" @selected($detail->language == 'cs')>Czech</option>
                                    <option value="hu" @selected($detail->language == 'hu')>Hungarian</option>
                                    <option value="ro" @selected($detail->language == 'ro')>Romanian</option>
                                    <option value="sk" @selected($detail->language == 'sk')>Slovak</option>
                                    <option value="uk" @selected($detail->language == 'uk')>Ukrainian</option>
                                    <option value="bg" @selected($detail->language == 'bg')>Bulgarian</option>
                                    <option value="sr" @selected($detail->language == 'sr')>Serbian</option>
                                    <option value="hr" @selected($detail->language == 'hr')>Croatian</option>
                                    <option value="sl" @selected($detail->language == 'sl')>Slovenian</option>
                                    <option value="et" @selected($detail->language == 'et')>Estonian</option>
                                    <option value="lt" @selected($detail->language == 'lt')>Lithuanian</option>
                                    <option value="lv" @selected($detail->language == 'lv')>Latvian</option>
                                    <option value="mk" @selected($detail->language == 'mk')>Macedonian</option>
                                    <option value="sq" @selected($detail->language == 'sq')>Albanian</option>
                                    <option value="hy" @selected($detail->language == 'hy')>Armenian</option>
                                    <option value="az" @selected($detail->language == 'az')>Azerbaijani</option>
                                    <option value="eu" @selected($detail->language == 'eu')>Basque</option>
                                    <option value="be" @selected($detail->language == 'be')>Belarusian</option>
                                    <option value="bs" @selected($detail->language == 'bs')>Bosnian</option>
                                    <option value="ka" @selected($detail->language == 'ka')>Georgian</option>
                                    <option value="is" @selected($detail->language == 'is')>Icelandic</option>
                                    <option value="gl" @selected($detail->language == 'gl')>Galician</option>
                                    <option value="mt" @selected($detail->language == 'mt')>Maltese</option>
                                    <option value="et" @selected($detail->language == 'et')>Estonian</option>
                                    <option value="lb" @selected($detail->language == 'lb')>Luxembourgish</option>
                                    <option value="mk" @selected($detail->language == 'mk')>Macedonian</option>
                                    <option value="mn" @selected($detail->language == 'mn')>Mongolian</option>
                                    <option value="ne" @selected($detail->language == 'ne')>Nepali</option>
                                    <option value="ps" @selected($detail->language == 'ps')>Pashto</option>
                                    <option value="fa" @selected($detail->language == 'fa')>Persian</option>
                                    <option value="rw" @selected($detail->language == 'rw')>Kinyarwanda</option>
                                    <option value="si" @selected($detail->language == 'si')>Sinhala</option>
                                    <option value="so" @selected($detail->language == 'so')>Somali</option>
                                    <option value="ta" @selected($detail->language == 'ta')>Tamil</option>
                                    <option value="te" @selected($detail->language == 'te')>Telugu</option>
                                    <option value="ur" @selected($detail->language == 'ur')>Urdu</option>
                                    <option value="yo" @selected($detail->language == 'yo')>Yoruba</option>
                                    <option value="zu" @selected($detail->language == 'zu')>Zulu</option>
                                </select>
                            </div>

                            <div class="mp3-buttons">
                                <div class="ai-checkbox">
                                    <input type="checkbox" name="ai-checkbox[]" id="ai-checkbox" />
                                    <label for="ai-checkbox">AI generate MP3</label>
                                </div>
                                <div class="audio-input cursor-pointer" onclick="fileInputClick('audioInput{{$detail->id}}')">
                                    <input type="file" id="audioInput{{$detail->id}}" class="d-none" name="audio[]"
                                        onchange="showFileName('select-audio{{$detail->id}}','audioInput{{$detail->id}}')" accept="audio/*" />
                                    <div class=""></div>
                                    {{-- <div class="selected-file" id="selectedFile">Upload Logo</div> --}}
                                    <div class="input-box" id="select-audio{{$detail->id}}">Upload some MP3 sounds</div>
                                    <div class="input-icon">
                                        <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                                    </div>
                                </div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('imageInput{{$detail->id}}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/photo-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedLogo{{$detail->id}}">Upload Logo</div>
                                <input type="file" id="imageInput{{$detail->id}}" class="d-none" name="logo[]"
                                    onchange="showFileName('selectedLogo{{$detail->id}}','imageInput{{$detail->id}}')" accept="image/*" />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('videoInput{{$detail->id}}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/upload-icon-large.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedVideo{{$detail->id}}">Upload videos</div>
                                <input type="file" id="videoInput{{$detail->id}}" class="d-none" name="video[]"
                                    onchange="showFileName('selectedVideo{{$detail->id}}','videoInput{{$detail->id}}')" accept="video/*" />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('fileInput{{$detail->id}}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/star-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedFile{{$detail->id}}">Upload 3D Object</div>
                                <input type="file" id="fileInput{{$detail->id}}" class="d-none" name="object[]"
                                    onchange="showFileName('selectedFile{{$detail->id}}','fileInput{{$detail->id}}')" />
                                <div class=""></div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="submit-details">
                    <button type="submit">SAVE</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function showFileName(id, value) {
            const fileInput = document.getElementById(value);
            const selectedFile = document.getElementById(id);
            const fileName = fileInput.files[0].name;
            selectedFile.innerHTML = `${fileName}`;
        }

        function changeBoxColor(inputId, id) {
            const colorInput = document.getElementById(inputId).value;
            const selectedBox = document.getElementById(id);
            // const fileName = colorInput.files[0].name;
            // selectedFile.innerHTML = `${fileName}`;
            selectedBox.style.backgroundColor = colorInput;
        }

        function fileInputClick(id) {
            document.getElementById(id).click();
        }

        document.getElementById("defaultOpen").click();

        function changeTab(evt, tabName) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        $(document).ready(function() {
            let audioChunks = [];
            let mediaRecorder;

            // Get user media constraints
            const constraints = {
                audio: true
            };

            // Event handler for starting recording
            $('#startRecording').click(function() {
                navigator.mediaDevices.getUserMedia(constraints)
                    .then(function(stream) {
                        mediaRecorder = new MediaRecorder(stream);

                        // Event handler for data available
                        mediaRecorder.ondataavailable = function(event) {
                            audioChunks.push(event.data);
                        }

                        // Start recording
                        mediaRecorder.start();
                    })
                    .catch(function(err) {
                        console.error('Error recording audio: ' + err);
                    });
            });

            // Event handler for stopping recording
            $('#stopRecording').click(function() {
                if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                    mediaRecorder.stop();
                }
            });

            // Event handler for data available
            $('#downloadLink').click(function() {
                // Convert audio chunks to blob
                const audioBlob = new Blob(audioChunks, {
                    type: 'audio/wav'
                });

                // Create download link
                const url = URL.createObjectURL(audioBlob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'recording.wav';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            });

            // Handle media recorder error
            mediaRecorder.onerror = function(e) {
                console.error('Error from Media Recorder:', e);
            };
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.add-lang-btn').click(function() {
                var randomId = Math.random().toString(36).substring(7);
                var newFlagSection = `
                <div class="tablinks" id="defaultOpen" onclick="changeTab(event, '${randomId}')">
                    <img src="{{asset('images/error_log.png')}}" alt="" width="40">
                </div>`;
                $('.flags-section').children('div').eq(-1).before(newFlagSection);
                $('#main-lang-div').append(`
                        <div id="${randomId}" class="tab-content" style="display: none;">
                            <input type="hidden" name="main_id[]" value="${randomId}">
                            <div class="title-1">
                                <input type="text" class="form-control" value="" name="title[]">
                            </div>
                            <div class="paragraph">
                                <textarea name="description[]" id="" class="form-control" rows="10"></textarea>
                            </div>

                            <div class="mt-2">
                                <select name="language[]" id="language" class="form-control select2">
                                    <option value="en">English</option>
                                    <option value="ar">Arabic</option>
                                    <option value="de">German</option>
                                    <option value="fr">French</option>
                                    <option value="es">Spanish</option>
                                    <option value="it">Italian</option>
                                    <option value="nl">Dutch</option>
                                    <option value="ja">Japanese</option>
                                    <option value="ko">Korean</option>
                                    <option value="pt">Portuguese</option>
                                    <option value="ru">Russian</option>
                                    <option value="zh">Chinese</option>
                                    <option value="hi">Hindi</option>
                                    <option value="tr">Turkish</option>
                                    <option value="id">Indonesian</option>
                                    <option value="vi">Vietnamese</option>
                                    <option value="th">Thai</option>
                                    <option value="el">Greek</option>
                                    <option value="sv">Swedish</option>
                                    <option value="pl">Polish</option>
                                    <option value="da">Danish</option>
                                    <option value="fi">Finnish</option>
                                    <option value="no">Norwegian</option>
                                    <option value="he">Hebrew</option>
                                    <option value="cs">Czech</option>
                                    <option value="hu">Hungarian</option>
                                    <option value="ro">Romanian</option>
                                    <option value="sk">Slovak</option>
                                    <option value="uk">Ukrainian</option>
                                    <option value="bg">Bulgarian</option>
                                    <option value="sr">Serbian</option>
                                    <option value="hr">Croatian</option>
                                    <option value="sl">Slovenian</option>
                                    <option value="et">Estonian</option>
                                    <option value="lt">Lithuanian</option>
                                    <option value="lv">Latvian</option>
                                    <option value="mk">Macedonian</option>
                                    <option value="sq">Albanian</option>
                                    <option value="hy">Armenian</option>
                                    <option value="az">Azerbaijani</option>
                                    <option value="eu">Basque</option>
                                    <option value="be">Belarusian</option>
                                    <option value="bs">Bosnian</option>
                                    <option value="ka">Georgian</option>
                                    <option value="is">Icelandic</option>
                                    <option value="gl">Galician</option>
                                    <option value="mt">Maltese</option>
                                    <option value="et">Estonian</option>
                                    <option value="lb">Luxembourgish</option>
                                    <option value="mk">Macedonian</option>
                                    <option value="mn">Mongolian</option>
                                    <option value="ne">Nepali</option>
                                    <option value="ps">Pashto</option>
                                    <option value="fa">Persian</option>
                                    <option value="rw">Kinyarwanda</option>
                                    <option value="si">Sinhala</option>
                                    <option value="so">Somali</option>
                                    <option value="ta">Tamil</option>
                                    <option value="te">Telugu</option>
                                    <option value="ur">Urdu</option>
                                    <option value="yo">Yoruba</option>
                                    <option value="zu">Zulu</option>
                                </select>
                            </div>

                            <div class="mp3-buttons">
                                <div class="ai-checkbox">
                                    <input type="checkbox" name="ai-checkbox[]" id="ai-checkbox" />
                                    <label for="ai-checkbox">AI generate MP3</label>
                                </div>
                                <div class="audio-input cursor-pointer" onclick="fileInputClick('audioInput${randomId}')">
                                    <input type="file" id="audioInput${randomId}" class="d-none" name="audio[]"
                                        onchange="showFileName('select-audio${randomId}','audioInput${randomId}')" accept="audio/*" />
                                    <div class=""></div>
                                    <div class="input-box" id="select-audio${randomId}">Upload some MP3 sounds</div>
                                    <div class="input-icon">
                                        <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                                    </div>
                                </div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('imageInput${randomId}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/photo-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedLogo${randomId}">Upload Logo</div>
                                <input type="file" id="imageInput${randomId}" class="d-none" name="logo[]"
                                    onchange="showFileName('selectedLogo${randomId}','imageInput${randomId}')" accept="image/*" />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('videoInput${randomId}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/upload-icon-large.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedVideo${randomId}">Upload videos</div>
                                <input type="file" id="videoInput${randomId}" class="d-none" name="video[]"
                                    onchange="showFileName('selectedVideo${randomId}','videoInput${randomId}')" accept="video/*" />
                                <div class=""></div>
                            </div>
                            <div class="input-large-box cursor-pointer" onclick="fileInputClick('fileInput${randomId}')">
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/star-icon.png') }}" alt="file-icon" />
                                </div>
                                <div class="selected-file" id="selectedFile${randomId}">Upload 3D Object</div>
                                <input type="file" id="fileInput${randomId}" class="d-none" name="object[]"
                                    onchange="showFileName('selectedFile${randomId}','fileInput${randomId}')" />
                                <div class=""></div>
                            </div>
                        </div>
                `)
            });
        });
    </script>
@endpush

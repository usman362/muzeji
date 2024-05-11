// audio recorder
let recorder, audio_stream;
const recordButton = document.getElementById("recordButton");
recordButton.addEventListener("click", startRecording);

// stop recording
const stopButton = document.getElementById("stopButton");
stopButton.addEventListener("click", stopRecording);
stopButton.disabled = true;

// set preview
const preview = document.getElementById("audio-playback");

// set download button event
// const downloadAudio = document.getElementById("downloadButton");
// downloadAudio.addEventListener("click", downloadRecording);

function startRecording() {
    // button settings
    recordButton.disabled = true;
    $("#recordButton").addClass("d-none");
    stopButton.disabled = false;
    $("#stopButton").removeClass("d-none");
    $("#stopButton").css("border","2px solid red");


    if (!$("#audio-playback").hasClass("d-none")) {
        $("#audio-playback").addClass("d-none")
    };

    // if (!$("#downloadContainer").hasClass("d-none")) {
    //     $("#downloadContainer").addClass("d-none")
    // };

    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(function (stream) {
            audio_stream = stream;
            recorder = new MediaRecorder(stream);

            // when there is data, compile into object for preview src
            recorder.ondataavailable = function (e) {
                const url = URL.createObjectURL(e.data);
                preview.src = url;

                // set link href as blob url, replaced instantly if re-recorded
                // downloadAudio.href = url;
            };
            recorder.start();

            timeout_status = setTimeout(function () {
                console.log("5 min timeout");
                stopRecording();
            }, 300000);
        });
}

function stopRecording() {
    recorder.stop();
    audio_stream.getAudioTracks()[0].stop();

    // buttons reset
    recordButton.disabled = false;
    $("#recordButton").removeClass("d-none");

    $("#stopButton").addClass("d-none");
    stopButton.disabled = true;

    $("#audio-playback").removeClass("d-none");

    // $("#downloadContainer").removeClass("d-none");
}

// function downloadRecording(){
//     var name = new Date();
//     var res = name.toISOString().slice(0,10)
//     downloadAudio.download = res + '.wav';
// }

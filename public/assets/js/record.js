function restore() {
    $("#record, #live").removeClass("disabled");
    $("#pause").replaceWith('<a class="button one" id="pause">Pause</a>');
    $(".one").addClass("disabled");
    $('#level').hide();
    Fr.voice.stop();
}
$(document).ready(function() {
    Fr.voice.mp3WorkerPath = "cdn/mp3Worker.js";
    $(document).on("click", "#record:not(.disabled)", function() {
        elem = $(this);
        Fr.voice.record($("#live").is(":checked"), function() {
            $('#level').show();
            elem.addClass("disabled");
            $("#live").addClass("disabled");
            $(".one").removeClass("disabled");
            // blur awal by default
            QuranJS.showAyat('start');

            analyser = Fr.voice.context.createAnalyser();
            analyser.fftSize = 2048;
            analyser.minDecibels = -90;
            analyser.maxDecibels = -10;
            analyser.smoothingTimeConstant = 0.85;
            Fr.voice.input.connect(analyser);
            var bufferLength = analyser.frequencyBinCount;
            var dataArray = new Uint8Array(bufferLength);
            WIDTH = 500, HEIGHT = 50;
            canvasCtx = $("#level")[0].getContext("2d");
            canvasCtx.clearRect(0, 0, WIDTH, HEIGHT);

            function draw() {
                drawVisual = requestAnimationFrame(draw);
                analyser.getByteTimeDomainData(dataArray);
                canvasCtx.fillStyle = 'rgba(222,239,215,0.4)';
                canvasCtx.fillRect(0, 0, WIDTH, HEIGHT);
                canvasCtx.lineWidth = 2;
                canvasCtx.strokeStyle = '#8D94AB';
                canvasCtx.beginPath();
                var sliceWidth = WIDTH * 1.0 / bufferLength;
                var x = 0;
                for (var i = 0; i < bufferLength; i++) {
                    var v = dataArray[i] / 128.0;
                    var y = v * HEIGHT / 2;
                    if (i === 0) {
                        canvasCtx.moveTo(x, y);
                    } else {
                        canvasCtx.lineTo(x, y);
                    }
                    x += sliceWidth;
                }
                canvasCtx.lineTo(WIDTH, HEIGHT / 2);
                canvasCtx.stroke();
            };
            draw();
        });
    });
    $(document).on("click", "#pause:not(.disabled)", function() {
        if ($(this).hasClass("resume")) {
            Fr.voice.resume();
            $(this).replaceWith('<a class="button one" id="pause">Pause</a>');
        } else {
            Fr.voice.pause();
            $(this).replaceWith('<a class="button one resume" id="pause">Resume</a>');
        }
    });
    $(document).on("click", "#stop:not(.disabled)", function() {
        restore();
    });
    $(document).on("click", "#play:not(.disabled)", function() {
        Fr.voice.export(function(url) {
            $("#audio").attr("src", url);
            $("#audio")[0].play();
        }, "URL");
         Fr.voice.export(function(base64) {
            $('#base64Decode').val(base64);
        }, "base64");
        $('.upload').removeClass('disabled');
        // remove blur 
        $('.ayat_arabic_memoz').removeClass('blur-ayat');
        restore();
    });
    $(document).on("click", "#download:not(.disabled)", function() {
        Fr.voice.export(function(url) {
            $("<a href='" + url + "' download='MyRecording.wav'></a>")[0].click();
        }, "URL");
        restore();
    });
    $(document).on("click", "#base64:not(.disabled)", function() {
        Fr.voice.export(function(url) {
            alert( url);
            console.log("Here is the base64 URL : " + url);
            alert("Check the web console for the URL");
            $("<a href='" + url + "' target='_blank'></a>")[0].click();
        }, "base64");
        restore();
    });
    $(document).on("click", "#mp3:not(.disabled)", function() {
        alert("The conversion to MP3 will take some time (even 10 minutes), so please wait....");
        Fr.voice.export(function(url) {
            console.log("Here is the MP3 URL : " + url);
            alert("Check the web console for the URL");
            $("<a href='" + url + "' target='_blank'></a>")[0].click();
        }, "mp3");
        restore();
    });
    $(document).on("click", "#save:not(.disabled)", function() {
        var idMemo = $('#id').val();
        $('.btn-upload').removeClass('fa-upload');
        $('#save,#record').addClass('disabled');
        $('.btn-upload').addClass('fa-cog fa-spin fa-3x fa-fw');
        if(idMemo!=''){
             base64Decode = $('#base64Decode').val();
             $.post("http://localhost/QuranNote/public/memoz/uploadRecorded",{
                  audioBase64:base64Decode,
                  id : idMemo
                }, function (response){
                    alert(response.message);
                    $('.btn-upload').addClass('fa-upload');
                    $('.btn-upload').removeClass('fa-cog fa-spin fa-3x fa-fw');
                    $('#save,#record').removeClass('disabled');
                }
              );
            restore();
        }else{
            alert('Hafalan harus di simpan dulu');
        }
    });
});

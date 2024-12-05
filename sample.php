<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Detection in Recorded Video</title>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
    <style>
        video {
            width: 100%;
            max-width: 640px;
        }
        #timer {
            text-align: center;
            font-size: 1.2em;
            margin-top: 10px;
        }
        button {
            display: block;
            margin: 20px auto;
        }
        #status {
            text-align: center;
            font-size: 1.2em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2 align="center">Human Detection in Recorded Video</h2>

    <!-- Video Elements -->
    <video id="videoPreview" autoplay muted></video>
    <video id="recordedVideo" controls style="display:none;"></video>
    <div id="timer">00:00</div>
    <div id="status">Detecting Human Presence...</div>

    <button id="startRecording">Start Recording</button>
    <button id="stopRecording" disabled>Stop Recording</button>
    <button id="retake" style="display:none;">Retake</button>

    <script>
        let mediaRecorder;
        let recordedBlobs = [];
        let timer;
        let timeElapsed = 0;

        const videoPreview = document.getElementById('videoPreview');
        const recordedVideo = document.getElementById('recordedVideo');
        const startRecordingButton = document.getElementById('startRecording');
        const stopRecordingButton = document.getElementById('stopRecording');
        const retakeButton = document.getElementById('retake');
        const timerDisplay = document.getElementById('timer');
        const statusElement = document.getElementById('status');

        // Access the webcam for recording
        navigator.mediaDevices.getUserMedia({ video: true, audio: true })
            .then(stream => {
                videoPreview.srcObject = stream;
                videoPreview.play();

                mediaRecorder = new MediaRecorder(stream, { mimeType: 'video/webm' });

                mediaRecorder.ondataavailable = event => {
                    if (event.data.size > 0) {
                        recordedBlobs.push(event.data);
                    }
                };

                mediaRecorder.onstop = () => {
                    clearInterval(timer);
                    const superBlob = new Blob(recordedBlobs, { type: 'video/webm' });
                    recordedVideo.src = URL.createObjectURL(superBlob);
                    recordedVideo.style.display = 'block';

                    // Start human detection after the recording is complete
                    detectHumanInVideo(superBlob);
                };
            })
            .catch(error => {
                alert('Camera and microphone access are required to record a video.');
                console.error('Error accessing media devices:', error);
            });

        // Timer function for the 15-second recording
        function updateTimer() {
            timeElapsed++;
            const minutes = String(Math.floor(timeElapsed / 60)).padStart(2, '0');
            const seconds = String(timeElapsed % 60).padStart(2, '0');
            timerDisplay.textContent = `${minutes}:${seconds}`;
            if (timeElapsed >= 15) {
                stopRecordingButton.click();
            }
        }

        startRecordingButton.addEventListener('click', () => {
            recordedBlobs = [];
            timeElapsed = 0;
            timerDisplay.textContent = "00:00";
            timer = setInterval(updateTimer, 1000);

            mediaRecorder.start();
            startRecordingButton.disabled = true;
            stopRecordingButton.disabled = false;
            retakeButton.style.display = 'none';
        });

        stopRecordingButton.addEventListener('click', () => {
            if (timeElapsed < 15) {
                alert('Recording must be exactly 15 seconds long.');
                return;
            }
            mediaRecorder.stop();
            startRecordingButton.disabled = false;
            stopRecordingButton.disabled = true;
        });

        // Retake functionality
        retakeButton.addEventListener('click', () => {
            recordedBlobs = [];
            recordedVideo.style.display = 'none';
            retakeButton.style.display = 'none';
            startRecordingButton.disabled = false;
            stopRecordingButton.disabled = true;
            statusElement.textContent = "Detecting Human Presence...";
        });

        // Load the COCO-SSD model for human detection
        async function loadModel() {
            return await cocoSsd.load();
        }

        // Function to detect humans in recorded video
        async function detectHumanInVideo(blob) {
            const model = await loadModel();

            const videoElement = document.createElement('video');
            const url = URL.createObjectURL(blob);
            videoElement.src = url;
            videoElement.play();

            videoElement.onloadeddata = async () => {
                const frameInterval = 100; // Check every 100 ms for human detection
                let currentTime = 0;

                const detectFrame = async () => {
                    if (currentTime > videoElement.duration) return;

                    videoElement.currentTime = currentTime;

                    // Wait for frame to be ready
                    videoElement.onseeked = async () => {
                        const predictions = await model.detect(videoElement);
                        let humanDetected = false;

                        predictions.forEach(prediction => {
                            if (prediction.class === 'person' && prediction.score > 0.5) {
                                humanDetected = true;
                            }
                        });

                        statusElement.textContent = humanDetected ? "Human detected!" : "No human detected.";
                    };

                    currentTime += frameInterval / 1000;
                    requestAnimationFrame(detectFrame);
                };

                detectFrame();
            };
        }
    </script>
</body>
</html>

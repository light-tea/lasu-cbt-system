<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Verification</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="{{ asset('js/face-api.min.js') }}"></script>
</head>

<body class="bg-slate-950 min-h-screen flex items-center justify-center text-white">

<div class="w-full max-w-xl bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl">

    <!-- HEADER -->
    <div class="text-center">

        <div class="text-5xl mb-4">
            🔐
        </div>

        <h2 class="text-3xl font-bold">
            Face Verification
        </h2>

        <p class="text-slate-400 mt-3">
            Verify your identity before accessing the examination system.
        </p>

    </div>

    <!-- VIDEO -->
    <div class="mt-8 flex justify-center">

        <video
            id="video"
            autoplay
            muted
            class="rounded-2xl border-4 border-slate-700 w-full max-w-md h-[320px] object-cover"
        ></video>

    </div>

    <!-- STATUS -->
    <div class="mt-6 text-center">

        <p
            id="status"
            class="inline-block bg-slate-800 px-4 py-2 rounded-xl text-sm text-slate-300"
        >
            Loading face system...
        </p>

    </div>

    <!-- BUTTON -->
    <div class="mt-8">

        <button
            onclick="verifyFace()"
            id="verifyBtn"
            class="w-full bg-blue-600 hover:bg-blue-700 transition duration-200 py-4 rounded-2xl font-semibold text-lg shadow-lg"
        >
            Verify Face
        </button>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', async () => {

    const video = document.getElementById('video');

    const status = document.getElementById('status');

    const verifyBtn = document.getElementById('verifyBtn');

    let modelsLoaded = false;

    /*
    |--------------------------------------------------------------------------
    | START CAMERA
    |--------------------------------------------------------------------------
    */
    try {

        const stream = await navigator.mediaDevices.getUserMedia({
            video: true
        });

        video.srcObject = stream;

    } catch (error) {

        alert("Unable to access camera");

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | LOAD FACE MODELS
    |--------------------------------------------------------------------------
    */
    try {

        await Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('/models')
        ]);

        modelsLoaded = true;

        status.innerText = "System Ready";

        status.classList.remove('bg-slate-800');

        status.classList.add('bg-green-600');

    } catch (error) {

        console.error(error);

        status.innerText = "Failed to load models";

        status.classList.remove('bg-slate-800');

        status.classList.add('bg-red-600');

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY FACE
    |--------------------------------------------------------------------------
    */
    window.verifyFace = async function () {

        if (!modelsLoaded) {

            alert("Models still loading");

            return;
        }

        verifyBtn.innerText = "Verifying...";

        verifyBtn.disabled = true;

        const detection = await faceapi
            .detectSingleFace(
                video,
                new faceapi.TinyFaceDetectorOptions()
            )
            .withFaceLandmarks()
            .withFaceDescriptor();

        /*
        |--------------------------------------------------------------------------
        | NO FACE DETECTED
        |--------------------------------------------------------------------------
        */
        if (!detection) {

            alert("No face detected");

            verifyBtn.innerText = "Verify Face";

            verifyBtn.disabled = false;

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | STORED FACE DESCRIPTOR
        |--------------------------------------------------------------------------
        */
        const storedDescriptor = JSON.parse(
            '{!! auth()->user()->face_descriptor !!}'
        );

        /*
        |--------------------------------------------------------------------------
        | CURRENT FACE
        |--------------------------------------------------------------------------
        */
        const currentDescriptor = Array.from(
            detection.descriptor
        );

        /*
        |--------------------------------------------------------------------------
        | FACE DISTANCE
        |--------------------------------------------------------------------------
        */
        const distance = faceapi.euclideanDistance(
            storedDescriptor,
            currentDescriptor
        );

        console.log("Distance:", distance);

        /*
        |--------------------------------------------------------------------------
        | FACE MATCH SUCCESS
        |--------------------------------------------------------------------------
        */
        if (distance < 0.5) {

            status.innerText = "Face Verified Successfully";

            status.classList.remove('bg-slate-800');

            status.classList.add('bg-green-600');

            /*
            |--------------------------------------------------------------------------
            | EXAM OR LOGIN VERIFICATION
            |--------------------------------------------------------------------------
            */
            const params = new URLSearchParams(window.location.search);

            const type = params.get('type');

            let payload = {
                verified: true
            };

            if (type === 'exam') {

                payload.type = 'exam';

            }

            fetch('/face-verification', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(() => {

                window.location.href = "/student/dashboard";

            });

        } else {

            status.innerText = "Face does not match";

            status.classList.remove('bg-slate-800');

            status.classList.add('bg-red-600');

            alert("Face does not match");

            verifyBtn.innerText = "Verify Face";

            verifyBtn.disabled = false;
        }
    };

});

</script>

</body>
</html>
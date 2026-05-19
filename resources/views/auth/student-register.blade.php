<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Registration — SmartCBT</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('js/face-api.min.js') }}"></script>

<style>
body{
    background:
        radial-gradient(circle at top left, rgba(96,165,250,0.18), transparent 40%),
        radial-gradient(circle at bottom right, rgba(59,130,246,0.12), transparent 40%),
        #f5faff;
}
.glass{
    background:rgba(255,255,255,0.8);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.9);
}
</style>
</head>

<body class="min-h-screen flex items-center justify-center px-6 py-10">

<div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">

<!-- LEFT -->
<div class="hidden lg:block space-y-5">

    <a href="/" class="text-sm text-slate-500 hover:text-blue-600">← Back Home</a>

    <h1 class="text-5xl font-extrabold text-slate-900">
        Student <br>
        <span class="text-blue-600">Biometric Registration</span>
    </h1>

    <p class="text-slate-600 max-w-md">
        Register once to access LASU-style CBT examinations with secure face verification.
    </p>

    <!-- LIVE PREVIEW BOX -->
    <div class="mt-6">
        <p class="text-sm text-slate-500 mb-2">Captured Face Preview</p>
        <img id="previewImage" class="rounded-2xl border shadow hidden w-64" />
    </div>

</div>

<!-- RIGHT -->
<div class="glass rounded-3xl p-8 shadow-xl w-full max-w-md mx-auto">

    <h2 class="text-3xl font-bold text-slate-800">Create Account</h2>
    <p class="text-slate-500 text-sm mb-5">Fill details and capture your face</p>

    <!-- STATUS -->
    <div id="statusBox"
         class="mb-5 text-sm p-3 rounded-xl bg-yellow-100 text-yellow-700 border border-yellow-200">
        Initializing system...
    </div>

    <form id="registerForm">

        <input type="text" name="name" placeholder="Full Name"
            class="w-full mb-4 px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 outline-none"
            required>

        <input type="text" name="matric_no" placeholder="Matric Number"
            class="w-full mb-4 px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 outline-none"
            required>

        <input type="password" name="password" placeholder="Password"
            class="w-full mb-5 px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 outline-none"
            required>

        <!-- CAMERA -->
        <div class="rounded-2xl overflow-hidden border mb-4">
            <video id="video" autoplay muted class="w-full h-56 object-cover"></video>
        </div>

        <input type="hidden" name="face_descriptor" id="face_descriptor">
        <input type="hidden" name="face_image" id="face_image">

        <div class="flex gap-3">

            <button type="button"
                onclick="captureFace()"
                class="flex-1 py-3 rounded-xl bg-purple-600 text-white font-semibold">
                Capture Face
            </button>

            <button type="submit"
                class="flex-1 py-3 rounded-xl bg-blue-600 text-white font-semibold">
                Register
            </button>

        </div>

    </form>
</div>

</div>

<script>

document.addEventListener('DOMContentLoaded', async () => {

    let video = document.getElementById('video');
    let faceCaptured = false;
    let modelsLoaded = false;

    // CAMERA
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
    } catch (error) {
        alert("Camera blocked");
        return;
    }

    // MODELS
    try {
        await Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('/models')
        ]);

        modelsLoaded = true;

        document.getElementById('statusBox').innerHTML = "✔ System Ready";
        document.getElementById('statusBox').className =
            "mb-5 text-sm p-3 rounded-xl bg-green-100 text-green-700 border border-green-200";

    } catch (error) {
        document.getElementById('statusBox').innerHTML =
            "❌ Face system failed to load";
        return;
    }

    // CAPTURE FACE
    window.captureFace = async function () {

        if (!modelsLoaded) return alert("System still loading");

        const detection = await faceapi
            .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) return alert("No face detected");

        const descriptor = Array.from(detection.descriptor);
        document.getElementById('face_descriptor').value = JSON.stringify(descriptor);

        let canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);

        let imageData = canvas.toDataURL('image/png');
        document.getElementById('face_image').value = imageData;

        // SHOW PREVIEW (IMPORTANT FIX)
        let preview = document.getElementById('previewImage');
        preview.src = imageData;
        preview.classList.remove('hidden');

        faceCaptured = true;

        alert("Face captured successfully");
    }

    // SUBMIT
    document.getElementById('registerForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!faceCaptured) return alert("Please capture your face first");

        let formData = new FormData(this);

        try {
            let res = await fetch('/student/register', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            let data = await res.json();

            // DEBUG (important)
            console.log(data);

            if (data.success === true) {

                document.getElementById('statusBox').innerHTML =
                    "✔ Registration successful. Redirecting...";

                setTimeout(() => {
                    window.location.href = "/student/login";
                }, 1200);

            } else {
                alert(data.message || "Registration failed");
            }

        } catch (error) {
            console.error(error);
            alert("Server error");
        }

    });

});

</script>

</body>
</html>
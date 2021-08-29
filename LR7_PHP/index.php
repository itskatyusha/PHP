<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="font-body bg-blue-100">

<div class="">
    <div class="w-full">
        <div class="m-auto w-max">
            <a class="flex flex-row items-center content-center" href="">
                <div class="flex items-center h-20">
                    <div class="text-green-800 text-5xl font-bold">
                        Geocoder
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container">
<form id="form" method="post">
    <div class="flex flex-row content-center items-center">
        <h5 class="text-lg pl-10 mr-5">Введите адрес:</h5>
        <input id="input_address" name="address" class="w-3/5 px-3 py-4" placeholder="Адрес" type="text">
    </div>
    <div class="container mx-auto text-center mt-6 mb-8">
        <button type="submit" class="bg-green-600 hover:bg-gray-800 text-white py-2 px-4 rounded-full text-lg">
            Найти ближайшее метро
        </button>
    </div>
</form>

<div class="result">
    <div class="flex flex-row content-center items-center">
        <h5 class="text-lg pl-10">Адрес: </h5>
        <h5 id="address" class="text-lg pl-5"></h5>
    </div>
    <div class="flex flex-row content-center items-center">
        <h5 class="text-lg pl-10">Координаты:</h5>
        <h5 id="coordinates" class="text-lg pl-5"></h5>
    </div>
    <div class="flex flex-row content-center items-center">
        <h5 class="text-lg pl-10">Ближайшее метро:</h5>
        <h5 id="subway" class="text-lg pl-5"></h5>
    </div>
</div>
</div>

</body>

<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</html>
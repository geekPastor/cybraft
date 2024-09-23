<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identité Numérique</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-yellow-500 flex items-center justify-center min-h-screen">
    <div class="text-center p-8 bg-yellow-500">
        <img src="./logo.png" alt="Logo" class="mx-auto mb-4 w-1/6">
        <h2 class="font-semibold mb-4 text-3xl">Créez votre identité numérique en un clic</h2>
        <p class="text-xl mb-6 ">Construisez un profil qui vous ressemble et partagez-le facilement avec le monde</p>
        <a class="bg-black text-white font-bold py-2 px-6 rounded-full text-2xl" href="{{Route('login')}}">CRÉER</a>
    </div>
</body>
</html>

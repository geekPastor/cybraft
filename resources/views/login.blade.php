@extends("base")
@section("content")
<div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full m-8">
    <h1 class="text-2xl font-bold mb-6 text-center">connexion</h1>
<form action={{Route('login')}} method="POST">
    @csrf
    <div>
        <label for="nom_entite" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" placeholder="saisissez votre email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div>
        <label for="nom_entite" class="block text-sm font-medium text-gray-700">mot de passe</label>
        <input type="password" name="password" placeholder="saisissez votre mot de passe"  required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    
    <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" type="submit">se connecter</button>
    <a class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 inline-block text-center" href="https://wa.me/243829255398">contacter l'admin</a>
 </form>
</div>
@endsection
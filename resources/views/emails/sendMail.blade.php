<x-mail::message>
# Introduction

### Mail de : {{$data["email"]}}
### Téléphone : {{$data["phone"]}}
### Adresse : {{$data["adresse"]}}

{{$data['notes']}}


{{ config('app.name') }}
</x-mail::message>

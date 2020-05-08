@extends('templates.email')

@section('email.subject', $subject)

@section('email.content')
<h1>{{ $subject }}</h1>
<p>
    Une nouvelle commande a été passé sur le site. <br>
    Vous pouvez la consulter en <a href="{{ route('admin.order.edit', ['order' => $order]) }}">cliquant ici</a>.
</p>
@endsection

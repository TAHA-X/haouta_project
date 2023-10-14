
@foreach ($achats as $achat)
    <tr>
        <td>{{ $achat->id }}</td>
        <td>{{ $achat->client->fname }}</td>
        <td>{{ $achat->client->lname }}</td>
        <td>{{ $achat->client->phone }}</td>
        <td>{{ $achat->produit->title }}</td>
        <td>
            <a class="btn btn-danger" onclick="return confirm('voulez vous vraiment supprimer cet achat ?')" href="{{route('partenaire.achats.delete',$achat->id)}}"><i class="bi bi-trash3-fill"></i></a>
        </td>
    </tr>
@endforeach

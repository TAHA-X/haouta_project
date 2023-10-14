
@foreach ($users as $user)
    <tr>
        <td>{{ $user->fname }}</td>
        <td>{{ $user->lname }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>   
                @if($user->points==null)
                   <div class="badge badge-danger">0</div>  
                @else
                    <div class="badge badge-success">{{ $user->points }}</div>
                @endif
        </td>
        <td>
            <a class="btn btn-danger" onclick="return confirm('voulez vous vraiment supprimer cet user ?')" href="{{route('partenaire.users.delete',$user->id)}}"><i class="bi bi-trash3-fill"></i></a>
            <a class="btn btn-primary"  href="{{route('partenaire.users.edit',$user->id)}}"><i class="bi bi-pen"></i></a>
        </td>
    </tr>
@endforeach

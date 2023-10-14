@foreach ($cadeaux as $cadeau)
    <tr>

        <td>{{ $cadeau->title }}</td>
        <td>{{ $cadeau->max_points }}</td>
        <td>{{ $cadeau->counter }}</td>

       
        <td>
            <a class="btn btn-danger" onclick="return confirm('voulez vous vraiment supprimer cet cadeau ?')"
                href="{{ route('admin.cadeaux.delete', $cadeau->id) }}"><i class="bi bi-trash3-fill"></i></a>
            <a class="btn btn-primary" href="{{ route('admin.cadeaux.edit', $cadeau->id) }}"><i
                    class="bi bi-pen"></i></a>
        </td>
    </tr>
@endforeach

@extends('frontend_home.leftmenu')


@foreach($depts as $key => $dept)
<tr>

    <td>{{ $key + 1 }}</td>
    <td>{{ $dept->department_name }}</td>
    <td>{{ $dept->add_by }}</td>
    <td>{{ $dept->add_date }}</td>
    <td>{{ $dept->add_time }}</td>
    <td>{{ $dept->update_by }}</td>
    <td>{{ $dept->update_date }}</td>
    <td>{{ $dept->update_time }}</td>
    <td>{{ $dept->flag }}</td>
    <!-- You can add additional columns here if needed -->
    {{-- <td>
        <!-- Update action link with encrypted ID -->
        <a href="{{ route('department.edit', $department->tbl_department_id) }}">Update</a>
        <!-- Delete action form with encrypted ID -->
        <form action="{{ route('department.destroy', $department->tbl_department_id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td> --}}
</tr>
@endforeach

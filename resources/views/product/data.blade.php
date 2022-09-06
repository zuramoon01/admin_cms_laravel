<x-dashboard.layout :name="$name" :menu="$menu">

    <x-dashboard.table :title="$title">
        <colgroup>
            @foreach ($table['size'] as $size)
                <col class="col-md-{{ $size }}">
            @endforeach
        </colgroup>
        <thead>
            <tr>
                @foreach ($table['title'] as $title)
                    <th>{{ $title }}</th>
                @endforeach

                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                @foreach ($table['title'] as $title)
                    <th>{{ $title }}</th>
                @endforeach

                <th class="text-center">Action</th>
            </tr>
        </tfoot>

        <tbody>
            @foreach ($table['data'] as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->code }}</td>
                    <td>{{ $data->productCategory->category }}</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->purchase_price }}</td>
                    <td>{{ $data->short_description }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->new_product }}</td>
                    <td>{{ $data->best_seller }}</td>
                    <td>{{ $data->featured }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="/products/{{ $data->id }}/edit" class="btn btn-warning btn-circle btn-sm mx-1">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="/products/{{ $data->id }}/delete" method="post">
                                @csrf

                                @method('delete')

                                <button class="btn btn-danger btn-circle btn-sm mx-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-dashboard.table>

</x-dashboard.layout>

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
                    <td>{{ $data->transaction_id }}</td>
                    <td>{{ $data->customer_name }}</td>
                    <td>{{ $data->customer_email }}</td>
                    <td>{{ $data->customer_phone }}</td>
                    <td>{{ $data->sub_total }}</td>
                    <td>{{ $data->total }}</td>
                    <td>{{ $data->total_purchase }}</td>
                    <td>{{ $data->additional_request }}</td>
                    <td>{{ $data->payment_method }}</td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            @if ($data->status === 1)
                                <a href="/transactions/{{ $data->id }}/edit"
                                    class="btn btn-warning btn-circle btn-sm mx-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endif
                            <form action="/transactions/{{ $data->id }}/delete" method="post">
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

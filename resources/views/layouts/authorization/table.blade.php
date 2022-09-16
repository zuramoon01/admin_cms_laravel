<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
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
                </tr>
            </thead>

            <tbody>
                @foreach ($table['menus'] as $menu)
                    <tr>
                        <td data-id={{ $menu->id }}>{{ $menu->menu_name }}</td>
                        @foreach ($table['authorization_types'] as $type)
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="true"
                                        name="authorization_types[]" id="{{ $type->type_name }}"
                                        @foreach ($table['authorizations'] as $authorization)
                                            @if ($authorization->menu->id === $menu->id && $authorization->authorization_type->id === $type->id) checked @endif @endforeach>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
